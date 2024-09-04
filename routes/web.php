<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\UsuarioController;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\UserRoles;


use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\InformesCondicionDiariaController;
use App\Http\Controllers\ListaProblemasController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\NotasEvolucionTratamientoController;
use App\Http\Controllers\ControlMedicamentosController;
use App\Http\Controllers\RegistroAdmisionEgresoHospitalarioController;
use App\Models\HistoriaClinica;
use App\Models\RegistroAdmisionEgresoHospitalario;
use App\Http\Controllers\RegistroPacientesController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HorarioDoctorController;





Route::get('/api/pacientes/citas', [PacienteController::class, 'getPacientescitas']);
Route::get('/api/doctores/citas', [DoctoresController::class, 'getDoctorescitas']);
Route::get('/api/especialidades/citas', [EspecialidadesController::class, 'getEspecialidadescitas']);


Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// aca estoy protegiendomlas rutas con spatie

Route::group(['middleware' => ['auth']],function() {

    Route::resource('roles', RoleController::class);
   
 });

 Route::get('/buscar-usuario', [UsuarioController::class, 'buscarUsuario'])->name('buscarusuario');
 Route::get('/api/usuarios/{id}', [UsuarioController::class, 'obtenerUsuario']);


Route::get('/perfil', 'App\Http\Controllers\UserController@profile')->name('profile');  
Route::put('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');


// Rutas para UsuarioController
Route::resource('usuarios', UsuarioController::class);


// Mostrar el formulario para solicitar el restablecimiento de contraseña
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Enviar el correo electrónico con el enlace de restablecimiento de contraseña
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostrar el formulario para restablecer la contraseña (con el token)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Procesar el restablecimiento de contraseña
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');





// Rutas para cambio de contrase;a
Route::get('cambiar_password', 'App\Http\Controllers\UsuarioController@showChangePasswordForm')->name('change-password-form');
Route::post('cambiar_password', 'App\Http\Controllers\UsuarioController@changePassword')->name('change_password');


// Rutas para roles
Route::resource('roles', RoleController::class);

Route::resource('usuarios_roles', UserRoles::class);


Route::resource('hospitales', HospitalController::class);




Route::get('ventas/{venta}/pdf', 'App\Http\Controllers\VentaController@downloadPdf')->name('ventas.pdf');
Route::get('/ventas/{venta}/print-pdf', 'App\Http\Controllers\VentaController@printPdf')->name('ventas.printPdf');

//Route::get('/ventas/{venta}/imprimir-baucher', [VentaController::class, 'imprimirBaucher'])->name('ventas.imprimirBaucher');

//Route::get('/ventas/{venta}/ventas-showview', [VentaController::class, 'showview'])->name('ventas.showview');




Route::resource('pacientes', PacienteController::class);
Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');
Route::get('/api/pacientes/{id}', [PacienteController::class, 'getPaciente'])->name('pacientes.getPaciente');
Route::get('/buscar-paciente', [PacienteController::class, 'buscarPaciente'])->name('buscarPaciente');
 
 Route::get('/pacientes/{id}/edit', [PacienteController::class, 'edit'])->name('pacientes.edit');

Route::get('/pacientes/{id}/pdf', [PacienteController::class, 'download'])->name('pacientes.pdf');

Route::get('/pacientes/{id}/historia_clinica', function($id) {
    // Buscar la primera historia clínica asociada al paciente
    $historiaClinica = HistoriaClinica::where('paciente_id', $id)->first();

    if ($historiaClinica) {
        // Redirigir a la vista de la historia clínica
        return redirect()->route('historias_clinicas.show', $historiaClinica->id);
    } else {
        // Redirigir de vuelta con un mensaje de error si no tiene historia clínica
        return redirect()->back()->with('error', 'Este paciente no tiene una historia clínica.');
    }
});
Route::get('pacientes_por_enfermedad', [PacienteController::class, 'getPacientesPorEnfermedad']);
Route::get('pacientes_por_ciudad_enfermedad', [PacienteController::class, 'filtrarPacientesPorCiudadYEnfermedad']);
Route::get('enfermedades_con_pacientes', [PacienteController::class, 'getEnfermedadesConPacientes']);
Route::get('ciudades_con_pacientes', [PacienteController::class, 'getCiudadesConPacientes']);
Route::get('consulta_total_por_enfermedad', [PacienteController::class, 'getConsultaTotalPorEnfermedad']);
Route::get('promedio_consultas_general', [PacienteController::class, 'getPromedioConsultasGeneral']);
Route::get('pacientes_con_promedio_consultas', [PacienteController::class, 'getPacientesConPromedioConsultas']);
Route::get('promedio_consultas_por_enfermedad', [PacienteController::class, 'getPromedioConsultasPorEnfermedad']);


Route::get('pacientes_calculos', [PacienteController::class, 'calculosPacientes'])->name('pacientes.calculos');



Route::resource('emergencias', EmergenciaController::class);

Route::resource('informes_condicion_diaria', InformesCondicionDiariaController::class);
Route::put('informes_condicion_diaria{informe}', [InformesCondicionDiariaController::class, 'update'])->name('informes_condicion_diaria.update');

