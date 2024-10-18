<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Traits\LogsActivity;
class RolesComponent extends Component
{
    use WithPagination;

    public $search = ''; // Variable para la búsqueda
    public $perPage = 3; // Control de cuántos resultados mostrar por página
    public $selectedPermission = ''; // Filtro por permiso

    protected $paginationTheme = 'bootstrap'; // Usar el estilo de Bootstrap para la paginación

    public function updatingSearch()
    {
        $this->resetPage(); // Resetea la paginación al cambiar la búsqueda
    }

    public function updatingPerPage()
    {
        $this->resetPage(); // Resetea la paginación al cambiar la cantidad por página
    }

    public function updatingSelectedPermission()
    {
        $this->resetPage(); // Resetea la paginación al cambiar el filtro de permisos
    }

    public function render()
    {
        // Consultar roles con permisos, búsqueda y filtro por permisos
        $rolesQuery = Role::with('permissions')
            ->where('name', 'like', '%' . $this->search . '%');

        // Si hay un permiso seleccionado, filtrar roles que tengan ese permiso
        if ($this->selectedPermission) {
            $rolesQuery->whereHas('permissions', function ($query) {
                $query->where('id', $this->selectedPermission);
            });
        }

        // Paginación con el número de resultados seleccionados por el usuario
        $roles = $rolesQuery->paginate($this->perPage);

        // Obtener todos los permisos para el filtro
        $permissions = Permission::all();

        return view('livewire.roles-component', compact('roles', 'permissions'));
    }
}
