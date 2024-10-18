<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HistoriaClinica;
use App\Models\Paciente;

class EnfermedadesConPacientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // Tema de paginación de Bootstrap
    public $searchEdad = ''; // Filtro por edad
    public $searchSexo = ''; // Filtro por sexo
    public $perPage = 10;    // Cantidad de elementos por página

    public function getEnfermedadesConPacientes()
    {
        // Obtener las enfermedades crónicas y contar el número de pacientes que tienen cada enfermedad
        $query = HistoriaClinica::join('pacientes', 'historias_clinicas.paciente_id', '=', 'pacientes.id')
            ->select('historias_clinicas.enfermedades_cronicas') // Selecciona solo una vez
            ->whereNotNull('historias_clinicas.enfermedades_cronicas') // Solo enfermedades no nulas
            ->groupBy('historias_clinicas.enfermedades_cronicas') // Agrupamos correctamente
            ->selectRaw('COUNT(*) as pacientes_count'); // Solo cuenta los pacientes

        // Filtrar por edad y sexo
        if ($this->searchEdad) {
            $query->where('pacientes.edad', $this->searchEdad);
        }

        if ($this->searchSexo) {
            // Asegúrate de que el sexo sea "M" o "F"
            $query->where('pacientes.sexo', $this->searchSexo);
        }

        return $query->paginate($this->perPage); // Paginación del resultado
    }

    public function render()
    {
        return view('livewire.enfermedades-con-pacientes', [
            'enfermedadesConPacientes' => $this->getEnfermedadesConPacientes(),
            'totalPacientes' => Paciente::count() // Total de pacientes
        ]);
    }
}
