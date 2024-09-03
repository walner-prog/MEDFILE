<?php

// app/Database/Factories/NotaEvolucionTratamientoFactory.php

namespace Database\Factories;

use App\Models\NotaEvolucionTratamiento;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotaEvolucionTratamientoFactory extends Factory
{
    protected $model = NotaEvolucionTratamiento::class;

    public function definition()
    {
        return [
            'paciente_id' => Paciente::factory(),
            'establecimiento_salud' => $this->faker->company,
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->lastName,
            'no_expediente' => 'EXP-' . $this->faker->unique()->numerify('#######'),
            'no_cedula' => $this->faker->unique()->numerify('###-######-#####'),
            'servicio' => $this->faker->word,
            'no_cama' => $this->faker->numberBetween(1, 100),
            'sala' => $this->faker->word,
            'no_inss' => $this->faker->unique()->numerify('######'),
            'fecha_hora' => $this->faker->dateTimeThisYear,
            'problemas_evolucion' => $this->faker->text,
            'planes' => $this->faker->text,
            'participantes_atencion' => $this->faker->name,
            'firma_codigo_profesional' => 'COD-' . $this->faker->unique()->numerify('#####'),
        ];
    }
}

