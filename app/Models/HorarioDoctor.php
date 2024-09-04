<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioDoctor extends Model
{
    use HasFactory;

    protected $table = 'horarios_doctor';

    protected $fillable = [
        'doctor_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'duracion_cita',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
