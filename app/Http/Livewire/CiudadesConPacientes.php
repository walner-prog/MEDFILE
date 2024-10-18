<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;

class CiudadesConPacientes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Estilo de paginación
    public $searchCiudad = ''; // Filtro de búsqueda por ciudad
    public $perPage = 10; // Cantidad de elementos por página

    public function getCiudadesConPacientes()
    {
        // Obtener las ciudades/localidades que tienen pacientes registrados
        $query = Paciente::select('departamento') // Selecciona solo una vez
            ->whereNotNull('departamento')
            ->groupBy('departamento')
            ->selectRaw('COUNT(*) as pacientes_count'); // Solo cuenta los pacientes

        // Filtrar por ciudad
        if ($this->searchCiudad) {
            $query->where('departamento', 'LIKE', '%' . $this->searchCiudad . '%'); // Búsqueda por ciudad
        }

        return $query->paginate($this->perPage); // Paginación del resultado
    }

    public function render()
    {
        // Obtener los totales de hombres y mujeres
        $totalHombres = Paciente::where('sexo', 'M')->count();
        $totalMujeres = Paciente::where('sexo', 'F')->count();

        return view('livewire.ciudades-con-pacientes', [
            'ciudadesConPacientes' => $this->getCiudadesConPacientes(),
            'totalHombres' => $totalHombres,
            'totalMujeres' => $totalMujeres,
        ]);
    }
}
