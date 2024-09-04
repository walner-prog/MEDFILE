<?php

namespace App\Http\Controllers;

use App\Models\HorarioDoctor;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HorarioDoctorController extends Controller
{
    // Mostrar una lista de todos los horarios
    public function index()
    {
        $doctores = Doctor::all();
        $horarios = HorarioDoctor::with('doctor')->get();
        return view('horarios.index', compact('horarios','doctores'));
    }

    // Mostrar el formulario para crear un nuevo horario
    public function create()
    {
        $doctores = Doctor::all();
        return view('horarios.create', compact('doctores'));
    }

    // Almacenar un nuevo horario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
           
        ]);

        HorarioDoctor::create($request->all());

        return redirect()->route('horarios-doctor.index')->with('success', 'Horario creado con éxito.');
    }

    // Mostrar los detalles de un horario específico
    public function show($id)
    {
        $horario = HorarioDoctor::with('doctor')->findOrFail($id);
        return view('horarios.show', compact('horario'));
    }

    // Mostrar el formulario para editar un horario
    public function edit($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        $doctores = Doctor::all();
        return view('horarios.edit', compact('horario', 'doctores'));
    }

    // Actualizar los detalles de un horario
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
          
        ]);

        $horario = HorarioDoctor::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('horarios-doctor.index')->with('success', 'Horario actualizado con éxito.');
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        $horario->delete();

        return redirect()->route('horarios-doctor.index')->with('success', 'Horario eliminado con éxito.');
    }



}
