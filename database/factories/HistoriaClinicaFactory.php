<?php

namespace Database\Factories;

use App\Models\HistoriaClinica;
use App\Models\Paciente;
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
     // Buscar pacientes que no tienen una historia clínica
     $paciente = Paciente::doesntHave('historiasClinicas')->inRandomOrder()->first();

     // Si no hay pacientes sin historia clínica, puedes decidir cómo manejarlo (por ejemplo, lanzar una excepción o retornar null)
     if (!$paciente) {
         return []; // O lanzar una excepción
     }


      $enfermedadesCrónicas = [
        'Hipertensión arterial',
        'Enfermedad pulmonar obstructiva crónica (EPOC)',
        'Artritis reumatoide',
        'Enfermedad cardíaca',
        'Asma',
        'Enfermedad renal crónica',
        'Diabetes mellitus tipo 2',
        'Accidente cerebrovascular (ACV)',
        'Insuficiencia cardíaca',
        'Enfermedad arterial periférica',
        'Fibromialgia'
    ];
     
    // Opciones para 'motivo_consulta'
$motivo_consulta_options = [
  'Dolor abdominal intenso',
  'Dificultad para respirar',
  'Fiebre alta persistente',
  'Cefalea severa',
  'Erupción cutánea inexplicable',
  'Fatiga extrema',
  'Lesión por accidente',
];

// Opciones para 'historia_enfermedad_actual'
$historia_enfermedad_actual_options = [
  'Paciente presenta síntomas desde hace tres días, con fiebre y escalofríos.',
  'Historia de dolor en el pecho al realizar esfuerzos.',
  'Refiere episodios de tos seca durante la última semana.',
  'Antecedentes de alergias estacionales con empeoramiento reciente.',
  'Náuseas y vómitos asociados con ingesta de alimentos.',
  'Dolor persistente en la región lumbar sin alivio.',
  'Recuperación postoperatoria complicada por infección.',
];

// Opciones para 'interrogatorio_aparatos_sistemas'
$interrogatorio_aparatos_sistemas_options = [
  'Cardiovascular: Sin antecedentes significativos.',
  'Respiratorio: Sin dificultad respiratoria aparente.',
  'Gastrointestinal: Reporta cambios en el hábito intestinal.',
  'Neurológico: Sin mareos ni pérdida de conciencia.',
  'Musculoesquelético: Dolor localizado en las extremidades.',
  'Urinario: Sin disuria ni hematuria.',
  'Endocrino: Sin síntomas de desregulación hormonal.',
];

// Opciones para 'enfermedades_infecto_contagiosas'
$enfermedades_infecto_contagiosas_options = [
  'Varicela',
  'Gripe',
  'Tuberculosis',
  'Hepatitis A',
  'Covid-19',
  'Fiebre tifoidea',
  'Sarampeón',
];

// Opciones para 'enfermedades_hereditarias'
$enfermedades_hereditarias_options = [
  'Diabetes tipo 2',
  'Hipertensión arterial',
  'Enfermedad celíaca',
  'Hemofilia',
  'Asma',
  'Enfermedad de Huntington',
  'Fibrosis quística',
];
// Opciones para 'tipo_hora_actividad_fisica'
$tipo_hora_actividad_fisica_options = [
  'Sedentaria',
  'Ligera',
  'Moderada',
  'Intensa',
  'Deportiva',
  'Aeróbica',
  'Entrenamiento de fuerza',
];

$cirugias_previas_options = [
  'Apéndice removido: Se realizó una apendicectomía debido a una apendicitis aguda. La cirugía fue exitosa, y el paciente se recuperó sin complicaciones significativas.',
  
  '', // Opción vacía para indicar que no ha tenido cirugías previas
  
  'Cirugía de rodilla: El paciente se sometió a una artroscopia de rodilla para reparar un desgarro del menisco. La intervención fue programada y no hubo complicaciones; se recomendó fisioterapia postoperatoria.',
  
  'Bypass cardíaco: Se realizó un procedimiento de bypass coronario para tratar la enfermedad arterial coronaria. El paciente fue monitoreado de cerca en la unidad de cuidados intensivos (UCI) y no presentó complicaciones durante su recuperación.',
  
  '', // Opción vacía para indicar que no ha tenido cirugías previas
  
  'Cirugía de hernia: El paciente fue operado para reparar una hernia inguinal. La cirugía fue exitosa y no se presentaron complicaciones. Se le dieron instrucciones postoperatorias para una recuperación adecuada.',
  
  'Extracción de vesícula: Se llevó a cabo una colecistectomía laparoscópica para remover la vesícula biliar debido a cálculos biliares. La cirugía fue exitosa, y el paciente no experimentó complicaciones mayores durante la recuperación.',
  
  '', // Opción vacía para indicar que no ha tenido cirugías previas
  
  'Cirugía de reemplazo de cadera: El paciente se sometió a un reemplazo total de cadera debido a la artritis degenerativa. La cirugía fue planificada, y aunque hubo un periodo de rehabilitación prolongado, no hubo complicaciones serias.',
  
  'Cirugía de corazón abierto: Se realizó una cirugía de corazón abierto para reparar una válvula cardíaca. Aunque la intervención fue exitosa, el paciente experimentó complicaciones menores que fueron manejadas adecuadamente.',
  
  // Más opciones si lo deseas...
];

