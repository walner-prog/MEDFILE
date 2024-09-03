<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;

    protected $table = 'emergencias';

    protected $fillable = [
        'paciente_id',
        'fecha',
        'hora',
        'no_expediente',
        'unidad_salud',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'edad',
        'sexo',
        'sala_servicio',
        'cama',
        'ocupacion',
        'direccion_residencia',
        'localidad',
        'departamento',
        'telefono',
        'no_inss',
        'no_cedula',
        'medio_llegada',
        'causa_accidente_violencia',
        'causa_tratamiento',
        'lugar_accidente_violencia',
        'vif',
        'direccion_avisar',
        'parentesco',
        'telefono_responsable',
        'localidad_avisar',
        'ciudad_avisar',
        'departamento_avisar',
        'peso',
        'talla',
        'temperatura',
        'nombre_quien_atiende',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'examen_fisico',
        'diagnostico',
        'planes',
        'diagnostico_egreso',
        'tipo_urgencia',
        'destino_paciente',
        'referencia',
        'hospitalizacion',
        'consulta_externa',
        'fuga',
        'salida_exigida'
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
