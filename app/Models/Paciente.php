<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'no_expediente',
        'fecha',
        'establecimiento_salud',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'edad',
        'sexo',
        'raza_etnia',
        'no_cedula',
        'categoria',
        'no_inss',
        'estado_civil',
        'telefono',
        'correo',
        'direccion',
        'nombre_responsable',
      
        'escolaridad',
        'ocupacion',
        'direccion_residencia',
        'localidad',
        'municipio',
        'departamento',
       
        'parentesco',
        'telefono_responsable',
        'direccion_responsable',
        'empleador',
        'direccion_empleador'
    ];

  

       // Definir la relación con el modelo Emergencia
       public function emergencias()
       {
           return $this->hasMany(Emergencia::class, 'paciente_id');
       }
   
       // Definir la relación con el modelo InformeCondicionDiaria
       public function informesCondicionDiaria()
       {
           return $this->hasMany(InformeCondicionDiaria::class, 'paciente_id');
       }
   
       // Definir la relación con el modelo ListaProblema
      public function listaProblemas()
      {
        return $this->hasMany(ListaProblema::class, 'paciente_id');
      }

       // Definir la relación con el modelo HistoriaClinica
      public function historiasClinicas()
     {
        return $this->hasMany(HistoriaClinica::class, 'paciente_id');
     }

     // Definir la relación con el modelo NotaEvolucionTratamiento
    public function notasEvolucionTratamiento()
    {
        return $this->hasMany(NotaEvolucionTratamiento::class, 'paciente_id');
    }

       // Definir la relación con el modelo ControlMedicamento
    public function controlMedicamentos()
    {
        return $this->hasMany(ControlMedicamento::class, 'paciente_id');
    }

    public function registrosAdmisionEgresoHospitalario()
    {
        return $this->hasMany(RegistroAdmisionEgresoHospitalario::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
    
}
