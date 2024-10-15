<?php
namespace App\Http\Controllers;
use App\Services\OpenAIService;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Consultorio;
use App\Models\DiaFestivo;
use App\Models\HorarioDoctor;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Excepcion;
use App\Notifications\CitaProximaNotification;
use Illuminate\Console\Scheduling\Schedule;


class CitavueController extends Controller
{
     // Método para mostrar el formulario de agendar cita
     public function agendarCita()
     {
        
    // Verificar si el paciente está autenticado
    if (!auth('paciente')->check()) {
        return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para agendar sus citas.');
    }

       // Obtener el ID del paciente autenticado
      $pacienteId = auth('paciente')->user()->id;
         // Lógica para agendar cita (puedes pasar datos a la vista si es necesario)
        
         $citas = Cita::with('paciente', 'doctor', 'especialidad')->get();
         $doctores = Doctor::all();
         $consultorios = Consultorio::all();
         $horarios = HorarioDoctor::with('doctor','consultorio')->get();
         $pacientes = Paciente::all();
         $citas = Cita::with('paciente', 'doctor', 'especialidad')->get();
         return view('citas_portal.agendar',compact('pacientes','doctores','citas','consultorios','horarios'));
     }
 
     public function citasAgendadas()
   {
      // Verificar si el paciente está autenticado
      if (!auth('paciente')->check()) {
        return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para ver sus citas.');
      }

      // Obtener el ID del paciente autenticado
      $pacienteId = auth('paciente')->user()->id;

       // Obtener las citas del paciente autenticado con las relaciones necesarias
      $citas = Cita::with('doctor', 'especialidad', 'consultorio')
                 ->where('paciente_id', $pacienteId)
                 ->get();

       // Lógica para obtener citas agendadas
       return view('citas_portal.agendadas', compact('citas'));
  }

      // Método para mostrar el historial de citas
   public function historialCitas()
   {
     // Verificar si el paciente está autenticado
     if (!auth('paciente')->check()) {
         return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para ver sus historial de  citas.');
     }
 
     // Obtener el paciente autenticado
     $paciente = auth('paciente')->user();
 
     // Obtener el historial de citas del paciente autenticado, ordenadas por fecha
     $citas = Cita::where('paciente_id', $paciente->id)
                 ->orderBy('fecha_cita', 'desc')
                 ->get();
 
     // Retornar la vista con las citas
     return view('citas_portal.historial', compact('citas'));
  }
 
         
   public function obtenerDetallesCita($id)
  {
    $cita = Cita::with('doctor', 'especialidad', 'consultorio', 'paciente')->findOrFail($id);
    
      // Retornar la cita en formato JSON para el frontend
      return response()->json($cita);
   }

   public function notificacionesPendientes()
  {

     Carbon::setLocale('es'); // Esto asegurará que Carbon use el idioma español
    // Verificar si el paciente está autenticado
     if (!auth('paciente')->check()) {
        return redirect()->route('pacientes.login')->with('error', 'Por favor inicie sesión para ver sus notificaciones.');
     }

      // Obtener el ID del paciente autenticado
      $pacienteId = auth('paciente')->user()->id;

    
      $notificaciones = Cita::where('paciente_id', $pacienteId)
        ->where('fecha_cita', '>=', now()) // Solo citas con fecha futura o hoy
        //->where('estado', 'pendiente') // Asegúrate de que este valor exista en la base de datos
        ->get();

     // Obtener el historial de notificaciones (citas atendidas y pasadas)
      $historialNotificaciones = Cita::where('paciente_id', $pacienteId)
      ->where('fecha_cita', '<', now()) // Citas pasadas
      ->orwhere('estado', 'confirmada')
      ->orwhere('estado', 'por confirmar')
      ->orwhere('estado', 'cancelada')  // Solo aquellas que han sido atendidas
      ->get();



   
     // Retornar la vista con las notificaciones y otros datos necesarios
     return view('citas_portal.notificaciones', [
        'notificaciones' => $notificaciones,
        'historialNotificaciones' => $historialNotificaciones,
       // 'recordatorios' => $recordatorios,
        'mostrarHistorial' => false // Puedes gestionar esto según tus necesidades
      ]);
   }

     // Mostrar el formulario para crear una nueva cita
     public function create()
     {
         $doctores = Doctor::all();
         $pacientes = Paciente::all();
         return view('citas.create', compact('doctores', 'pacientes'));
     }
 
