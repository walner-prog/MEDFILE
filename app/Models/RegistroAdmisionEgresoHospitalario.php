<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAdmisionEgresoHospitalario extends Model
{
    use HasFactory;

    protected $table = 'registro_admision_egreso_hospitalario';

    protected $fillable = [
        'paciente_id',
        'establecimiento_salud',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'no_expediente',
        'nacionalidad',
        'no_cedula',
        'estado_civil',
        'escolaridad',
        'categoria_paciente',
        'no_inss',
        'sexo',
        'direccion_residencia',
        'municipio',
        'localidad',
        'departamento',

        'raza_etnia',
        'edad',
        'ocupacion',
        'nombre_madre',
        'nombre_padre',

        'urgencia_avisar',
        'direccion_telefono_avisar',
        'ingreso',
        'empleador',
        'direccion_empleador',
        'municipio_distrito',
      
        
       
        'parentesco',
        'diagnostico_ingreso',
        'forma_llegada_hospital',
        'reingreso_mismo_diagnostico',
        'sitio_ingreso_hospitalario',
        'nombre_medico',
        'sello_medico_ingreso',
        'egreso_fecha',
        'egreso_hora',
        'diagnostico_egreso',
        'diagnostico_egreso_principal',
        'diagnostico_egreso_complementarios',
        'cirugias_realizadas',
        'nombre_admisionista',
        'dias_estancia',
        'accidente_trabajo',
        'de_trayecto',
        'enfermedad_laboral',
        'causa_trauma',
        'infeccion_intrahospitalaria',
        'referido_otro_establecimiento',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
