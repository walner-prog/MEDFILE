<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HistoriaClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function index()
    {   

        $total_historias= HistoriaClinica::count();
         $doctores = Doctor::all();
        return view('historias_clinicas.index', compact('total_historias','doctores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('historias_clinicas.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'hora' => 'nullable',
            'sala' => 'nullable|string|max:255',
           'no_cama' => $request->has('is_ingresado') ? 'required|string|max:255' : 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'lugar_nacimiento' => 'nullable|string|max:255',
            'procedencia' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'direccion_habitual' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'fuente_informacion' => 'nullable|string|max:255',
            'profesion_oficio' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'confiabilidad' => 'nullable|string|max:255',
            'motivo_consulta' => 'nullable|string',
            'historia_enfermedad_actual' => 'nullable|string',
            'interrogatorio_aparatos_sistemas' => 'nullable|string',
           'enfermedades_infecto_contagiosas' => 'nullable|string',
           // Validaciones para enfermedades hereditarias
      
            'enfermedades_hereditarias' => 'nullable|string',
            'inmunizaciones_completas' => 'nullable|boolean',
            'detalle_inmunizaciones' => $request->has('inmunizaciones_completas') ? 'nullable|string' : 'required|string|max:255',
            'horas_sueno' => 'nullable|integer|min:0',
            'horas_laborales' => 'nullable|integer|min:0',
            'tipo_hora_actividad_fisica' => 'nullable|string',
            'tabaco' => 'nullable|boolean',
            'tipo_tabaco' => 'nullable|string|max:255',
            'edad_inicio_tabaco' => 'nullable|integer|min:0',
            'cantidad_frecuencia_tabaco' => 'nullable|integer|min:0',
            'edad_abandono_tabaco' => 'nullable|integer|min:0',
            'duracion_habito_tabaco' => 'nullable|integer|min:0',
            'alcohol' => 'nullable|boolean',
            'tipo_alcohol' => 'nullable|string|max:255',
            'cantidad_frecuencia_alcohol' => 'nullable|integer|min:0',
            'edad_inicio_alcohol' => 'nullable|integer|min:0',
            'edad_abandono_alcohol' => 'nullable|integer|min:0',
            'duracion_habito_alcohol' => 'nullable|integer|min:0',
            'drogas_ilegales' => 'nullable|boolean',
            'tipo_drogas' => 'nullable|string|max:255',
            'cantidad_frecuencia_drogas' => 'nullable|integer|min:0',
            'edad_inicio_drogas' => 'nullable|integer|min:0',
            'edad_abandono_drogas' => 'nullable|integer|min:0',
            'duracion_habito_drogas' => 'nullable|integer|min:0',
            'farmacos' => 'nullable|boolean',
            'edad_abandono_farmacos' => 'nullable|integer|min:0',
            'cantidad_frecuencia_farmacos' => 'nullable|integer|min:0',
            'duracion_habito_farmacos' => 'nullable|integer|min:0',
            'num_medicamentos_actuales' => 'nullable|integer|min:0',
            'nombre_posologia_farmacos' => 'nullable|string',
            'otros_habitos' => 'nullable|string',
            'enfermedades_infecto' => 'nullable|string',
            
            'enfermedades_cronicas' => 'nullable|string',
            'cirugias_previas' => 'nullable|string',
            'hospitalizaciones' => 'nullable|string',
            'menarca' => 'nullable|string|max:255',
            'gesta' => 'nullable|string|max:255',
            'fur' => 'nullable|string|max:255',
            'inicio_vida_sexual' => 'nullable|string|max:255',
            'para' => 'nullable|string|max:255',
            'cesarea' => 'nullable|string|max:255',
            'num_companeros_sexuales' => 'nullable|string|max:255',
            'aborto' => 'nullable|string|max:255',
            'legrado' => 'nullable|string|max:255',
            'semanas_amenorrea' => 'nullable|string|max:255',
            'menopausia' => 'nullable|boolean',
            'fecha_menopausia' => 'nullable|date',
            'planificacion_familiar' => 'nullable|boolean',
            'metodo_planificacion' => 'nullable|string|max:255',
            'sustitucion_hormonal' => 'nullable|boolean',
            'especificar_sustitucion_hormonal' => 'nullable|string|max:255',
            'pap' => 'nullable|boolean',
            'resultado_fecha_pap' => 'nullable|string|max:255',
            'trabajo_actual' => 'nullable|boolean',
            'lugar_trabajo' => 'nullable|string|max:255',
            'area_labora' => 'nullable|string|max:255',
            'oficio_categoria' => 'nullable|string|max:255',
            'anos_oficio_trabajo_actual' => 'nullable|integer|min:0',
            'dia_laboral_horas' => 'nullable|integer|min:0',
            'tipo_horario' => 'nullable|string|max:255',
            'horas_semanales' => 'nullable|integer|min:0',
            'descripcion_trabajo_actual' => 'nullable|string',
            'exposicion_sustancias' => 'nullable|boolean',
            'descripcion_exposicion' => 'nullable|string',
            'frecuencia_intensidad_tarea' => 'nullable|string',
            'posicion_trabajo' => 'nullable|string|max:255',
            'trabajos_fuera_empleo' => 'nullable|boolean',
            'horas_extras' => 'nullable|integer|min:0',
            'antecedentes_laborales' => 'nullable|boolean',
            'fecha_inicio' => 'nullable|date',
            'puesto_trabajo' => 'nullable|string|max:255',
            'anos_trabajados' => 'nullable|integer|min:0',
            'fecha_conclusion' => 'nullable|date',
            'signos_vitales' => 'nullable|string',
            'fc' => 'nullable|string|max:255',
            'fr' => 'nullable|string|max:255',
            'ta' => 'nullable|string|max:255',
            'temperatura' => 'nullable|string|max:255',
            'datos_antropometricos' => 'nullable|string',
            'peso' => 'nullable|string|max:255',
            'talla' => 'nullable|string|max:255',
            'area_superficie_corporal' => 'nullable|string|max:255',
            'imc' => 'nullable|string|max:255',
            'aspecto_general' => 'nullable|string',
            'piel_mucosas' => 'nullable|string',
            'craneo' => 'nullable|string',
            'ojos' => 'nullable|string',
            'orejas' => 'nullable|string',
            'nariz' => 'nullable|string',
            'boca' => 'nullable|string',
            'cuello' => 'nullable|string',
            'caja_toracica' => 'nullable|string',
            'mamas' => 'nullable|string',
            'campos_pulmonares' => 'nullable|string',
            'cardiaco' => 'nullable|string',
            'abdomen_pelvis' => 'nullable|string',
            'extremidades_superiores' => 'nullable|string',
            'extremidades_inferiores' => 'nullable|string',
            'genitourinario' => 'nullable|string',
            'examen_ginecologico' => 'nullable|string',
            'examen_neurologico' => 'nullable|string',
            'observaciones_analisis' => 'nullable|string',
            'diagnosticos_problemas' => 'nullable|string',
            'nombre_elabora_historia' => 'nullable|max:255',
            'firma_codigo_sello' => 'string|required|digits:5',
           
        ]);


        // Crear historia clínica
           $historiaClinica = HistoriaClinica::create($request->all());
  
        return redirect()->route('historias_clinicas.index', compact('historiaClinica'))->with('info', 'Historia clínica creada con éxito.');
    }


    //   /************ verificarHistoriaClinica es para ver si un paciente ya tiene un historial clinico   */
    public function comprobarHistoriaClinica($pacienteId)
    {
        // Busca si ya existe una historia clínica para el paciente
        $historiaClinica = HistoriaClinica::where('paciente_id', $pacienteId)->first();
    
        if ($historiaClinica) {
            $fechaCreacion = $historiaClinica->created_at;
            $diasTranscurridos = $fechaCreacion->diffInDays(now());
    
            return response()->json([
                'existe' => true,
                'fecha_creacion' => $fechaCreacion->format('Y-m-d'),
                'dias_transcurridos' => $diasTranscurridos,
            ]);
        } else {
            return response()->json(['existe' => false]);
        }
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
         $historiaClinica = HistoriaClinica::with('paciente')->find($id);
    
        if (!$historiaClinica) {
            return redirect()->route('historias_clinicas.index')->with('error', 'Historia Clínica no encontrada.');
        }
    
          // Convertir la fecha de nacimiento a un objeto Carbon
         $historiaClinica->fecha_nacimiento = Carbon::parse($historiaClinica->fecha_nacimiento);
         // Formatea las fechas
         $historiaClinica = HistoriaClinica::find($id);

        if ($historiaClinica->fecha_menopausia)
        {
           $historiaClinica->fecha_menopausia = Carbon::parse($historiaClinica->fecha_menopausia);
        }

           $historiaClinica->fecha_inicio = $historiaClinica->fecha_inicio ? Carbon::parse($historiaClinica->fecha_inicio)->format('d/m/Y') : 'No disponible';
           $historiaClinica->fecha_conclusion = $historiaClinica->fecha_conclusion ? Carbon::parse($historiaClinica->fecha_conclusion)->format('d/m/Y') : 'No disponible';
           $modo = auth()->user()->modo; // O cualquier lógica para determinar el modo
        return view('historias_clinicas.show', compact('historiaClinica','modo'));
    }
                                              
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
   

    public function edit($id)
    {
        $historiasClinica = HistoriaClinica::find($id);
        
        return view('historias_clinicas.edit', compact('historiasClinica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriaClinica $historiasClinica)
    {
        $validator = Validator::make($request->all(), [
           
            'paciente_id' => 'required|exists:pacientes,id',
            'hora' => 'nullable',
            'sala' => 'nullable|string|max:255',
            'no_cama' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'lugar_nacimiento' => 'nullable|string|max:255',
            'procedencia' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'direccion_habitual' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'fuente_informacion' => 'nullable|string|max:255',
            'profesion_oficio' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'confiabilidad' => 'nullable|string|max:255',
            'motivo_consulta' => 'nullable|string',
            'historia_enfermedad_actual' => 'nullable|string',
            'interrogatorio_aparatos_sistemas' => 'nullable|string',
            'enfermedades_hereditarias' => 'nullable|string|max:255',
            'enfermedades_infecto_contagiosas' => 'nullable|string|max:255',
            'inmunizaciones_completas' => 'nullable|boolean',
            'horas_sueno' => 'nullable|integer|min:0',
            'horas_laborales' => 'nullable|integer|min:0',
            'tipo_hora_actividad_fisica' => 'nullable|string',
            'tabaco' => 'nullable|boolean',
            'tipo_tabaco' => 'nullable|string|max:255',
            'edad_inicio_tabaco' => 'nullable|integer|min:0',
            'cantidad_frecuencia_tabaco' => 'nullable|integer|min:0',
            'edad_abandono_tabaco' => 'nullable|integer|min:0',
            'duracion_habito_tabaco' => 'nullable|integer|min:0',
            'alcohol' => 'nullable|boolean',
            'tipo_alcohol' => 'nullable|string|max:255',
            'cantidad_frecuencia_alcohol' => 'nullable|integer|min:0',
            'edad_inicio_alcohol' => 'nullable|integer|min:0',
            'edad_abandono_alcohol' => 'nullable|integer|min:0',
            'duracion_habito_alcohol' => 'nullable|integer|min:0',
            'drogas_ilegales' => 'nullable|boolean',
            'tipo_drogas' => 'nullable|string|max:255',
            'cantidad_frecuencia_drogas' => 'nullable|integer|min:0',
            'edad_inicio_drogas' => 'nullable|integer|min:0',
            'edad_abandono_drogas' => 'nullable|integer|min:0',
            'duracion_habito_drogas' => 'nullable|integer|min:0',
            'farmacos' => 'nullable|boolean',
            'edad_abandono_farmacos' => 'nullable|integer|min:0',
            'cantidad_frecuencia_farmacos' => 'nullable|integer|min:0',
            'duracion_habito_farmacos' => 'nullable|integer|min:0',
            'num_medicamentos_actuales' => 'nullable|integer|min:0',
            'nombre_posologia_farmacos' => 'nullable|string',
            'otros_habitos' => 'nullable|string',
            'enfermedades_cronicas' => 'nullable|string',
            'cirugias_previas' => 'nullable|string',
            'hospitalizaciones' => 'nullable|string',
            'menarca' => 'nullable|string|max:255',
            'gesta' => 'nullable|string|max:255',
            'fur' => 'nullable|string|max:255',
            'inicio_vida_sexual' => 'nullable|string|max:255',
            'para' => 'nullable|string|max:255',
            'cesarea' => 'nullable|string|max:255',
            'num_companeros_sexuales' => 'nullable|string|max:255',
            'aborto' => 'nullable|string|max:255',
            'legrado' => 'nullable|string|max:255',
            'semanas_amenorrea' => 'nullable|string|max:255',
            'menopausia' => 'nullable|boolean',
            'fecha_menopausia' => 'nullable|date',
            'planificacion_familiar' => 'nullable|boolean',
            'metodo_planificacion' => 'nullable|string|max:255',
            'sustitucion_hormonal' => 'nullable|boolean',
            'especificar_sustitucion_hormonal' => 'nullable|string|max:255',
            'pap' => 'nullable|boolean',
            'resultado_fecha_pap' => 'nullable|string|max:255',

            'trabajo_actual' => 'nullable|boolean',
            'lugar_trabajo' => 'nullable|string|max:255',
            'area_labora' => 'nullable|string|max:255',
            'oficio_categoria' => 'nullable|string|max:255',
            'anos_oficio_trabajo_actual' => 'nullable|integer|min:0',
            'dia_laboral_horas' => 'nullable|integer|min:0',
            'tipo_horario' => 'nullable|string|max:255',
            'horas_semanales' => 'nullable|integer|min:0',
            'descripcion_trabajo_actual' => 'nullable|string',
            'exposicion_sustancias' => 'nullable|boolean',
            'descripcion_exposicion' => 'nullable|string',
            'frecuencia_intensidad_tarea' => 'nullable|string',
            'posicion_trabajo' => 'nullable|string|max:255',
            'trabajos_fuera_empleo' => 'nullable|boolean',
            'horas_extras' => 'nullable|integer|min:0',
            'antecedentes_laborales' => 'nullable|boolean',
            'fecha_inicio' => 'nullable|date',
            'puesto_trabajo' => 'nullable|string|max:255',
            'anos_trabajados' => 'nullable|integer|min:0',
            'fecha_conclusion' => 'nullable|date',
           
            'fc' => 'nullable|string|max:255',
            'fr' => 'nullable|string|max:255',
            'ta' => 'nullable|string|max:255',
            'temperatura' => 'nullable|string|max:255',
           
            'peso' => 'nullable|string|max:255',
            'talla' => 'nullable|string|max:255',
            'area_superficie_corporal' => 'nullable|string|max:255',
            'imc' => 'nullable|string|max:255',
            'aspecto_general' => 'nullable|string',
            'piel_mucosas' => 'nullable|string',
            'craneo' => 'nullable|string',
            'ojos' => 'nullable|string',
            'orejas' => 'nullable|string',
            'nariz' => 'nullable|string',
            'boca' => 'nullable|string',
            'cuello' => 'nullable|string',
            'caja_toracica' => 'nullable|string',
            'mamas' => 'nullable|string',
            'campos_pulmonares' => 'nullable|string',
            'cardiaco' => 'nullable|string',
            'abdomen_pelvis' => 'nullable|string',
            'extremidades_superiores' => 'nullable|string',
            'extremidades_inferiores' => 'nullable|string',
            'genitourinario' => 'nullable|string',
            'examen_ginecologico' => 'nullable|string',
            'examen_neurologico' => 'nullable|string',
            'observaciones_analisis' => 'nullable|string',
            'diagnosticos_problemas' => 'nullable|string',
            'doctor_id' => 'nullable|max:255',
            'firma_codigo_sello' => 'nullable|string|max:255',
        ]);

        // Actualizar historia clínica
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }
    

        // Actualizar la historia clínica con los datos validados
        $historiasClinica->update($validator->validated());
       
 

    

        return redirect()->route('historias_clinicas.index')
        ->with('update', 'Historia clínica actualizada con éxito.');
   

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
   

    public function destroy($id)
    {
      try {
          $historiaClinica = HistoriaClinica::findOrFail($id);
          $historiaClinica->delete();
  
          return response()->json(['success' => 'Dato eliminado correctamente.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('Error eliminando Emergencia: '.$e->getMessage());
          return redirect()->route('emergencias.index')->with('delete', 'Dato eliminado exitosamente.');
      }
    }

    

     public function generatePdf($id)
    {
        $historiaClinica = HistoriaClinica::with('paciente')->find($id);

        if (!$historiaClinica) {
          return redirect()->route('historias_clinicas.index')->with('error', 'Historia Clínica no encontrada.');
        }

         // Generar el PDF y visualizarlo en el navegador
          $pdf = PDF::loadView('historias_clinicas.pdf', compact('historiaClinica'));
           // Mostrar el PDF en el navegador
          return $pdf->stream('historia_clinica_' . $historiaClinica->id . '.pdf');
     }

      
    public function analizarHistoriaClinica(Request $request, $id)
 {

      try {
        // Obtén la historia clínica del paciente
        $historiaClinica = HistoriaClinica::findOrFail($id);
      } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Historia clínica no encontrada.'], 404);
      } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener la historia clínica.'], 500);
      }

       // Crea el cliente de Guzzle para las solicitudes a la API de OpenAI
      $client = new Client();

       // Lógica de análisis con OpenAI (Resumen) 
     


       try {
        $inputResumen = "Analiza la historia clínica del paciente y proporciona un resumen detallado de los síntomas y diagnósticos con el objetivo de ayudar al medico. " .
                        "Motivo de consulta: " . $historiaClinica->motivo_consulta . 
                        ". Historia de enfermedad actual: " . $historiaClinica->historia_enfermedad_actual . 
                        ". Diagnósticos: " . $historiaClinica->diagnosticos_problemas;
                       

        $responseResumen = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'user', 'content' => $inputResumen],
                ],
            ],
        ]);

         $resumen = json_decode($responseResumen->getBody(), true);
         $resumenContenido = $resumen['choices'][0]['message']['content'] ?? 'No se obtuvo respuesta';

        } catch (\GuzzleHttp\Exception\RequestException $e) {
        return response()->json(['error' => 'Error en la comunicación con la API de OpenAI.'], 500);
       } catch (\Exception $e) {
        return response()->json(['error' => 'Error al procesar el resumen.'], 500);
       }

        // Lógica de análisis con OpenAI (Recomendaciones)
       try {
        $inputRecomendaciones = "Proporciona recomendaciones personalizadas sobre salud y bienestar basadas en la siguiente historia clínica: " . json_encode($historiaClinica);

        $responseRecomendaciones = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'user', 'content' => $inputRecomendaciones],
                ],
            ],
         ]);

          $recomendaciones = json_decode($responseRecomendaciones->getBody(), true);
          $recomendacionesContenido = $recomendaciones['choices'][0]['message']['content'] ?? 'No se obtuvo respuesta';

       } catch (\GuzzleHttp\Exception\RequestException $e) {
        return response()->json(['error' => 'Error en la comunicación con la API de OpenAI.'], 500);
       } catch (\Exception $e) {
        return response()->json(['error' => 'Error al procesar las recomendaciones.'], 500);
       }

    // Detección de patrones y anomalías
     try {
        $resultadosPatronesAnomalias = $this->detectarPatronesYAnomalias($historiaClinica->paciente_id);

        if (isset($resultadosPatronesAnomalias['error'])) {
            return response()->json(['error' => $resultadosPatronesAnomalias['error']], 500);
        }

        } catch (\Exception $e) {
        return response()->json(['error' => 'Error al detectar patrones y anomalías.'], 500);
        }

       // Devuelve la respuesta como JSON (para ser usada con AJAX)
        return response()->json([
        'resumen' => $resumenContenido,
        'recomendaciones' => $recomendacionesContenido,
        'patrones' => $resultadosPatronesAnomalias['patrones'] ?? [],
        'anomalías' => $resultadosPatronesAnomalias['anomalías'] ?? [],
        ]);
   }


    public function showHistoriaClinica($id)
   {
       // Obtener la historia clínica por su ID junto con la información del paciente
      $historiaClinica = HistoriaClinica::with('paciente')->findOrFail($id);

      // Retornar la vista con los datos de la historia clínica y del paciente
      return view('analisis-IA-HCP.analizar_historia', compact('historiaClinica'));
   }
   public function mostraPacientesParaanalisIA()
  {
    // Obtener todas las historias clínicas junto con la información del paciente
   // $historiasClinicas = HistoriaClinica::with('paciente')->get();

    // Retornar la vista con los datos de las historias clínicas y de los pacientes
    return view('analisis-IA-HCP.mostrar_pacientes_ia');
  }

  public function analizarTodasHistoriasClinicas()
  {
      // Obtener todas las historias clínicas
      $historiasClinicas = HistoriaClinica::all();
  
      // Inicializar resultados
      $resultados = [];
  
      foreach ($historiasClinicas as $historiaClinica) {
          try {
              // Crea el cliente de Guzzle para las solicitudes a la API de OpenAI
              $client = new Client();
  
              // Lógica de análisis con OpenAI (Resumen)
              $inputResumen = "Analiza la historia clínica del paciente y proporciona un resumen detallado de los síntomas y diagnósticos. " .
                              "Motivo de consulta: " . $historiaClinica->motivo_consulta . 
                              ". Historia de enfermedad actual: " . $historiaClinica->historia_enfermedad_actual . 
                              ". Diagnósticos: " . $historiaClinica->diagnosticos_problemas;
  
              $responseResumen = $client->post('https://api.openai.com/v1/chat/completions', [
                  'headers' => [
                      'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                      'Content-Type' => 'application/json',
                  ],
                  'json' => [
                      'model' => 'gpt-4',
                      'messages' => [
                          ['role' => 'user', 'content' => $inputResumen],
                      ],
                  ],
              ]);
  
              $resumen = json_decode($responseResumen->getBody(), true);
              $resumenContenido = $resumen['choices'][0]['message']['content'] ?? 'No se obtuvo respuesta';
  
              // Lógica de análisis con OpenAI (Recomendaciones)
              $inputRecomendaciones = "Proporciona recomendaciones personalizadas sobre salud y bienestar basadas en la siguiente historia clínica: " . json_encode($historiaClinica);
  
              $responseRecomendaciones = $client->post('https://api.openai.com/v1/chat/completions', [
                  'headers' => [
                      'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                      'Content-Type' => 'application/json',
                  ],
                  'json' => [
                      'model' => 'gpt-4',
                      'messages' => [
                          ['role' => 'user', 'content' => $inputRecomendaciones],
                      ],
                  ],
              ]);
  
              $recomendaciones = json_decode($responseRecomendaciones->getBody(), true);
              $recomendacionesContenido = $recomendaciones['choices'][0]['message']['content'] ?? 'No se obtuvo respuesta';
  
              // Guardar resultados
              $resultados[] = [
                  'paciente_id' => $historiaClinica->paciente_id,
                  'resumen' => $resumenContenido,
                  'recomendaciones' => $recomendacionesContenido,
              ];
  
          } catch (\Exception $e) {
              // Manejo de errores (opcional)
              $resultados[] = [
                  'paciente_id' => $historiaClinica->paciente_id,
                  'error' => 'Error al analizar la historia clínica: ' . $e->getMessage(),
              ];
          }
      }
  
      // Devuelve los resultados como JSON
      return response()->json($resultados);
  }
  
  public function guardarArchivo(Request $request, $id)
{
    $request->validate([
        'archivo_examen' => 'required|file|mimes:pdf,jpg,jpeg,png', // Validar tipos de archivo
    ]);

    if ($request->hasFile('archivo_examen')) {
        // Almacenar el archivo en la carpeta "public/examenes"
        $rutaArchivo = $request->file('archivo_examen')->store('public/examenes');

        // Obtener la ruta pública del archivo
        $rutaPublica = str_replace('public/', 'storage/', $rutaArchivo);

        // Guardar la ruta en la base de datos
        $historiaClinica = HistoriaClinica::find($id);
        $historiaClinica->archivo_examen = $rutaPublica;
        $historiaClinica->save();
    }

    return back()->with('success', 'Archivo guardado exitosamente.');
}


