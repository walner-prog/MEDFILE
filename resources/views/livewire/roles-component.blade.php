<div>

    <div class="row">
        
        <div class="col-lg-4 ">
              <!-- Campo de búsqueda -->
            <div class="mb-4">
                <label for="">Buscar rol por nombre</label>
             <input type="text" wire:model="search" placeholder="Buscar rol por nombre..." class="form-control ">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-4">
                <label for="perPage">Mostrar por página:</label>
                <select wire:model="perPage" class="form-control ">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-4">
                <label for="">Filtrar por Permiso</label>
                <select wire:model="selectedPermission" class="form-control ">
                    <option value="">Filtrar por Permiso</option>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
  
    
    <div class="row mb-3">
        <div class="col-lg-3">
            <p class="text-sm text-dark">Mostrando {{ $roles->count() }} roles de {{ $roles->total() }} resultados</p>

        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="min-w-full table-bordered  w-100 border border-gray-300 shadow-md rounded-lg p-2">
                    <thead class="from-green-500 to-green-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Rol</th>
                            <th class="px-4 py-3 text-left">Permisos</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200" style="width: 300px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <!-- Nombre del rol -->
                                <td class=" text-primary px-4 py-3">{{ $role->name }}</td>
        
                                <!-- Indicador de permisos del rol -->
                                <td class="px-4 py-3">
                                    {{ $role->permissions->count() }} permisos
                                    <ul>
                                        @foreach($role->permissions->take(3) as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                        @if($role->permissions->count() > 3)
                                            <li>y {{ $role->permissions->count() - 3 }} más...</li>
                                        @endif
                                    </ul>
                                </td>
        
                                <!-- Acciones (ver, editar, eliminar) -->
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-purple btn-sm font-bold py-2 px-4 rounded-full">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-green btn-sm font-bold py-2 px-4 rounded-full">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block; margin-left: 4px;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-orange btn-sm font-bold py-2 px-4 rounded-full">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <!-- Paginación -->
            <div class="mt-4">
                {{ $roles->links() }}
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-4">
            @php
            $unassignedPermissions = $permissions->filter(function ($permission) use ($roles) {
                return $roles->every(function ($role) use ($permission) {
                    return !$role->permissions->contains($permission->id);
                });
                });
            @endphp
        
            <div class="mb-4 card">
               <h5>Permisos no asignados a ningún rol</h5>
              <ul>
                  @forelse($unassignedPermissions as $permission)
                    <li>{{ $permission->name }}</li>
                  @empty
                    <li>Todos los permisos están asignados a roles.</li>
                  @endforelse
             </ul>
           </div>
        </div>
       <div class="col-lg-4">
            @php
           $rolesWithoutPermissions = $roles->filter(function ($role) {
           return $role->permissions->isEmpty();
          });
           @endphp

          <div class="mb-4 card">
             <h5>Roles sin permisos asignados</h5>
          <ul>
           @forelse($rolesWithoutPermissions as $role)
            <li>{{ $role->name }}</li>
           @empty
            <li>Todos los roles tienen permisos asignados.</li>
           @endforelse
         </ul>
         </div>
        </div>
        <div class="col-lg-4">
        
            @php
            $rolesWithMostPermissions = $roles->sortByDesc(function ($role) {
                return $role->permissions->count();
           })->take(5); // Mostrar los 5 roles con más permisos
         @endphp
           
           <div class="mb-4 card">
            <h5>Roles con mayor cantidad de permisos</h5>
            <ul>
              @foreach($rolesWithMostPermissions as $role)
                  <li>{{ $role->name }} - {{ $role->permissions->count() }} permisos</li>
              @endforeach
             </ul>
         </div>
           
    
        </div>
    <br>


</div>
