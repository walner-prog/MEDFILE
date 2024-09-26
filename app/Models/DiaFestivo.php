<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaFestivo extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'dias_festivos';

    // Atributos que pueden ser asignados en masa
    protected $fillable = ['fecha', 'descripcion'];
    
    // Definir que la fecha es un tipo de dato 'date'
    protected $dates = ['fecha'];
}
