<?php
namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    public function run()
    {
        Especialidad::factory()->count(25)->create();
    }
}
