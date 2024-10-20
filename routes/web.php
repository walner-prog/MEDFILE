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
use App\Http\Controllers\ExcepcionController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PacienteAuthController;
use App\Http\Controllers\CitavueController;
use App\Http\Controllers\AutoevaluacionController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\FileUploadController;
Auth::routes();
Route::resource('welcome', WebController::class);
Route::get('horarios-consultorio/{id}', [WebController::class, 'horarios_doctor_consultorio'])
    ->name('horarios-consultorio');

// Ruta para el perfil del paciente
Route::get('/agendar-cita', [CitavueController::class, 'agendarCita'])->name('agendar.cita');
 // Archivo: routes/web.php

Route::get('/terapia-en-linea', function () {
    return view('terapia-en-linea');
})->name('terapia.en.linea');

// Asegúrate de tener esta ruta en tus archivos de rutas
Route::post('/agendar-cita', [CitavueController::class, 'stores'])->name('citas.stores');
Route::get('/citas-agendadas', [CitavueController::class, 'citasAgendadas'])->name('citas.agendadas');
Route::get('/historial-citas', [CitavueController::class, 'historialCitas'])->name('historial.citas');
Route::get('/notificaciones-pendientes', [CitavueController::class, 'notificacionesPendientes'])->name('notificaciones.pendientes');
// Ruta para la generación de consejos
Route::get('/pacientes/{id}/generarConsejos', [CitavueController::class, 'generarConsejos']);
// Maneja la solicitud POST
Route::get('/obtener_horarios_doctor/{doctor}', [CitavueController::class, 'obtenerHorariosDoctor']);
Route::get('/citas_mostrar', [CitavueController::class, ' mostrarHorarios'])->name('citas.mostrar');

 // rutas para para el chat con la IA y pacientes 
Route::post('send', [ChatBotController::class, 'sendChat'])->name('send');
Route::get('/chat-historial', [ChatBotController::class, 'getChats'])->name('chat.historial');
// Route::get('/chat/{chatId?}', [ChatBotController::class, 'showChat'])->name('chat.show');
Route::get('/chat/{chat_id}', [ChatBotController::class, 'viewChat'])->name('chat.view');
Route::get('/chat', [ChatBotController::class, 'index'])->name('chat');


Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelarCita'])->name('citas.cancelar');


// Rutas para auto evaluacoones del paciente
Route::get('/auto-evaluacion', [AutoevaluacionController::class, 'index'])->name('autoevaluacion.index');
Route::post('/auto-evaluacion', [AutoevaluacionController::class, 'store'])->name('autoevaluacion.store');
Route::post('/autoevaluacion/enviar-whatsapp', [AutoevaluacionController::class, 'enviarPorWhatsapp'])->name('autoevaluacion.enviar-whatsapp');

// Rutas para el login del paciente y la vista principal de pacientes 
Route::post('pacientes/logout', [PacienteAuthController::class, 'logout'])->name('pacientes.logout');
Route::get('pacientes/login', [PacienteAuthController::class, 'showLoginForm'])->name('pacientes.login');
Route::post('pacientes/login', [PacienteAuthController::class, 'login']);
Route::get('/medfile-pacientes', [PacienteAuthController::class, 'index'])->name('medfile-pacientes.home');
Route::get('/medfile-pacientes/quienes-somos', [PacienteAuthController::class, 'quienesSomos'])->name('medfile-pacientes.quienes-somos');
Route::group(['middleware' => ['auth:paciente', 'inactivity']], function () {
    // Rutas protegidas para pacientes

    Route::get('/paciente/perfil', [PacienteAuthController::class, 'perfil'])->name('profile.paciente')->middleware('auth:paciente');
    // Otras rutas del portal del paciente...
});


Route::get('/api/pacientes/citas', [PacienteController::class, 'getPacientescitas']);
Route::get('/api/doctores/citas', [DoctoresController::class, 'getDoctorescitas']);
Route::get('/api/especialidades/citas', [EspecialidadesController::class, 'getEspecialidadescitas']);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// aca estoy protegiendomlas rutas con spatie

