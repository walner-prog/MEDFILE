<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    // Define el nombre de la tabla asociada al modelo
    protected $table = 'consultas';

    // Define los campos que se pueden asignar en masa
    protected $fillable = [
        'fecha_consulta',
        'paciente_id',
        'doctor_id',
        'motivo_consulta',
        'diagnostico',
        'tratamiento_recomendado',
        'observaciones',
        'estado',
    ];

    // Define las relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
