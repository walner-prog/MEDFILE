<?php

namespace Database\Factories;

use App\Models\InformeCondicionDiaria;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InformeCondicionDiariaFactory extends Factory
{
    protected $model = InformeCondicionDiaria::class;

    public function definition()
    {
        return [
            'paciente_id' => Paciente::factory(), // Relación con la factory de Paciente
            'fecha' => $this->faker->date(),
            'servicio' => $this->faker->word(),
            'sala' => $this->faker->word(),
            'no_expediente' => $this->faker->word(),
            'fecha_hora_condicion' => $this->faker->dateTime(),
            'tratamiento' => $this->faker->text(),
            'procedimientos' => $this->faker->text(),
            'brindada_por' => $this->faker->name(),
            'recibida_por' => $this->faker->name(),
            'firma_quien_recibe' => $this->faker->name(),
        ];
    }
}
