<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaProblema extends Model
{
    use HasFactory;

    protected $table = 'lista_problemas';

    protected $fillable = [
        'paciente_id',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'edad',
        'no_expediente',
        'servicio',
        'sala',
        'fecha',
        'nombre_problema',
        'inactivo',
        'resuelto',
        'establecimiento_salud',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
