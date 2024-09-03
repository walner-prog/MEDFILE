<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeCondicionDiaria extends Model
{
    use HasFactory;

    protected $table = 'informes_condicion_diaria';

    protected $fillable = [
        'paciente_id',
        'fecha',
        'servicio',
        'sala',
        'no_expediente',
        'fecha_hora_condicion',
        'tratamiento',
        'procedimientos',
        'brindada_por',
        'recibida_por',
        'firma_quien_recibe',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
