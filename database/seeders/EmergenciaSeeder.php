<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emergencia;

class EmergenciaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Emergencia::factory()->count(50)->create(); // Ajusta el número de registros según tus necesidades
    }
}
