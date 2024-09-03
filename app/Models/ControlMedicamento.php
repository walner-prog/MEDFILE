<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlMedicamento extends Model
{
    use HasFactory;



    protected $fillable = [
        'paciente_id',
        'establecimiento_salud',
        'no_expediente',
        'no_cedula',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha',
        'hora',
        'no_inss',
        'servicio',
        'no_cama',
        'sala',
        'medicamentos_otros',
        'fecha_medicamentos',
        'hora_medicamentos',
        'medicamentos_stat_prn_preanestesico',
        'hora_medicamentos_stat_prn',
        'fecha_medicamentos_stat_prn',
        'nombre_enfermera_codigo',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
