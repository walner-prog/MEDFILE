<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListaProblema;

class ListaProblemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListaProblema::factory()->count(50)->create();
    }
}
