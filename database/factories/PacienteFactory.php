<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

class PacienteFactory extends Factory
{
    protected $model = \App\Models\Paciente::class;

    protected function generateUniqueCedula()
    {
        // Generar un número único para la cédula
        return $this->faker->unique()->numerify('234-######-####-R');
    }

    public function definition()
    {
        // Listas de valores fijos para los campos
        $categorias = ['Asegurado Activo', 'Jubilado', 'Otros'];
        $razas = [
            'Mestizos', 'Miskitu (Miskitos)', 'Matagalpa', 'Creole / Afro descendiente', 
            'Subtiava', 'Nahua', 'Chorotega', 'Mayangna', 'Nicarao', 'Rama', 'Otros'
        ];
        $estados_civiles = ['Casado', 'Soltero', 'Divorciado', 'Otro'];
        $departamentos = ['Managua', 'León', 'Chinandega'];
        $municipios = [
            'Managua' => ['Managua', 'Tipitapa', 'Ticuantepe', 'Mateare'],
            'León' => ['León', 'El Sauce', 'La Paz Centro'],
            'Chinandega' => ['Chinandega', 'El Viejo', 'Corinto', 'San Pedro del Norte', 'Chichigalpa', 'Posoltega'],
        ];
        $direcciones = [
            'Managua' => [
                'Managua' => ['Colonia Centroamérica', 'Barrio Monseñor Lezcano', 'Altamira'],
                'Tipitapa' => ['Tipitapa Centro', 'Ciudadela Nicaragua', 'Lomas de Esquipulas'],
                'Ticuantepe' => ['Las Colinas', 'San Rafael', 'El Progreso'],
                'Mateare' => ['Mateare Centro', 'Las Palmeras', 'El Recreo']
            ],
            'León' => [
                'León' => ['Sutiaba', 'El Coyolar', 'Fundeci'],
                'El Sauce' => ['El Sauce Centro', 'Barrio El Rosario', 'Barrio El Carmen'],
                'La Paz Centro' => ['La Paz Centro Centro', 'Barrio Santa Rosa', 'Barrio El Calvario']
            ],
            'Chinandega' => [
                'Chinandega' => ['Santa Ana', 'El Viejo', 'Barrio Guadalupe'],
                'El Viejo' => ['El Viejo Centro', 'La Bolsa', 'El Recreo'],
                'Corinto' => ['Corinto Centro', 'Puerto Morazán', 'Las Lomas'],
                'San Pedro del Norte' => ['San Pedro Centro', 'Las Maravillas', 'El Calvario'],
                'Chichigalpa' => ['Chichigalpa Centro', 'Las Brisas', 'La Ceiba'],
                'Posoltega' => ['Posoltega Centro', 'Barrio El Triunfo', 'Santa Maria']
            ]
        ];
        $empleadores = [
            'Constructora XYZ', 
            'Tecnologías Avanzadas S.A.', 
            'Instituto Educativo San Felipe', 
            'Compañía de Seguros La Protección', 
            'Consultora Financiera ABC', 
            'Agencia de Marketing Digital', 
            'Escuela Técnica de Diseño', 
            'Desarrollo de Software Innovador', 
            'Compañía Energética Verde', 
            'Universidad del Futuro'
        ];

        $escolaridad = [
            'Primaria Completa', 'Secundaria Incompleta', 'Secundaria Completa', 
            'Universidad Incompleta', 'Universidad Completa', 'Ninguno'
        ];

        // Listas separadas de nombres femeninos y masculinos
        $nombres_femeninos = [
            'Mercedes', 'María', 'Fernanda', 'Noemi', 'Marlene', 'Estefania', 
            'Johanna', 'Sofia', 'Martha', 'Patricia', 'Diana', 'Lucía', 'Sahira', 
            'Maribel', 'Katerine', 'Raquel', 'Alejandra', 'Georgina', 'Piedad', 
            'Karina', 'Monserrat', 'Susana', 'Lilli', 'Fanny', 'Margoth', 'Gladys', 
            'Angela', 'Fabiola', 'Vanessa', 'Luz', 'Mireya', 'Estefania', 'Lucia', 'Sofia'
        ];

        $nombres_masculinos = [
            'Byron', 'David', 'Gonzalo', 'Luis', 'Jaime', 'Eduardo', 'Carlos', 
            'Daniel', 'Xavier', 'Ruben', 'Danilo', 'Fernando', 'Oswaldo', 'Ernesto', 
            'Juan', 'Jose', 'Geovanny', 'Ramiro', 'Lenin', 'Eduardo', 'Hernán', 
            'Sebastián', 'Pedro', 'Javier', 'Ricardo', 'Israel', 'Diego', 'Jorge'
        ];
        
        $apellidos = [
            'López', 'González', 'Cevallos', 'Trujillo', 'Balcazar', 'Campoverde', 
            'Campos', 'Mendieta', 'Cárdenas', 'Molina', 'Villavicencio', 'Pesantez', 
            'Novillo', 'Jara', 'Perez', 'Cabrera', 'Morales', 'Harris', 'Iñiguez', 
            'Chuchuca', 'Serrano', 'Martinez', 'Cepeda', 'Montalvo', 'Aponte', 
            'Cobos', 'Veloz', 'Pazmiño', 'Arregui', 'García', 'Bravo', 'Ortega'
        ];

        // Elegir un departamento aleatorio
        $departamento = $this->faker->randomElement($departamentos);
        // Obtener municipios correspondientes al departamento seleccionado
        $municipioOptions = $municipios[$departamento];
        $municipio = $this->faker->randomElement($municipioOptions);
        // Obtener direcciones correspondientes al municipio seleccionado
        $direccionOptions = $direcciones[$departamento][$municipio];

        // Generar la fecha de nacimiento y calcular la edad
        $fechaNacimiento = $this->faker->dateTimeBetween('-80 years', '-18 years');
        $edad = Carbon::parse($fechaNacimiento)->age;

        // Determinar sexo
        $sexo = $this->faker->randomElement(['M', 'F']);

        // Seleccionar nombres en función del sexo
        if ($sexo == 'F') {
            $primerNombre = $this->faker->randomElement($nombres_femeninos);
            $segundoNombre = $this->faker->randomElement($nombres_femeninos);
        } else {
            $primerNombre = $this->faker->randomElement($nombres_masculinos);
            $segundoNombre = $this->faker->randomElement($nombres_masculinos);
        }

        // Generar apellidos aleatorios
        $primerApellido = $this->faker->randomElement($apellidos);
        $segundoApellido = $this->faker->randomElement($apellidos);
              $correos = "mi-correo";  // Crear correo basado en el primer nombre
         $correo = strtolower($correos) . '@gmail.com';
         $parentesco_options = [
            'Madre',
            'Padre',
            'Hermano',
          
        ];
        $profesiones = [
            'Estudiante',
            'Ingeniero',
            'Enfermero',
            'Docente',
            'Desarrollador',
        ];

        return [
            'no_expediente' => $this->faker->unique()->numerify('EXP-#######'),  // Único 
            'fecha' => $this->faker->dateTimeBetween('2022-01-01', '2024-05-31')->format('Y-m-d'), // Fecha entre 2022 y 2024
            'establecimiento_salud' => 'MEDFILE-IA', // Establecimiento de salud fijo
            'primer_nombre' => $primerNombre, // En español 
            'segundo_nombre' => $segundoNombre, // En español 
            'primer_apellido' => $primerApellido, // En español 
            'segundo_apellido' => $segundoApellido, // En español 
            'fecha_nacimiento' => $fechaNacimiento->format('Y-m-d'), 
            'edad' => $edad,
            'sexo' => $sexo,
            'telefono' => $this->faker->unique()->numerify('505-########'),
            'correo' => $correo,
            'direccion' =>$departamento,
            'raza_etnia' => $this->faker->randomElement($razas),
            'no_cedula' => $this->generateUniqueCedula(), // Generar cedula única
            'categoria' => $this->faker->randomElement($categorias),
            'no_inss' => $this->faker->unique()->numerify('##########'),
            'estado_civil' => $this->faker->randomElement($estados_civiles),
            'escolaridad' => $this->faker->randomElement($escolaridad),

           'ocupacion' => $edad < 65 ? $this->faker->randomElement($profesiones) : 'Ninguna',
            'direccion_residencia' => $this->faker->randomElement($direccionOptions),
            'localidad' =>  $this->faker->randomElement($direccionOptions),
            'municipio' => $municipio,
            'departamento' => $departamento,
            'responsable_emergencia' => $this->faker->name('es_ES'), // En español
             'parentesco' => $this->faker->randomElement($parentesco_options), 
            'telefono_responsable' => $this->faker->unique()->numerify('505-########'),
            'direccion_responsable' =>$departamento,
            'empleador' => $this->faker->randomElement($empleadores),
            'direccion_empleador' => $departamento,
            'password' => bcrypt('12345' . strtolower(str_replace(' ', '', $primerNombre))) // Genera y encripta la contraseña
        ];
    }
}
