<?php
namespace Database\Factories;

use App\Models\NotaEvolucionTratamiento;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotaEvolucionTratamientoFactory extends Factory
{
    protected $model = NotaEvolucionTratamiento::class;

    public function definition()
    {
        // Selecciona un paciente existente de la tabla 'pacientes'
        $paciente = Paciente::inRandomOrder()->first();

        return [
            'paciente_id' => $paciente->id,
            'establecimiento_salud' => $this->faker->company,
            'primer_nombre' => $paciente->primer_nombre, // Obtener el primer nombre del paciente
            'segundo_nombre' => $paciente->segundo_nombre, // Obtener el segundo nombre del paciente
            'primer_apellido' => $paciente->primer_apellido, // Obtener el primer apellido del paciente
            'segundo_apellido' => $paciente->segundo_apellido, // Obtener el segundo apellido del paciente
            'no_expediente' => $paciente->no_expediente, // Obtener el número de expediente del paciente
            'no_cedula' => $paciente->no_cedula, // Obtener la cédula del paciente
            'servicio' => $this->faker->randomElement(['Medicina General', 'Cirugía', 'Pediatría']),
            'no_cama' => $this->faker->numberBetween(1, 100),
            'sala' => $this->faker->randomElement(['A', 'B', 'C']),
            'no_inss' => $paciente->no_inss, // Obtener el número de INSS del paciente
            'fecha_hora' => $this->faker->dateTimeBetween('2023-08-01', '2024-08-31'),

            // Problemas de evolución realistas relacionados con la salud del paciente
            'problemas_evolucion' => $this->faker->randomElement([
                'El paciente presenta mejoría significativa en la respuesta respiratoria tras el tratamiento con broncodilatadores.',
                'Persisten episodios de dolor torácico, se recomienda evaluación cardiológica urgente.',
                'Disminución de la fiebre y estabilización de los niveles de glucosa tras ajuste en la medicación.',
                'El edema en las extremidades inferiores ha disminuido notablemente con la administración de diuréticos.',
                'Mejoría en la movilidad articular tras sesiones de fisioterapia, pero persiste leve inflamación en la rodilla.',
                'Se observa una respuesta positiva al tratamiento antibiótico, sin signos de infección residual.',
                'El paciente ha estabilizado la presión arterial con el tratamiento antihipertensivo actual.',
                'Continúa con molestias gástricas, pero sin vómitos ni diarrea tras el cambio de dieta.'
            ]),

            // Planes de tratamiento que incluyen medicación y recomendaciones
            'planes' => $this->faker->randomElement([
                'Continuar con el tratamiento antibiótico por 7 días más y reevaluar signos de infección.',
                'Ajustar la dosis de insulina a 10 UI/día y controlar niveles de glucosa cada 6 horas.',
                'Iniciar terapia con corticoides para reducir la inflamación pulmonar durante 5 días.',
                'Administrar analgésicos cada 8 horas y programar sesión de fisioterapia para la rodilla.',
                'Revisar nuevamente en 48 horas para control de la fiebre y ajuste de dosis de antipiréticos.',
                'Iniciar tratamiento con beta-bloqueadores y recomendar monitoreo diario de la presión arterial.',
                'Implementar una dieta baja en sodio y grasas, y agendar consulta con nutricionista.',
                'Programar cirugía laparoscópica para extracción de apéndice, se recomienda reposo absoluto hasta entonces.'
            ]),

            'participantes_atencion' => $this->faker->name,
            'firma_codigo_profesional' => 'COD-' . $this->faker->unique()->numerify('#####'),
        ];
    }
}
