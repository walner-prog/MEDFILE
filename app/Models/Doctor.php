<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    // Los campos que pueden ser asignados masivamente
    protected $fillable = [
        'codigo',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'cedula',
        'telefono',
        'email',
        'especialidad_id',
        'departamento_id',
        'fecha_contratacion',
        'estado',
        'horario_trabajo',
        'direccion',
        'foto',
        'fecha_nacimiento',
        'sexo',
        'usuario_id',
    ];

    // Relaciones
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }


    public function horarios()
   {
    return $this->hasMany(HorarioDoctor::class);
   }

    public function isAvailable($fecha_cita, $hora_cita)
  {
    // Verificar si existe un horario disponible en esa fecha y hora
    $horario = $this->horarios()
        ->where('fecha', $fecha_cita)
        ->where('hora_inicio', '<=', $hora_cita)
        ->where('hora_fin', '>=', $hora_cita)
        ->first();

    if (!$horario) {
        return false; // No hay un horario disponible
    }

    // Verificar si ya hay una cita agendada en esa fecha y hora
    return !$this->citas()
        ->where('fecha_cita', $fecha_cita)
        ->where('hora_cita', $hora_cita)
        ->exists();
   }

    
}
