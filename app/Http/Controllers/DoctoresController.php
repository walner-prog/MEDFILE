<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use App\Models\Especialidad;
use App\Models\Departamento;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class DoctoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    
    public function index()
    {
        // Obtener los doctores con sus relaciones
        $doctores = Doctor::with(['especialidad', 'departamento'])->paginate(10);
    
        // Obtener las especialidades y departamentos para la vista
        $especialidades = Especialidad::all();
        $departamentos = Departamento::all();

    
        return view('doctores.index', compact('doctores', 'especialidades', 'departamentos'));
    }
    

    public function mostrarDoctores() {
        $especialidad_id = Doctor::select('especialidad_id')
                              ->groupBy('especialidad_id')
                              ->orderByRaw('COUNT(*) DESC')
                              ->pluck('especialidad_id')
                              ->first();

    $doctores = Doctor::where('especialidad_id', $especialidad_id)->paginate(10);

      //  $doctores = Doctor::all();
        return view('doctores.mostrar', compact('doctores'));
    }
    
    public function calculosDoctores() {
        $maxPatients = 50; // Número máximo de pacientes
    // Consulta para obtener doctores con menos de $maxPatients pacientes
    $doctores = Doctor::withCount('pacientes')
                      ->having('pacientes_count', '<', $maxPatients)
                      ->paginate(10);
    
        return view('doctores.calculos', compact('doctores','maxPatients'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:20|unique:doctores,codigo',
            'primer_nombre' => 'required|string|max:50',
            'segundo_nombre' => 'nullable|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'cedula' => 'required|string|max:20|unique:doctores,cedula',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:100|unique:doctores,email',
            'especialidad_id' => 'nullable|exists:especialidades,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'fecha_contratacion' => 'nullable|date',
            'estado' => 'required|in:activo,inactivo',
            'horario_trabajo' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|in:M,F,O',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctores.index')
                         ->with('info', 'Doctor creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor_mayor_consulta = Doctor::withCount('consultas')->findOrFail($id);
        $doctor = Doctor::findOrFail($id);
        
    $age = now()->diffInYears($doctor->fecha_nacimiento);
      
        return view('doctores.show', compact('doctor','doctor_mayor_consulta','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar el doctor o mostrar un error si no se encuentra
        $doctor = Doctor::findOrFail($id);
    
        // Obtener todas las especialidades y departamentos para los select
        $especialidades = Especialidad::all();
        $departamentos = Departamento::all();
       
        // Pasar todas las variables necesarias a la vista
        return view('doctores.edit', compact('doctor', 'especialidades', 'departamentos'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:20',
            'primer_nombre' => 'string|max:50',
            'segundo_nombre' => 'string|max:50',
            'primer_apellido' => 'string|max:50',
            'segundo_apellido' => 'string|max:50',
            'cedula' => 'string|max:20',
            'email' => 'string|email|max:100',
            'especialidad_id' => 'nullable|exists:especialidades,id',
            'telefono' => 'nullable|string|max:15',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'fecha_contratacion' => 'nullable|date',
            'estado' => 'in:activo,inactivo',
            'horario_trabajo' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable',
            'usuario_id' => 'nullable',

        ]);
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }
    
        // Excluye usuario_id de la actualización
        $data = $validator->validated();
     // Asegúrate de que 'usuario_id' no se actualice
    
        $doctor->update($data);
    
        return redirect()->route('doctores.index')
                         ->with('update', 'Doctor actualizado exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();

            return response()->json(['delete' => 'Doctor eliminado correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error eliminando doctor: '.$e->getMessage());
            return redirect()->route('doctores.index')->with('delete', 'Error al eliminar el doctor.');
        }
    }
      
    // este metodo me da en una respuesta json los datos de un doctor y la ruta en el controlador es 
    // Route::get('/api/doctores/{id}', [DoctoresController::class, 'getDoctor'])->name('doctores.getDoctor');
    public function getDoctor($id)
    {
        // Recupera un doctor con sus relaciones 'especialidad' y 'departamento' por su ID.
        // Si el doctor no se encuentra, lanza una excepción 404.
        $doctor = Doctor::with(['especialidad', 'departamento'])->findOrFail($id);
    
        // Devuelve una respuesta JSON con los detalles del doctor.
        return response()->json([
            // Incluye el código único del doctor.
            'codigo' => $doctor->codigo,
            // Incluye el primer nombre del doctor.
            'primer_nombre' => $doctor->primer_nombre,
            // Incluye el segundo nombre del doctor, si existe.
            'segundo_nombre' => $doctor->segundo_nombre,
            // Incluye el primer apellido del doctor.
            'primer_apellido' => $doctor->primer_apellido,
            // Incluye el segundo apellido del doctor, si existe.
            'segundo_apellido' => $doctor->segundo_apellido,
            // Incluye el nombre de la especialidad del doctor, si está asociada.
            'especialidad' => $doctor->especialidad ? $doctor->especialidad->nombre : null,
            // Incluye el nombre del departamento al que pertenece el doctor, si está asociado.
            'departamento' => $doctor->departamento ? $doctor->departamento->nombre : null,
            // Incluye la cédula del doctor.
            'cedula' => $doctor->cedula,
            // Incluye el número de teléfono del doctor.
            'telefono' => $doctor->telefono,
            // Incluye el correo electrónico del doctor.
            'email' => $doctor->email,
            // Incluye el estado actual del doctor (activo/inactivo).
            'estado' => $doctor->estado,
            // Incluye la fecha de contratación del doctor.
            'fecha_contratacion' => $doctor->fecha_contratacion,
            // Verifica si el doctor tiene una especialidad asociada.
            'tiene_especialidad' => $doctor->especialidad !== null,
        ]);
    }
    
    

  // este metodo es para busacr un doctor por su id 
  // Route::get('/buscar-doctor', [DoctoresController::class, 'buscardoctor'])->name('buscardoctor')
  public function buscarDoctor(Request $request) {
    // Se obtiene el término de búsqueda de la solicitud HTTP.
    $query = $request->get('query');
    
    // Se divide el término de búsqueda en palabras individuales.
    $terms = explode(' ', $query);

    // Inicia la consulta a la base de datos utilizando el modelo Doctor.
    $doctores = Doctor::where(function($q) use ($terms) {
        // Itera sobre cada palabra en el array $terms.
        foreach ($terms as $term) {
            // Busca coincidencias en el campo primer_nombre que contengan el término de búsqueda actual.
            $q->orWhere('primer_nombre', 'LIKE', "%{$term}%")
              // Busca coincidencias en el campo segundo_nombre.
              ->orWhere('segundo_nombre', 'LIKE', "%{$term}%")
              // Busca coincidencias en el campo primer_apellido.
              ->orWhere('primer_apellido', 'LIKE', "%{$term}%")
              // Busca coincidencias en el campo segundo_apellido.
              ->orWhere('segundo_apellido', 'LIKE', "%{$term}%");
        }
    })
                 // Concatenación de los campos de nombre completo y búsqueda en la cadena completa.
            ->orWhere(DB::raw("CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido)"), 'LIKE', "%{$query}%")
             // Busca coincidencias en el campo cedula con el término de búsqueda.
             ->orWhere('cedula', 'LIKE', "%{$query}%")
            // Busca coincidencias en el campo codigo con el término de búsqueda.
            ->orWhere('codigo', 'LIKE', "%{$query}%")
           // Pagina el resultado de la consulta, devolviendo 5 resultados por página.
            ->paginate(5);

          // Devuelve la lista de doctores en formato JSON como respuesta a la solicitud.
          return response()->json($doctores);
}

/****************Metodos que deveuelven json  */
public function getEspecialidadConMasDoctores()
{
    // Obtener las especialidades con el mayor número de doctores
    $especialidades = Especialidad::select('especialidades.id', 'especialidades.nombre')
        ->withCount('doctores')
        ->orderBy('doctores_count', 'DESC')
        ->take(1) // Obtenemos la especialidad con la mayor cantidad de doctores
        ->get();

    return view('partials.especialidad_mas_doctores', compact('especialidades'));
}

public function getDoctoresRecientes()
{
    // Obtener los doctores contratados en el último año
    $lastYear = now()->subYear()->format('Y-m-d');
    $doctoresyear = Doctor::where('fecha_contratacion', '>=', $lastYear)
        ->select('primer_nombre', 'primer_apellido', 'fecha_contratacion', 
                 DB::raw('TIMESTAMPDIFF(YEAR, fecha_contratacion, CURDATE()) as anios'),
                 DB::raw('TIMESTAMPDIFF(MONTH, fecha_contratacion, CURDATE()) % 12 as meses'))
        ->get();

    return view('partials.doctores-recientes', compact('doctoresyear'));
}


public function getDoctoresPorEspecialidad()
{
    // Obtener la especialidad con el máximo número de doctores
    $especialidadConMasDoctores = Especialidad::withCount('doctores')
        ->orderBy('doctores_count', 'desc')
        ->first();

    // Si no hay especialidad con doctores, retornamos la vista con datos vacíos
    if (!$especialidadConMasDoctores) {
        return view('partials.doctores-especialidad', ['doctores' => collect(), 'especialidad' => null]);
    }

    // Obtener los doctores de la especialidad más frecuente
    $doctores = Doctor::where('especialidad_id', $especialidadConMasDoctores->id)->get();

    return view('partials.doctores-especialidad', compact('doctores', 'especialidadConMasDoctores'));
}


public function getEspecialidadesConDoctores()
{
    // Obtener las especialidades junto con el conteo de doctores y cargar solo los campos necesarios
    $especialidades = Especialidad::with(['doctores:id,codigo,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,especialidad_id'])
        ->withCount('doctores')
        ->get(['id', 'nombre']);

    return view('partials.especialidades-con-doctores', compact('especialidades'));
}

public function getConsultaTotalPorEspecialidad()
{// Obtener las especialidades junto con el conteo de doctores y cargar solo los campos necesarios
    $especialidades = Especialidad::with(['doctores:id,especialidad_id'])
        ->withCount('doctores')
        ->get(['id', 'nombre']);

    // Calcular el total de doctores
    $totalDoctores = Doctor::count();

    return view('partials.consulta-total-por-especialidad',  compact('especialidades', 'totalDoctores'));
}



public function getPromedioConsultasGeneral()
{
    // Calcular el promedio de consultas por doctor en general
    $averageConsultations = Doctor::withCount('consultas')->avg('consultas_count');

    return view('partials.promedio-consultas-general', compact('averageConsultations'));
}

public function getDoctoresConPromedioConsultas()
{
    // Obtener la lista de doctores con el conteo de consultas
    $doctores_promedio = Doctor::withCount('consultas')->get();
    $promedioConsultas = $doctores_promedio->avg('consultas_count');
    return view('partials.doctores-con-promedio-consultas', compact('doctores_promedio','promedioConsultas'));
}

public function getPromedioConsultasPorEspecialidad()
{
    // Calcular el promedio de consultas por doctor para los doctores en la especialidad más popular
    $especialidad_id = Doctor::select('especialidad_id')
                            ->groupBy('especialidad_id')
                            ->orderByRaw('COUNT(*) DESC')
                            ->pluck('especialidad_id')
                            ->first();

    $doctores = Doctor::where('especialidad_id', $especialidad_id)->withCount('consultas')->get();
    $promedioConsultas = $doctores->avg('consultas_count');

    return view('partials.promedio-consultas-por-especialidad', compact('promedioConsultas'));
}

public function getDepartamentosConDoctores()
{
    // Obtener departamentos con doctores y el conteo de doctores
    $departamentosConDoctores = Departamento::with(['doctores'])->withCount('doctores')->whereHas('doctores')->get();

    // Obtener departamentos sin doctores
    $departamentosSinDoctores = Departamento::doesntHave('doctores')->get();

    return view('partials.departamentos-con-doctores', compact('departamentosConDoctores', 'departamentosSinDoctores'));
}

    
}
