<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Paciente;
use App\Models\Emergencia;
use App\Models\HistoriaClinica;
use Yajra\DataTables\Facades\DataTables;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('pacientes', function () {
    $query = Paciente::query()
        ->select([
            'id',
            'no_expediente',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'no_cedula',
            'edad'
        ]);

    return DataTables::of($query)
        ->addColumn('btn','actions')
       
        ->rawColumns(['no_expediente', 'primer_nombre', 'no_cedula', 'edad', 'btn'])
        ->toJson();
});


Route::get('emergencias', function () {
    $query = Emergencia::query()
        ->select([
            'id',
            'no_expediente',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'no_cedula',
            'hora',
            'fecha'
        ]);

    return DataTables::of($query)
        ->addColumn('btn','actions-emergencias')
       
        ->rawColumns(['no_expediente', 'no_cedula', 'btn'])
        ->toJson();
});

Route::get('historias_clinicas', function () {
    return datatables()
        ->eloquent(App\Models\HistoriaClinica::select(['id', 'no_expediente', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'no_cedula','sexo','no_inss','edad'])) // Ajusta las columnas según lo que necesites
        ->addColumn('btn', 'actions-historiaclinica')
        ->rawColumns(['btn'])
        ->toJson();
});



Route::get('medicamentos', function () {
    
    return datatables()
    ->eloquent( App\Models\ControlMedicamento::query())
    ->addColumn('btn','actions-medicamento')
    ->rawColumns(['btn'])
    ->toJson();
});

Route::get('informes_condicion_diaria', function () {
    
    return datatables()
    ->eloquent( App\Models\InformeCondicionDiaria::query())
    ->addColumn('btn','actions-condicion-diaria')
    ->rawColumns(['btn'])
    ->toJson();
});


Route::get('lista_problemas', function () {
    
    return datatables()
    ->eloquent( App\Models\ListaProblema::query())
    ->addColumn('btn','actions-lista-problema')
    ->rawColumns(['btn'])
    ->toJson();
});


Route::get('notas_evolucion_tratamiento', function () {
    
    return datatables()
    ->eloquent( App\Models\NotaEvolucionTratamiento::query())
    ->addColumn('btn','actions-nota-evolucion')
    ->rawColumns(['btn'])
    ->toJson();
});


Route::get('registro_admision_hospitalario', function () {
    
    return datatables()
    ->eloquent( App\Models\RegistroAdmisionEgresoHospitalario::query())
    ->addColumn('btn','actions-egreso-hospital')
    ->rawColumns(['btn'])
    ->toJson();
});
use App\Models\Doctor;


Route::get('doctores', function () {
    $doctors = Doctor::with('especialidad')->get(); // Cargar la relación con Especialidad

    return DataTables::of($doctors)
        ->addColumn('especialidad', function ($doctor) {
            return $doctor->especialidad ? $doctor->especialidad->nombre : 'N/A'; // Mostrar el nombre de la especialidad
        })
        ->addColumn('btn', 'actions-doctor') // Reemplaza 'actions' con la vista o el código HTML para las acciones
        ->rawColumns(['btn'])
        ->toJson();
});



Route::get('especialidades', function () {
    
    return datatables()
    ->eloquent( App\Models\Especialidad::query())
    ->addColumn('btn','actions-especialidad')
    ->rawColumns(['btn'])
    ->toJson();
});


Route::get('departamentos', function () {
    
    return datatables()
    ->eloquent( App\Models\Departamento::query())
    ->addColumn('btn','actions-departamento')
    ->rawColumns(['btn'])
    ->toJson();
});














/**
 * Route::get('historias_clinicas', function () {
    $historias = App\Models\HistoriaClinica::where('fecha', '>=', now()->subYear()) // Filtra historias del último año
        ->select(['id', 'paciente_id', 'diagnostico', 'fecha']);

    return datatables()
        ->eloquent($historias)
        ->addColumn('btn', 'actions-historiaclinica')
        ->rawColumns(['btn'])
        ->toJson();
});

 */