<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $table = 'consultorios';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'capacidad',
        'telefono',
        'especialidad',
        'estado',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function horarios()
    {
        return $this->hasMany(HorarioDoctor::class);
    }

    
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
