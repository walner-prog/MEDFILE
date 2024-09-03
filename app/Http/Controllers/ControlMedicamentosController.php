<?php

namespace App\Http\Controllers;

use App\Models\ControlMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Paciente;

class ControlMedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
     }
    public function index()
    {
       
        return view('control_medicamentos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('control_medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'no_inss' => 'nullable|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'no_cama' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'medicamentos_otros' => 'nullable|string',
            'fecha_medicamentos' => 'nullable|date',
            'hora_medicamentos' => 'nullable',
            'medicamentos_stat_prn_preanestesico' => 'nullable|string',
            'hora_medicamentos_stat_prn' => 'nullable',
            'fecha_medicamentos_stat_prn' => 'nullable|date',
            'nombre_enfermera_codigo' => 'nullable|string|max:255',
        ]);


        ControlMedicamento::create($request->all());

        return redirect()->route('control_medicamentos.index')
                         ->with('info', 'Control de medicamentos creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ControlMedicamentos $control
     * @return \Illuminate\Http\Response
     */
   
     public function show($id)
    {
        $controle = ControlMedicamento::find($id);
        return view('control_medicamentos.show', compact('controle'));
    }

   
        
       
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ControlMedicamento $control
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $controle = ControlMedicamento::find($id);
        return view('control_medicamentos.edit', compact('controle'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ControlMedicamento $control
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlMedicamento $controle)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'no_inss' => 'nullable|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'no_cama' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'medicamentos_otros' => 'nullable|string',
            'fecha_medicamentos' => 'nullable|date',
            'hora_medicamentos' => 'nullable',
            'medicamentos_stat_prn_preanestesico' => 'nullable|string',
            'hora_medicamentos_stat_prn' => 'nullable',
            'fecha_medicamentos_stat_prn' => 'nullable|date',
            'nombre_enfermera_codigo' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }
    
        // Actualizar la historia clínica con los datos validados
        $controle->update($validator->validated());
       
        return redirect()->route('control_medicamentos.index')
                         ->with('update', 'Control de medicamentos actualizado exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ControlMedicamento $control
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
      try {
          $control = ControlMedicamento::findOrFail($id);
          $control->delete();
  
          return response()->json(['delete' => 'Dato eliminado correctamente.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('ErrorControl de medicamentos: '.$e->getMessage());
          return redirect()->route('control_medicamentos.index')->with('delete', 'Control de medicamentos eliminado con éxito.');
      }
    }
}
