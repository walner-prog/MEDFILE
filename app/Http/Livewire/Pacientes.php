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

    /**
     * public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'no_expediente' => 'nullable|string|max:10|unique:pacientes,no_expediente',
            'fecha' => 'nullable|date',
            'establecimiento_salud' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|in:M,F',
            'raza_etnia' => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:255',
            'correo'    => 'nullable|string|max:255|unique:pacientes,correo',
            'direccion' => 'nullable|string|max:255',
            'nombre_responsable' => 'nullable|string|max:255',
         
            'no_cedula' => 'nullable|string|max:255|unique:pacientes,no_cedula',
            'categoria' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'direccion_residencia' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'responsable_emergencia' => 'nullable|string|max:255',
            'parentesco' => 'nullable|string|max:255',
            'telefono_responsable' => 'nullable|string|max:255',
            'direccion_responsable' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'direccion_empleador' => 'nullable|string|max:255',

        ]);

        Paciente::updateOrCreate(['id' => $this->pacienteId], [
          'no_expediente' => $this->no_expediente,
            'fecha' => $this->fecha,
            'establecimiento_salud' => $this->establecimiento_salud,
            'nombre' => $this->nombre,
            'primer_apellido' => $this->primer_apellido,
            'segundo_apellido' => $this->segundo_apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'raza_etnia' => $this->raza_etnia,
            'no_cedula' => $this->no_cedula,
            'categoria' => $this->categoria,
            'no_inss' => $this->no_inss,
            'estado_civil' => $this->estado_civil,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'nombre_responsable' => $this->nombre_responsable,
            'escolaridad' => $this->escolaridad,
            'ocupacion' => $this->ocupacion,
            'direccion_residencia' => $this->direccion_residencia,
            'localidad' => $this->localidad,
            'municipio' => $this->municipio,
            'departamento' => $this->departamento,
            'responsable_emergencia' => $this->responsable_emergencia,
            'parentesco' => $this->parentesco,
            'telefono_responsable' => $this->telefono_responsable,
            'direccion_responsable' => $this->direccion_responsable,
            'empleador' => $this->empleador,
            'direccion_empleador' => $this->direccion_empleador,

        ]);

        session()->flash('message', $this->pacienteId ? 'Paciente actualizado.' : 'Paciente creado.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $this->pacienteId = $id;
        $this->no_expediente = $paciente->no_expediente;
        $this->fecha = $paciente->fecha;
        $this->establecimiento_salud = $paciente->establecimiento_salud;
        $this->nombre = $paciente->nombre;
        $this->primer_apellido = $paciente->primer_apellido;
        $this->segundo_apellido = $paciente->segundo_apellido;
        $this->fecha_nacimiento = $paciente->fecha_nacimiento;
        $this->edad = $paciente->edad;
        $this->sexo = $paciente->sexo;
        $this->raza_etnia = $paciente->raza_etnia;
        $this->no_cedula = $paciente->no_cedula;
        $this->categoria = $paciente->categoria;
        $this->no_inss = $paciente->no_inss;
        $this->estado_civil = $paciente->estado_civil;
        $this->telefono = $paciente->telefono;
        $this->correo = $paciente->correo;
        $this->direccion = $paciente->direccion;
        $this->nombre_responsable = $paciente->nombre_responsable;
        $this->escolaridad = $paciente->escolaridad;
        $this->ocupacion = $paciente->ocupacion;
        $this->direccion_residencia = $paciente->direccion_residencia;
        $this->localidad = $paciente->localidad;
        $this->municipio = $paciente->municipio;
        $this->departamento = $paciente->departamento;
        $this->responsable_emergencia = $paciente->responsable_emergencia;
        $this->parentesco = $paciente->parentesco;
        $this->telefono_responsable = $paciente->telefono_responsable;
        $this->direccion_responsable = $paciente->direccion_responsable;
        $this->empleador = $paciente->empleador;
        $this->direccion_empleador = $paciente->direccion_empleador;
        $this->isOpen = true;

    }

    public function delete($id)
    {
        Paciente::find($id)->delete();
        session()->flash('message', 'Paciente eliminado.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->no_expediente = '';
        $this->fecha = '';
        $this->establecimiento_salud = '';
        $this->nombre = '';
        $this->primer_apellido = '';
        $this->segundo_apellido = '';
        $this->fecha_nacimiento = '';
        $this->edad = '';
        $this->sexo = '';
        $this->raza_etnia = '';
        $this->no_cedula = '';
        $this->categoria = '';
        $this->no_inss = '';
        $this->estado_civil = '';
        $this->telefono = '';
        $this->correo = '';
        $this->direccion = '';
        $this->nombre_responsable = '';
        $this->escolaridad = '';
        $this->ocupacion = '';
        $this->direccion_residencia = '';
        $this->localidad = '';
        $this->municipio = '';
        $this->departamento = '';
        $this->responsable_emergencia = '';
        $this->parentesco = '';
        $this->telefono_responsable = '';
        $this->direccion_responsable = '';
        $this->empleador = '';
        $this->direccion_empleador = '';
        $this->pacienteId = '';

    }
     */
}

