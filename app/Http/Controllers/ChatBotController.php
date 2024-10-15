<?php
// app/Http/Controllers/ChatBotController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Chat;
use Exception;

class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
        // Validar entrada
        $request->validate([
            'input' => 'required|string|max:5000',
            'chat_id' => 'nullable|exists:chats,id', // Validar que chat_id sea un ID de un chat existente
        ]);
    
        try {
           
            $pacienteId = auth('paciente')->user()->id;
    
            // Obtener el chat actual o crear uno nuevo
            $chat = Chat::find($request->input('chat_id'));

            if (strlen($request->input('input')) > 500) {
                return response()->json(['error' => 'El nombre del chat es demasiado largo.'], 400);
            }
            
            if (!$chat) {
                // Si no existe un chat, creamos uno nuevo
                $chat = Chat::create([
                    'paciente_id' => $pacienteId,
                    'name' => $request->input('input'), // Nombre del chat será la primera pregunta
                ]);
            }
    
            // Llamar a la API de OpenAI para obtener la respuesta
            $client = new Client();
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4o',
                    'messages' => [
                        ['role' => 'user', 'content' => $request->input('input')],
                    ],
                ],
            ]);
    
            // Obtener la respuesta de la API
            $result = json_decode($response->getBody(), true);
            $responseText = $result['choices'][0]['message']['content'];
    
            // Guardar la pregunta y la respuesta en la tabla chat_messages
            $chat->messages()->create([
                'question' => $request->input('input'),
                'response' => $responseText,
            ]);
    
            // Retornar la respuesta con el chat_id
            return response()->json(['response' => $responseText, 'chat_id' => $chat->id]);
    
        } catch (RequestException $e) {
            // Capturar errores de la API
            return response()->json(['error' => 'Error al comunicarse con la API: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            // Capturar cualquier otro error
            return response()->json(['error' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }
    

    

      

    public function getChats()

    {
           
         if (!auth('paciente')->check()) {
           return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para ver su historial de chats.');
        }

        // Obtener el ID del paciente autenticado
         $pacienteId = auth('paciente')->user()->id;

          // Obtener solo los chats que pertenecen al paciente autenticado
          $chats = Chat::where('paciente_id', $pacienteId)->get();

          // Retornar la vista con los chats del paciente
          return view('chat_historial', compact('chats'));
    }

    public function showChat()
    {
        // Puedes asignar un valor inicial a $chat_id, por ejemplo, null
         $chat_id = null; // O el ID del chat que deseas cargar

         return view('chat', compact('chat_id'));
    }
    public function viewChat($chat_id)
    {
         // Obtener el chat con el ID proporcionado
         $chat = Chat::with('messages')->findOrFail($chat_id);

         // Retornar la vista del historial del chat
         return view('chat-view', compact('chat'));
    }



    public function index()
    {
        // Retornar la vista principal de los chats
        return view('chat');
    }



}
