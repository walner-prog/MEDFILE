<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HistoriaClinica;
use App\Models\Paciente; // Importa el modelo Paciente
use Illuminate\Http\Request; // Importa la clase Request de Laravel
use Illuminate\Support\Facades\Validator; // Importa la clase Validator de Laravel
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Log;
class PacienteController extends Controller
{
    /**
     * Constructor del controlador que aplica middleware de autenticación.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }

    /**
     * Muestra todos los pacientes disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {  
       
        return view('pacientes.index');
    }
    
    public function calculosPacientes(Request $request) {
          
        $averageAge = Paciente::avg(DB::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento)'));

        $medicos = Doctor::withCount('pacientes')->get();

        $ages = Paciente::select(DB::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) as edad'))->pluck('edad');
         // Convertir la colección a un array y ordenar
        $agesArray = $ages->sort()->values()->all();
        
        // Función para calcular percentil
        function calculatePercentile($array, $percentile) {
            $index = ($percentile / 100) * (count($array) - 1);
            $indexFloor = floor($index);
            $indexCeil = ceil($index);
        
            if ($indexFloor == $indexCeil) {
                return $array[$indexFloor];
            }
        
            return $array[$indexFloor] * ($indexCeil - $index) + $array[$indexCeil] * ($index - $indexFloor);
        }
        
        $percentile25 = calculatePercentile($agesArray, 25);
        $percentile75 = calculatePercentile($agesArray, 75);
        $pacientes = Paciente::whereBetween(DB::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento)'), [$percentile25, $percentile75])
                     ->paginate(10);     
                     
                     
                     $minAge = $request->input('min_age', 30);
                     $maxAge = $request->input('max_age', 50);
                 
                     $pacientes = Paciente::whereBetween(DB::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento)'), [$minAge, $maxAge])
                         ->paginate(10);
                 
                     if ($request->ajax()) {
                         return view('pacientes._list', compact('pacientes'))->render();
                     }
                 
 
    
        return view('pacientes.calculos' , compact( 'averageAge','medicos','pacientes','percentile25','percentile75','minAge', 'maxAge'));

    }
    
  

  

    /**
     * Muestra el formulario para crear un nuevo paciente.
     *
     * @return \Illuminate\View\View
     */
 
    

     // En PacienteController.php
public function edit($id)
{
    $paciente = Paciente::find($id);
    return view('pacientes.edit', compact( 'paciente'));
}
 

    /**
     * Almacena un nuevo paciente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_expediente' => 'nullable|string|max:15|unique:pacientes,no_expediente',
            'fecha' => 'nullable|date',
            'establecimiento_salud' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|in:M,F',
            'raza_etnia' => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:255',
            'correo'    => 'nullable|string|max:255|unique:pacientes,correo',
            'direccion' => 'nullable|string|max:255',
            'nombre_responsable' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255|unique:pacientes,no_cedula',
            'categoria' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'direccion_residencia' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'responsable_emergencia' => 'nullable|string|max:255',
            'parentesco' => 'nullable|string|max:255',
            'telefono_responsable' => 'nullable|string|max:255',
            'direccion_responsable' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'direccion_empleador' => 'nullable|string|max:255',
        ]);

        $paciente = Paciente::create($validator->validated());

        if ($paciente) {
            return redirect()->route('pacientes.index')->with('info', 'Paciente creado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al crear el paciente.');
        }
    }

    /**
     * Muestra los detalles de un paciente específico.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\View\View
     */
  
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        
            // Formatea la fecha de nacimiento
              $paciente->fecha_nacimiento = $paciente->fecha_nacimiento ?
                Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') : 'N/A';

        $registrosAdmisionEgreso = $paciente->registrosAdmisionEgresoHospitalario;
        $historiasClinicas = $paciente->registrosHistoriasclinicas;
    
        // Ordenar los registros por fecha de egreso para determinar el más reciente
        $registrosAdmisionEgreso = $registrosAdmisionEgreso->sortByDesc('egreso_fecha'); // Ajusta el campo según tu modelo
      
