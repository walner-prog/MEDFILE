<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformeCondicionDiaria;

class InformeCondicionDiariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformeCondicionDiaria::factory()->count(60)->create();
    }
}
