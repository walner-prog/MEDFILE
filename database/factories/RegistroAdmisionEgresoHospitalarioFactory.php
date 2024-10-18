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
  // Generar un código único de 5 dígitos
 do {
    $sello_medico_ingreso = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
  } while (RegistroAdmisionEgresoHospitalario::where('sello_medico_ingreso', $sello_medico_ingreso)->exists());
  
        return [
            'paciente_id' => $paciente->id, // Tomar el paciente ya existente
            'establecimiento_salud' => $paciente->establecimiento_salud,
            'primer_nombre' => $paciente->primer_nombre, // Tomar el dato del paciente seleccionado
            'segundo_nombre' => $paciente->segundo_nombre, // Tomar el dato del paciente seleccionado
            'primer_apellido' => $paciente->primer_apellido, // Tomar el dato del paciente seleccionado
            'segundo_apellido' => $paciente->segundo_apellido, // Tomar el dato del paciente seleccionado
            'no_expediente' => $paciente->no_expediente, // Tomar el dato del paciente seleccionado
            'nacionalidad' => $this->faker->country,
            'no_cedula' => $paciente->no_cedula, // Tomar el dato del paciente seleccionado
            'estado_civil' => $paciente->estado_civil,
            'escolaridad' => $paciente->escolaridad,
            'categoria_paciente' => $this->faker->randomElement(['Adulto', 'Niño', 'Anciano']),
            'no_inss' => $paciente->no_inss, // Tomar el dato del paciente seleccionado
            'sexo' => $paciente->sexo, // Tomar el dato del paciente seleccionado
            'direccion_residencia' => $paciente->direccion_residencia,
            'municipio' => $paciente->municipio,
            'localidad' => $paciente->localidad,
            'departamento'=> $paciente->departamento,
            'raza_etnia' => $paciente->raza_etnia,
            'edad' => $paciente->edad, // Tomar el dato del paciente seleccionado
            'ocupacion' => $paciente->ocupacion,
            'nombre_madre' => $this->faker->firstNameFemale . ' ' . $this->faker->lastName,
            'nombre_padre' => $this->faker->firstNameMale . ' ' . $this->faker->lastName,
            'urgencia_avisar' => $paciente->responsable_emergencia,
            'direccion_telefono_avisar' => $paciente->telefono_responsable,
            'ingreso' => $this->faker->dateTimeThisYear,
            'empleador' => $paciente->empleador,
            'direccion_empleador' => $paciente->direccion_empleador,
            'municipio_distrito' => $this->faker->city,
            'parentesco' => $this->faker->randomElement(['Padre', 'Madre', 'Hermano', 'Hermana']),
            'diagnostico_ingreso' => $this->faker->randomElement([
            'Neumonía leve', 
            'Fractura de fémur', 
            'Infección del tracto urinario', 
            'Crisis hipertensiva', 
            'Insuficiencia renal cronica',
            'Gastroenteritis aguda', 
            'Artritis reumatoide en fase aguda'
        ]),
            'forma_llegada_hospital' => $this->faker->randomElement(['Ambulancia', 'Por cuenta propia']),
            'reingreso_mismo_diagnostico' => $this->faker->boolean,
            'sitio_ingreso_hospitalario' => $this->faker->randomElement(['Urgencias', 'Consulta externa']),
            'nombre_medico' => $this->faker->name,
            'sello_medico_ingreso' => $sello_medico_ingreso,
            'egreso_fecha' => $this->faker->dateTimeThisYear,
            'egreso_hora' => $this->faker->time,
          
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
