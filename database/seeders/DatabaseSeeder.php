<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Llama a otros seeders aquí
        $this->call([
          
            //SeederTablaRoles::class, // Añade esta línea
            PacienteSeeder::class, // Asegúrate de que este seeder ya esté creado
            EmergenciaSeeder::class,
            
            ListaProblemasSeeder::class,
            HistoriaClinicaSeeder::class,
           // ControlMedicamentoSeeder::class,
            NotaEvolucionTratamientoSeeder::class,
          //  ControlMedicamentosSeeder::class,
            AdmisionSeeder::class,

            EspecialidadSeeder::class,
            DepartamentoSeeder::class,
            UserSeeder::class,
            DepartamentosHospitalSeeder::class,
            EspecialidadesSeeder::class,
            DoctorSeeder::class,
           
            ConsultorioSeeder::class,
            AdmisionSeeder::class,
            RolesSeeder::class,
            SeederTablaPermisos::class
        ]);
    }
}
