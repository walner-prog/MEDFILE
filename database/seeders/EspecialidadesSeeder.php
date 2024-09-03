<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = [
            ['nombre' => 'Cardiología', 'descripcion' => 'Estudio y tratamiento de las enfermedades del corazón y el sistema cardiovascular.'],
            ['nombre' => 'Dermatología', 'descripcion' => 'Diagnóstico y tratamiento de las enfermedades de la piel.'],
            ['nombre' => 'Endocrinología', 'descripcion' => 'Estudio y tratamiento de los trastornos hormonales y metabólicos.'],
            ['nombre' => 'Gastroenterología', 'descripcion' => 'Tratamiento de enfermedades del sistema digestivo.'],
            ['nombre' => 'Geriatría', 'descripcion' => 'Atención médica a personas mayores y tratamiento de enfermedades asociadas con el envejecimiento.'],
            ['nombre' => 'Hematología', 'descripcion' => 'Estudio y tratamiento de enfermedades de la sangre y los órganos hematopoyéticos.'],
            ['nombre' => 'Infectología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades infecciosas.'],
            ['nombre' => 'Nefrología', 'descripcion' => 'Estudio y tratamiento de las enfermedades del riñón.'],
            ['nombre' => 'Neumología', 'descripcion' => 'Tratamiento de enfermedades del sistema respiratorio.'],
            ['nombre' => 'Neurología', 'descripcion' => 'Estudio y tratamiento de trastornos del sistema nervioso.'],
            ['nombre' => 'Obstetricia y Ginecología', 'descripcion' => 'Atención médica de la salud reproductiva femenina, embarazo y parto.'],
            ['nombre' => 'Oncología', 'descripcion' => 'Diagnóstico y tratamiento de cáncer.'],
            ['nombre' => 'Oftalmología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades de los ojos.'],
            ['nombre' => 'Otorrinolaringología', 'descripcion' => 'Tratamiento de enfermedades del oído, nariz y garganta.'],
            ['nombre' => 'Pediatría', 'descripcion' => 'Atención médica a niños y adolescentes.'],
            ['nombre' => 'Psiquiatría', 'descripcion' => 'Diagnóstico y tratamiento de trastornos mentales y emocionales.'],
            ['nombre' => 'Radiología', 'descripcion' => 'Uso de imágenes médicas para el diagnóstico y tratamiento de enfermedades.'],
            ['nombre' => 'Reumatología', 'descripcion' => 'Estudio y tratamiento de enfermedades reumáticas y del sistema musculoesquelético.'],
            ['nombre' => 'Traumatología', 'descripcion' => 'Tratamiento de lesiones y enfermedades del sistema musculoesquelético.'],
            ['nombre' => 'Urología', 'descripcion' => 'Estudio y tratamiento de enfermedades del sistema urinario y el sistema reproductor masculino.'],
            ['nombre' => 'Medicina de Urgencias', 'descripcion' => 'Atención médica inmediata para enfermedades y lesiones agudas.'],
            ['nombre' => 'Medicina Familiar', 'descripcion' => 'Atención integral y continua de pacientes de todas las edades.'],
            ['nombre' => 'Medicina Interna', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades complejas en adultos.'],
            ['nombre' => 'Cirugía General', 'descripcion' => 'Realización de procedimientos quirúrgicos en diferentes partes del cuerpo.'],
            ['nombre' => 'Anestesiología', 'descripcion' => 'Administración de anestesia y manejo del dolor durante procedimientos médicos.'],
        ];

        // Inserta los datos en la tabla 'especialidades'
        DB::table('especialidades')->insert($especialidades);
    }
}
