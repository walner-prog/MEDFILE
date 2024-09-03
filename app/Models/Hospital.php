<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitales'; 

    protected $fillable = [
        'nombre_hospital',
        'ruc',
        'telefono_contacto',
        'direccion',
        'correo_contacto',
        'tipo_hospital',
        'numero_camas',
        'nivel_atencion',
    ];
}
