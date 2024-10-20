<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class PacientesEnfermedadRenal extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchNombre = ''; // Búsqueda por nombre
    public $searchFecha = '';  // Búsqueda por fecha
    public $edadMin = '';      // Filtro por edad mínima
    public $edadMax = '';      // Filtro por edad máxima

    public function render()
    {
        $enfermedad = 'Enfermedad renal crónica'; // Enfermedad fija
    
        // Total de pacientes para calcular el porcentaje
        $totalPacientes = Paciente::count();
    
        // Consulta para obtener pacientes con la enfermedad
        $pacientes = Paciente::whereHas('historiasClinicas', function ($query) use ($enfermedad) {
            $query->where('enfermedades_cronicas', $enfermedad);
        })
        ->when($this->searchNombre, function($query) {
            // Filtro por nombre del paciente
            $query->where('primer_nombre', 'like', '%' . $this->searchNombre . '%')
                  ->orWhere('primer_apellido', 'like', '%' . $this->searchNombre . '%');
        })
        ->when($this->searchFecha, function($query) {
            // Filtro por fecha de nacimiento
            $query->whereDate('fecha_nacimiento', $this->searchFecha);
        })
        ->when($this->edadMin || $this->edadMax, function($query) {
            // Filtro por rango de edades
            $hoy = Carbon::now();
            if ($this->edadMin) {
                $query->whereYear('fecha_nacimiento', '<=', $hoy->subYears($this->edadMin)->format('Y'));
            }
            if ($this->edadMax) {
                $query->whereYear('fecha_nacimiento', '>=', $hoy->subYears($this->edadMax)->format('Y'));
            }
        })
        ->paginate(10); // Paginación de 10 resultados
    
        // Calcular porcentaje de pacientes con la enfermedad
        $porcentaje = $totalPacientes > 0 ? ($pacientes->total() / $totalPacientes) * 100 : 0;
    
        return view('livewire.pacientes-enfermedad-renal', compact('pacientes', 'enfermedad', 'totalPacientes', 'porcentaje'));
    }
}
