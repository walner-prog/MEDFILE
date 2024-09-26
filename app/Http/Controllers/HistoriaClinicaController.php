<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }
    public function index()
    {   

        $total_historias= HistoriaClinica::count();
         
        return view('historias_clinicas.index', compact('total_historias'));
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

           // 'edad' => 'nullable|integer|min:0',
            'fecha_nacimiento' => 'nullable|date',
            'lugar_nacimiento' => 'nullable|string|max:255',
           // 'sexo' => 'nullable|in:M,F',
            'procedencia' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
           // 'grupos_etnicos' => 'nullable|string|max:255',
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
            'nombre_elabora_historia' => 'nullable|string|max:255',
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
    { $historiaClinica = HistoriaClinica::with('paciente')->find($id);
    
        if (!$historiaClinica) {
            return redirect()->route('historias_clinicas.index')->with('error', 'Historia Clínica no encontrada.');
        }
    
          // Convertir la fecha de nacimiento a un objeto Carbon
    $historiaClinica->fecha_nacimiento = Carbon::parse($historiaClinica->fecha_nacimiento);
     // Formatea las fechas
     $historiaClinica = HistoriaClinica::find($id);
    if ($historiaClinica->fecha_menopausia) {
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
            'nombre_elabora_historia' => 'nullable|string|max:255',
            'firma_codigo_sello' => 'nullable|string|max:255',
        ]);

        // Actualizar historia clínica
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }
    
       // $result = $historiasClinica->update($validator->validated());
        //dd($result, $historiasClinica);

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

   // return $pdf->download('historia_clinica_' . $historiaClinica->id . '.pdf');
    
    // Mostrar el PDF en el navegador
    return $pdf->stream('historia_clinica_' . $historiaClinica->id . '.pdf');
}

}
