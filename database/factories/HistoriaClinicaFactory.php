<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HistoriaClinicaFactory extends Factory
{
    protected $model = \App\Models\HistoriaClinica::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->lastName,
            'hora' => $this->faker->time(),
            'sala' => $this->faker->word,
            'no_expediente' => $this->faker->word,
            'no_cedula' => $this->faker->numerify('#######'),
            'no_inss' => $this->faker->numerify('#######'),
            'no_cama' => $this->faker->word,
            'edad' => $this->faker->numberBetween(1, 100),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2005-01-01'),
            'lugar_nacimiento' => $this->faker->randomElement(['Managua', 'León', 'Granada', 'Masaya', 'Chinandega']),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'procedencia' => $this->faker->word,
            'religion' => $this->faker->word,
            'grupos_etnicos' => $this->faker->word,
            'escolaridad' => $this->faker->word,
            'direccion_habitual' => $this->faker->streetAddress . ', ' . $this->faker->randomElement(['Managua', 'León', 'Granada', 'Masaya', 'Chinandega']) . ', Nicaragua',
            'nombre_padre' => $this->faker->randomElement(['José', 'María', 'Juan', 'Ana', 'Luis', 'Carmen']) . ' ' . $this->faker->randomElement(['García', 'Rodríguez', 'Martínez', 'López', 'Hernández']),
            'fuente_informacion' => $this->faker->word,
            'profesion_oficio' => $this->faker->word,
            'nombre_madre' => $this->faker->randomElement(['José', 'María', 'Juan', 'Ana', 'Luis', 'Carmen']) . ' ' . $this->faker->randomElement(['García', 'Rodríguez', 'Martínez', 'López', 'Hernández']),
            'confiabilidad' => $this->faker->word,
            'motivo_consulta' => $this->faker->paragraph,
            'historia_enfermedad_actual' => $this->faker->paragraph,
            'interrogatorio_aparatos_sistemas' => $this->faker->paragraph,
            'enfermedades_infecto_contagiosas' => $this->faker->paragraph,
            'enfermedades_hereditarias' => $this->faker->paragraph,
            'inmunizaciones_completas' => $this->faker->boolean,
            'horas_sueno' => $this->faker->numberBetween(1, 24),
            'horas_laborales' => $this->faker->numberBetween(1, 24),
            'tipo_hora_actividad_fisica' => $this->faker->word,
            'tabaco' => $this->faker->boolean,
            'tipo_tabaco' => $this->faker->word,
            'edad_inicio_tabaco' => $this->faker->numberBetween(10, 30),
            'cantidad_frecuencia_tabaco' => $this->faker->numberBetween(1, 100),
            'edad_abandono_tabaco' => $this->faker->numberBetween(30, 60),
            'duracion_habito_tabaco' => $this->faker->numberBetween(1, 50),
            'alcohol' => $this->faker->boolean,
            'tipo_alcohol' => $this->faker->word,
            'cantidad_frecuencia_alcohol' => $this->faker->numberBetween(1, 100),
            'edad_inicio_alcohol' => $this->faker->numberBetween(10, 30),
            'edad_abandono_alcohol' => $this->faker->numberBetween(30, 60),
            'duracion_habito_alcohol' => $this->faker->numberBetween(1, 50),
            'drogas_ilegales' => $this->faker->boolean,
            'tipo_drogas' => $this->faker->word,
            'cantidad_frecuencia_drogas' => $this->faker->numberBetween(1, 100),
            'edad_inicio_drogas' => $this->faker->numberBetween(10, 30),
            'edad_abandono_drogas' => $this->faker->numberBetween(30, 60),
            'duracion_habito_drogas' => $this->faker->numberBetween(1, 50),
            'farmacos' => $this->faker->boolean,
            'edad_abandono_farmacos' => $this->faker->numberBetween(30, 60),
            'cantidad_frecuencia_farmacos' => $this->faker->numberBetween(1, 100),
            'duracion_habito_farmacos' => $this->faker->numberBetween(1, 50),
            'num_medicamentos_actuales' => $this->faker->numberBetween(0, 10),
            'nombre_posologia_farmacos' => $this->faker->paragraph,
            'otros_habitos' => $this->faker->paragraph,
            'enfermedades_cronicas' => $this->faker->paragraph,
            'cirugias_previas' => $this->faker->paragraph,
            'hospitalizaciones' => $this->faker->paragraph,
            'menarca' => $this->faker->word,
            'gesta' => $this->faker->word,
            'fur' => $this->faker->word,
            'inicio_vida_sexual' => $this->faker->word,
            'para' => $this->faker->word,
            'cesarea' => $this->faker->word,
            'num_companeros_sexuales' => $this->faker->word,
            'aborto' => $this->faker->word,
            'legrado' => $this->faker->word,
            'semanas_amenorrea' => $this->faker->word,
            'menopausia' => $this->faker->boolean,
            'fecha_menopausia' => $this->faker->date(),
            'planificacion_familiar' => $this->faker->boolean,
            'metodo_planificacion' => $this->faker->word,
            'sustitucion_hormonal' => $this->faker->boolean,
            'especificar_sustitucion_hormonal' => $this->faker->word,
            'pap' => $this->faker->boolean,
            'resultado_fecha_pap' => $this->faker->word,
            'trabajo_actual' => $this->faker->boolean,
            'lugar_trabajo' => $this->faker->word,
            'area_labora' => $this->faker->word,
            'oficio_categoria' => $this->faker->word,
            'anos_oficio_trabajo_actual' => $this->faker->numberBetween(1, 50),
            'dia_laboral_horas' => $this->faker->numberBetween(1, 24),
            'tipo_horario' => $this->faker->word,
            'horas_semanales' => $this->faker->numberBetween(1, 168),
            'descripcion_trabajo_actual' => $this->faker->paragraph,
            'exposicion_sustancias' => $this->faker->boolean,
            'descripcion_exposicion' => $this->faker->paragraph,
            'frecuencia_intensidad_tarea' => $this->faker->word,
            'posicion_trabajo' => $this->faker->word,
            'trabajos_fuera_empleo' => $this->faker->boolean,
            'horas_extras' => $this->faker->numberBetween(0, 20),
            'antecedentes_laborales' => $this->faker->boolean,
            'fecha_inicio' => $this->faker->date(),
            'puesto_trabajo' => $this->faker->word,
            'anos_trabajados' => $this->faker->numberBetween(1, 50),
            'fecha_conclusion' => $this->faker->date(),
            'fc' => $this->faker->numberBetween(60, 100), // Frecuencia cardíaca en bpm
            'fr' => $this->faker->numberBetween(12, 20), // Frecuencia respiratoria en rpm
            'ta' => $this->faker->numberBetween(90, 180) . '/' . $this->faker->numberBetween(60, 120), // Presión arterial en mmHg
            'temperatura' => $this->faker->numberBetween(36, 38), // Temperatura en grados Celsius
            'peso' => $this->faker->numberBetween(40, 120), // Peso en kg
            'talla' => $this->faker->numberBetween(150, 200), // Talla en cm
            'area_superficie_corporal' => $this->faker->numberBetween(1.5, 2.5), // Área superficial corporal en m²
            'imc' => $this->faker->numberBetween(18, 30), // Índice de masa corporal
            'aspecto_general' => $this->faker->paragraph,
            'piel_mucosas' => $this->faker->paragraph,
            'craneo' => $this->faker->paragraph,
            'ojos' => $this->faker->paragraph,
            'orejas' => $this->faker->paragraph,
            'nariz' => $this->faker->paragraph,
            'boca' => $this->faker->paragraph,
            'cuello' => $this->faker->paragraph,
            'caja_toracica' => $this->faker->paragraph,
            'mamas' => $this->faker->paragraph,
            'campos_pulmonares' => $this->faker->paragraph,
            'cardiaco' => $this->faker->paragraph,
            'abdomen_pelvis' => $this->faker->paragraph,
            'extremidades_superiores' => $this->faker->paragraph,
            'extremidades_inferiores' => $this->faker->paragraph,
            'genitourinario' => $this->faker->paragraph,
            'examen_ginecologico' => $this->faker->paragraph,
            'examen_neurologico' => $this->faker->paragraph,
            'observaciones_analisis' => $this->faker->paragraph,
            'diagnosticos_problemas' => $this->faker->paragraph,
            'nombre_elabora_historia' => $this->faker->name,
            'firma_codigo_sello' => $this->faker->word,
        ];
        
        
    }
}