Route::group(['middleware' => ['auth']], function () {

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

// Ruta en admin para pacientes 
Route::get('/notificaciones', [PacienteController::class, 'listaNotificaciones'])->name('notificaciones.lista');
Route::resource('pacientes', PacienteController::class)->middleware('permission:ver-paciente');
Route::get('/pacientes/{no_expediente}', [PacienteController::class, 'show'])->name('pacientes.show');
Route::get('/api/pacientes/{id}', [PacienteController::class, 'getPaciente'])->name('pacientes.getPaciente');
Route::get('/buscar-paciente', [PacienteController::class, 'buscarPaciente'])->name('buscarPaciente');
Route::get('/pacientes/{id}/pdf', [PacienteController::class, 'download'])->name('pacientes.pdf');
Route::delete('/pacientes/{id}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

Route::get('/pacientes/{id}/historia_clinica', function ($id) {
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
Route::get('pacientes_por_enfermedad', [PacienteController::class, 'getPacientesPorEnfermedad'])->middleware('permission:ver-paciente');
Route::get('pacientes_por_ciudad_enfermedad', [PacienteController::class, 'filtrarPacientesPorCiudadYEnfermedad'])->middleware('permission:ver-paciente');
Route::get('enfermedades_con_pacientes', [PacienteController::class, 'getEnfermedadesConPacientes'])->middleware('permission:ver-paciente');
Route::get('ciudades_con_pacientes', [PacienteController::class, 'getCiudadesConPacientes'])->middleware('permission:ver-paciente');
Route::get('consulta_total_por_enfermedad', [PacienteController::class, 'getConsultaTotalPorEnfermedad'])->middleware('permission:ver-paciente');
Route::get('promedio_consultas_general', [PacienteController::class, 'getPromedioConsultasGeneral'])->middleware('permission:ver-paciente');
Route::get('pacientes_con_promedio_consultas', [PacienteController::class, 'getPacientesConPromedioConsultas'])->middleware('permission:ver-paciente');
Route::get('promedio_consultas_por_enfermedad', [PacienteController::class, 'getPromedioConsultasPorEnfermedad'])->middleware('permission:ver-paciente');
Route::get('pacientes_calculos', [PacienteController::class, 'calculosPacientes'])->name('pacientes.calculos')->middleware('permission:ver-calculos-pacientes');
Route::get('/grafica-enfermedades', [PacienteController::class, 'graficaEnfermedadesCronicas'])->name('grafica.enfermedades');

//Route::resource('emergencias', EmergenciaController::class);
Route::resource('emergencias', EmergenciaController::class)->middleware('permission:ver-emergencia');

Route::resource('informes_condicion_diaria', InformesCondicionDiariaController::class)->middleware('permission:ver-informe-condicion-diaria');
Route::put('informes_condicion_diaria{informe}', [InformesCondicionDiariaController::class, 'update'])->name('informes_condicion_diaria.update');


Route::resource('lista_problemas', ListaProblemasController::class)->middleware('permission:ver-lista-problemas');
Route::resource('historias_clinicas', HistoriaClinicaController::class);
Route::get('/api/historia_clinica/{id}', [HistoriaClinica::class, 'gethistoria_clinica'])->name('historias_clinicas.gethistoria_clinica');

//Route::middleware('can:ver-historia-clinica')->group(function () {Route::resource('historias_clinicas', HistoriaClinicaController::class);});
Route::resource('historias_clinicas', HistoriaClinicaController::class)->middleware('permission:ver-historia-clinica');

//Route::group(['middleware' => 'permission:ver-historia-clinica'], function () { Route::resource('historias_clinicas', HistoriaClinicaController::class);});

Route::get('historias_clinicas/{id}', [HistoriaClinicaController::class, 'show'])->name('historias_clinicas.show');

Route::get('/api/historias-clinicas/comprobar/{pacienteId}', [HistoriaClinicaController::class, 'comprobarHistoriaClinica']);
Route::get('historias_clinicas/{id}/pdf', 'App\Http\Controllers\HistoriaClinicaController@generatePdf')->name('historias_clinicas.pdf');
Route::get('/historia-clinica/analizar/{id}', [HistoriaClinicaController::class, 'analizarHistoriaClinica'])->name('analizar.historia');
Route::get('/historia-clinica/ia/{id}', [HistoriaClinicaController::class, 'showHistoriaClinica'])->name('mostrar.historia');
Route::get('/historias-clinicas/analizar/ia', [HistoriaClinicaController::class, 'mostraPacientesParaanalisIA'])->name('historias-clinicas.ia');
Route::post('/historia-clinica/{id}/archivo', [HistoriaClinicaController::class, 'guardarArchivo'])->name('guardar.archivo');

Route::resource('notas_evolucion_tratamiento', NotasEvolucionTratamientoController::class)->middleware('permission:ver-nota-evolucion-tratamiento');
Route::put('notas_evolucion_tratamiento{nota}', [NotasEvolucionTratamientoController::class, 'update'])->name('notas_evolucion_tratamiento.update');
// Define las rutas para el controlador de ControlMedicamentos
Route::resource('control_medicamentos', ControlMedicamentosController::class)->middleware('permission:ver-control-medicamentos');

Route::put('control_medicamentos{controle}', [ControlMedicamentosController::class, 'update'])->name('control_medicamentos.update');


Route::resource('registro_admision_hospitalario', RegistroAdmisionEgresoHospitalarioController::class)->middleware('permission:ver-registro-admision-hospitalario');
Route::put('registro_admision_hospitalario{admision}', [RegistroAdmisionEgresoHospitalarioController::class, 'update'])->name('registro_admision_hospitalario.update');

Route::resource('registro_pacientes', RegistroPacientesController::class); //vista principal de pacientes
Route::get('registro_pacientes/{id}', [RegistroPacientesController::class, 'show'])->name('registro_pacientes.show');
//Route::get('registro_pacientes', [RegistroPacientesController::class, 'index'])->name('registro_pacientes.index');

Route::get('pacientes-data', [RegistroPacientesController::class, 'data'])->name('pacientes.data');
Route::get('/pacientes/{id}/registro_admision_egreso', function ($id) {
    $admision = RegistroAdmisionEgresoHospitalario::where('paciente_id', $id)->first();

    if ($admision) {
        return redirect()->route('registro_admision_hospitalario.show', $admision->id);
    } else {
        return redirect()->back()->with('error', 'Este paciente no tiene un registro de admisión o egreso hospitalario.');
    }
});

Route::resource('doctores', DoctoresController::class)->middleware('permission:ver-doctor');

Route::get('/api/doctores/{id}', [DoctoresController::class, 'getDoctor'])->name('doctores.getDoctor')->middleware('permission:ver-doctor-api');
Route::get('doctores_mostrar', [DoctoresController::class, 'mostrarDoctores'])->name('doctores.mostrar')->middleware('permission:ver-doctores-mostrar');
Route::get('doctores_calculos', [DoctoresController::class, 'calculosDoctores'])->name('doctores.calculos')->middleware('permission:ver-doctores-calculos'); 
Route::get('doctores_especialidad_con_mas_doctores', [DoctoresController::class, 'getEspecialidadConMasDoctores'])->name('doctores.especialidad_con_mas_doctores');

Route::get('doctores_recientes', [DoctoresController::class, 'getDoctoresRecientes'])
    ->middleware(['auth', 'can:view-doctores-recientes']);

Route::get('doctores-por-especialidad', [DoctoresController::class, 'getDoctoresPorEspecialidad']);
Route::get('especialidades_con_doctores', [DoctoresController::class, 'getEspecialidadesConDoctores']);
Route::get('departamentos_con_doctores', [DoctoresController::class, 'getDepartamentosConDoctores']);
Route::get('consulta_total_por_especialidad', [DoctoresController::class, 'getConsultaTotalPorEspecialidad']);
Route::get('promedio_consultas_general', [DoctoresController::class, 'getPromedioConsultasGeneral']);
Route::get('doctores_con_promedio_consultas', [DoctoresController::class, 'getDoctoresConPromedioConsultas']);
Route::get('promedio_consultas_por_especialidad', [DoctoresController::class, 'getPromedioConsultasPorEspecialidad']);
Route::get('/buscar-doctor', [DoctoresController::class, 'buscardoctor'])->name('buscardoctor')->middleware('permission:buscar-doctor');



Route::resource('especialidades', EspecialidadesController::class)->middleware('permission:ver-especialidad');
Route::put('/especialidades/{especialidad}', [EspecialidadesController::class, 'update'])->name('especialidades.update');
Route::get('/buscar-especialidades', [EspecialidadesController::class, 'buscar'])->name('buscaespecialidad');
Route::get('/especialidades/{id}', [EspecialidadesController::class, 'detalles']);

Route::resource('departamentos', DepartamentosController::class)->middleware('permission:ver-departamento');
   

Route::resource('citas', CitaController::class)->middleware('permission:ver-cita');
Route::post('/citas/verificar-disponibilidad', [CitaController::class, 'verificarDisponibilidad'])->name('citas.verificar_disponibilidad');
Route::post('/citas/obtener-horarios-disponibles', [CitaController::class, 'obtenerHorariosDisponibles'])->name('citas.obtenerHorariosDisponibles');
Route::get('horarios-citas-consultorio/{id}', [CitaController::class, 'horarios_citas_consultorio'])
    ->name('horarios-citas-consultorio');

Route::get('doctor_por_citas', [CitaController::class, 'verCitas'])->name('doctor.citas')->middleware('auth');
Route::get('/citas/{id}', [CitaController::class, 'show'])->name('citas.show');


Route::resource('horarios-doctor', HorarioDoctorController::class)->names('horarios-doctor')->middleware('permission:ver-horarios-doctor-consultorio');
Route::get('horarios-doctor-consultorio/{id}', [HorarioDoctorController::class, 'horarios_doctor_consultorio'])
    ->name('horarios-doctor-consultorio');
Route::get('/horarios', [HorarioDoctorController::class, 'getHorarios']);
Route::get('/horarios_disponibles', [HorarioDoctorController::class, 'horariosDisponibles']);

Route::resource('excepciones', ExcepcionController::class);

// Ruta que controla todo lo refernte a las vitas en uppload
Route::resource('/upload-file-view', FileUploadController::class)->middleware('permission:file-permiso-ver');
Route::get('/list-files', [FileUploadController::class, 'listFiles']);
Route::get('/retrieve-file/{id}', [FileUploadController::class, 'retrieveFile']);
Route::delete('/delete-file/{id}', [FileUploadController::class, 'deleteFile']); // Ruta para eliminar archivo
Route::get('/retrieve-file-content/{id}', [FileUploadController::class, 'retrieveFileContent']); // Ruta para recuperar contenido
Route::view('/upload-file-view', 'analist-archivos.upload_file'); // Ruta para la vista
Route::get('/upload-file-view', [FileUploadController::class, 'index'])->name('upload-file.view')->middleware('permission:file-permiso-ver');
Route::post('/upload-file', [FileUploadController::class, 'upload']);


 // rutas para para el chat con la IA y pacientes 
 Route::post('send', [FileUploadController::class, 'sendChatMedico'])->name('send');
 Route::get('/chat-historial', [FileUploadController::class, 'getChats'])->name('chat.historial');
 // Route::get('/chat/{chatId?}', [ChatBotController::class, 'showChat'])->name('chat.show');
 Route::get('/chat/{chat_id}', [FileUploadController::class, 'viewChat'])->name('chat.view');
 Route::get('/chat-medico', [FileUploadController::class, 'chatMedico'])->name('chat.medico');
 