// Opciones para 'hospitalizaciones'
$hospitalizaciones_options = [
  'Hospitalización por neumonía: El paciente fue ingresado debido a una neumonía severa que requirió tratamiento con antibióticos intravenosos y oxígeno suplementario. No hubo complicaciones durante la estadía.',
  '',
  'Internación por deshidratación: El paciente fue hospitalizado debido a una deshidratación severa causada por diarrea y vómitos persistentes. Recibió líquidos intravenosos y electrolitos, con recuperación completa sin complicaciones.',
  '',
  'Cirugía por fractura de fémur: El paciente se sometió a una cirugía para reparar una fractura de fémur después de un accidente. La cirugía fue exitosa y no hubo complicaciones, aunque se requirió terapia física durante la recuperación.',
  '',
  'Cirugía de apendicitis: Se realizó una apendicectomía laparoscópica debido a una apendicitis aguda. La cirugía fue sin complicaciones, y el paciente fue dado de alta después de una recuperación rápida.',
  
  'Hospitalización por infarto agudo de miocardio: El paciente fue admitido por un infarto agudo de miocardio. Recibió tratamiento inmediato con anticoagulantes y un stent. Hubo complicaciones menores, pero se estabilizó después de la intervención.',
  '',
  'Tratamiento de diabetes tipo 2: El paciente fue hospitalizado para ajustar su tratamiento de diabetes tipo 2 después de experimentar complicaciones como hiperglucemia. Se le administraron insulina y educación sobre el manejo de la enfermedad, con una mejoría notable.',
  
  'Cuidados postoperatorios tras cirugía bariátrica: El paciente fue hospitalizado para monitoreo y cuidados después de una cirugía bariátrica. Se realizaron chequeos frecuentes y no se presentaron complicaciones significativas durante su recuperación.',
  '',
  'Internación por accidente cerebrovascular: El paciente fue ingresado tras un accidente cerebrovascular. Recibió tratamiento inmediato para minimizar daños y fue sometido a fisioterapia. Hubo complicaciones relacionadas con la movilidad, pero se está recuperando con éxito.',
  
  'Cirugía de hernia inguinal: Se realizó una reparación de hernia inguinal. La cirugía fue programada y se llevó a cabo sin complicaciones. El paciente recibió instrucciones postoperatorias y se recuperó bien en casa.',
  
  '', // Opción vacía para indicar que no ha sido hospitalizado
];

                       $sexo = $this->faker->randomElement(['M', 'F']); // Suponiendo que tienes una forma de obtener el sexo del paciente
                       $tipo_horario_options = [
                        'Matutino',  // Horario de la mañana
                        'Vespertino', // Horario de la tarde
                        'Nocturno',   // Horario de la noche
                        'Turno completo', // Trabajo durante todo el día
                        'Flexible',   // Horario que se adapta a las necesidades del empleado
                    ];

                    $descripcion_trabajo_actual_options = [
                      'Trabajo como ingeniero de software, desarrollando aplicaciones web y móviles, colaborando con equipos multidisciplinarios para entregar soluciones innovadoras.',
                      'Soy médico general, atendiendo pacientes en consulta y brindando tratamiento adecuado según el diagnóstico clínico realizado.',
                      'Desempeño el cargo de profesor de matemáticas, impartiendo clases a estudiantes de secundaria y ayudándoles a desarrollar habilidades analíticas.',
                      'Trabajo en un centro de atención al cliente, resolviendo dudas y ofreciendo soporte técnico a usuarios sobre productos y servicios.',
                      'Soy chef en un restaurante, encargado de la preparación de platillos gourmet y supervisando al equipo de cocina para asegurar la calidad en cada servicio.',
                  ];
                  $descripcion_exposicion_options = [
                    'Exposición frecuente a productos químicos en un entorno laboral, lo que podría causar irritación en la piel y problemas respiratorios.',
                    '',
                    '',
                    'Exposición a la radiación en el trabajo, siguiendo todos los protocolos de seguridad para minimizar riesgos de salud.',
                     '', 
                     '',
                    'Interacción diaria con pacientes en un ambiente hospitalario, lo que puede aumentar el riesgo de contagio de enfermedades infecciosas.',
                    '',
                   
                    'Exposición a condiciones climáticas extremas debido a trabajos al aire libre, lo que requiere un manejo adecuado de la salud y la hidratación.',
                    '',
                  
                  'Trabajo en un entorno de alto estrés, donde la presión constante puede afectar el bienestar emocional y físico.',
                  '',
            ];
            
                // Opciones para cada campo
    $piel_mucosas_options = [
      'Piel sana, sin lesiones visibles.',
      'Piel con erupciones leves y sin signos de infección.',
      'Mucosas húmedas y bien perfundidas, sin signos de deshidratación.',
      'Piel pálida con signos de anemia leve.',
      'Mucosas secas, posiblemente indicativas de deshidratación leve.'
  ];

  $craneo_options = [
      'Cráneo simétrico, sin deformidades.',
      'Deformidad leve en el cráneo, pero sin comprometer la función.',
      'Tensión en el cuero cabelludo, posible causa de cefalea.',
      'Sin signos de trauma o contusiones.',
      'Cráneo normal, sin evidencias de fractura.'
  ];

  $ojos_options = [
      'Visión clara, sin signos de irritación.',
      'Ojos levemente inyectados, sin secreción.',
      'Ojos con buen reflejo pupilar y respuesta a la luz.',
      'Sin signos de estrabismo o desviación.',
      'Ojos secos, posible indicio de fatiga visual.'
  ];

  $orejas_options = [
      'Oídos limpios, sin secreciones.',
      'Sin signos de inflamación o infección.',
      'Audición normal a voces susurradas.',
      'Oídos con cerumen, pero sin obstrucción.',
      'Oídos normales, sin signos de patología.'
  ];

  $nariz_options = [
      'Nariz simétrica, sin deformidades.',
      'Secreción nasal leve, posible alergia estacional.',
      'Sin signos de congestión o sangrado.',
      'Nariz con buen flujo de aire, sin obstrucción.',
      'Nariz normal, sin evidencias de patología.'
  ];

  $boca_options = [
      'Boca húmeda, dientes en buen estado.',
      'Encías sanas, sin sangrado al tocar.',
      'Lengua normal, sin lesiones visibles.',
      'Aliento fresco, sin signos de halitosis.',
      'Boca con úlceras menores, pero sin dolor significativo.'
  ];

  $cuello_options = [
      'Cuello sin rigidez, rango de movimiento completo.',
      'Sin adenopatías palpables o signos de inflamación.',
      'Cuello simétrico, sin deformidades visibles.',
      'Sin dolor a la palpación, rango de movimiento adecuado.',
      'Cuello normal, sin evidencias de lesiones.'
  ];

  $caja_toracica_options = [
      'Caja torácica simétrica, sin deformidades.',
      'Ruidos respiratorios normales, sin estertores.',
      'Sin dolor a la palpación en el área torácica.',
      'Respiración regular y profunda, sin signos de dificultad.',
      'Caja torácica normal, sin evidencias de trauma.'
  ];

  $campos_pulmonares_options = [
    'Respiraciones normales, sin ruidos anormales.',
    'Estertores finos en la base pulmonar, posible signo de congestión.',
    'Sibilancias audibles, indicativas de posible asma.',
    'Percusión clara, sin matidez significativa.',
    'Sin signos de dificultad respiratoria o uso de músculos accesorios.'
];

