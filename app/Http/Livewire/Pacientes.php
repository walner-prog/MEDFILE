<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;

class Pacientes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $no_expediente, $fecha, $establecimiento_salud, $nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $edad, $sexo, $raza_etnia, $no_cedula, $categoria, $no_inss, $estado_civil, $telefono, $correo, $direccion, $nombre_responsable, $escolaridad, $ocupacion, $direccion_residencia, $localidad, $municipio, $departamento, $responsable_emergencia, $parentesco, $telefono_responsable, $direccion_responsable, $empleador, $direccion_empleador, $pacienteId;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.pacientes', [
            'pacientes' => Paciente::all(),
        ]);
    }

   
}

