 
<!DOCTYPE html>
<html lang="en">
    <head>
       
        @section('css')
        <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
          <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
        
       
          <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
         
          @livewireStyles
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
      
      @stop
          <!-- Otros elementos del encabezado... -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
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
   
<body>
 
    
    
        @extends('adminlte::page')
        
        @section('title', 'AdminSalud')
        
        
        
        @section('content')
        <div class="container  mt-2">
            <br>
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                            <li class="breadcrumb-item">Hogar</li>
                            <li class="breadcrumb-item active" aria-current="page">Gestión de Departamentos</li>
                        </ol>
                    </nav>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-2 ">
                    <a class="text-white" href="{{ route('departamentos.index') }}">
                        <button class="btn btn-info ">
                            <i class="fas fa-house-medical-circle-check"></i> Regresar
                        </button>
                    </a>
                   
                </div>
                <div class="col-lg-10 text-right">
                 
                </div>
             </div>
        
          
             
        
                <br>
                     <div class="card">
                        <div class="card-header bg-info">
                            Editar Departamento 
                          </div>
                          <card class="body">
                            <form action="{{ route('departamentos.update', $departamento->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $departamento->nombre) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $departamento->descripcion) }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Guardar cambios</button>
                                </div>
                            </form>
                            
                          </card>
                     </div>
                   
              
        
                <br>
        
        
        
          </div>
      
        
        
        @stop
        
        
        
        @section('js')
           
          
          <!-- JS de DataTables -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        
         
        
        <script>
        // Check for saved user theme preference
        const currentTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
        if (currentTheme) {
            document.body.classList.add(currentTheme + '-mode');
            document.getElementById('theme-toggle').checked = currentTheme === 'dark';
        }
        
        const toggleSwitch = document.getElementById('theme-toggle');
        
        function switchTheme(e) {
            if (e.target.checked) {
                document.body.classList.add('dark-mode');
                document.body.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                document.body.classList.add('light-mode');
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
            }
        }
        
        toggleSwitch.addEventListener('change', switchTheme);
        
        
        
        
        
        
        </script>
        @stop
    
</body>
</html>
