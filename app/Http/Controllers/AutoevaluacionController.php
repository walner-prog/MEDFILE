<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriaClinica;
use Carbon\Carbon;
use App\Models\Autoevaluacion;
use Twilio\Rest\Client;
class AutoevaluacionController extends Controller
{
    
  public function index()
  
  {
    // Verificar si el paciente está autenticado
    if (!auth('paciente')->check()) {
        return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para continuar.');
    }

    // Obtener el ID del paciente autenticado
    $pacienteId = auth('paciente')->user()->id;

    // Renderizar la vista con la lógica que quieras
    return view('autoevaluacion.index', compact('pacienteId'));
  }
  public function store(Request $request)
  
  {
    // Validate input
    $request->validate([
        'horas_sueno' => 'required|integer|min:0|max:24',
        'historia_enfermedad_actual' => 'required|string|max:255',
        'enfermedades_cronicas' => 'nullable|string|max:255',
        'diagnostico_medico' => 'nullable|string|max:255',
        'nivel_estres' => 'required|integer|min:1|max:10',
        'sintomas_mentales' => 'nullable|string|max:255',
        'calidad_vida' => 'nullable|string|max:255',
        'pregunta_1' => 'required|in:sí,no',
        'pregunta_2' => 'required|in:sí,no',
        'pregunta_3' => 'required|in:sí,no',
        'pregunta_4' => 'required|in:sí,no',
        'pregunta_5' => 'required|in:sí,no',
        'pregunta_6' => 'required|in:sí,no',
        'pregunta_7' => 'required|in:sí,no',
        'pregunta_8' => 'required|in:sí,no',
        'pregunta_9' => 'required|in:sí,no',
        'pregunta_10' => 'required|in:sí,no',
        'pregunta_11' => 'required|in:sí,no',
        'pregunta_12' => 'required|in:sí,no',
    ]);

    // Check if the patient is authenticated
    if (!auth('paciente')->check()) {
        return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para continuar.');
    }

    // Get the authenticated patient's ID
    $pacienteId = auth('paciente')->user()->id;

    // Save or update the clinical history and evaluation
    $historiaClinica = Autoevaluacion::updateOrCreate(
        ['paciente_id' => $pacienteId],
        [
            'horas_sueno' => $request->horas_sueno,
            'historia_enfermedad_actual' => $request->historia_enfermedad_actual,
            'enfermedades_cronicas' => $request->enfermedades_cronicas,
            'diagnostico_medico' => $request->diagnostico_medico,
            'nivel_estres' => $request->nivel_estres,
            'sintomas_mentales' => $request->sintomas_mentales,
            'calidad_vida' => $request->calidad_vida,
            'pregunta_1' => $request->pregunta_1 === 'sí',
            'pregunta_2' => $request->pregunta_2 === 'sí',
            'pregunta_3' => $request->pregunta_3 === 'sí',
            'pregunta_4' => $request->pregunta_4 === 'sí',
            'pregunta_5' => $request->pregunta_5 === 'sí',
            'pregunta_6' => $request->pregunta_6 === 'sí',
            'pregunta_7' => $request->pregunta_7 === 'sí',
            'pregunta_8' => $request->pregunta_8 === 'sí',
            'pregunta_9' => $request->pregunta_9 === 'sí',
            'pregunta_10' => $request->pregunta_10 === 'sí',
            'pregunta_11' => $request->pregunta_11 === 'sí',
            'pregunta_12' => $request->pregunta_12 === 'sí',
        ]
    );

    // Prepara las respuestas de las preguntas
    $respuestasPreguntas = [
        'pregunta_1' => $request->pregunta_1 === 'sí',
        'pregunta_2' => $request->pregunta_2 === 'sí',
        'pregunta_3' => $request->pregunta_3 === 'sí',
        'pregunta_4' => $request->pregunta_4 === 'sí',
        'pregunta_5' => $request->pregunta_5 === 'sí',
        'pregunta_6' => $request->pregunta_6 === 'sí',
        'pregunta_7' => $request->pregunta_7 === 'sí',
        'pregunta_8' => $request->pregunta_8 === 'sí',
        'pregunta_9' => $request->pregunta_9 === 'sí',
        'pregunta_10' => $request->pregunta_10 === 'sí',
        'pregunta_11' => $request->pregunta_11 === 'sí',
        'pregunta_12' => $request->pregunta_12 === 'sí',
    ];

    // Llama a generarRecomendaciones con las respuestas
    $recomendaciones = $this->generarRecomendaciones(
        $request->horas_sueno, 
        $request->historia_enfermedad_actual,
        $request->enfermedades_cronicas, // Asegúrate de que esta variable está definida
        $respuestasPreguntas // Aquí pasamos las respuestas correctamente
    );



    return view('autoevaluacion.resultado', compact('recomendaciones'));
  }



    
   private function generarRecomendaciones($horasSueno, $historia_enfermedad_actual, $enfermedadCronica,$respuestasPreguntas)


    
   {
    // Lógica simple para generar recomendaciones
    $recomendaciones = [];

    // Recomendaciones basadas en horas de sueño
    if ($horasSueno < 7) {
        $recomendaciones[] = 'Es recomendable que intentes dormir al menos 7 horas por noche para mejorar tu salud mental.';
    }

    // Evaluar la enfermedad crónica seleccionada
    switch ($enfermedadCronica) {
        case 'insuficiencia_renal_cronica':
            $recomendaciones[] = 'Diagnóstico: Insuficiencia Renal Crónica';
        
            // Sección de Dieta
            $recomendaciones[] = 'Dieta y Nutrición:';
            $recomendaciones[] = '1. Sigue una dieta baja en proteínas. Se recomienda limitar el consumo de carnes rojas, aves y productos lácteos para reducir la carga de trabajo en los riñones.';
            $recomendaciones[] = '2. Controla tu ingesta de sodio. Evita los alimentos procesados y las comidas con mucha sal, como snacks, embutidos y comidas rápidas. Opta por alimentos frescos y naturales.';
            $recomendaciones[] = '3. Limita el consumo de fósforo y potasio. Alimentos como los frutos secos, las semillas, los plátanos y los tomates pueden contener niveles elevados de estos minerales.';
            $recomendaciones[] = '4. Hidrátate con moderación. Es importante mantener un equilibrio adecuado de líquidos, pero no exceder la cantidad recomendada por tu médico. Agua y tés suaves sin cafeína son las mejores opciones.';
        
            // Hábitos y Cuidados Especiales
            $recomendaciones[] = 'Hábitos Saludables:';
            $recomendaciones[] = '1. Evita fumar y reducir al máximo el consumo de alcohol, ya que ambos pueden afectar gravemente la función renal.';
            $recomendaciones[] = '2. Mantén un peso saludable. El sobrepeso puede agravar los problemas renales, por lo que una dieta equilibrada y ejercicio moderado son fundamentales.';
            $recomendaciones[] = '3. Controla tus niveles de glucosa y presión arterial. La diabetes y la hipertensión son factores de riesgo que pueden empeorar la insuficiencia renal.';
            
            // Actividades recomendadas/restringidas
            $recomendaciones[] = 'Actividades Físicas y Recomendaciones:';
            $recomendaciones[] = '1. Realiza ejercicio físico moderado, como caminar, nadar o practicar yoga. Evita actividades que demanden gran esfuerzo físico o impliquen deshidratación.';
            $recomendaciones[] = '2. Descansa lo suficiente y trata de dormir entre 7-9 horas cada noche para permitir que tu cuerpo se recupere y mantenga un funcionamiento óptimo.';
            
            // Monitoreo Médico
            $recomendaciones[] = 'Monitoreo y Cuidados Médicos:';
            $recomendaciones[] = '1. Monitorea tus niveles de creatinina, fósforo y potasio regularmente mediante análisis de sangre. Esto te ayudará a controlar la progresión de la enfermedad.';
            $recomendaciones[] = '2. Asiste a todas las citas médicas y sigue las indicaciones de tu nefrólogo de forma estricta.';
            break;
        

        case 'cancer':
            $recomendaciones[] = 'Asegúrate de seguir las indicaciones de tu oncólogo y mantener una buena nutrición.';
            break;

        case 'cancer_prostata':
            $recomendaciones[] = 'Habla con tu médico sobre los exámenes de detección y las opciones de tratamiento disponibles.';
            break;

        case 'cirrosis':
            $recomendaciones[] = 'Evita el alcohol y sigue una dieta saludable. Controla tus niveles de bilirrubina regularmente.';
            break;

        case 'presion_arterial':
            $recomendaciones[] = 'Monitorea tu presión arterial y reduce el consumo de sal en tu dieta.';
            break;

        case 'diabetes':
            $recomendaciones[] = 'Mantén un control regular de tus niveles de glucosa y sigue una dieta equilibrada.';
            break;

        case 'asma':
            $recomendaciones[] = 'Evita los desencadenantes conocidos y lleva siempre tu inhalador de rescate contigo.';
            break;

        case 'epoc':
            $recomendaciones[] = 'Evita el tabaco y considera participar en programas de rehabilitación pulmonar.';
            break;

        case 'artritis':
            $recomendaciones[] = 'Realiza ejercicios de bajo impacto para mantener la movilidad y reduce la inflamación con una dieta adecuada.';
            break;

        case 'hipotiroidismo':
            $recomendaciones[] = 'Asegúrate de tomar tu medicación de reemplazo hormonal según lo prescrito.';
            break;

        case 'hipertiroidismo':
            $recomendaciones[] = 'Consulta a tu médico sobre el manejo de tus síntomas y el tratamiento adecuado.';
            break;

        case 'enfermedad_coronaria':
            $recomendaciones[] = 'Mantén una dieta baja en grasas saturadas y colesterol. Realiza ejercicio regularmente.';
            break;

        case 'acv':
            $recomendaciones[] = 'Controla tus factores de riesgo como la hipertensión y la diabetes para prevenir futuros eventos.';
            break;

        case 'osteoporosis':
            $recomendaciones[] = 'Consume suficiente calcio y vitamina D. Realiza ejercicios de fortalecimiento.';
            break;

        case 'insuficiencia_cardiaca':
            $recomendaciones[] = 'Monitorea tu peso y limita la ingesta de líquidos según lo indicado por tu médico.';
            break;

        case 'glaucoma':
            $recomendaciones[] = 'Realiza chequeos oculares regulares y sigue las recomendaciones de tu oftalmólogo.';
            break;

        case 'enfermedades_renales':
            $recomendaciones[] = 'Evita el uso excesivo de medicamentos antiinflamatorios y controla tu ingesta de líquidos.';
            break;

        case 'esclerosis_multiplex':
            $recomendaciones[] = 'Consulta con un neurólogo y considera un programa de ejercicios adaptado a tus necesidades.';
            break;

        case 'parkinson':
            $recomendaciones[] = 'Mantén un estilo de vida activo y considera participar en terapia física.';
            break;

        case 'alzheimer':
            $recomendaciones[] = 'Mantén un entorno familiar seguro y realiza actividades que estimulen la mente.';
            break;

        case 'fibromialgia':
            $recomendaciones[] = 'Considera un enfoque multifacético que incluya terapia física y manejo del estrés.';
            break;

        // Agrega más enfermedades y recomendaciones según sea necesario

        default:
            $recomendaciones[] = 'Mantén un estilo de vida saludable y consulta a tu médico regularmente.';
            break;
    }

    // Evaluar la historia de la enfermedad actual
    switch (true) {
        case str_contains($historia_enfermedad_actual, 'estrés'):
        case str_contains($historia_enfermedad_actual, 'ansiedad'):
            $recomendaciones[] = 'Considera practicar técnicas de relajación o meditación.';
            break;

        case str_contains($historia_enfermedad_actual, 'depresión'):
            $recomendaciones[] = 'Es importante buscar apoyo profesional si te sientes abrumado por la depresión.';
            break;

        // Agregar más condiciones según sea necesario

        default:
            $recomendaciones[] = 'Mantén un estilo de vida saludable y consulta a tu médico regularmente.';
            break;
        }

        
        // Recomendaciones basadas en las respuestas a las preguntas
       

        if ($respuestasPreguntas['pregunta_1']) {
            $recomendaciones[] = 'Te sugiero que hables con un profesional sobre cualquier dificultad para concentrarte.';
        }
    
        if ($respuestasPreguntas['pregunta_2']) {
            $recomendaciones[] = 'Si tus preocupaciones afectan tu sueño, podría ser útil considerar la terapia.';
        }
    
        if ($respuestasPreguntas['pregunta_3']) {
            $recomendaciones[] = 'Refuerza tu papel en la vida buscando actividades que te hagan sentir útil.';
        }
    
        if ($respuestasPreguntas['pregunta_4']) {
            $recomendaciones[] = 'La toma de decisiones puede ser difícil. Considera hablar con alguien en quien confíes.';
        }
    
        if ($respuestasPreguntas['pregunta_5']) {
            $recomendaciones[] = 'El estrés constante puede ser abrumador. Las técnicas de relajación pueden ser útiles.';
        }
    
        if ($respuestasPreguntas['pregunta_6']) {
            $recomendaciones[] = 'Busca ayuda profesional si sientes que no puedes superar tus dificultades.';
        }
    
        if ($respuestasPreguntas['pregunta_7']) {
            $recomendaciones[] = 'Intenta incluir actividades placenteras en tu rutina diaria.';
        }
    
        if ($respuestasPreguntas['pregunta_8']) {
            $recomendaciones[] = 'No dudes en buscar apoyo si sientes que no puedes hacer frente a tus problemas.';
        }
    
        if ($respuestasPreguntas['pregunta_9']) {
            $recomendaciones[] = 'Es importante hablar sobre tus sentimientos de tristeza o depresión con un profesional.';
        }
    
        if ($respuestasPreguntas['pregunta_10']) {
            $recomendaciones[] = 'Recuerda que la autoestima puede mejorar. Considera participar en grupos de apoyo.';
        }
    
        if ($respuestasPreguntas['pregunta_11']) {
            $recomendaciones[] = 'Los pensamientos negativos pueden ser tratados con ayuda profesional. No estás solo.';
        }
    
        if ($respuestasPreguntas['pregunta_12']) {
            $recomendaciones[] = 'Si sientes razonablemente feliz, intenta mantener esas actividades que te traen alegría.';
        }

         return $recomendaciones;
   }




}
