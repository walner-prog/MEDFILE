<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Importamos el modelo de permisos de Spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definimos los permisos correspondientes a las rutas
        $permisos = [
            // Rutas para buscar usuario
            'ver-buscar-usuario',
            'ver-usuario-api',

            // Rutas para el perfil del usuario
            'ver-perfil',
            'editar-perfil',

            // Permisos para UsuarioController (resource)
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            // Rutas para restablecimiento de contraseña
            'ver-password-reset-form',
            'enviar-password-reset-link',
            'ver-password-reset-token',
            'actualizar-password',

            // Rutas para cambio de contraseña
            'ver-cambiar-password-form',
            'cambiar-password',

            // Permisos para RoleController (resource)
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            // Permisos para UserRoles (resource)
            'ver-usuario-rol',
            'crear-usuario-rol',
            'editar-usuario-rol',
            'borrar-usuario-rol',

            // Permisos para HospitalController (resource)
            'ver-hospital',
            'crear-hospital',
            'editar-hospital',
            'borrar-hospital',

            // Rutas para manejo de ventas y PDF
            'ver-venta-pdf',
            'imprimir-venta-pdf',

            // Permisos para PacienteController (resource)
            'ver-paciente',
            'crear-paciente',
            'editar-paciente',
            'borrar-paciente',
            'ver-historia-clinica-paciente',
            'ver-paciente-api',
            'buscar-paciente',
            'ver-paciente-pdf',

            // Permisos para los cálculos de pacientes
            'ver-pacientes-por-enfermedad',
            'ver-pacientes-por-ciudad-enfermedad',
            'ver-enfermedades-con-pacientes',
            'ver-ciudades-con-pacientes',
            'ver-consulta-total-por-enfermedad',
            'ver-promedio-consultas-general',
            'ver-pacientes-con-promedio-consultas',
            'ver-promedio-consultas-por-enfermedad',
            'ver-calculos-pacientes',

            // Permisos para EmergenciaController (resource)
            'ver-emergencia',
            'crear-emergencia',
            'editar-emergencia',
            'borrar-emergencia',

            // Permisos para InformesCondicionDiariaController (resource)
            'ver-informe-condicion-diaria',
            'crear-informe-condicion-diaria',
            'editar-informe-condicion-diaria',
            'borrar-informe-condicion-diaria',

            // Permisos para ListaProblemasController (resource)
            'ver-lista-problemas',
            'crear-lista-problemas',
            'editar-lista-problemas',
            'borrar-lista-problemas',

             // Rutas para HistoriaClinicaController y API
             'ver-historia-clinica',
             'crear-historia-clinica',
             'editar-historia-clinica',
             'borrar-historia-clinica',
             'ver-historia-clinica-api',
             'comprobar-historia-clinica-api',
 
             // Permisos para NotasEvolucionTratamientoController (resource)
             'ver-nota-evolucion-tratamiento',
             'crear-nota-evolucion-tratamiento',
             'editar-nota-evolucion-tratamiento',
             'borrar-nota-evolucion-tratamiento',
 
             // Permisos para ControlMedicamentosController (resource)
             'ver-control-medicamentos',
             'crear-control-medicamentos',
             'editar-control-medicamentos',
             'borrar-control-medicamentos',
 
             // Permisos para RegistroAdmisionEgresoHospitalarioController (resource)
             'ver-registro-admision-hospitalario',
             'crear-registro-admision-hospitalario',
             'editar-registro-admision-hospitalario',
             'borrar-registro-admision-hospitalario',
 
             // Permisos para RegistroPacientesController
             'ver-registro-paciente',
             'ver-registro-paciente-index',
             'ver-pacientes-data',
             'ver-admision-por-paciente',
 
             // Permisos para DoctoresController (resource)
             'ver-doctor',
             'crear-doctor',
             'editar-doctor',
             'borrar-doctor',
             'ver-doctor-api',
             'ver-doctores-mostrar',
             'ver-doctores-calculos',
             'ver-especialidad-con-mas-doctores',
             'ver-doctores-recientes',

              // Rutas para DoctoresController con métodos personalizados
            'ver-doctores-por-especialidad',
            'ver-especialidades-con-doctores',
            'ver-departamentos-con-doctores',
            'ver-consulta-total-por-especialidad',
            'ver-promedio-consultas-general',
            'ver-doctores-con-promedio-consultas',
            'ver-promedio-consultas-por-especialidad',
            'buscar-doctor',

            // Permisos para EspecialidadesController (resource)
            'ver-especialidad',
            'crear-especialidad',
            'editar-especialidad',
            'borrar-especialidad',
            'buscar-especialidad',
            'ver-detalle-especialidad',

            // Permisos para DepartamentosController (resource)
            'ver-departamento',
            'crear-departamento',
            'editar-departamento',
            'borrar-departamento',
         ];
        

        // Creamos cada permiso en la base de datos
        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
