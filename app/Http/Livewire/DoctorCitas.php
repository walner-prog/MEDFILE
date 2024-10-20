<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class DoctorCitas extends Component
{
    public $citas;

    public function mount()
    {
        // Obtener el doctor autenticado
        $doctor = Auth::user(); 

        // Filtrar las citas por el id del doctor autenticado
        $this->citas = Cita::with('paciente', 'especialidad')
                           ->where('doctor_id', $doctor->id)
                           ->paginate();
    }

    public function render()
    {
        return view('livewire.doctor-citas');
    }
}
