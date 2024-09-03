<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
    protected $table = 'especialidades';

    protected $fillable = ['nombre', 'descripcion'];

    public function doctores()
    {
        return $this->hasMany(Doctor::class);
    }

  

public function consultas()
{
    return $this->hasManyThrough(Consulta::class, Doctor::class, 'especialidad_id', 'doctor_id');
}

}
