<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::with('permissions')->paginate(5); // Carga ansiosa de permisos
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.crear', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
       
        return redirect()->route('roles.index')
                         ->with('info', 'Roll creado con éxito.');
    }

    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $totalPermissions = $role->permissions->count();
        $totalPermissions = Permission::count(); // Contar todos los permisos disponibles
        $assignedPermissionsCount = $role->permissions->count(); // Contar permisos asignados al rol
        return view('roles.show', compact('role','totalPermissions','assignedPermissionsCount'));
    }
    
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id); // Carga ansiosa de permisos
        $permissions = Permission::get();
        $rolePermissions = $role->permissions->pluck('id', 'id')->all();

        return view('roles.editar', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array', // Cambiado de 'permission' a 'permissions'
        ]);
       
        $role = Role::find($id);
        $role->name = $request->input('name');
        
        // Sincroniza los permisos con el rol
        $role->syncPermissions($request->input('permissions')); // Cambiado de 'permission' a 'permissions'
        
        $role->save();
        
        return redirect()->route('roles.index')
                         ->with('update', 'Rol editado con éxito.');
    }
    

    public function destroy($id)
    {
        Role::find($id)->delete();
        
        return redirect()->route('roles.index')
                         ->with('delete', 'Roll Eliminado con éxito.');
    }
}
