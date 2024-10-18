<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use Carbon\Carbon;

class PacientesPorEnfermedad extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Configura el tema de la paginación
    public $searchAnio = ''; // Filtro por año
    public $searchMes = '';  // Filtro por mes

    public function render()
    {
        // Consulta para obtener la enfermedad con más pacientes
        $enfermedad = HistoriaClinica::select('enfermedades_cronicas')
            ->whereNotNull('enfermedades_cronicas')
            ->groupBy('enfermedades_cronicas')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $totalPacientes = Paciente::count();

        if (!$enfermedad) {
            return view('livewire.pacientes-por-enfermedad', [
                'pacientes' => collect(), 
                'enfermedad' => null, 
                'totalPacientes' => $totalPacientes, 
                'porcentaje' => 0
            ]);
        }

        // Consulta de pacientes con la enfermedad más común
        $pacientes = Paciente::whereHas('historiasClinicas', function ($query) use ($enfermedad) {
            $query->where('enfermedades_cronicas', $enfermedad->enfermedades_cronicas);
        })
        ->when($this->searchAnio, function($query) {
            // Asegurarse de que el filtro por año se aplique correctamente
            if ($this->searchAnio) {
                $query->whereYear('fecha_nacimiento', $this->searchAnio);
            }
        })
        ->when($this->searchMes, function($query) {
            // Asegurarse de que el filtro por mes se aplique correctamente
            if ($this->searchMes) {
                $query->whereMonth('fecha_nacimiento', $this->searchMes);
            }
        })
        ->paginate(10); // Aquí implementas la paginación

        $porcentaje = $totalPacientes > 0 ? ($pacientes->count() / $totalPacientes) * 100 : 0;

        return view('livewire.pacientes-por-enfermedad', compact('pacientes', 'enfermedad', 'totalPacientes', 'porcentaje'));
    }
}
