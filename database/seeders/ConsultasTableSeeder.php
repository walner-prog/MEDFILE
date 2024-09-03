<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultasTableSeeder extends Seeder
{
    public function run()
    {
        // Obtén IDs de doctores y pacientes (asegúrate de que existan estos registros)
        $doctores = DB::table('doctores')->pluck('id');
        $pacientes = DB::table('pacientes')->pluck('id');
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('consultas')->insert([
                'fecha_consulta' => now()->subDays(rand(1, 30)), // Fecha aleatoria en el último mes
                'paciente_id' => $pacientes->random(), // Paciente aleatorio
                'doctor_id' => $doctores->random(), // Doctor aleatorio
                'motivo_consulta' => 'Motivo de consulta ' . ($i + 1),
                'diagnostico' => 'Diagnóstico ejemplo ' . ($i + 1),
                'tratamiento_recomendado' => 'Tratamiento recomendado ' . ($i + 1),
                'observaciones' => 'Observaciones adicionales ' . ($i + 1),
                'estado' => ['completada', 'pendiente', 'cancelada'][rand(0, 2)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

