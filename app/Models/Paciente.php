<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Paciente extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable; // Agrega el trait Authenticatable

    protected $table = 'pacientes';

    protected $fillable = [
        'no_expediente',
        'password',
        'fecha',
        'establecimiento_salud',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'edad',
        'sexo',
        'raza_etnia',
        'no_cedula',
        'categoria',
        'no_inss',
        'estado_civil',
        'telefono',
        'correo',
        'direccion',
        'nombre_responsable',
        'escolaridad',
        'ocupacion',
        'direccion_residencia',
        'localidad',
        'municipio',
        'departamento',
        'parentesco',
        'telefono_responsable',
        'direccion_responsable',
        'empleador',
        'direccion_empleador',
        'foto'
    ];

    // Definir las relaciones con otros modelos
    public function emergencias()
    {
        return $this->hasMany(Emergencia::class, 'paciente_id');
    }

    public function informesCondicionDiaria()
    {
        return $this->hasMany(InformeCondicionDiaria::class, 'paciente_id');
    }

    public function listaProblemas()
    {
        return $this->hasMany(ListaProblema::class, 'paciente_id');
    }

    public function historiasClinicas()
    {
        return $this->hasMany(HistoriaClinica::class, 'paciente_id');
    }

    public function notasEvolucionTratamiento()
    {
        return $this->hasMany(NotaEvolucionTratamiento::class, 'paciente_id');
    }

    public function controlMedicamentos()
    {
        return $this->hasMany(ControlMedicamento::class, 'paciente_id');
    }

    public function registrosAdmisionEgresoHospitalario()
    {
        return $this->hasMany(RegistroAdmisionEgresoHospitalario::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    /* public function getRouteKeyName()
    {
        return 'no_expediente';  // Usar el no_expediente en las rutas
    }  */
}
