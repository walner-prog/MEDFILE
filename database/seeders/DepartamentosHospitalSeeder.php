<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosHospitalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            ['nombre' => 'Urgencias', 'descripcion' => 'Atención médica inmediata para emergencias y casos críticos.'],
            ['nombre' => 'Admisión y Registro', 'descripcion' => 'Gestión de la entrada de pacientes y documentación administrativa.'],
            ['nombre' => 'Radiología', 'descripcion' => 'Servicios de diagnóstico por imágenes como rayos X, resonancias magnéticas y tomografías computarizadas.'],
            ['nombre' => 'Laboratorio Clínico', 'descripcion' => 'Realización de pruebas de laboratorio y análisis de muestras biológicas.'],
            ['nombre' => 'Cirugía', 'descripcion' => 'Realización de procedimientos quirúrgicos, incluyendo quirófanos y cuidados postoperatorios.'],
            ['nombre' => 'Medicina Interna', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades complejas en adultos.'],
            ['nombre' => 'Pediatría', 'descripcion' => 'Atención médica especializada en niños y adolescentes.'],
            ['nombre' => 'Obstetricia y Ginecología', 'descripcion' => 'Atención relacionada con el embarazo, parto y salud reproductiva femenina.'],
            ['nombre' => 'Neurología', 'descripcion' => 'Diagnóstico y tratamiento de trastornos del sistema nervioso.'],
            ['nombre' => 'Cardiología', 'descripcion' => 'Evaluación y tratamiento de enfermedades del corazón.'],
            ['nombre' => 'Oncología', 'descripcion' => 'Tratamiento de cáncer y seguimiento de pacientes oncológicos.'],
            ['nombre' => 'Gastroenterología', 'descripcion' => 'Atención a enfermedades del sistema digestivo.'],
            ['nombre' => 'Endocrinología', 'descripcion' => 'Tratamiento de trastornos hormonales y metabólicos.'],
            ['nombre' => 'Nefrología', 'descripcion' => 'Atención a enfermedades del riñón.'],
            ['nombre' => 'Neumología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades respiratorias.'],
            ['nombre' => 'Psiquiatría', 'descripcion' => 'Atención a trastornos mentales y emocionales.'],
            ['nombre' => 'Reumatología', 'descripcion' => 'Tratamiento de enfermedades reumáticas y del sistema musculoesquelético.'],
            ['nombre' => 'Urología', 'descripcion' => 'Atención a enfermedades del sistema urinario y el sistema reproductor masculino.'],
            ['nombre' => 'Anestesiología', 'descripcion' => 'Administración de anestesia y manejo del dolor durante procedimientos.'],
            ['nombre' => 'Traumatología', 'descripcion' => 'Atención a lesiones y enfermedades del sistema musculoesquelético.'],
            ['nombre' => 'Dermatología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades de la piel.'],
            ['nombre' => 'Infectología', 'descripcion' => 'Manejo de enfermedades infecciosas.'],
            ['nombre' => 'Fisioterapia y Rehabilitación', 'descripcion' => 'Terapias físicas y rehabilitación para recuperar la función física.'],
            ['nombre' => 'Farmacia', 'descripcion' => 'Gestión y distribución de medicamentos y tratamientos.'],
            ['nombre' => 'Nutrición y Dietética', 'descripcion' => 'Asesoramiento y planificación de dietas para pacientes.'],
        ];

        // Inserta los datos en la tabla 'departamentos'
        DB::table('departamentos')->insert($departamentos);
    }
}
