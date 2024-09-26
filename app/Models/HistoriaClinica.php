<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $table = 'historias_clinicas';

    protected $fillable = [
        'paciente_id',
        
        'hora',
        'sala',
       
        'no_cama',
       
        'fecha_nacimiento',
        'lugar_nacimiento',
       
        'procedencia',
        'religion',
       
        'escolaridad',
        'direccion_habitual',
        'nombre_padre',
        'fuente_informacion',
        'profesion_oficio',
        'nombre_madre',
        'confiabilidad',
        'motivo_consulta',
        'historia_enfermedad_actual',
        'interrogatorio_aparatos_sistemas',

        'enfermedades_infecto_contagiosas',
        'enfermedades_hereditarias',

        'inmunizaciones_completas',
        'detalle_inmunizaciones',
        'horas_sueno',
        'horas_laborales',
        'tipo_hora_actividad_fisica',
        'tabaco',
        'tipo_tabaco',
        'edad_inicio_tabaco',
        'cantidad_frecuencia_tabaco',
        'edad_abandono_tabaco',
        'duracion_habito_tabaco',

        'alcohol',
        'tipo_alcohol',
        'cantidad_frecuencia_alcohol',
        'edad_inicio_alcohol',
        'edad_abandono_alcohol',
        'duracion_habito_alcohol',

        'drogas_ilegales',
        'tipo_drogas',
        'cantidad_frecuencia_drogas',
        'edad_inicio_drogas',
        'edad_abandono_drogas',
        'duracion_habito_drogas',
        'farmacos',

        'edad_abandono_farmacos',
        'cantidad_frecuencia_farmacos',
        'duracion_habito_farmacos',
        'num_medicamentos_actuales',
        'nombre_posologia_farmacos',
        'otros_habitos',
        'enfermedades_infecto',
        
        'enfermedades_cronicas',
        'cirugias_previas',
        'hospitalizaciones',
        'menarca',
        'gesta',
        'fur',
        'inicio_vida_sexual',
        'para',
        'cesarea',
        'num_companeros_sexuales',
        'aborto',
        'legrado',
        'semanas_amenorrea',
        'menopausia',
        'fecha_menopausia',
        'planificacion_familiar',
        'metodo_planificacion',
        'sustitucion_hormonal',
        'especificar_sustitucion_hormonal',
        'pap',
        'resultado_fecha_pap',
        
        'trabajo_actual',
        'lugar_trabajo',
        'area_labora',
        'oficio_categoria',
        'anos_oficio_trabajo_actual',
        'dia_laboral_horas',
        'tipo_horario',
        'horas_semanales',
        'descripcion_trabajo_actual',
        'exposicion_sustancias',
        'descripcion_exposicion',
        'frecuencia_intensidad_tarea',
        'posicion_trabajo',
        'trabajos_fuera_empleo',
        'horas_extras',
        'antecedentes_laborales',
        'fecha_inicio',
        'puesto_trabajo',
        'anos_trabajados',
        'fecha_conclusion',
        'signos_vitales',
        'fc',
        'fr',
        'ta',
        'temperatura',
        'datos_antropometricos',
        'peso',
        'talla',
        'area_superficie_corporal',
        'imc',
        'aspecto_general',
        'piel_mucosas',
        'craneo',
        'ojos',
        'orejas',
        'nariz',
        'boca',
        'cuello',
        'caja_toracica',
        'mamas',
        'campos_pulmonares',
        'cardiaco',
        'abdomen_pelvis',
        'extremidades_superiores',
        'extremidades_inferiores',
        'genitourinario',
        'examen_ginecologico',
        'examen_neurologico',
        'observaciones_analisis',
        'diagnosticos_problemas',
        'nombre_elabora_historia',
        'firma_codigo_sello',
    ];

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
