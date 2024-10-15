<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;

class IaPacientes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = ''; // Propiedad para el término de búsqueda

    public function render()
    {
        // Normalizar la búsqueda
        $searchTerm = trim($this->search);
        $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);
        
        Log::info('Valor de búsqueda normalizado:', [$searchTerm]);
        
        // Obtener pacientes con sus historias clínicas y paginación
        $pacientes = Paciente::with('historiasClinicas') // Asegúrate de que la relación está correctamente definida en el modelo Paciente
            ->where(function ($query) use ($searchTerm) {
                // Dividir el término de búsqueda en palabras
                $searchWords = explode(' ', $searchTerm);

                foreach ($searchWords as $word) {
                    // Asegúrate de que la palabra no esté vacía
                    if (!empty($word)) {
                        Log::info('Buscando palabra:', [$word]); // Log para ver cada palabra que se busca

                        $query->orWhere(function ($subQuery) use ($word) {
                            $subQuery->where('no_expediente', 'like', '%' . $word . '%')
                                     ->orWhere('primer_nombre', 'like', '%' . $word . '%')
                                     ->orWhere('segundo_nombre', 'like', '%' . $word . '%')
                                     ->orWhere('primer_apellido', 'like', '%' . $word . '%')
                                     ->orWhere('segundo_apellido', 'like', '%' . $word . '%')
                                     ->orWhere('no_cedula', 'like', '%' . $word . '%');
                        });
                    }
                }
            })
            ->paginate(5);

        Log::info('Tipo de variable pacientes:', [gettype($pacientes)]);
        Log::info('Resultados de búsqueda:', [$pacientes->items()]); // Aquí usamos items() para obtener los modelos
        
        return view('livewire.ia-pacientes', [
            'pacientes' => $pacientes,
            'noResults' => $pacientes->isEmpty(), // Manejo de no resultados
        ]);
    }
}
