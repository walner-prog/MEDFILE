<?php
namespace Database\Factories;

use App\Models\Emergencia;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmergenciaFactory extends Factory
{
    protected $model = Emergencia::class;

    public function definition()
    {
        // Seleccionar un paciente al azar
        $paciente = Paciente::inRandomOrder()->first();

        return [
            'paciente_id' => $paciente->id, // Relación con la tabla pacientes 
            'fecha' => $this->faker->date,
            'hora' => $this->faker->time,
            'no_expediente' => $paciente->no_expediente, // Tomar el dato del paciente seleccionado
            'unidad_salud' => $this->faker->company,
            'primer_nombre' => $paciente->primer_nombre, // Tomar el dato del paciente seleccionado
            'segundo_nombre' => $paciente->segundo_nombre, // Tomar el dato del paciente seleccionado
            'primer_apellido' => $paciente->primer_apellido, // Tomar el dato del paciente seleccionado
            'segundo_apellido' => $paciente->segundo_apellido, // Tomar el dato del paciente seleccionado
            'edad' => $paciente->edad, // Tomar el dato del paciente seleccionado
            'sexo' => $paciente->sexo, // Tomar el dato del paciente seleccionado
            'sala_servicio' => $this->faker->word,
            'cama' => $this->faker->word,
            'ocupacion' => $this->faker->word,
            'direccion_residencia' => $this->faker->address,
            'localidad' => $this->faker->word,
            'departamento' => $this->faker->word,
            'telefono' => $this->faker->phoneNumber,
            'no_inss' => $paciente->no_inss, // Tomar el dato del paciente seleccionado
            'no_cedula' => $paciente->no_cedula, // Tomar el dato del paciente seleccionado
            'medio_llegada' => $this->faker->word,
            'causa_accidente_violencia' => $this->faker->word,
            'causa_tratamiento' => $this->faker->word,
            'lugar_accidente_violencia' => $this->faker->word,
            'vif' => $this->faker->word,
            'direccion_avisar' => $this->faker->address,
            'parentesco' => $this->faker->word,
            'telefono_responsable' => $this->faker->phoneNumber,
            'localidad_avisar' => $this->faker->word,
            'ciudad_avisar' => $this->faker->word,
            'departamento_avisar' => $this->faker->word,
            'peso' => $this->faker->randomFloat(2, 0, 150),
            'talla' => $this->faker->randomFloat(2, 0, 2.5),
            'temperatura' => $this->faker->randomFloat(1, 35, 40),
            'nombre_quien_atiende' => $this->faker->name,
            'frecuencia_cardiaca' => $this->faker->numberBetween(60, 100),
            'frecuencia_respiratoria' => $this->faker->numberBetween(12, 20),
            'examen_fisico' => $this->faker->text,
            'diagnostico' => $this->faker->text,
            'planes' => $this->faker->text,
            'diagnostico_egreso' => $this->faker->word,
            'tipo_urgencia' => $this->faker->word,
            'destino_paciente' => $this->faker->word,
            'referencia' => $this->faker->word,
            'hospitalizacion' => $this->faker->word,
            'consulta_externa' => $this->faker->word,
            'fuga' => $this->faker->word,
            'salida_exigida' => $this->faker->word,
        ];
    }
}