public function detectarPatronesYAnomalias($pacienteId)
{
    try {
        $paciente = Paciente::findOrFail($pacienteId);
        $sexo = $paciente->sexo;
        // Obtener todas las historias clínicas del paciente
        $historias = HistoriaClinica::where('paciente_id', $pacienteId)->get();
    
        // Validar si hay historias clínicas
        if ($historias->isEmpty()) {
            return ['error' => 'No se encontraron historias clínicas para este paciente.'];
        }

        $resultados = [
            'patrones' => [],
            'anomalías' => [],
        ];

        // Análisis de signos vitales y otros datos
        foreach ($historias as $historia) {
            // 1. Patrones en la frecuencia cardíaca (FC)
            if ($historia->fc < 60 || $historia->fc > 100) {
                $resultados['anomalías'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Frecuencia cardíaca anormal: ' . $historia->fc,
                ];
            } else {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Frecuencia cardíaca normal: ' . $historia->fc,
                ];
            }

            foreach ($historias as $historia) {
                // Obtener edad del paciente
                $edad = $historia->paciente->edad; // Asumiendo que tienes una relación con el paciente
            
                // Definir rangos de peso según la edad
                if ($edad < 13) {
                    // Niños
                    $pesoNormal = ($historia->peso >= 20 && $historia->peso <= 45); // Ejemplo de rangos
                } elseif ($edad < 20) {
                    // Adolescentes
                    $pesoNormal = ($historia->peso >= 50 && $historia->peso <= 70); // Ejemplo de rangos
                } elseif ($edad < 65) {
                    // Adultos
                    $pesoNormal = ($historia->peso >= 50 && $historia->peso <= 100); // Ejemplo de rangos
                } else {
                    // Adultos mayores
                    $pesoNormal = ($historia->peso >= 45 && $historia->peso <= 90); // Ejemplo de rangos
                }
            
                // Evaluar peso según edad
                if (!$pesoNormal) {
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Peso anormal: ' . $historia->peso,
                    ];
                } else {
                    $resultados['patrones'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Peso dentro del rango normal: ' . $historia->peso,
                    ];
                }
            }
            
              
            foreach ($historias as $historia) {
                // Obtener edad del paciente
                $edad = $historia->paciente->edad; // Asumiendo que tienes una relación con el paciente
            
                // Evaluar peso según edad
                if ($edad < 13) {
                    // Niños
                    $pesoNormal = ($historia->peso >= 20 && $historia->peso <= 45); // Ejemplo de rangos
                } elseif ($edad < 20) {
                    // Adolescentes
                    $pesoNormal = ($historia->peso >= 50 && $historia->peso <= 70); // Ejemplo de rangos
                } elseif ($edad < 65) {
                    // Adultos
                    $pesoNormal = ($historia->peso >= 50 && $historia->peso <= 100); // Ejemplo de rangos
                } else {
                    // Adultos mayores
                    $pesoNormal = ($historia->peso >= 45 && $historia->peso <= 90); // Ejemplo de rangos
                }
            
                // Evaluar IMC
                if ($historia->imc < 18.5) {
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'IMC indica bajo peso: ' . $historia->imc,
                    ];
                } elseif ($historia->imc >= 18.5 && $historia->imc <= 24.9) {
                    $resultados['patrones'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'IMC dentro de rango normal: ' . $historia->imc,
                    ];
                } elseif ($historia->imc >= 25 && $historia->imc <= 29.9) {
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'IMC indica sobrepeso: ' . $historia->imc,
                    ];
                } else {
                    // IMC mayor a 30
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'IMC indica obesidad: ' . $historia->imc,
                    ];
                }
            
                // Análisis final sobre peso
                if (!$pesoNormal) {
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Peso anormal: ' . $historia->peso,
                    ];
                } else {
                    $resultados['patrones'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Peso dentro del rango normal: ' . $historia->peso,
                    ];
                }
            }
            
                                                
           
            if (!empty($historia->ta)) {
                // Dividir la presión arterial en sistólica y diastólica
                list($sistolica, $diastolica) = explode('/', $historia->ta);
            
                // Asegurarse de que ambos valores son números
                $sistolica = (int) $sistolica;
                $diastolica = (int) $diastolica;
            
                // Clasificación de la presión arterial
                if ($sistolica < 90 || $diastolica < 60) {
                    // Presión arterial baja
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Presión arterial baja: ' . $historia->ta,
                    ];
                } elseif ($sistolica >= 90 && $sistolica < 120 && $diastolica >= 60 && $diastolica < 80) {
                    // Presión arterial normal
                    $resultados['patrones'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Presión arterial normal: ' . $historia->ta,
                    ];
                } elseif (($sistolica >= 120 && $sistolica < 130 && $diastolica < 80) || ($sistolica < 140 && $diastolica >= 80 && $diastolica < 90)) {
                    // Hipertensión en etapa 1
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Presión arterial alta (etapa 1): ' . $historia->ta,
                    ];
                } elseif (($sistolica >= 130 && $sistolica < 140) || ($diastolica >= 80 && $diastolica < 90)) {
                    // Hipertensión en etapa 2
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Presión arterial alta (etapa 2): ' . $historia->ta,
                    ];
                } elseif ($sistolica >= 180 || $diastolica >= 120) {
                    // Crisis hipertensiva
                    $resultados['anomalías'][] = [
                        'historia_id' => $historia->id,
                        'mensaje' => 'Crisis hipertensiva: ' . $historia->ta,
                    ];
                }
            }
            
            // 5. Patrones en la temperatura corporal
            if ($historia->temperatura < 36.0 || $historia->temperatura > 37.5) {
                $resultados['anomalías'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Temperatura corporal anormal: ' . $historia->temperatura,
                ];
            } else {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Temperatura corporal normal: ' . $historia->temperatura,
                ];
            }

            // 6. Patrones en el consumo de tabaco
            if ($historia->tabaco) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente consume tabaco: ' . $historia->tipo_tabaco,
                ];
            } else {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente no consume tabaco.',
                ];
            }

            // 7. Patrones en el consumo de alcohol
            if ($historia->alcohol) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente consume alcohol: ' . $historia->tipo_alcohol,
                ];
            } else {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente no consume alcohol.',
                ];
            }

            // 8. Patrones en el consumo de drogas ilegales
            if ($historia->drogas_ilegales) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente consume drogas: ' . $historia->tipo_drogas,
                ];
            }

            // 9. Patrones en horas de sueño
            if ($historia->horas_sueno < 6 || $historia->horas_sueno > 9) {
                $resultados['anomalías'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Horas de sueño anormales: ' . $historia->horas_sueno,
                ];
            } else {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Horas de sueño dentro del rango normal: ' . $historia->horas_sueno,
                ];
            }

            // 10. Patrones en horas laborales
            if ($historia->horas_laborales > 10) {
                $resultados['anomalías'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Exceso de horas laborales: ' . $historia->horas_laborales,
                ];
            }

            // 11. Patrones en inmunizaciones
            if (!$historia->inmunizaciones_completas) {
                $resultados['anomalías'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Inmunizaciones incompletas.',
                ];
            }

            // 12. Patrones en enfermedades hereditarias
            if ($historia->enfermedades_hereditarias) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente tiene antecedentes de enfermedades hereditarias.',
                ];
            }

            // 13. Patrones en cirugías previas
            if ($historia->cirugias_previas) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente ha tenido cirugías previas.',
                ];
            }

            // 14. Patrones en hospitalizaciones previas
            if ($historia->hospitalizaciones) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente ha tenido hospitalizaciones previas.',
                ];
            }

            // 15. Patrones en enfermedades crónicas
            if ($historia->enfermedades_cronicas) {
                $resultados['patrones'][] = [
                    'historia_id' => $historia->id,
                    'mensaje' => 'Paciente tiene enfermedades crónicas: ' . $historia->enfermedades_cronicas,
                ];
            }
            
        }
        

        return $resultados;

        
    } catch (\Exception $e) {
        return ['error' => 'Error al detectar patrones y anomalías: ' . $e->getMessage()];
    }
 }



}
