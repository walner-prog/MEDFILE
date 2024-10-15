<?php
namespace App\Http\Controllers;
 
//https://platform.openai.com/settings/organization/billing/overview 
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser; 
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;
class FileUploadController extends Controller
{
  
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,xlsx,xls|max:512000', // máximo 512 MB
            'purpose' => 'required|string',
        ]);
    
        // Manejar la carga del archivo
        $file = $request->file('file');
        $purpose = $request->input('purpose');
    
        // Guardar el archivo en el almacenamiento
        $path = $file->store('uploads');
        $text = '';
    
        try {
            // Procesar según el tipo de archivo
            if ($file->getClientOriginalExtension() === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($file->getRealPath());
                $text = $pdf->getText();
            } elseif ($file->getClientOriginalExtension() === 'docx') {
                // Cargar DOCX con PHPWord
                $phpWord = WordIOFactory::load($file->getRealPath());
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        // Si el elemento es un texto simple, agrega su texto
                        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                            // Procesar todos los elementos dentro de TextRun
                            foreach ($element->getElements() as $textElement) {
                                // Verifica si el elemento es de tipo Text
                                if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                    $text .= $textElement->getText() . "\n";
                                }
                            }
                        }
                        // También verifica si el elemento puede contener texto directamente
                        elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text .= $element->getText() . "\n";
                        }
                    }
                }
                
            } elseif (in_array($file->getClientOriginalExtension(), ['xlsx', 'xls'])) {
                // Cargar XLSX/XLS con PHPSpreadsheet
                $spreadsheet = SpreadsheetIOFactory::load($file->getRealPath());
                $worksheet = $spreadsheet->getActiveSheet();
                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                    foreach ($cellIterator as $cell) {
                        $text .= $cell->getValue() . " ";
                    }
                    $text .= "\n";
                }
            }
    
            // Dividir el texto en fragmentos y analizar con OpenAI
            $chunks = $this->splitTextIntoChunks($text, 7000);
            $analysisResults = [];
    
            // Inicializar Guzzle Client para hacer solicitudes a OpenAI
            $client = new Client();
    
            foreach ($chunks as $index => $chunk) {
                $inputResumen = "Fragmento " . ($index + 1) . ": Analiza el siguiente contenido del archivo de resultados médicos: " . $chunk;
                $response = $client->post('https://api.openai.com/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => 'gpt-4',
                        'messages' => [
                            ['role' => 'user', 'content' => $inputResumen],
                        ],
                    ],
                ]);
                $data = json_decode($response->getBody(), true);
                $analysisResult = $data['choices'][0]['message']['content'] ?? 'No se obtuvo respuesta';
                $analysisResults[] = "Fragmento " . ($index + 1) . ": " . $analysisResult;
            }
    
            $finalAnalysis = implode("\n\n", $analysisResults);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar el archivo: ' . $e->getMessage()], 500);
        }
    
        // Retornar la respuesta
        return response()->json([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'analysis' => $finalAnalysis,
        ]);
    }
    /**
     * Divide el texto en fragmentos más pequeños para cumplir con los límites de tokens.
     */
    private function splitTextIntoChunks($text, $maxLength)
    {
        $chunks = [];
    
        while (strlen($text) > $maxLength) {
            // Encuentra el último espacio dentro del límite
            $splitPos = strrpos(substr($text, 0, $maxLength), ' ');
            $chunks[] = substr($text, 0, $splitPos);
            $text = substr($text, $splitPos + 1);
        }
    
        // Añadir el fragmento restante
        if (!empty($text)) {
            $chunks[] = $text;
        }
    
        return $chunks;
    }
    
    

    // Método para listar archivos
    public function listFiles()
    {
        // Obtiene los archivos del almacenamiento
        $files = Storage::files('uploads');
        return response()->json($files);
    }

    // Método para recuperar un archivo por ID (puedes usar el nombre del archivo o un ID único)
    public function retrieveFile($filename)
    {
        if (Storage::exists('uploads/' . $filename)) {
            return response()->download(storage_path('app/uploads/' . $filename));
        } else {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }
    }

    // Método para eliminar un archivo
    public function deleteFile($filename)
    {
        if (Storage::exists('uploads/' . $filename)) {
            Storage::delete('uploads/' . $filename);
            return response()->json(['success' => 'Archivo eliminado correctamente.']);
        } else {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }
    }

    // Método para recuperar contenido del archivo (esto depende de cómo quieras implementarlo)
    public function retrieveFileContent($filename)
    {
        if (Storage::exists('uploads/' . $filename)) {
            $content = file_get_contents(storage_path('app/uploads/' . $filename));
            return response()->json(['content' => $content]);
        } else {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }
    }
}