$cardiaco_options = [
    'Ritmo cardiaco regular, sin soplos audibles.',
    'Frecuencia cardiaca ligeramente elevada, posible respuesta al estrés.',
    'Soplo sistólico leve, sin irradiación a otros focos.',
    'Presión arterial dentro de rangos normales, sin hipertensión.',
    'Palpitaciones ocasionales, pero sin signos de arritmia.'
];

$abdomen_pelvis_options = [
    'Abdomen blando, sin distensión ni dolor a la palpación.',
    'Ruidos hidroaéreos presentes y normales.',
    'Hígado y bazo no palpables, sin hepatomegalia ni esplenomegalia.',
    'Sensibilidad leve en la región epigástrica, pero sin signos de rebote.',
    'Abdomen simétrico, sin masas palpables.'
];

$extremidades_superiores_options = [
    'Extremidades superiores con buena movilidad y fuerza.',
    'Sin deformidades o signos de trauma.',
    'Reflejos normales en extremidades, sin hiperreflexia.',
    'Circulación adecuada, sin signos de isquemia.',
    'Sensibilidad intacta en manos y brazos, sin parestesias.'
];

$extremidades_inferiores_options = [
    'Extremidades inferiores con movilidad completa y simetría.',
    'Sin edemas ni signos de trombosis venosa profunda.',
    'Reflejos normales en piernas, sin debilidad muscular.',
    'Pulsos periféricos presentes y simétricos.',
    'Sensación intacta en pies y piernas, sin alteraciones.'
];
$examen_neurologico_options = [
  'Paciente alerta y orientado en tiempo, lugar y persona. Reflejos neurológicos dentro de los límites normales.',
  'Signos de debilidad en extremidades derechas, reflejos disminuidos. Requiere evaluación adicional.',
  'No se observan signos de paresia. Reflejos profundos simétricos y adecuados.',
  'Dificultad para seguir comandos simples, posible indicativo de déficit cognitivo leve.',
  'Aferencias sensoriales intactas, sin alteraciones de la percepción ni sensibilidad disminuida.'
];

