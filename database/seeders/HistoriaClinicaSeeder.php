<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoriaClinica;

class HistoriaClinicaSeeder extends Seeder
{
    public function run()
    {
        // Crea 50 registros de HistoriaClinica
        HistoriaClinica::factory()->count(100)->create();
    }
}
