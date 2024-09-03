<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

class PacienteFactory extends Factory
{
    protected $model = \App\Models\Paciente::class;

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
                'Posoltega' => ['Posoltega Centro', 'Barrio El Triunfo', 'San Francisco']
            ]
        ];
        $empleadores = [
            'Hospital San Juan de Dios', 'Clínica Santa María', 'Centro Médico La Paz', 
            'Hospital Nacional', 'Centro de Salud San Carlos'
        ];

        $escolaridad = [
            'Primaria Completa','Secundaria Incompleta','Secundaria Completa','Universidad Incompleta','Universidad Completa','Ninguno'
        ];

        $nombres = [
            'Mercedes', 'María', 'Byron', 'David', 'Gonzalo', 'Luis', 'Fernanda', 'Noemi', 'Jaime', 'Eduardo', 
            'Carlos', 'Daniel', 'Marlene', 'Estefania', 'Johanna', 'Sofia', 'Martha', 'Patricia', 'Diana', 'Lucía', 
            'Jaime', 'Vicente', 'Sahira', 'Maribel', 'Xavier', 'Eduardo', 'Alex', 'Ruben', 'Mireya', 'Katerine', 
            'Danilo', 'Fernando', 'Oswaldo', 'Ernesto', 'Juan', 'Jose', 'Geovanny', 'Ramiro', 'Marlene', 'Alexandra', 
            'Lenin', 'Eduardo', 'Hernán', 'Sebastián', 'Pedro', 'Raquel', 'Alejandra', 'Georgina', 'Piedad', 'Karina', 
            'Monserrat', 'Diego', 'Javier', 'Ricardo', 'Israel', 'Lilli', 'Lucia', 'Susana', 'del Rocio', 'José', 
            'Eliecer', 'Edgar', 'Guillermo', 'Gustavo', 'Patricio', 'Lourdes', 'del Rocío', 'Fanny', 'Margoth', 'Jorge', 
            'Alfonso', 'Alexandra', 'Elizabeth', 'Jorge', 'Xavier', 'Andrés', 'Alberto', 'Wilson', 'Fernando', 'Karol', 
            'Narcisa', 'Elizabeth', 'Vanessa', 'Luz', 'Mariuxi', 'Santander', 'Luis Enrique', 'Gladys', 'Monserrate', 
            'Maria', 'Jose', 'Diego', 'Alejandro', 'Angela', 'Lucciola', 'Martha', 'Fabiola', 'Carlos', 'Dionisio'
        ];
        
        $apellidos = [
            'López', 'González', 'Cevallos', 'Trujillo', 'Balcazar', 'Campoverde', 'Campos', 'Mendieta', 'Cárdenas', 'Molina',
            'Villavicencio', 'Pesantez', 'Novillo', 'Jara', 'Perez', 'Cabrera', 'Morales', 'Harris', 'Iñiguez', 'Iñiguez',
            'Chuchuca', 'Serrano', 'Martinez', 'Cepeda', 'Montalvo', 'Aponte', 'Cobos', 'Veloz', 'Pazmiño', 'Arregui',
            'García', 'García', 'Lopez', 'Bravo', 'Ortega', 'Vintimilla', 'Cabezas', 'Velasco', 'Narvaez', 'Calvachi',
            'Saguay', 'Sanaguano', 'Lopez', 'Montero', 'Guaraca', 'Cuñas', 'Arcos', 'Cabezas', 'Panchez', 'Hernandez',
            'Masache', 'Alvarado', 'Cajas', 'Logroño', 'Valencia', 'Cuviña', 'Romero', 'Pacheco', 'Andrade', 'Soto',
            'Chicaiza', 'Ronquillo', 'Guasca', 'Tulmo', 'Mena', 'Zapata', 'Lara', 'Valencia', 'Cañar', 'Caisalitín',
            'Llerena', 'Vargas', 'Carrion', 'Córdova', 'Paredes', 'Lucas', 'Suárez', 'Pineda', 'Montenegro', 'Espinoza',
            'Macias', 'Yanez', 'De', 'Ring', 'Salvador', 'Murillo', 'Calvache', 'Rosero', 'Luis Enrique', 'Ordóñez', 'Alemán',
            'Franco', 'Pico', 'Redroban', 'Becerra', 'Suarez', 'Velasquez', 'Rizzo', 'Gonzalez', 'Sornoza', 'Moran'
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

        // Generar el nombre y determinar el sexo
        $primerNombre = $this->faker->randomElement($nombres);
        $segundoNombre = $this->faker->randomElement($nombres);
        $primerApellido = $this->faker->randomElement($apellidos);
        $segundoApellido = $this->faker->randomElement($apellidos);
        $sexo = (strtolower(explode(' ', $primerNombre)[0]) == 'fernanda' || strtolower(explode(' ', $primerNombre)[0]) == 'mireya') ? 'F' : 'M';

        return [
            'no_expediente' => $this->faker->unique()->numerify('EXP-#######'),  // Único 
            'fecha' => $this->faker->date, 
            'establecimiento_salud' => $this->faker->company,
            'primer_nombre' => $primerNombre, // En español 
            'segundo_nombre' => $segundoNombre, // En español 
            'primer_apellido' => $primerApellido, // En español 
            'segundo_apellido' => $segundoApellido, // En español 
            'fecha_nacimiento' => $fechaNacimiento->format('Y-m-d'), 
            'edad' => $edad,
            'sexo' => $sexo,
            'raza_etnia' => $this->faker->randomElement($razas),
            'no_cedula' => $this->faker->unique()->numerify('###########'),
            'categoria' => $this->faker->randomElement($categorias),
            'no_inss' => $this->faker->unique()->numerify('##########'),
            'estado_civil' => $this->faker->randomElement($estados_civiles),
         'escolaridad' => $this->faker->randomElement($escolaridad),

            'ocupacion' => $this->faker->word,
            'direccion_residencia' => $this->faker->randomElement($direccionOptions),
            'localidad' => $this->faker->word,
            'municipio' => $municipio,
            'departamento' => $departamento,
            'responsable_emergencia' => $this->faker->name('es_ES'), // En español
            'parentesco' => $this->faker->word,
            'telefono_responsable' => $this->faker->phoneNumber,
            'direccion_responsable' => $this->faker->address,
            'empleador' => $this->faker->randomElement($empleadores),
            'direccion_empleador' => $this->faker->address,
         
        ];
    }
}