// Opciones para 'observaciones_analisis'
$observaciones_analisis_options = [
  'Los análisis muestran niveles elevados de glucosa, recomendando un seguimiento para descartar diabetes.',
  'Resultados normales en la mayoría de los parámetros, excepto hemoglobina ligeramente baja.',
  'No se observaron anomalías significativas en los análisis de sangre, resultados dentro de los valores normales.',
  'Se requiere repetir los análisis de función hepática debido a valores fuera del rango.',
  'Presencia de inflamación leve indicada en marcadores, sugiriendo un posible proceso infeccioso.'
];
$diagnosticos_problemas_options = [
  'Hipertensión arterial: El paciente fue diagnosticado tras varias mediciones de presión arterial que indicaron valores superiores a 140/90 mmHg. Se le prescribió un tratamiento con inhibidores de la enzima convertidora de angiotensina (IECA) y se le recomendó cambios en su estilo de vida, como dieta baja en sodio y ejercicio regular.',
  
  'Diabetes tipo 2: Diagnóstico basado en un análisis de glucosa en sangre que mostró niveles superiores a 126 mg/dL en ayunas. El paciente fue educado sobre la importancia de una dieta equilibrada, actividad física, y se le inició tratamiento con metformina para controlar los niveles de glucosa.',
  
  'Asma: El paciente presenta síntomas de dificultad para respirar y sibilancias, especialmente durante la noche. Se le realizó una espirometría que confirmó la obstrucción reversible de las vías respiratorias. Se le prescribió un inhalador de rescate y se le recomendó evitar alérgenos conocidos.',
  
  'Artritis: El paciente presentó dolor e inflamación en las articulaciones, especialmente en las manos y las rodillas. Se realizaron análisis de sangre que confirmaron la presencia de marcadores inflamatorios. Se le inició un tratamiento con antiinflamatorios no esteroides (AINEs) y terapia física.',
  
  'Depresión: Se realizó una evaluación psicológica que reveló síntomas de depresión persistente, incluyendo tristeza, fatiga y pérdida de interés en actividades cotidianas. Se le recomendó terapia cognitivo-conductual y se consideró el uso de antidepresivos después de una conversación sobre los riesgos y beneficios.',
];
            
 // Generar un código único de 5 dígitos
 do {
  $firma_codigo_sello = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
} while (HistoriaClinica::where('firma_codigo_sello', $firma_codigo_sello)->exists());

        return [
            'paciente_id' => $paciente->id,
       
            'hora' => $this->faker->time(),
            'sala' => $this->faker->randomElement(['A', 'B', 'C']),

        
            'no_cama' => $this->faker->numberBetween(1, 99),

            'lugar_nacimiento'=>$paciente->departamento,
         
            'procedencia'=>$paciente->departamento,
         
            'religion' => $this->faker->randomElement(['Protestante', 'Catolica', 'Apostolica']),
      
            'escolaridad' =>$paciente->escolaridad,
            'direccion_habitual' =>$paciente->direccion_residencia,
            'nombre_padre' => $this->faker->randomElement(['José', 'María', 'Juan', 'Ana', 'Luis', 'Carmen']) . ' ' . $this->faker->randomElement(['García', 'Rodríguez', 'Martínez', 'López', 'Hernández']),
            'fuente_informacion' => $paciente->parentesco,
            'profesion_oficio' => $paciente->ocupacion,
            'nombre_madre' => $this->faker->randomElement(['José', 'María', 'Juan', 'Ana', 'Luis', 'Carmen']) . ' ' . $this->faker->randomElement(['García', 'Rodríguez', 'Martínez', 'López', 'Hernández']),
            'confiabilidad' => $this->faker->randomElement(['Alta', 'En duda', 'Alta']),
            'motivo_consulta' => $this->faker->paragraph,
            'motivo_consulta' => $this->faker->randomElement($motivo_consulta_options),
            'historia_enfermedad_actual' => $this->faker->randomElement($historia_enfermedad_actual_options),
            'interrogatorio_aparatos_sistemas' => $this->faker->randomElement($interrogatorio_aparatos_sistemas_options),
            'enfermedades_infecto_contagiosas' => $this->faker->randomElement($enfermedades_infecto_contagiosas_options),
            'enfermedades_hereditarias' => $this->faker->randomElement($enfermedades_hereditarias_options),
            'inmunizaciones_completas' => $this->faker->boolean,
            'horas_sueno' => $this->faker->numberBetween(3, 10),
            'horas_laborales' => $this->faker->numberBetween(8, 16),
            'tipo_hora_actividad_fisica' => $this->faker->randomElement($tipo_hora_actividad_fisica_options),
          
            
            'tabaco' => $this->faker->boolean,
            'tipo_tabaco' => $this->faker->boolean ? $this->faker->randomElement
              ([
             'Cigarrillos',
               'Cohibás',
              'Pipa',
              'Cigarrillos electrónicos',
               ]) : null,
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
            'enfermedades_cronicas' => $this->faker->randomElement($enfermedadesCrónicas),
            'cirugias_previas' => $this->faker->randomElement($cirugias_previas_options),
            'hospitalizaciones' => $this->faker->randomElement($hospitalizaciones_options),
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

            'trabajo_actual'=> $this->faker->boolean,
            'lugar_trabajo' => $paciente->ocupacion,
            'area_labora' => $this->faker->word,
            'oficio_categoria' => $paciente->ocupacion, 
            'anos_oficio_trabajo_actual' => $this->faker->numberBetween(1, 50),
            'dia_laboral_horas' => $this->faker->numberBetween(1, 24),
                      
             'tipo_horario' => $this->faker->randomElement($tipo_horario_options), 
            'horas_semanales' => $this->faker->numberBetween(1, 168),
            'tipo_hora_actividad_fisica' => $this->faker->randomElement($descripcion_trabajo_actual_options),
            'descripcion_exposicion' => $this->faker->randomElement($descripcion_exposicion_options),
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
           'piel_mucosas' => $this->faker->randomElement($piel_mucosas_options),
        'craneo' => $this->faker->randomElement($craneo_options),
        'ojos' => $this->faker->randomElement($ojos_options),
        'orejas' => $this->faker->randomElement($orejas_options),
        'nariz' => $this->faker->randomElement($nariz_options),
        'boca' => $this->faker->randomElement($boca_options),
        'cuello' => $this->faker->randomElement($cuello_options),
        'caja_toracica' => $this->faker->randomElement($caja_toracica_options),
            'mamas' => $this->faker->paragraph,
            'campos_pulmonares' => $this->faker->randomElement($campos_pulmonares_options),
            'cardiaco' => $this->faker->randomElement($cardiaco_options),
            'abdomen_pelvis' => $this->faker->randomElement($abdomen_pelvis_options),
            'extremidades_superiores' => $this->faker->randomElement($extremidades_superiores_options),
            'extremidades_inferiores' => $this->faker->randomElement($extremidades_inferiores_options),
            'genitourinario' => $this->faker->paragraph,
            'examen_ginecologico' => $this->faker->paragraph,
           'examen_neurologico' => $this->faker->randomElement($examen_neurologico_options),
           'observaciones_analisis' => $this->faker->randomElement($observaciones_analisis_options),
           'diagnosticos_problemas' => $this->faker->randomElement($diagnosticos_problemas_options),
            'nombre_elabora_historia' => $this->faker->name,
           'firma_codigo_sello' => $firma_codigo_sello,
        ];
        
        
    }
}
