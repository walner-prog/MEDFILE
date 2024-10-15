<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoevaluacion extends Model
{
    use HasFactory;
    protected $table = 'autoevaluaciones';
    protected $fillable = [
        'paciente_id',
        'horas_sueno',
        'historia_enfermedad_actual',
        'enfermedades_cronicas',
        'diagnostico_medico',
        'nivel_estres',
        'sintomas_mentales',
        'calidad_vida',
        'pregunta_1',
        'pregunta_2',
        'pregunta_3',
        'pregunta_4',
        'pregunta_5',
        'pregunta_6',
        'pregunta_7',
        'pregunta_8',
        'pregunta_9',
        'pregunta_10',
        'pregunta_11',
        'pregunta_12',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}

