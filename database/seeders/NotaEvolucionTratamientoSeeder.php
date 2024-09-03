<?php
// app/Database/Seeders/NotaEvolucionTratamientoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotaEvolucionTratamiento;

class NotaEvolucionTratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 100 registros en la tabla de notas de evolución y tratamiento
        NotaEvolucionTratamiento::factory()->count(50)->create();
    }
}

