<?php

namespace App\Http\Controllers;

use App\Models\Excepcion;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExcepcionController extends Controller
{
    // Método index para listar todas las excepciones
    public function index()
    {
        $excepciones = Excepcion::with('doctor')->get();
        return view('excepciones.index', compact('excepciones'));
    }

    // Método create para mostrar el formulario de creación de una excepción
    public function create()
    {
        $doctores = Doctor::all();
        return view('excepciones.create', compact('doctores'));
    }

    // Método store para almacenar una nueva excepción
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'tipo' => 'required|in:dia_no_laborable,bloqueo_horas',
            'hora_inicio' => 'nullable|required_if:tipo,bloqueo_horas|date_format:H:i',
            'hora_fin' => 'nullable|required_if:tipo,bloqueo_horas|date_format:H:i|after:hora_inicio',
        ]);

        // Verificar que no haya conflicto con otras excepciones
        $excepcionExistente = Excepcion::where('doctor_id', $request->doctor_id)
                                       ->where('fecha', $request->fecha)
                                       ->where(function ($query) use ($request) {
                                           if ($request->tipo === 'bloqueo_horas') {
                                               $query->where('hora_inicio', '<=', $request->hora_fin)
                                                     ->where('hora_fin', '>=', $request->hora_inicio);
                                           }
                                           $query->where('tipo', $request->tipo);
                                       })
                                       ->exists();

        if ($excepcionExistente) {
            return redirect()->back()->withErrors(['error' => 'Ya existe una excepción para este doctor en esa fecha y horario.']);
        }

        // Crear la excepción
        Excepcion::create([
            'doctor_id' => $request->doctor_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('excepciones.index')->with('info', 'Excepción creada con éxito.');
    }

    // Método show para mostrar una excepción específica
    public function show($id)
    {
        $excepcion = Excepcion::findOrFail($id);
        return view('excepciones.show', compact('excepcion'));
    }

    // Método edit para mostrar el formulario de edición de una excepción
    public function edit($id)
    {
        $excepcion = Excepcion::findOrFail($id);
        $doctores = Doctor::all();
        return view('excepciones.edit', compact('excepcion', 'doctores'));
    }

    // Método update para actualizar una excepción existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'tipo' => 'required|in:dia_no_laborable,bloqueo_horas',
            'hora_inicio' => 'nullable|required_if:tipo,bloqueo_horas|date_format:H:i',
            'hora_fin' => 'nullable|required_if:tipo,bloqueo_horas|date_format:H:i|after:hora_inicio',
        ]);

        $excepcion = Excepcion::findOrFail($id);

        // Verificar que no haya conflicto con otras excepciones
        $excepcionExistente = Excepcion::where('doctor_id', $request->doctor_id)
                                       ->where('fecha', $request->fecha)
                                       ->where('id', '!=', $id)
                                       ->where(function ($query) use ($request) {
                                           if ($request->tipo === 'bloqueo_horas') {
                                               $query->where('hora_inicio', '<=', $request->hora_fin)
                                                     ->where('hora_fin', '>=', $request->hora_inicio);
                                           }
                                           $query->where('tipo', $request->tipo);
                                       })
                                       ->exists();

        if ($excepcionExistente) {
            return redirect()->back()->withErrors(['error' => 'Ya existe una excepción para este doctor en esa fecha y horario.']);
        }

        // Actualizar la excepción
        $excepcion->update([
            'doctor_id' => $request->doctor_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('excepciones.index')->with('success', 'Excepción actualizada con éxito.');
    }

    // Método destroy para eliminar una excepción
    public function destroy($id)
    {
        $excepcion = Excepcion::findOrFail($id);
        $excepcion->delete();

        return redirect()->route('excepciones.index')->with('success', 'Excepción eliminada con éxito.');
    }
}
