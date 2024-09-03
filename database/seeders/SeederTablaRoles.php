<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeederTablaRoles extends Seeder
{
    public function run()
    {
        // Verificar y crear roles si no existen
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);
        
        // Obtener todos los permisos
        $permissions = Permission::all();

        // Asignar todos los permisos al rol de admin si aún no los tiene
        foreach ($permissions as $permission) {
            if (!$roleAdmin->hasPermissionTo($permission)) {
                $roleAdmin->givePermissionTo($permission);
            }
        }

        // Asignar permisos específicos al rol de user (si es necesario)
        // Por ejemplo, solo ver y editar alertas
        $userPermissions = [
             //vista usuario
             'ver-usuario',
             'crear-usuario',
             'editar-usuario',
             'borrar-usuario',
        ];

        foreach ($userPermissions as $userPermission) {
            // Verificar si el permiso existe
            $permission = Permission::firstOrCreate(['name' => $userPermission]);

            // Asignar el permiso al rol de user si aún no lo tiene
            if (!$roleUser->hasPermissionTo($permission)) {
                $roleUser->givePermissionTo($permission);
            }
        }
    }
}
