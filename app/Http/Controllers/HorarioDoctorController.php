<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\DiaFestivo;
use App\Models\HorarioDoctor;
use App\Models\Doctor;
use Carbon\Carbon;

use Illuminate\Http\Request;


class HorarioDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }

    // Mostrar una lista de todos los horarios
    public function index()
    {
        $doctores_crear = Doctor::all();
        $consultorios_crear = Consultorio::all();
        $horarios_crear = HorarioDoctor::with('doctor','consultorio')->get();
        return view('horarios.index', compact('doctores_crear','consultorios_crear','horarios_crear'));
    }

    // Mostrar el formulario para crear un nuevo horario
    public function create()
    {
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = HorarioDoctor::with('doctor','consultorio')->get();
        return view('horarios.create', compact('horarios','doctores','consultorios'));
    }

   
    
    public function store(Request $request)
    {
        // Validaciones básicas
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'consultorio_id'  => 'required|exists:consultorios,id',
            'dia_semana' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'duracion_cita' => 'required|integer|min:5', // Puedes ajustar el mínimo
        ]);
    
        
        // **2. Verificación del Horario del Consultorio (Cierre a las 20:00)**
        $horaCierre = Carbon::createFromTime(20, 0); // Hora de cierre del consultorio
        $horaInicio = Carbon::createFromTimeString($request->hora_inicio);
        $horaFin = Carbon::createFromTimeString($request->hora_fin);
    
        if ($horaFin->greaterThan($horaCierre)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El horario no puede exceder el cierre del consultorio a las 20:00.');
        }
    
        // **3. Verificación de superposición de horarios para el doctor**
        $horarioExistente = HorarioDoctor::where('doctor_id', $request->doctor_id)
            ->where('dia_semana', $request->dia_semana)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '>=', $request->hora_inicio)
                          ->where('hora_inicio', '<', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_fin', '>', $request->hora_inicio)
                          ->where('hora_fin', '<=', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_inicio', '<', $request->hora_inicio)
                          ->where('hora_fin', '>', $request->hora_fin);
                });
            })
            ->exists();
    
        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El doctor ya tiene un horario superpuesto en otro consultorio para este día y hora.');
        }
    
        // Crear el nuevo horario si todas las validaciones pasan
        HorarioDoctor::create($request->all());
    
        return redirect()->route('horarios-doctor.index')->with('info', 'Horario creado con éxito.');
    }
    
    
    
    public function horarios_doctor_consultorio($id)

     
    {

        $horario = Consultorio::find($id);
        try {
            // Se utiliza Eloquent para obtener los horarios, incluyendo las relaciones con 'doctor' y 'consultorio'.
            $horarios = HorarioDoctor::with(['doctor', 'consultorio'])
                // Filtra los horarios basados en el 'consultorio_id' proporcionado en el parámetro $id.
                ->where('consultorio_id', $id)
                // Obtiene los resultados de la consulta.
                ->get();
    
            // Devuelve una vista, pasando la variable $horarios a la vista 'admin.horarios.cargar_datos_consultorios'.
            return view('horarios.horarios_doctor_consultorio', compact('horarios','horario'));
        } catch (\Exception $exception) {
            // En caso de que ocurra un error, devuelve una respuesta JSON con el mensaje 'Error'.
            return response()->json(['mensaje' => 'Error']);
        }
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

    public function update(Request $request, $id)
    {
        // Validaciones básicas
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'consultorio_id'  => 'required|exists:consultorios,id',
            'dia_semana' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'duracion_cita' => 'required|integer|min:5',
        ]);
    
        // Buscar el horario a actualizar
        $horario = HorarioDoctor::findOrFail($id);
    
        // **1. Verificar días festivos (opcional)**
        $esFestivo = DiaFestivo::where('fecha', $request->fecha_cita)->exists();
        if ($esFestivo) {
            return redirect()->back()->with('error', 'El día seleccionado es un día festivo y no se pueden modificar horarios.');
        }
    
        // **2. Verificación del Horario del Consultorio (Cierre a las 20:00)**
        $horaCierre = Carbon::createFromTime(20, 0); // Hora de cierre del consultorio
        $horaInicio = Carbon::createFromTimeString($request->hora_inicio);
        $horaFin = Carbon::createFromTimeString($request->hora_fin);
    
        if ($horaFin->greaterThan($horaCierre)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El horario no puede exceder el cierre del consultorio a las 20:00.');
        }
    
        // **3. Verificación de superposición de horarios para el doctor**
        $horarioExistente = HorarioDoctor::where('doctor_id', $request->doctor_id)
            ->where('dia_semana', $request->dia_semana)
            ->where('id', '!=', $id) // Excluir el horario actual de la verificación
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '>=', $request->hora_inicio)
                          ->where('hora_inicio', '<', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_fin', '>', $request->hora_inicio)
                          ->where('hora_fin', '<=', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_inicio', '<', $request->hora_inicio)
                          ->where('hora_fin', '>', $request->hora_fin);
                });
            })
            ->exists();
    
        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El doctor ya tiene un horario superpuesto en otro consultorio para este día y hora.');
        }
    
        // **4. Actualizar el horario si todas las validaciones pasan**
        $horario->update($request->all());
    
        return redirect()->route('horarios-doctor.index')->with('info', 'Horario actualizado con éxito.');
    }
    

    // Eliminar un horario
    public function destroy($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        $horario->delete();

        return redirect()->route('horarios-doctor.index')->with('success', 'Horario eliminado con éxito.');
    }



}
