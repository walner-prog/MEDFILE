<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultorio;

class ConsultorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consultorio::create([
            'nombre' => 'Consultorio Central',
            'ubicacion' => 'Av. Libertador 1234',
            'capacidad' => 10,
            'telefono' => '011-1234-5678',
            'especialidad' => 'Medicina General',
            'estado' => 'activo',
        ]);

        Consultorio::create([
            'nombre' => 'Consultorio Norte',
            'ubicacion' => 'Calle Las Flores 4321',
            'capacidad' => 8,
            'telefono' => '011-4321-8765',
            'especialidad' => 'Pediatría',
            'estado' => 'activo',
        ]);

        Consultorio::create([
            'nombre' => 'Consultorio Este',
            'ubicacion' => 'Calle San Martín 987',
            'capacidad' => 5,
            'telefono' => '011-9876-5432',
            'especialidad' => 'Dermatología',
            'estado' => 'activo',
        ]);

        Consultorio::create([
            'nombre' => 'Consultorio Oeste',
            'ubicacion' => 'Av. Mitre 321',
            'capacidad' => 6,
            'telefono' => '011-5432-2109',
            'especialidad' => 'Cardiología',
            'estado' => 'activo',
        ]);

        Consultorio::create([
            'nombre' => 'Consultorio Sur',
            'ubicacion' => 'Calle Independencia 456',
            'capacidad' => 12,
            'telefono' => '011-2109-8765',
            'especialidad' => 'Neurología',
            'estado' => 'inactivo',
        ]);
    }
}
