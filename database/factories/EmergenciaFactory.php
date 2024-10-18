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
         $medio_llegada = ['Ambulancia','Caminando','otro medio'];
         // Crear un array vacío para almacenar las camas
         $camas = [];

         // Utilizamos un bucle para generar las 50 camas
         foreach (range(1, 50) as $numero) {
         $camas[] = "cama#$numero";
          }

          $causas_accidente_violencia = [
            'Accidente de tránsito',
            'Caída',
            'Agresión física',
            'Incendio',
            'Accidente laboral',
        ];
         
          
                       
$causas_tratamiento = [
    'Infección',
    'Fractura',
    'Quemaduras',
    'Deshidratación',
    'Dolor abdominal',
];

// Definir un array con 5 lugares para lugar_accidente_violencia
$lugares_accidente_violencia = [
    'Calle',
    'Casa',
    'Trabajo',
    'Escuela',
    'Parque',
];

// Definir un array con 5 opciones para vif (Violencia Intrafamiliar)
$vif_options = [
    'No',
    'No',
    'Desconocido',
    'En evaluación',
    
];
        

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
            'ocupacion' => $this->faker->word,
            'cama' => $this->faker->randomElement($camas),
            'direccion_residencia' => $paciente->municipio,
            'localidad' => $paciente->departamento,
            'departamento' =>$paciente->departamento,
            'telefono' => $paciente->telefono,
            'no_inss' => $paciente->no_inss, // Tomar el dato del paciente seleccionado
            'no_cedula' => $paciente->no_cedula, // Tomar el dato del paciente seleccionado
            
            'medio_llegada' => $this->faker->randomElement($medio_llegada),
            'causa_accidente_violencia' => $this->faker->randomElement($causas_accidente_violencia),
           'causa_tratamiento' => $this->faker->randomElement($causas_tratamiento),
           'lugar_accidente_violencia' => $this->faker->randomElement($lugares_accidente_violencia),
           'vif' => $this->faker->randomElement($vif_options),
          
            'direccion_avisar' => $paciente-> direccion_residencia,
            'parentesco' => $paciente-> parentesco,
            'telefono_responsable' => $paciente->telefono_responsable,
            'localidad_avisar' => $paciente->municipio,
            'ciudad_avisar' => $this->faker->word,
            'departamento_avisar' => $paciente->departamento,
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
