<?php

namespace App\Http\Controllers;

use App\Models\InformeCondicionDiaria;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InformesCondicionDiariaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    
      //  $informes = InformeCondicionDiaria::with('paciente')->get();
        return view('informes_condicion_diaria.index');
    }

    public function create()
    {
        return view('informes_condicion_diaria.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'servicio' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'fecha_hora_condicion' => 'nullable|date',
            'tratamiento' => 'nullable|string',
            'procedimientos' => 'nullable|string',
            'brindada_por' => 'nullable|string|max:255',
            'recibida_por' => 'nullable|string|max:255',
            'firma_quien_recibe' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

        $informe = InformeCondicionDiaria::create($validator->validated());

        if ($informe) {
            return redirect()->route('informes_condicion_diaria.index')->with('info', 'Informe creado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al crear el informe.');
        }
    }

   

    public function show($id)
    {
        
        $informe = InformeCondicionDiaria::find($id);
        return view('informes_condicion_diaria.show', compact('informe'));
    }
    public function edit($id)
    {
        //$informe = InformeCondicionDiaria::findOrFail($id);
        $informe = InformeCondicionDiaria::find($id);
        $paciente = Paciente::find($informe->paciente_id); // Obtener el paciente específico
        return view('informes_condicion_diaria.edit', compact('informe','paciente'));
    }
    
   

    public function update(Request $request, InformeCondicionDiaria $informe)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'servicio' => 'nullable|string|max:255',
            'sala' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255',
            'fecha_hora_condicion' => 'nullable|date',
            'tratamiento' => 'nullable|string',
            'procedimientos' => 'nullable|string',
            'brindada_por' => 'nullable|string|max:255',
            'recibida_por' => 'nullable|string|max:255',
            'firma_quien_recibe' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }
         // $result = $informe->update($validator->validated());
         // dd($result, $informe);
          $informe->update($validator->validated());

        if ($informe) {
            return redirect()->route('informes_condicion_diaria.index')->with('update', 'Informe editado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar el informe.');
        }
    }
    public function destroy($id)
    {
      try {
          $informe = InformeCondicionDiaria::findOrFail($id);
          $informe->delete();
  
          return response()->json(['delete' => 'Informe eliminado exitosamente.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('ErrorControl de medicamentos: '.$e->getMessage());
          return redirect()->route('InformeCondicionDiaria.index')->with('delete', 'Informe eliminado exitosamente.');
      }
    }
   
}
