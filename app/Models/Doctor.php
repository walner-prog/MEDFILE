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

   
   public function isAvailable($fecha, $hora, $duracion_cita)
  {
    $dia_semana = \Carbon\Carbon::parse($fecha)->format('l'); // Nombre del día en inglés
    
    $horario = $this->horarios()->where('dia_semana', strtolower($dia_semana))
                                ->whereTime('hora_inicio', '<=', $hora)
                                ->whereTime('hora_fin', '>=', $hora)
                                ->first();
    
    if (!$horario) {
        return false;
    }

    // Verificar si la duración de la cita cabe en el horario disponible
    $hora_fin_cita = \Carbon\Carbon::createFromFormat('H:i', $hora)->addMinutes($duracion_cita)->format('H:i');
    return \Carbon\Carbon::createFromFormat('H:i', $hora_fin_cita)->lessThanOrEqualTo($horario->hora_fin);
}

    
}
