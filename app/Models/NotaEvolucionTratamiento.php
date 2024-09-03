<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaEvolucionTratamiento extends Model
{
    use HasFactory;

    protected $table = 'notas_evolucion_tratamiento';

    protected $fillable = [
        'paciente_id',
        'establecimiento_salud',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'no_expediente',
        'no_cedula',
        'servicio',
        'no_cama',
        'sala',
        'no_inss',
        'fecha_hora',
        'problemas_evolucion',
        'planes',
        'participantes_atencion',
        'firma_codigo_profesional',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