     public function stores(Request $request)
     {
         // Validación de los datos de entrada
         try {

         $request->validate([
             'doctor_id' => 'required|exists:doctores,id',
            
             'fecha_cita' => 'required|date',
             'hora_cita' => 'required',
             'tipo_cita' => 'required|string',
             'estado' => 'required|in:por confirmar,confirmada,en progreso,cancelada,realizada',
             'duracion' => 'required|integer|min:30', // Duración mínima de 15 minutos
            // 'especialidad_id' => 'required|exists:especialidades,id', // Validar especialidad_id
          ]);
     
              $doctor = Doctor::findOrFail($request->doctor_id);
             $fecha = Carbon::parse($request->fecha_cita);
             $hora = Carbon::parse($request->hora_cita);
            $duracion = $request->duracion;
            $pacienteId = auth('paciente')->user()->id;

         
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
     $cita =  Cita::create([
        'paciente_id' => $pacienteId,
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
    // dd($citas);
   
         // Enviar notificación al paciente
         $citas = Cita::where('fecha_cita', Carbon::now()->addDay()->format('Y-m-d'))->get();
         foreach ($citas as $cita) {
             $cita->paciente->notify(new CitaProximaNotification($cita));
         }
         

        
         
         return redirect()->route('citas.agendadas')->with('info', 'cita creada con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al agendar la cita. Por favor, inténtelo de nuevo.']);
        }
    }
 
       // Método para obtener todas las citas
       public function index()
       {
           $citas = Cita::with(['doctor', 'paciente'])->get();
           return response()->json($citas, 200);
       }
   
       // Método para ver una cita específica
       public function show($id)
       {
           $cita = Cita::with(['doctor', 'paciente'])->findOrFail($id);
           return response()->json($cita, 200);
       }
   
       // Método para actualizar una cita
       public function update(Request $request, $id)
       {
           $cita = Cita::findOrFail($id);
           // Aquí puedes incluir validaciones similares al método `store`
           $cita->update($request->all());
           return response()->json(['message' => 'Cita actualizada exitosamente.', 'cita' => $cita], 200);
       }
   
       // Método para eliminar una cita
       public function destroy($id)
       {
           $cita = Cita::findOrFail($id);
           $cita->delete();
           return response()->json(['message' => 'Cita eliminada exitosamente.'], 200);
       }

       
         // Método para programar las notificaciones
         protected function schedule(Schedule $schedule)
         {
             $schedule->call(function () {
                 $citas = Cita::where('fecha_cita', Carbon::now()->addDay()->format('Y-m-d'))->get();
                 foreach ($citas as $cita) {
                     $cita->paciente->notify(new CitaProximaNotification($cita));
                 }
             })->daily();
         }

         public function obtenerHorariosDisponibles($doctorId)
{
    $horarios = HorarioDoctor::where('doctor_id', $doctorId)
                ->get(['dia_semana', 'hora_inicio', 'hora_fin']);
    
    return response()->json($horarios);
}

public function mostrarHorarios($doctorId)
{
    // Obtén los horarios del doctor específico
    $doctor = Doctor::findOrFail($doctorId);
    $horarios = HorarioDoctor::where('doctor_id', $doctorId)->get();

    return view('doctor.horarios', compact('doctor', 'horarios'));
}


public function obtenerCitasOcupadas($doctorId, $fecha)
{
    // Obtener citas ocupadas para el doctor en la fecha específica
    $citas = Cita::where('doctor_id', $doctorId)
                  ->whereDate('fecha_cita', $fecha)
                  ->get(['hora_cita', 'duracion']);

    // Formatear las citas para incluir el horario de inicio y fin
    $citasFormateadas = $citas->map(function ($cita) {
        $horaInicio = Carbon::parse($cita->hora_cita);
        $horaFin = $horaInicio->copy()->addMinutes($cita->duracion);
        
        return [
            'hora_inicio' => $horaInicio->format('H:i'),
            'hora_fin' => $horaFin->format('H:i'),
        ];
     });

    return response()->json($citasFormateadas);
 }

   public function obtenerHorariosDoctor($doctorId)
   {
     // Obtener horarios del doctor
     $horarios = HorarioDoctor::where('doctor_id', $doctorId)->get();
    
     // Obtener citas agendadas para ese doctor en la semana actual
     $citasAgendadas = Cita::where('doctor_id', $doctorId)
        ->whereBetween('fecha_cita', [now()->startOfWeek(), now()->endOfWeek()])
        ->get();

     // Lógica para construir la tabla con los horarios disponibles
      $horariosDisponibles = [];
     foreach ($horarios as $horario) {
        $horasDisponibles = []; // Guardar horas que no están ocupadas
        $inicio = Carbon::parse($horario->hora_inicio);
        $fin = Carbon::parse($horario->hora_fin);

        // Dividir el horario en intervalos
        while ($inicio->lt($fin)) {
            $horaFin = $inicio->copy()->addMinutes($horario->duracion_cita);
            
            // Verificar disponibilidad para cada día de la semana
            foreach (range(0, 6) as $i) {
                $diaSemana = now()->startOfWeek()->addDays($i)->toDateString(); // Obteniendo cada día de la semana

                $citaExistente = $citasAgendadas->where('fecha_cita', $diaSemana)
                                                 ->where('hora_cita', $inicio->format('H:i'))->first();

                // Si no existe una cita agendada, agregar a las horas disponibles
                if (!$citaExistente) {
                    $horasDisponibles[] = [
                        'hora' => $inicio->format('H:i') . ' - ' . $horaFin->format('H:i'),
                        'dia' => $diaSemana,
                        'ocupado' => false,
                    ];
                } else {
                    $horasDisponibles[] = [
                        'hora' => $inicio->format('H:i') . ' - ' . $horaFin->format('H:i'),
                        'dia' => $diaSemana,
                        'ocupado' => true,
                    ];
                }
            }
            $inicio = $horaFin; // Avanzar al siguiente intervalo
         }

          // Almacenar los horarios por día
          foreach ($horasDisponibles as $disponible) {
            $horariosDisponibles[$disponible['dia']][] = $disponible;
          }
      }

           return view('partials.horarios', compact('horariosDisponibles'));
   }


      protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
    $this->openAIService = $openAIService;
   }

    
   
   public function generarConsejos(Request $request, $id)
  {
    // Obtener los datos de la historia clínica y formulario
    $paciente = Paciente::find($id);
    $historiaClinica = $paciente->historia_clinica;
    $formularioPaciente = $request->input('formulario');

    // Llamar al servicio de OpenAI
    $consejos = $this->openAIService->obtenerConsejosSalud($historiaClinica, $formularioPaciente);

    return view('consejos.consejos', compact('consejos'));
  }
}