        $historiasClinicas = $paciente->historiasClinicas()->orderBy('created_at', 'desc');
        // Obtener el registro más reciente
        $registroMasReciente = $registrosAdmisionEgreso->first();
        $historiaMasReciente = $historiasClinicas->first();
        $paciente_num_consulta = Paciente::withCount('consultas')->findOrFail($id);
        return view('pacientes.show', [
            'paciente' => $paciente,
            'registrosAdmisionEgreso' => $registrosAdmisionEgreso,
            'registroMasReciente' => $registroMasReciente,
            'historiasClinicas' => $historiasClinicas,
            'historiaMasReciente' => $historiaMasReciente,
            'paciente_num_consulta'=> $paciente_num_consulta,

        ]);
    }
    

   /** public function show($id)
    {
        $Paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('Paciente'));
    } */

    /**
     * Muestra el formulario para editar un paciente existente.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\View\View
     */





    /**
     * Actualiza un paciente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Paciente $paciente)
    {
        $validator = Validator::make($request->all(), [
            'no_expediente' => 'nullable|string|max:12',
            'fecha' => 'nullable|date',
            'establecimiento_salud' => 'nullable|string|max:255',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|in:M,F',
            'raza_etnia' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:255',
            'correo'    => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'nombre_responsable' => 'nullable|string|max:255',
            
            'no_inss' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'direccion_residencia' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'responsable_emergencia' => 'nullable|string|max:255',
            'parentesco' => 'nullable|string|max:255',
            'telefono_responsable' => 'nullable|string|max:255',
            'direccion_responsable' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'direccion_empleador' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }

        $paciente->update($validator->validated());

        if ($paciente) {
            return redirect()->route('pacientes.index')->with('update', 'Paciente editado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar el paciente.');
        }
    }

    /**
     * Elimina un paciente de la base de datos.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\RedirectResponse
     */


    public function destroy($id)
  {
    try {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return response()->json(['success' => 'Paciente eliminado correctamente.']);
    } catch (\Exception $e) {
        // Registra el error en los logs
        Log::error('Error eliminando paciente: '.$e->getMessage());
        return redirect()->route('pacientes.index')->with('delete', 'Paciente eliminado exitosamente.');
    }
  }

  public function download($id)
  {
      // Obtén el paciente por ID
      $paciente = Paciente::findOrFail($id);

      // Carga la vista para el PDF
      $pdf = Pdf::loadView('pdf.paciente', ['paciente' => $paciente]);

      // Devuelve el PDF para su descarga
      return $pdf->download('detalles_paciente.pdf');
  }


  // este metodo me carga en tiempo real los datos que quiero 


  public function getPaciente($id)
  {
      $paciente = Paciente::with(['historiasClinicas', 'registrosAdmisionEgresoHospitalario'])->findOrFail($id);
  
      return response()->json([
        'id' => $paciente->id,
          'no_expediente' => $paciente->no_expediente,
          'primer_nombre' => $paciente->primer_nombre,
          'segundo_nombre' => $paciente->segundo_nombre,
          'primer_apellido' => $paciente->primer_apellido,
          'segundo_apellido' => $paciente->segundo_apellido,
          'edad' => $paciente->edad,
          'sexo' => $paciente->sexo,
          'no_cedula' => $paciente->no_cedula,
          'no_inss' => $paciente->no_inss,
          'estado_civil' => $paciente->estado_civil,
          'raza_etnia' => $paciente->raza_etnia,
          'escolaridad' => $paciente->escolaridad,
          'categoria' => $paciente->categoria,
          'tiene_historia_clinica' => $paciente->historiasClinicas->isNotEmpty(),
          'tiene_registro_admision_egreso' => $paciente->registrosAdmisionEgresoHospitalario->isNotEmpty(),
      ]);
  }
  

  
/**Concatenar nombres y apellidos: Se utiliza una consulta donde se concatenan los nombres y apellidos
 *  del paciente para realizar la búsqueda.
Descomponer la búsqueda en términos: Se divide la búsqueda en palabras clave para que puedan coincidir 
con cualquier combinación de nombre y apellido */
 
  public function buscarPaciente(Request $request) {
    $query = $request->get('query');
    $terms = explode(' ', $query);

    $pacientes = Paciente::where(function($q) use ($terms) {
        foreach ($terms as $term) {
            $q->orWhere('primer_nombre', 'LIKE', "%{$term}%")
              ->orWhere('segundo_nombre', 'LIKE', "%{$term}%")
              ->orWhere('primer_apellido', 'LIKE', "%{$term}%")
              ->orWhere('segundo_apellido', 'LIKE', "%{$term}%");
        }
    })
    ->orWhere(DB::raw("CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido)"), 'LIKE', "%{$query}%")
    ->orWhere('no_cedula', 'LIKE', "%{$query}%")
    ->orWhere('no_expediente', 'LIKE', "%{$query}%")
    ->paginate(5); // Ajusta el número de resultados por página según sea necesario

    return response()->json($pacientes);
}
public function getPacientesPorEnfermedad()
{
    // Obtener la enfermedad con el máximo número de pacientes
    $enfermedad = HistoriaClinica::select('enfermedades_cronicas')
        ->whereNotNull('enfermedades_cronicas')
        ->groupBy('enfermedades_cronicas')
        ->orderByRaw('COUNT(*) DESC')
        ->first();

    // Obtener el número total de pacientes
    $totalPacientes = Paciente::count();

    // Si no se encuentra ninguna enfermedad
    if (!$enfermedad) {
        return view('partials.pacientes-enfermedad', ['pacientes' => collect(), 'enfermedad' => null, 'totalPacientes' => $totalPacientes, 'porcentaje' => 0]);
    }

    // Obtener los pacientes con la enfermedad más común
    $pacientes = Paciente::whereHas('historiasClinicas', function ($query) use ($enfermedad) {
        $query->where('enfermedades_cronicas', $enfermedad->enfermedades_cronicas);
    })->get();

    // Calcular el porcentaje de pacientes con la enfermedad más común
    $porcentaje = $totalPacientes > 0 ? ($pacientes->count() / $totalPacientes) * 100 : 0;

    return view('partials.pacientes-enfermedad', compact('pacientes', 'enfermedad', 'totalPacientes', 'porcentaje'));
}


