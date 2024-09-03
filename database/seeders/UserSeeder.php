<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['id' => 31, 'name' => 'Carlos González', 'email' => 'carlos.gonzalez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87543210'],
            ['id' => 2, 'name' => 'María Lopez', 'email' => 'maria.lopez@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '86543210'],
            ['id' => 3, 'name' => 'Juan Martinez', 'email' => 'juan.martinez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '89543210'],
            ['id' => 4, 'name' => 'Ana Hernández', 'email' => 'ana.hernandez@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '83543210'],
            ['id' => 5, 'name' => 'Pedro Morales', 'email' => 'pedro.morales@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '84543210'],
            ['id' => 6, 'name' => 'Sofía Vargas', 'email' => 'sofia.vargas@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '87561234'],
            ['id' => 7, 'name' => 'Luis Rivas', 'email' => 'luis.rivas@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '89561234'],
            ['id' => 8, 'name' => 'Gloria Rivera', 'email' => 'gloria.rivera@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '86561234'],
            ['id' => 9, 'name' => 'José Rodríguez', 'email' => 'jose.rodriguez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87567890'],
            ['id' => 10, 'name' => 'Elena Santos', 'email' => 'elena.santos@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '89567890'],
            ['id' => 11, 'name' => 'Daniel Torres', 'email' => 'daniel.torres@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 12, 'name' => 'Adriana Ramírez', 'email' => 'adriana.ramirez@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '89568901'],
            ['id' => 13, 'name' => 'Francisco Pérez', 'email' => 'francisco.perez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '86568901'],
            ['id' => 14, 'name' => 'Gabriela Ortega', 'email' => 'gabriela.ortega@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 15, 'name' => 'Fernando Ruiz', 'email' => 'fernando.ruiz@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '83568901'],
            ['id' => 16, 'name' => 'Margarita Vargas', 'email' => 'margarita.vargas@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '87567890'],
            ['id' => 17, 'name' => 'Ricardo Jiménez', 'email' => 'ricardo.jimenez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '89567890'],
            ['id' => 18, 'name' => 'Liliana Molina', 'email' => 'liliana.molina@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 19, 'name' => 'Mauricio Castro', 'email' => 'mauricio.castro@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '89568901'],
            ['id' => 20, 'name' => 'Valeria Mejía', 'email' => 'valeria.mejia@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '83568901'],
            ['id' => 21, 'name' => 'Carlos Lara', 'email' => 'carlos.lara@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 22, 'name' => 'Alicia Ríos', 'email' => 'alicia.rios@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '89567890'],
            ['id' => 23, 'name' => 'David Cruz', 'email' => 'david.cruz@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '83567890'],
            ['id' => 24, 'name' => 'Sofía González', 'email' => 'sofia.gonzalez@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 25, 'name' => 'Javier Vargas', 'email' => 'javier.vargas@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '83568901'],
            ['id' => 26, 'name' => 'Elena Ortega', 'email' => 'elena.ortega@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '89567890'],
            ['id' => 27, 'name' => 'Luis Díaz', 'email' => 'luis.diaz@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 28, 'name' => 'Marta Torres', 'email' => 'marta.torres@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '83567890'],
            ['id' => 29, 'name' => 'Rosa Gómez', 'email' => 'rosa.gomez@example.com', 'Direccion' => 'León, Nicaragua', 'Contacto' => '87568901'],
            ['id' => 30, 'name' => 'Fernando Reyes', 'email' => 'fernando.reyes@example.com', 'Direccion' => 'Chinandega, Nicaragua', 'Contacto' => '83568901'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make(str_replace(' ', '', $user['name']) . '12345'),
                'Direccion' => $user['Direccion'],
                'Contacto' => $user['Contacto'],
            ]);
        }
    }
}
