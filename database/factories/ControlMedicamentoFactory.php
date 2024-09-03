<?php

namespace Database\Factories;

use App\Models\ControlMedicamento;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ControlMedicamentoFactory extends Factory
{
    protected $model = ControlMedicamento::class;

    public function definition()
    {
        return [
            'paciente_id' => Paciente::factory(),
            'nombre_unidad_salud' => $this->faker->company,
            'no_expediente' => $this->faker->numerify('EXP-####'),
            'no_cedula' => $this->faker->numerify('###-######-####L'),
            'nombres_paciente' => $this->faker->firstName,
            'apellidos_paciente' => $this->faker->lastName,
            'fecha' => $this->faker->date,
            'hora' => $this->faker->time,
            'no_inss' => $this->faker->numerify('###-##-####'),
            'servicio_sala' => $this->faker->word,
            'no_cama' => $this->faker->numerify('###'),
            'medicamentos_otros' => $this->faker->sentence,
            'fecha_medicamentos' => $this->faker->date,
            'hora_medicamentos' => $this->faker->time,
            'medicamentos_stat_prn_preanestesico' => $this->faker->sentence,
            'hora_medicamentos_stat_prn' => $this->faker->time,
            'fecha_medicamentos_stat_prn' => $this->faker->date,
            'nombre_enfermera_codigo' => $this->faker->name . ' ' . $this->faker->numerify('COD-####'),
        ];
    }
}
