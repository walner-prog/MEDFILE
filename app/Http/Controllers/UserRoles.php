<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserRoles extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios y roles
        $usuarios = User::all();
        $roles = Role::all();

        // Pasar los datos a la vista
        return view('usuarios_roles.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('usuarios_roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('usuarios_roles.index');
    }

    public function show(User $usuario)
    {
        // Mostrar la vista de detalle de usuario
        return view('usuarios_roles.show', compact('usuario'));
    }

    public function edit($id)
    {
        // Obtener el usuario por ID
        $usuario = User::findOrFail($id);
        
        $role = Role::with('permissions')->find($id); // Carga ansiosa de permisos
        $permissions = Permission::get();
        $rolePermissions = $role->permissions->pluck('id', 'id')->all();
        return view('usuarios_roles.edit', compact('usuario', 'role','permissions','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        // Obtener el usuario por ID
        $usuario = User::findOrFail($id);

        // Actualizar datos del usuario
        $usuario->update($request->all());

        // Validar y asignar roles según la entrada del formulario
        $request->validate([
            //'roles' => 'required|array',
            // Puedes agregar otras validaciones si es necesario
        ]);

        // Sincronizar roles del usuario
        $usuario->syncRoles($request->input('roles'));

        // Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios_roles.index', $usuario)->with('success', 'Roles asignados correctamente.');
    }

    public function destroy(User $usuario)
    {
        // Eliminar usuario
        $usuario->delete();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios_roles.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
