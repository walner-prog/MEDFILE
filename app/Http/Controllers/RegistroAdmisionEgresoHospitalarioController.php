<?php
namespace App\Http\Controllers;

use App\Models\RegistroAdmisionEgresoHospitalario;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RegistroAdmisionEgresoHospitalarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }
    public function index()
    {
      
    
        $admisiones = RegistroAdmisionEgresoHospitalario::with(['paciente' => function($query) {
                                $query->select('id', 'no_expediente', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'no_cedula');
                            }])
                                ->paginate(6); // Ajusta según el número de registros por página 
    
        return view('registro_admision_egreso_hospitalario.index');
    }
    
    

    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255', 
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255', 
            'nacionalidad' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255', 
            'categoria_paciente' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255', 
            'sexo' => 'nullable|in:M,F',
            'direccion_residencia' => 'nullable|string|max:255', 
            'localidad' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',

         
            'raza_etnia' => 'nullable|string|max:255', // Nombre alternativo para 'raza_etnia'
            'edad' => 'nullable|integer', // Nombre alternativo para 'edad'
            'ocupacion' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',

            'urgencia_avisar' => 'nullable|string|max:255',
            'direccion_telefono_avisar' => 'nullable|string|max:255',
            'ingreso' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'direccion_empleador' => 'nullable|string|max:255',
            'municipio_distrito' => 'nullable|string|max:255',
            
            'parentesco' => 'nullable|string|max:255',
            'diagnostico_ingreso' => 'nullable|string|max:255',
            'forma_llegada_hospital' => 'nullable|string|max:255',
            'reingreso_mismo_diagnostico' => 'nullable|boolean',
            'sitio_ingreso_hospitalario' => 'nullable|string|max:255',
            'nombre_medico' => 'nullable|string|max:255',
            'sello_medico_ingreso' => 'nullable|string|max:255',
            'egreso_fecha' => 'nullable|date',
            'egreso_hora' => 'nullable',
            'diagnostico_egreso' => 'nullable|string|max:255',
            'diagnostico_egreso_principal' => 'nullable|string|max:255',
            'diagnostico_egreso_complementarios' => 'nullable|string|max:255',
            'cirugias_realizadas' => 'nullable|string',
            'nombre_admisionista' => 'nullable|string|max:255',
            'dias_estancia' => 'nullable|integer',
            'accidente_trabajo' => 'nullable|boolean',
            'de_trayecto' => 'nullable|boolean',
            'enfermedad_laboral' => 'nullable|boolean',
            'causa_trauma' => 'nullable|string|max:255',
            'infeccion_intrahospitalaria' => 'nullable|boolean',
            'referido_otro_establecimiento' => 'nullable|string|max:255',
         
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }
                 
        RegistroAdmisionEgresoHospitalario::create($validator->validated());
      
    
        return redirect()->route('registro_admision_hospitalario.index')->with('info', 'Registro creado con éxito.');
    }
    
   


    public function show($id)
    {
       $admision = RegistroAdmisionEgresoHospitalario::findOrFail($id);
       // $admision = RegistroAdmisionEgresoHospitalario::with('paciente')->findOrFail($id);
         // Convertir fecha de egreso
    if ($admision->egreso_fecha) {
        $admision->egreso_fecha = Carbon::parse($admision->egreso_fecha);
    }

    // Convertir hora de egreso si no es nula
    if (!empty($admision->egreso_hora)) {
        $admision->egreso_hora = Carbon::createFromFormat('H:i:s', $admision->egreso_hora);
    }

   
        return view('registro_admision_egreso_hospitalario.show', compact('admision'));
    }

    

    public function edit($id)
    {
        
        $admision = RegistroAdmisionEgresoHospitalario::find($id);
        $paciente = Paciente::find($admision->paciente_id); // Obtener el paciente específico
        return view('registro_admision_egreso_hospitalario.edit', compact('admision','paciente'));
    }



    public function update(Request $request, RegistroAdmisionEgresoHospitalario $admision)
    {
        $validator = Validator::make($request->all(), [
           'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_salud' => 'nullable|string|max:255', 
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'no_expediente' => 'nullable|string|max:255', 
            'nacionalidad' => 'nullable|string|max:255',
            'no_cedula' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255', 
            'categoria_paciente' => 'nullable|string|max:255',
            'no_inss' => 'nullable|string|max:255', 
            'sexo' => 'nullable|in:M,F',
            'direccion_residencia' => 'nullable|string|max:255', 
            'localidad' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',

         
            'raza_etnia' => 'nullable|string|max:255', // Nombre alternativo para 'raza_etnia'
            'edad' => 'nullable|integer', // Nombre alternativo para 'edad'
            'ocupacion' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',

            'urgencia_avisar' => 'nullable|string|max:255',
            'direccion_telefono_avisar' => 'nullable|string|max:255',
            'ingreso' => 'nullable|string|max:255',
            'empleador' => 'nullable|string|max:255',
            'direccion_empleador' => 'nullable|string|max:255',
            'municipio_distrito' => 'nullable|string|max:255',
            
            'parentesco' => 'nullable|string|max:255',
            'diagnostico_ingreso' => 'nullable|string|max:255',
            'forma_llegada_hospital' => 'nullable|string|max:255',
            'reingreso_mismo_diagnostico' => 'nullable|boolean',
            'sitio_ingreso_hospitalario' => 'nullable|string|max:255',
            'nombre_medico' => 'nullable|string|max:255',
            'sello_medico_ingreso' => 'nullable|string|max:255',
            'egreso_fecha' => 'nullable|date',
            'egreso_hora' => 'nullable',
            'diagnostico_egreso' => 'nullable|string|max:255',
            'diagnostico_egreso_principal' => 'nullable|string|max:255',
            'diagnostico_egreso_complementarios' => 'nullable|string|max:255',
            'cirugias_realizadas' => 'nullable|string',
            'nombre_admisionista' => 'nullable|string|max:255',
            'dias_estancia' => 'nullable|integer',
            'accidente_trabajo' => 'nullable|boolean',
            'de_trayecto' => 'nullable|boolean',
            'enfermedad_laboral' => 'nullable|boolean',
            'causa_trauma' => 'nullable|string|max:255',
            'infeccion_intrahospitalaria' => 'nullable|boolean',
            'referido_otro_establecimiento' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Por favor corrige los errores.');
        }

        $admision->update($validator->validated());

      
      

        return redirect()->route('registro_admision_hospitalario.index')->with('update', 'Registro actualizado con éxito.');
    }

    
      
    public function destroy($id)
    {
      try {
          $admision = RegistroAdmisionEgresoHospitalario::findOrFail($id);
          $admision->delete();
  
          return response()->json(['delete' => 'Registro eliminado con éxito.']);
      } catch (\Exception $e) {
          // Registra el error en los logs
          Log::error('ErrorControl Registro: '.$e->getMessage());
          return redirect()->route('registro_admision_hospitalario.index')->with('delete', 'Registro eliminado con éxito.');
      }
    }
}
