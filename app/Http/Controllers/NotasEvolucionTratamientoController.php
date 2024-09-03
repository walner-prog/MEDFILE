<?php

namespace App\Http\Controllers;

use App\Models\NotaEvolucionTratamiento;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class NotasEvolucionTratamientoController extends Controller
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
       
        return view('notas_evolucion_tratamiento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notas_evolucion_tratamiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'no_cama' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'fecha_hora' => 'nullable|date',
            'problemas_evolucion' => 'nullable|string',
            'planes' => 'nullable|string',
            'participantes_atencion' => 'nullable|string',
            'firma_codigo_profesional' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

     
        NotaEvolucionTratamiento::create($validator->validated());

        return redirect()->route('notas_evolucion_tratamiento.index')
                         ->with('info', 'Nota de evolución y tratamiento creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\NotasEvolucionTratamiento $nota
     * @return \Illuminate\Http\Response
     */
    
    
    public function show($id)
    {
        
        $nota = NotaEvolucionTratamiento::find($id);
        if (!$nota) {
            return redirect()->route('notas_evolucion_tratamiento.index')->with('error', 'Nota no encontrada.');
        }
    
        // Asegúrate de que fecha_hora es un objeto Carbon
        $nota->fecha_hora = $nota->fecha_hora ? Carbon::parse($nota->fecha_hora) : null;
        return view('notas_evolucion_tratamiento.show', compact('nota'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\NotasEvolucionTratamiento $nota
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        //$listaProblema = ListaProblema::findOrFail($id);
        $nota = NotaEvolucionTratamiento::find($id);
        $paciente = Paciente::find($nota->paciente_id); // Obtener el paciente específico
        return view('notas_evolucion_tratamiento.edit', compact('nota','paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NotasEvolucionTratamiento $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaEvolucionTratamiento $nota)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'no_cama' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'fecha_hora' => 'nullable|date',
            'problemas_evolucion' => 'nullable|string',
            'planes' => 'nullable|string',
            'participantes_atencion' => 'nullable|string',
            'firma_codigo_profesional' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

        
       // En tu controlador o donde preparas los datos
       $nota->fecha_hora = \Carbon\Carbon::parse($nota->fecha_hora)->format('Y-m-d\TH:i');

       //$result = $nota->update($validator->validated());
         // dd($result, $nota);

        $nota->update($validator->validated());

        
        if ($nota) {
            return redirect()->route('notas_evolucion_tratamiento.index')->with('update', 'Nota de evolución y tratamiento actualizada con éxito.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar la Nota de evolución y tratamiento.');
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\NotasEvolucionTratamiento $nota
     * @return \Illuminate\Http\Response
     */
   
     
    public function destroy($id)
    {
      try {
          $nota = NotaEvolucionTratamiento::findOrFail($id);
          $nota->delete();
  
          return response()->json(['delete' => 'Nota de evolución y tratamiento eliminada con éxito.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('ErrorControl Nota de evolución: '.$e->getMessage());
          return redirect()->route('notas_evolucion_tratamiento.index')->with('delete', 'Nota de evolución y tratamiento eliminada con éxito.');
      }
    }
}
