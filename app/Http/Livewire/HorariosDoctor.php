<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HorarioDoctor;
use App\Models\Doctor;
use App\Models\Consultorio; // Make sure to import the Consultorio model

class HorariosDoctor extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Bootstrap pagination theme
    public $searchDoctor = ''; // Filter by doctor's name
    public $searchDia = ''; // Filter by day of the week
    public $perPage = 6; // Items per page

    protected $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']; // Weekdays

    public function render()
    {
        // Fetching horarios with filters
        $horarios = HorarioDoctor::with('doctor', 'consultorio')
            ->when($this->searchDoctor, function ($query) {
                $query->whereHas('doctor', function ($query) {
                    $query->where('primer_nombre', 'like', '%' . $this->searchDoctor . '%')
                          ->orWhere('primer_apellido', 'like', '%' . $this->searchDoctor . '%');
                });
            })
            ->when($this->searchDia, function ($query) {
                $query->where('dia_semana', $this->searchDia);
            })
            ->paginate($this->perPage); // Paginated result
    
        return view('livewire.horarios-doctor', [
            'horarios' => $horarios,
            'doctores' => Doctor::all(), // Consider using pagination or AJAX if the list is large
            'consultorios' => Consultorio::all(), // Asegúrate de no paginar aquí si solo quieres todos los consultorios
            'dias' => $this->dias, // Pass days for use in the view
        ]);
    }
    
}
