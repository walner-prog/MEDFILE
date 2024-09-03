<?php

namespace App\Http\Controllers;

use App\Models\Emergencia; // Importa el modelo Emergencia
use App\Models\Paciente; // Importa el modelo Paciente
use Illuminate\Http\Request; // Importa la clase Request de Laravel
use Illuminate\Support\Facades\Validator; // Importa la clase Validator de Laravel
use Illuminate\Support\Facades\Log;
class EmergenciaController extends Controller
{
    /**
     * Constructor del controlador que aplica middleware de autenticación.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }

    /**
     * Muestra todas las emergencias disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       // $pacientes = Paciente::get();
      //  $emergencias = Emergencia::get(); 
        return view('emergencias.index');
    }

    /**
     * Muestra el formulario para crear una nueva emergencia.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pacientes = Paciente::all(); // Obtén todos los pacientes para el dropdown
        return view('emergencias.create', compact('pacientes'));
    }

    /**
     * Almacena una nueva emergencia en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'no_expediente' => 'required|string|max:255',
            'hora' => 'required|date_format:H:i',
            'unidad_salud' => 'required|string|max:255',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'required|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:M,F',
            'sala_servicio' => 'required|string|max:255',
            'cama' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'direccion_residencia' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'departamento' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'no_cedula' => 'required|string|max:255',
            'medio_llegada' => 'required|string|max:255',
            'causa_accidente_violencia' => 'required|string|max:255',
            'causa_tratamiento' => 'required|string|max:255',
            'lugar_accidente_violencia' => 'required|string|max:255',
            'vif' => 'required|string|max:255',
            'direccion_avisar' => 'required|string|max:255',
            'parentesco' => 'nullable|string|max:255',
            'telefono_responsable' => 'required|string|max:255',
            'localidad_avisar' => 'required|string|max:255',
            'ciudad_avisar' => 'nullable|string|max:255',
            'departamento_avisar' => 'nullable|string|max:255',
            'peso' => 'required|numeric',
            'talla' => 'required|numeric',
            'temperatura' => 'required|numeric',
            'nombre_quien_atiende' => 'required|string|max:255',
            'frecuencia_cardiaca' => 'required|integer',
            'frecuencia_respiratoria' => 'required|integer',
            'examen_fisico' => 'required|string',
            'diagnostico' => 'required|string',
            'planes' => 'required|string',
            'diagnostico_egreso' => 'required|string',
            'tipo_urgencia' => 'required|string|max:255',
            'destino_paciente' => 'required|string|max:255',
            'referencia' => 'required|string|max:255',
            'hospitalizacion' => 'required|string|max:255',
            'consulta_externa' => 'required|string|max:255',
            'fuga' => 'required|string|max:255',
            'salida_exigida' => 'required|string|max:255',
        ]);
        

        $emergencia = Emergencia::create($validator->validated());

        if ($emergencia) {
            return redirect()->route('emergencias.index')->with('info', 'Emergencia creada exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al crear la emergencia.');
        }
    }

    /**
     * Muestra los detalles de una emergencia específica.
     *
     * @param  \App\Models\Emergencia  $emergencia
     * @return \Illuminate\View\View
     */
    public function show(Emergencia $emergencia)
    {
        return view('emergencias.show', compact('emergencia'));
    }

    /**
     * Muestra el formulario para editar una emergencia existente.
     *
     * @param  \App\Models\Emergencia  $emergencia
     * @return \Illuminate\View\View
     */

    
    public function edit($id)
{
    $emergencia = Emergencia::find($id);
    return view('emergencias.edit', compact( 'emergencia'));
}
    /**
     * Actualiza una emergencia en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emergencia  $emergencia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Emergencia $emergencia)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'unidad_salud' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|in:M,F',
            'sala_servicio' => 'nullable|string|max:255',
            'cama' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'direccion_residencia' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'medio_llegada' => 'nullable|string|max:255',
            'causa_accidente_violencia' => 'nullable|string|max:255',
            'causa_tratamiento' => 'nullable|string|max:255',
            'lugar_accidente_violencia' => 'nullable|string|max:255',
            'vif' => 'nullable|string|max:255',
            'direccion_avisar' => 'nullable|string|max:255',
            'parentesco' => 'nullable|string|max:255',
            'telefono_responsable' => 'nullable|string|max:255',
            'localidad_avisar' => 'nullable|string|max:255',
            'ciudad_avisar' => 'nullable|string|max:255',
            'departamento_avisar' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'talla' => 'nullable|numeric',
            'temperatura' => 'nullable|numeric',
            'nombre_quien_atiende' => 'nullable|string|max:255',
            'frecuencia_cardiaca' => 'nullable|integer',
            'frecuencia_respiratoria' => 'nullable|integer',
            'examen_fisico' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'planes' => 'nullable|string',
            'diagnostico_egreso' => 'nullable|string',
            'tipo_urgencia' => 'nullable|string|max:255',
            'destino_paciente' => 'nullable|string|max:255',
            'referencia' => 'nullable|string|max:255',
            'hospitalizacion' => 'nullable|string|max:255',
            'consulta_externa' => 'nullable|string|max:255',
            'fuga' => 'nullable|string|max:255',
            'salida_exigida' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }

        $emergencia->update($validator->validated());

        if ($emergencia) {
            
            return redirect()->route('emergencias.index')->with('update', 'Emergencia actualizada exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar la emergencia.');
        }
    }

  

    /**
     * Elimina una emergencia de la base de datos.
     *
     * @param  \App\Models\Emergencia  $emergencia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
      try {
          $paciente = Emergencia::findOrFail($id);
          $paciente->delete();
  
          return response()->json(['success' => 'Dato eliminado correctamente.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('Error eliminando Emergencia: '.$e->getMessage());
          return redirect()->route('emergencias.index')->with('delete', 'Dato eliminado exitosamente.');
      }
    }
}
