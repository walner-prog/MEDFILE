<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Paciente;
use App\Models\Emergencia;
use App\Models\HistoriaClinica;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Doctor;
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
            'edad',
            'foto' // Incluimos la foto del paciente
        ]);

    return DataTables::of($query)
        ->addColumn('btn', 'actions')
        ->rawColumns(['foto', 'btn']) // Aseguramos que 'foto' también se trate como HTML
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


Route::get('historias_clinicas', function (Request $request) {
    $query = HistoriaClinica::with('paciente'); // Carga la relación paciente
 
    // Filtro global de búsqueda
    if ($request->has('search') && $request->search['value'] !== '') {
        $searchValue = $request->search['value'];

        // Aplica el filtro sobre los campos de la relación paciente
        $query->whereHas('paciente', function($q) use ($searchValue) {
            $q->where('no_expediente', 'like', "%{$searchValue}%")
              ->orWhere('primer_nombre', 'like', "%{$searchValue}%")
              ->orWhere('segundo_nombre', 'like', "%{$searchValue}%")
              ->orWhere('primer_apellido', 'like', "%{$searchValue}%")
              ->orWhere('segundo_apellido', 'like', "%{$searchValue}%")
              ->orWhere('no_cedula', 'like', "%{$searchValue}%");
        });
    }

    return datatables()
        ->eloquent($query)
        ->addColumn('no_expediente', function ($historiaClinica) {
            return $historiaClinica->paciente->no_expediente ?? 'No disponible';
        })
        ->addColumn('primer_nombre', function ($historiaClinica) {
            return $historiaClinica->paciente->primer_nombre ?? 'No disponible';
        })
        ->addColumn('segundo_nombre', function ($historiaClinica) {
            return $historiaClinica->paciente->segundo_nombre ?? 'No disponible';
        })
        ->addColumn('primer_apellido', function ($historiaClinica) {
            return $historiaClinica->paciente->primer_apellido ?? 'No disponible';
        })
        ->addColumn('segundo_apellido', function ($historiaClinica) {
            return $historiaClinica->paciente->segundo_apellido ?? 'No disponible';
        })
        ->addColumn('no_cedula', function ($historiaClinica) {
            return $historiaClinica->paciente->no_cedula ?? 'No disponible';
        })
        ->addColumn('edad', function ($historiaClinica) {
            return $historiaClinica->paciente->edad ?? 'No disponible';
        })
        ->addColumn('sexo', function ($historiaClinica) {
            return $historiaClinica->paciente->sexo == 'M' ? 'Masculino' : 'Femenino';
        })
        ->addColumn('no_inss', function ($historiaClinica) {
            return $historiaClinica->paciente->no_inss ?? 'No disponible';
        })
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



Route::get('citas', function () {
    
    return datatables()
    ->eloquent( App\Models\Cita::query())
    ->addColumn('btn','actions-departamento')
    ->rawColumns(['btn'])
    ->toJson();
});


Route::get('excepciones', function () {
    
    return datatables()
    ->eloquent( App\Models\Excepcion::query())
    ->addColumn('btn','actions-excepciones')
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