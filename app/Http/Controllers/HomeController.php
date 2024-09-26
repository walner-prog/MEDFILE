<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use App\Models\Emergencia; 
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\ControlMedicamento;
use App\Models\RegistroAdmisionEgresoHospitalario;
use App\Models\Especialidad;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersCount = User::count();
        $historiasClinicasCount = HistoriaClinica::count();
        $pacientesCount = Paciente::count();
        $emergenciasCount = Emergencia::count();
        $citasCount = Cita::count();
        $doctoresCount = Doctor::count();
        $controlMedicamentosCount = ControlMedicamento::count();
        $admisionEgresoCount = RegistroAdmisionEgresoHospitalario::count();
        $especialidadesCount = Especialidad::count();
        $rolesCount = Role::count();

        // 
        $pacientesPorCiudad = Paciente::select('departamento', DB::raw('count(*) as total'))
        ->groupBy('departamento')
        ->get();

          $ciudades = $pacientesPorCiudad->pluck('departamento');
          $totales = $pacientesPorCiudad->pluck('total');
        //
        
        $enfermedades = [
            'Hipertensión arterial',
            'Enfermedad renal crónica',
            'Enfermedad cardíaca'
        ];
    
        // Obtener los pacientes con las enfermedades crónicas especificadas
        $pacientes = Paciente::whereHas('historiasClinicas', function ($query) use ($enfermedades) {
            $query->whereIn('enfermedades_cronicas', $enfermedades);
        })->with('historiasClinicas')->get();
    
        // Contar pacientes por enfermedad
        $totales_enfermedades = [];
    
        foreach ($enfermedades as $enfermedad) {
            $count = $pacientes->filter(function ($paciente) use ($enfermedad) {
                return $paciente->historiasClinicas->contains('enfermedades_cronicas', $enfermedad);
            })->count();
    
            $totales_enfermedades[] = $count;
        }  
       //
       $pacientesPorGenero = Paciente::selectRaw('sexo, COUNT(*) as total')
       ->groupBy('sexo')
       ->get();
        //
        //
         // Obtener los pacientes y calcular su edad
    $pacientes = Paciente::selectRaw('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) as edad')
    ->get();

// Definir los rangos de edad
$rangos = [
    '0-10' => 0,
    '11-20' => 0,
    '21-30' => 0,
    '31-40' => 0,
    '41-50' => 0,
    '51-60' => 0,
    '61+' => 0,
];

// Contar cuántos pacientes hay en cada rango de edad
foreach ($pacientes as $paciente) {
    $edad = $paciente->edad;

    if ($edad >= 0 && $edad <= 10) {
        $rangos['0-10']++;
    } elseif ($edad >= 11 && $edad <= 20) {
        $rangos['11-20']++;
    } elseif ($edad >= 21 && $edad <= 30) {
        $rangos['21-30']++;
    } elseif ($edad >= 31 && $edad <= 40) {
        $rangos['31-40']++;
    } elseif ($edad >= 41 && $edad <= 50) {
        $rangos['41-50']++;
    } elseif ($edad >= 51 && $edad <= 60) {
        $rangos['51-60']++;
    } else {
        $rangos['61+']++;
    }
}
//
        return view('home', compact(
            'usersCount', 'historiasClinicasCount', 'pacientesCount', 'emergenciasCount', 
            'citasCount', 'doctoresCount', 'controlMedicamentosCount', 'admisionEgresoCount', 
            'especialidadesCount', 'rolesCount','ciudades', 'totales','enfermedades' ,
        'totales_enfermedades','pacientesPorGenero','rangos' 
        ));
    }


}