Route::resource('lista_problemas', ListaProblemasController::class);


Route::get('/api/historia_clinica/{id}', [HistoriaClinica::class, 'gethistoria_clinica'])->name('historias_clinicas.gethistoria_clinica');
Route::resource('historias_clinicas', HistoriaClinicaController::class);
Route::get('historias_clinicas/{id}', [HistoriaClinicaController::class, 'show'])->name('historias_clinicas.show');

Route::get('/api/historias-clinicas/comprobar/{pacienteId}', [HistoriaClinicaController::class, 'comprobarHistoriaClinica']);




Route::resource('notas_evolucion_tratamiento', NotasEvolucionTratamientoController::class);
Route::put('notas_evolucion_tratamiento{nota}', [NotasEvolucionTratamientoController::class, 'update'])->name('notas_evolucion_tratamiento.update');
// Define las rutas para el controlador de ControlMedicamentos
Route::resource('control_medicamentos', ControlMedicamentosController::class);
Route::put('control_medicamentos{controle}', [ControlMedicamentosController::class, 'update'])->name('control_medicamentos.update');





Route::resource('registro_admision_hospitalario', RegistroAdmisionEgresoHospitalarioController::class);
Route::put('registro_admision_hospitalario{admision}', [RegistroAdmisionEgresoHospitalarioController::class, 'update'])->name('registro_admision_hospitalario.update');


Route::get('registro_pacientes/{id}', [RegistroPacientesController::class, 'show'])->name('registro_pacientes.show');
Route::get('registro_pacientes', [RegistroPacientesController::class, 'index'])->name('registro_pacientes.index');
Route::get('pacientes-data', [RegistroPacientesController::class, 'data'])->name('pacientes.data');
Route::get('/pacientes/{id}/registro_admision_egreso', function($id) {
    $admision = RegistroAdmisionEgresoHospitalario::where('paciente_id', $id)->first();

    if ($admision) {
        return redirect()->route('registro_admision_hospitalario.show', $admision->id);
    } else {
        return redirect()->back()->with('error', 'Este paciente no tiene un registro de admisión o egreso hospitalario.');
    }
});

Route::resource('doctores', DoctoresController::class);
Route::get('/api/doctores/{id}', [DoctoresController::class, 'getDoctor'])->name('doctores.getDoctor');
Route::get('doctores_mostrar', [DoctoresController::class, 'mostrarDoctores'])->name('doctores.mostrar');
Route::get('doctores_calculos', [DoctoresController::class, 'calculosDoctores'])->name('doctores.calculos');
Route::get('doctores_especialidad_con_mas_doctores', [DoctoresController::class, 'getEspecialidadConMasDoctores'])->name('doctores.especialidad_con_mas_doctores');
//Route::get('doctores_recientes', [DoctoresController::class, 'getDoctoresRecientes']);
Route::get('doctores_recientes', [DoctoresController::class, 'getDoctoresRecientes'])
    ->middleware(['auth', 'can:view-doctores-recientes']);

Route::get('doctores-por-especialidad', [DoctoresController::class, 'getDoctoresPorEspecialidad']);
Route::get('especialidades_con_doctores', [DoctoresController::class, 'getEspecialidadesConDoctores']);
Route::get('departamentos_con_doctores', [DoctoresController::class, 'getDepartamentosConDoctores']);
Route::get('consulta_total_por_especialidad', [DoctoresController::class, 'getConsultaTotalPorEspecialidad']);
Route::get('promedio_consultas_general', [DoctoresController::class, 'getPromedioConsultasGeneral']);
Route::get('doctores_con_promedio_consultas', [DoctoresController::class, 'getDoctoresConPromedioConsultas']);
Route::get('promedio_consultas_por_especialidad', [DoctoresController::class, 'getPromedioConsultasPorEspecialidad']);

Route::get('/buscar-doctor', [DoctoresController::class, 'buscardoctor'])->name('buscardoctor');


Route::resource('especialidades', EspecialidadesController::class);
Route::put('/especialidades/{especialidad}', [EspecialidadesController::class, 'update'])->name('especialidades.update');

Route::get('/buscar-especialidades', [EspecialidadesController::class, 'buscar'])->name('buscaespecialidad');
Route::get('/especialidades/{id}', [EspecialidadesController::class, 'detalles']);


Route::resource('departamentos', DepartamentosController::class)->middleware([
    'index' => 'can:ver-departamento',
    'create' => 'can:crear-departamento',
    'store' => 'can:crear-departamento',
    'edit' => 'can:editar-departamento',
    'update' => 'can:editar-departamento',
    'destroy' => 'can:borrar-departamento',
    'show' => 'can:ver-departamento',
]);

Route::resource('citas', CitaController::class);


Route::resource('horarios-doctor', HorarioDoctorController::class);

Route::get('/horarios', [HorarioDoctorController::class, 'getHorarios']);

Route::get('/horarios_disponibles', [HorarioDoctorController::class, 'horariosDisponibles']);
