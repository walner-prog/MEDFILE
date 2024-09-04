<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CitaController extends Controller
{
    // Mostrar una lista de todas las citas
    public function index()
    {
       // $citas = Cita::with('paciente', 'doctor', 'especialidad')->get();
        return view('citas.index');
    }

    // Mostrar el formulario para crear una nueva cita
    public function create()
    {
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('citas.create', compact('doctores', 'pacientes'));
    }

    // Almacenar una nueva cita en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'tipo_cita' => 'required',
            'estado' => 'required',
        ]);

        $doctor = Doctor::find($request->doctor_id);
        $duracion_cita = $doctor->horarios()->where('fecha', $request->fecha_cita)->value('duracion_cita');

        if ($doctor->isAvailable($request->fecha_cita, $request->hora_cita, $duracion_cita)) {
            Cita::create($request->all());
            return redirect()->route('citas.index')->with('info', 'Cita agendada con éxito.');
        } else {
            return redirect()->back()->with('error', 'El doctor no está disponible en la fecha y hora seleccionadas.');
        }
    }

    // Mostrar los detalles de una cita específica
    public function show($id)
    {
        $cita = Cita::with('paciente', 'doctor', 'especialidad')->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    // Mostrar el formulario para editar una cita
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('citas.edit', compact('cita', 'doctores', 'pacientes'));
    }

    // Actualizar los detalles de una cita
    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'tipo_cita' => 'required',
            'estado' => 'required',
        ]);

        $cita = Cita::findOrFail($id);
        $doctor = Doctor::find($request->doctor_id);
        $duracion_cita = $doctor->horarios()->where('fecha', $request->fecha_cita)->value('duracion_cita');

        if ($doctor->isAvailable($request->fecha_cita, $request->hora_cita, $duracion_cita) || ($cita->fecha_cita == $request->fecha_cita && $cita->hora_cita == $request->hora_cita)) {
            $cita->update($request->all());
            return redirect()->route('citas.index')->with('update', 'Cita actualizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'El doctor no está disponible en la fecha y hora seleccionadas.');
        }
    }
    // Eliminar una cita
    
    public function destroy($id)
    {
      try {
          $cita = Cita::findOrFail($id);
          $cita->delete();
  
          return response()->json(['delete' => 'Cita eliminada con éxito.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('Error eliminando cita medica : '.$e->getMessage());
          return redirect()->route('emergencias.index')->with('delete', 'Cita eliminada con éxito.');
      }
    }
}
