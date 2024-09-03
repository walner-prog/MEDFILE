<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ControlMedicamento;
use App\Models\Paciente;

class ControlMedicamentosSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 100 registros de ControlMedicamento
        ControlMedicamento::factory()->count(100)->create();
    }
}
