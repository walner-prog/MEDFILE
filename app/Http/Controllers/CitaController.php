<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Consultorio;
use App\Models\DiaFestivo;
use App\Models\HorarioDoctor;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Excepcion;
class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }

    // Mostrar una lista de todas las citas
    public function index()
    {
       // $citas = Cita::with('paciente', 'doctor', 'especialidad')->get();
       $doctores = Doctor::all();
       $consultorios = Consultorio::all();
       $horarios = HorarioDoctor::with('doctor','consultorio')->get();
   
          return view('citas.index' , compact('horarios','doctores','consultorios'));
    }

    // Mostrar el formulario para crear una nueva cita
    public function create()
    {
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('citas.create', compact('doctores', 'pacientes'));
    }

    public function store(Request $request)
   {
        // Validación de los datos de entrada
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required|date_format:H:i',
            'tipo_cita' => 'required|string',
            'estado' => 'required|in:por confirmar,confirmada,en progreso,cancelada,realizada',
            'duracion' => 'required|integer|min:30', // Duración mínima de 15 minutos
           // 'especialidad_id' => 'required|exists:especialidades,id', // Validar especialidad_id
         ]);
    
             $doctor = Doctor::findOrFail($request->doctor_id);
            $fecha = Carbon::parse($request->fecha_cita);
            $hora = Carbon::parse($request->hora_cita);
           $duracion = $request->duracion;
           $pacienteId = $request->paciente_id;
        
         // 1. Validar que no se agenden citas en días festivos
    $esDiaFestivo = DiaFestivo::where('fecha', $fecha->toDateString())->exists();

    if ($esDiaFestivo) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'No se pueden agendar citas en días festivos.');
    }

    // 2. Verificar si el paciente ya tiene una cita a la misma hora en otro consultorio
    $citaExistentePaciente = Cita::where('paciente_id', $pacienteId)
        ->where('fecha_cita', $fecha->toDateString())
        ->where(function ($query) use ($hora, $duracion) {
            $horaFin = $hora->copy()->addMinutes($duracion);
            $query->whereBetween('hora_cita', [$hora->toTimeString(), $horaFin->toTimeString()])
                ->orWhere(function ($query) use ($hora, $horaFin) {
                    $query->where('hora_cita', '<=', $hora->toTimeString())
                        ->where(DB::raw("ADDTIME(hora_cita, SEC_TO_TIME(duracion * 60))"), '>=', $hora->toTimeString());
                });
        })
        ->where('consultorio_id', '!=', $request->consultorio_id) // Verifica en otro consultorio
        ->exists();

    if ($citaExistentePaciente) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'El paciente ya tiene una cita a la misma hora en otro consultorio.');
    }


            // Verificar que la fecha y hora estén dentro del horario laboral del doctor
             $diasSemana = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sabado',
            'Sunday' => 'domingo',
           ];
        
        $diaSemana = $diasSemana[$fecha->format('l')];
    
        $horario = $doctor->horarios()
                          ->where('dia_semana', $diaSemana)
                          ->first();
    
        if (!$horario || $hora->lt(Carbon::parse($horario->hora_inicio)) || $hora->copy()->addMinutes($duracion)->gt(Carbon::parse($horario->hora_fin))) {
           // return response()->json(['error' => 'El horario no está disponible para el doctor.'], 422);
            return redirect()->back()
            ->withInput() // Esto preserva el valor de los campos del formulario
            ->with('error', 'El horario no está disponible para el doctor.'); // Solo un 'with'
         }
    
          // Verificar si es un día no laborable o tiene bloqueos horarios
          $excepcion = Excepcion::where('doctor_id', $doctor->id)
                              ->where('fecha', $fecha->toDateString())
                              ->where(function($query) use ($hora) {
                                  $query->where('tipo', 'dia_no_laborable')
                                        ->orWhere(function($query) use ($hora) {
                                            $query->where('tipo', 'bloqueo_horas')
                                                  ->where('hora_inicio', '<=', $hora->toTimeString())
                                                  ->where('hora_fin', '>=', $hora->toTimeString());
                                        });
                              })
                              ->first();
    
        if ($excepcion) {
           
            return redirect()->back()
            ->withInput() // Esto preserva el valor de los campos del formulario
            ->with('error', 'El doctor no está disponible en la fecha u hora seleccionada debido a una excepción.'); // Solo un 'with'
        }
    
        // Verificar si ya existe una cita en el horario solicitado
        $citaExistente = Cita::where('doctor_id', $doctor->id)
                             ->where('fecha_cita', $fecha->toDateString())
                             ->where(function($query) use ($hora, $duracion) {
                                 $horaFin = $hora->copy()->addMinutes($duracion);
                                 $query->whereBetween('hora_cita', [$hora->toTimeString(), $horaFin->toTimeString()])
                                       ->orWhere(function($query) use ($hora, $horaFin) {
                                           $query->where('hora_cita', '<=', $hora->toTimeString())
                                                 ->where(DB::raw("ADDTIME(hora_cita, SEC_TO_TIME(duracion * 60))"), '>=', $hora->toTimeString());
                                       });
                             })
                             ->exists();
    
        if ($citaExistente) {
           
            return redirect()->back()
            ->withInput() // Esto preserva el valor de los campos del formulario
            ->with('error', 'La hora seleccionada no está disponible o ya esta ocupada.'); // Solo un 'with'
        }
     // Crear la cita
      Cita::create([
    'paciente_id' => $request->paciente_id,
    'doctor_id' => $doctor->id,
    'fecha_cita' => $fecha->toDateString(),
    'hora_cita' => $hora->toTimeString(),
    'duracion' => $duracion,
    'tipo_cita' => $request->tipo_cita,
    'descripcion_cita' => $request->descripcion_cita,
    'estado' => $request->estado,
    'especialidad_id' => $request->especialidad_id, // Incluir especialidad_id
     'title' => (!empty($request->hora_cita) ? $request->hora_cita : 'Hora no especificada') . ' ' . (!empty($doctor->especialidad->nombre) ? $doctor->especialidad->nombre : 'Especialidad no especificada'),

    'start' => $request->fecha_cita . ' ' . $request->hora_cita . ':00',

    'end' => $request->fecha_cita . ' ' . $request->hora_cita . ':00',
    'color' => '#e82216',
    'consultorio_id' => 1, // Asegúrate de que 'consultorio_id' tenga un valor
    ]);

        //return response()->json([    'message' => 'Cita agendada exitosamente.'    ], 201);

        return redirect()->route('citas.index')->with('info', 'cita creada con éxito.');
 }


    public function verificarDisponibilidad(Request $request)
   {
    $request->validate([
        'doctor_id' => 'required|exists:doctores,id',
        'fecha_cita' => 'required|date',
        'hora_cita' => 'required|date_format:H:i',
        'duracion' => 'required|integer|min:30',
    ]);

    $doctor = Doctor::findOrFail($request->doctor_id);
    $fecha = Carbon::parse($request->fecha_cita);
    $hora = Carbon::parse($request->hora_cita);
    $duracion = $request->duracion;

    // Verificar horario laboral
    $horario = $doctor->horarios()
                      ->where('dia_semana', $fecha->format('l'))
                      ->first();
    if (!$horario || $hora->lt(Carbon::parse($horario->hora_inicio)) || $hora->copy()->addMinutes($duracion)->gt(Carbon::parse($horario->hora_fin))) {
        return response()->json(['error' => 'El horario no está disponible para el doctor.'], 422);
    }

    // Verificar excepciones
    $excepcion = Excepcion::where('doctor_id', $doctor->id)
                          ->where('fecha', $fecha->toDateString())
                          ->where(function($query) use ($hora) {
                              $query->where('tipo', 'dia_no_laborable')
                                    ->orWhere(function($query) use ($hora) {
                                        $query->where('tipo', 'bloqueo_horas')
                                              ->where('hora_inicio', '<=', $hora->toTimeString())
                                              ->where('hora_fin', '>=', $hora->toTimeString());
                                    });
                          })
                          ->first();
    if ($excepcion) {
        return response()->json(['error' => 'El doctor no está disponible debido a una excepción.'], 422);
    }

    $citaExistente = Cita::where('doctor_id', $doctor->id)
    ->where('fecha_cita', $fecha->toDateString())
    ->where(function($query) use ($hora, $duracion) {
        $horaFin = $hora->copy()->addMinutes($duracion);
        $query->where(function($query) use ($hora, $horaFin) {
            // Verificar si la nueva cita empieza o termina dentro de una cita existente
            $query->where('hora_cita', '<=', $horaFin->toTimeString())
                  ->where(DB::raw("ADDTIME(hora_cita, SEC_TO_TIME(duracion * 60))"), '>', $hora->toTimeString());
        });
    })
    ->exists();

    if ($citaExistente) {
        return response()->json(['error' => 'La hora seleccionada ya está ocupada.'], 422);
    }

    return response()->json(['message' => 'Horario disponible.'], 200);
   }



public function obtenerHorariosDisponibles(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctores,id',
        'fecha_cita' => 'required|date',
    ]);

    $doctorId = $request->doctor_id;
    $fechaCita = $request->fecha_cita;
    $duracion = 30; // Duración en minutos de cada cita

    // Llamada al procedimiento almacenado
    $resultados = DB::select('CALL obtener_horarios_disponibles(?, ?, ?)', [$doctorId, $fechaCita, $duracion]);

    $horariosDisponibles = array_map(function($horario) {
        return $horario->hora_inicio . ' - ' . $horario->hora_fin;
    }, $resultados);

    return response()->json(['horarios' => $horariosDisponibles]);
}


   public function horarios_citas_consultorio($id) {

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

        $cita->title = (!empty($request->hora_reserva) ? $request->hora_reserva : 'Hora no especificada') . ' ' . (!empty($doctor->especialidad) ? $doctor->especialidad : 'Especialidad no especificada');

        $cita ->start = $request->fecha_reserva;
        $cita->end = $request->fecha_reserva;
        $cita->color='#e82216';
        $cita->consultorio_id = '1'; 
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

