<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'no_expediente',
        'paciente_id',
        'doctor_id',
        'especialidad_id',
        'fecha_cita',
        'hora_cita',
        'tipo_cita',
        'descripcion_cita',
        'estado',
        'title',
        'consultorio_id',
        'start', 
        'end',
        'color',
        
    ];
  

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
