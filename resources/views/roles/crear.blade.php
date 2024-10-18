<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
     
      @livewireStyles
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <head>
        <script>
          (function() {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
              document.documentElement.classList.add('dark-mode');
              document.documentElement.classList.remove('light-mode');
            } else if (currentTheme === 'light') {
              document.documentElement.classList.add('light-mode');
              document.documentElement.classList.remove('dark-mode');
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              document.documentElement.classList.add('dark-mode');
            } else {
              document.documentElement.classList.add('light-mode');
            }
          })();
        </script>
        <!-- Resto de tu <head> -->
      </head>
</head>
<body>
    
    @extends('adminlte::page')
    
    @section('title', 'Crear rol')
    
   
    
 
    @section('content')
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 ">
                    <ol id="breadcrumb" class="breadcrumb mb-0 text-light ">
                        <li class="breadcrumb-item active">Hogar</li>
                        <li class="breadcrumb-item active " aria-current="page">Registro de Roles de usuarios</li>
                        <li class="text-dark breadcrumb-item ">Crear.</li>
                    </ol>
                </nav>
            </div>
    
            <div class="col-lg-4">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary font-bold py-2 px-4 rounded-full">
                    <i class="fas fa-arrow-left"></i> Volver a Roles
                </a>
            </div>
        </div>
        <div class="col-md-10 col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Crear Nuevo Rol</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('roles.store') }}">
                        @csrf
    
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre del rol</label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" value="{{ old('name') }}">
                            
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="" class="form-label">Permisos para este rol</label>
                            <div class="form-check">
                                <input type="checkbox" name="select_all" class="form-check-input" id="select_all">
                                <label class="form-check-label" for="select_all">
                                    Seleccionar todos
                                </label>
                            </div>
                            <div class="row">
                                @foreach($permission as $value)
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="form-check-input" id="permiso{{ $value->id }}">
                                            <label class="form-check-label" for="permiso{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
    
                            @error('permission')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Botón para asignar todos los permisos -->
                        
    
                        <button class="btn btn-info btn-block w-25" type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @stop
    
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    @stop
    
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.getElementById('select_all');
                const permissionCheckboxes = document.querySelectorAll('input[name="permission[]"]');
    
                selectAllCheckbox.addEventListener('change', function() {
                    permissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
    
                // Evento para el botón "Asignar Todos los Permisos"
                const assignAllPermissionsButton = document.getElementById('assignAllPermissions');
                assignAllPermissionsButton.addEventListener('click', function() {
                    permissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = true; // Marcar todos los checkboxes
                    });
                });
            });
        </script>
    @stop
    
</body>
</html>

