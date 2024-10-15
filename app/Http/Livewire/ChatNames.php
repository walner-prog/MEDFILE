<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ChatNames extends Component
{
    use WithPagination; // Importar el trait de paginación

    protected $paginationTheme = 'bootstrap'; // Establecer el tema de paginación

    public function mount() 
    {
        // No es necesario obtener los chats aquí, ya que lo haremos en el render
    }

    public function render()
    {
        // Obtener los chats paginados del paciente autenticado
        $pacienteId = Auth::guard('paciente')->id();
        $chats = Chat::where('paciente_id', $pacienteId)->paginate(10); // Paginación de 5 por página

        return view('livewire.chat-names', ['chats' => $chats]);
    }
}
