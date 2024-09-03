<?php

namespace Database\Factories;

use App\Models\ListaProblema;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ListaProblemaFactory extends Factory
{
    protected $model = ListaProblema::class;

    public function definition()
    {
        $faker = FakerFactory::create('es_ES'); // Crear faker con localización en español

        return [
            'paciente_id' => Paciente::inRandomOrder()->first()->id,
            'primer_nombre' => $faker->firstName,
            'segundo_nombre' => $faker->firstName,
            'primer_apellido' => $faker->lastName,
            'segundo_apellido' => $faker->lastName,
            'edad' => $faker->numberBetween(1, 100),
            'no_expediente' => $faker->unique()->numerify('EXP-####'),
            'servicio' => $faker->word,
            'sala' => $faker->word,
            'fecha' => $faker->date,
            'nombre_problema' => $faker->sentence,
            'inactivo' => $faker->boolean,
            'resuelto' => $faker->boolean,
            'establecimiento_salud' => $faker->company,
        ];
    }
}
