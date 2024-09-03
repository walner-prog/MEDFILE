<?php

namespace App\Http\Controllers;

use App\Models\ListaProblema;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ListaProblemasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      
        return view('lista_problemas.index');
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('lista_problemas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'edad' => 'required|integer',
            'no_expediente' => 'required|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'nombre_problema' => 'required|string|max:255',
            'inactivo' => 'boolean',
            'resuelto' => 'boolean',
            'establecimiento_salud' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

        ListaProblema::create($validator->validated());

        return redirect()->route('lista_problemas.index')->with('info', 'Problema agregado exitosamente.');
    }

  
    public function show($id)
    {
        
        $listaProblema = ListaProblema::find($id);
        return view('lista_problemas.show', compact('listaProblema'));
    }

   
    public function edit($id)
    {
        
        $listaProblema = ListaProblema::find($id);
        $paciente = Paciente::find($listaProblema->paciente_id); // Obtener el paciente específico
        return view('lista_problemas.edit', compact('listaProblema','paciente'));
    }
   

    public function update(Request $request, ListaProblema $listaProblema)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'edad' => 'required|integer',
            'no_expediente' => 'required|string|max:255',
            'servicio' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'nombre_problema' => 'required|string|max:255',
            'inactivo' => 'boolean',
            'resuelto' => 'boolean',
            'establecimiento_salud' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

        $listaProblema->update($validator->validated());

        return redirect()->route('lista_problemas.index')->with('update', 'Problema actualizado exitosamente.');
    }

    
    public function destroy($id)
    {
      try {
          $listaProblema = ListaProblema::findOrFail($id);
          $listaProblema->delete();
  
          return response()->json(['delete' => 'Problema eliminado exitosamente.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('ErrorControl de Problema: '.$e->getMessage());
          return redirect()->route('lista_problemas.index')->with('delete', 'Problema eliminado exitosamente.');
      }
    }
}
