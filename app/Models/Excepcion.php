<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excepcion extends Model
{

    protected $table = 'excepciones';
    protected $fillable = [
        'doctor_id', 'fecha', 'hora_inicio', 'hora_fin', 'tipo'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
