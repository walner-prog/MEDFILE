<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistroAdmisionEgresoHospitalario;

class AdmisionSeeder extends Seeder
{
    public function run()
    {
        RegistroAdmisionEgresoHospitalario::factory()->count(100)->create();
    }
}
