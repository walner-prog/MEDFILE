<?php
namespace Database\Factories;

use App\Models\RegistroAdmisionEgresoHospitalario;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistroAdmisionEgresoHospitalarioFactory extends Factory
{
    protected $model = RegistroAdmisionEgresoHospitalario::class;

    public function definition()
    {
        // Selecciona un paciente existente de la tabla 'pacientes'
        $paciente = Paciente::inRandomOrder()->first();

        return [
            'paciente_id' => $paciente->id, // Tomar el paciente ya existente
            'establecimiento_salud' => $this->faker->company,
            'primer_nombre' => $paciente->primer_nombre, // Tomar el dato del paciente seleccionado
            'segundo_nombre' => $paciente->segundo_nombre, // Tomar el dato del paciente seleccionado
            'primer_apellido' => $paciente->primer_apellido, // Tomar el dato del paciente seleccionado
            'segundo_apellido' => $paciente->segundo_apellido, // Tomar el dato del paciente seleccionado
            'no_expediente' => $paciente->no_expediente, // Tomar el dato del paciente seleccionado
            'nacionalidad' => $this->faker->country,
            'no_cedula' => $paciente->no_cedula, // Tomar el dato del paciente seleccionado
            'estado_civil' => $this->faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
            'escolaridad' => $this->faker->randomElement(['Primaria', 'Secundaria', 'Universitaria']),
            'categoria_paciente' => $this->faker->randomElement(['Adulto', 'Niño', 'Anciano']),
            'no_inss' => $paciente->no_inss, // Tomar el dato del paciente seleccionado
            'sexo' => $paciente->sexo, // Tomar el dato del paciente seleccionado
            'direccion_residencia' => $this->faker->address,
            'municipio' => $this->faker->city,
            'localidad' => $this->faker->streetName,
            'departamento' => $this->faker->state,
            'raza_etnia' => $this->faker->randomElement(['Mestizo', 'Indígena', 'Afrodescendiente']),
            'edad' => $paciente->edad, // Tomar el dato del paciente seleccionado
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
