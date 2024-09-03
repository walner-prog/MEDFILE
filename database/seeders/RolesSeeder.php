<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // RolesSeeder.php
public function run()
{
    Role::create(['name' => 'administrador']);
    Role::create(['name' => 'tesorero']);
    Role::create(['name' => 'secretario']);

    $adminRole = Role::findByName('administrador');
     $adminRole->givePermissionTo(['crear registros', 'editar registros', 'actualizar registros', 'eliminar registros']);

}

}