public function getEnfermedadesConPacientes()
{
    // Obtener las enfermedades crónicas y contar el número de pacientes que tienen cada enfermedad
    $enfermedadesConPacientes = HistoriaClinica::select('enfermedades_cronicas')
        ->whereNotNull('enfermedades_cronicas')
        ->groupBy('enfermedades_cronicas')
        ->selectRaw('enfermedades_cronicas, COUNT(*) as pacientes_count')
        ->get();

    return view('partials.enfermedades-con-pacientes', compact('enfermedadesConPacientes'));
}

public function getCiudadesConPacientes()
{
    // Obtener las ciudades/localidades que tienen pacientes registrados
    $ciudadesConPacientes = Paciente::select('departamento')
        ->whereNotNull('departamento')
        ->groupBy('departamento')
        ->selectRaw('departamento, COUNT(*) as pacientes_count')
        ->get();

    // Obtener las ciudades/localidades que no tienen pacientes registrados
    // Nota: Este paso puede no ser necesario si solo quieres ciudades con pacientes
    $ciudadesSinPacientes = Paciente::select('departamento')
        ->whereNull('departamento')
        ->groupBy('departamento')
        ->get();

    return view('partials.ciudades-con-pacientes', compact('ciudadesConPacientes', 'ciudadesSinPacientes'));
}


public function getConsultaTotalPorEnfermedad()
{
    // Obtener todas las enfermedades crónicas registradas en las historias clínicas
    $enfermedades = HistoriaClinica::select('enfermedades_cronicas')
        ->whereNotNull('enfermedades_cronicas') // Filtrar registros donde la enfermedad crónica no sea nula
        ->get()
        ->groupBy('enfermedades_cronicas') // Agrupar por el campo 'enfermedades_cronicas'
        ->map(function ($group) {
            return $group->count(); // Contar la cantidad de registros para cada grupo
        });

    // Contar el total de pacientes registrados
    $totalPacientes = Paciente::count();
  
    return view('partials.consulta-total-por-enfermedad', compact('enfermedades', 'totalPacientes'));
}


public function getPromedioConsultasGeneral()
{
    $averageConsultations = Paciente::withCount('consultas')->avg('consultas_count');

    return view('partials.promedio-consultas-general', compact('averageConsultations'));
}

public function getPacientesConPromedioConsultas()
{
    $pacientes_promedio = Paciente::withCount('consultas')->get();
    $promedioConsultas = $pacientes_promedio->avg('consultas_count');
    
    return view('partials.pacientes-con-promedio-consultas', compact('pacientes_promedio','promedioConsultas'));
}

public function getPromedioConsultasPorEnfermedad()
{
    $enfermedad_id = Paciente::select('enfermedad_id')
                            ->groupBy('enfermedad_id')
                            ->orderByRaw('COUNT(*) DESC')
                            ->pluck('enfermedad_id')
                            ->first();

    $pacientes = Paciente::where('enfermedad_id', $enfermedad_id)->withCount('consultas')->paginate(10);
    $promedioConsultas = $pacientes->avg('consultas_count');

    return view('partials.promedio-consultas-por-enfermedad', compact('promedioConsultas'));
}

public function filtrarPacientesPorCiudadYEnfermedad(Request $request)
{
    // Obtener los valores de la ciudad y enfermedad desde la solicitud
    $ciudad = $request->input('ciudad');
    $enfermedad = $request->input('enfermedad');

    // Filtrar los pacientes por ciudad y enfermedad
    $pacientes = Paciente::where('direccion_residencia', 'LIKE', "%$ciudad%")
        ->whereHas('historiasClinicas', function($query) use ($enfermedad) {
            $query->where('enfermedades_cronicas', 'LIKE', "%$enfermedad%");
        })
        ->paginate(10);

    // Retornar la vista con los pacientes filtrados
    return view('partials.filtrados', compact('pacientes'));
}


}
