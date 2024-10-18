<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Asegúrate de que el namespace sea correcto
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'enfermera']);

        // Asignar permisos al rol de administrador
        $adminRole = Role::findByName('administrador');
      

        // Crear un usuario
        $user = User::create([
            'name' => 'Admin', // Puedes cambiar el nombre según tu preferencia
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'), // Encriptar la contraseña
        ]);

        // Asignar el rol de administrador al usuario
        $user->assignRole('administrador');
        
        // Asignar todos los permisos al usuario
        $permissions = Permission::all();
        $user->syncPermissions($permissions);
    }
}
