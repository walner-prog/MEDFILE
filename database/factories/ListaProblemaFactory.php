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
        // Selecciona un paciente existente de la tabla 'pacientes'
        $paciente = Paciente::inRandomOrder()->first();
        $faker = FakerFactory::create('es_ES'); // Crear faker con localización en español

        return [
            'paciente_id' => $paciente->id, // Tomar el paciente ya existente
            'primer_nombre' => $paciente->primer_nombre, 
            'segundo_nombre' => $paciente->segundo_nombre, 
            'primer_apellido' => $paciente->primer_apellido, 
            'segundo_apellido' => $paciente->segundo_apellido, 
            'edad' => $paciente->edad, 
            'no_expediente' => $paciente->no_expediente,
            
            // Generar un servicio aleatorio
            'servicio' => $faker->randomElement(['Provisional', 'Ambulatorio', 'Hospitalización']), 

            // Seleccionar una sala aleatoria: A, B o C
            'sala' => $faker->randomElement(['A', 'B', 'C']), 

            // Generar una fecha entre agosto 2023 y agosto 2024
            'fecha' => $faker->dateTimeBetween('2023-08-01', '2024-08-31'),

            // Generar un problema de salud realista
            'nombre_problema' => $faker->randomElement([
                'Insuficiencia respiratoria aguda',
                'Fractura de cadera',
                'Infarto agudo de miocardio',
                'Neumonía bacteriana',
                'Derrame pleural',
                'Apéndice perforada',
                'Gastroenteritis viral',
                'Hipertensión arterial no controlada',
                'Diabetes tipo 2 descompensada',
                'Asma bronquial exacerbada'
            ]),

            'inactivo' => $faker->boolean,
            'resuelto' => $faker->boolean,
            'establecimiento_salud' => $faker->company,
        ];
    }
}
