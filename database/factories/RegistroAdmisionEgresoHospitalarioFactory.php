<?php

namespace Database\Factories;

use App\Models\RegistroAdmisionEgresoHospitalario;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistroAdmisionEgresoHospitalarioFactory extends Factory
{
    protected $model = RegistroAdmisionEgresoHospitalario::class;

    public function definition()
    {
        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'establecimiento_salud' => $this->faker->company,
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->lastName,
            'no_expediente' => $this->faker->numerify('EXP####'),
            'nacionalidad' => $this->faker->country,
            'no_cedula' => $this->faker->unique()->numerify('###########'),
            'estado_civil' => $this->faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
            'escolaridad' => $this->faker->randomElement(['Primaria', 'Secundaria', 'Universitaria']),
            'categoria_paciente' => $this->faker->randomElement(['Adulto', 'Niño', 'Anciano']),
            'no_inss' => $this->faker->numerify('###########'),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'direccion_residencia' => $this->faker->address,
            'municipio' => $this->faker->city,
            'localidad' => $this->faker->streetName,
            'departamento' => $this->faker->state,
            'raza_etnia' => $this->faker->randomElement(['Mestizo', 'Indígena', 'Afrodescendiente']),
            'edad' => $this->faker->numberBetween(1, 100),
            'ocupacion' => $this->faker->jobTitle,
            'nombre_madre' => $this->faker->firstNameFemale . ' ' . $this->faker->lastName,
            'nombre_padre' => $this->faker->firstNameMale . ' ' . $this->faker->lastName,
            'urgencia_avisar' => $this->faker->name,
            'direccion_telefono_avisar' => $this->faker->phoneNumber,
            'ingreso' => $this->faker->dateTimeThisYear,
            'empleador' => $this->faker->company,
            'direccion_empleador' => $this->faker->address,
            'municipio_distrito' => $this->faker->city,
            'parentesco' => $this->faker->randomElement(['Padre', 'Madre', 'Hermano', 'Hermana']),
            'diagnostico_ingreso' => $this->faker->sentence,
            'forma_llegada_hospital' => $this->faker->randomElement(['Ambulancia', 'Por cuenta propia']),
            'reingreso_mismo_diagnostico' => $this->faker->boolean,
            'sitio_ingreso_hospitalario' => $this->faker->randomElement(['Urgencias', 'Consulta externa']),
            'nombre_medico' => $this->faker->name,
            'sello_medico_ingreso' => $this->faker->word,
            'egreso_fecha' => $this->faker->dateTimeThisYear,
            'egreso_hora' => $this->faker->time,
            'diagnostico_egreso' => $this->faker->sentence,
            'diagnostico_egreso_principal' => $this->faker->sentence,
            'diagnostico_egreso_complementarios' => $this->faker->sentence,
            'cirugias_realizadas' => $this->faker->sentence,
            'nombre_admisionista' => $this->faker->name,
            'dias_estancia' => $this->faker->numberBetween(1, 30),
            'accidente_trabajo' => $this->faker->boolean,
            'de_trayecto' => $this->faker->boolean,
            'enfermedad_laboral' => $this->faker->boolean,
            'causa_trauma' => $this->faker->sentence,
            'infeccion_intrahospitalaria' => $this->faker->boolean,
            'referido_otro_establecimiento' => $this->faker->boolean,
        ];
    }
}
