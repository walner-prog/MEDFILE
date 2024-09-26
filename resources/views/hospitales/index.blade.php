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

  </head>
<body>

     
  @extends('adminlte::page')
    
  @section('title', 'MEDFILE')
  


@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
                </ol>
            </nav>
        </div>
        
    </div>
      
     <div class="row">
      
      <div class="col-lg-4">
        @can('crear-hospital')
        <button class="btn btn-info mb-3" data-toggle="modal" data-target="#createHospitalModal"> Configuración del Hospital</button>
        @endcan
      </div>
        <div class="col-lg-8 text-right">
          
        </div>
      </div>
   

              

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bienvenido al Sistema de Gestión de Configuraciones Hospitalarias</h5>
                    <p class="card-text text-dark">
                        Gestiona la información crítica de tu hospital, incluyendo el nombre, RUC, número de camas, nivel de atención, y más. Mantén esta información centralizada y actualizada para asegurar un funcionamiento eficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    
    @can('ver-hospital')
    <!-- Código o vista para ver un hospital -->
    <div class="row">
        @foreach ($hospitales as $hospital)
        <div class="col-md-10 mb-4">
            <div class="card">
                <div class="card-body text-dark">
                    <h5 class="card-title"><strong>Nombre del Hospital:</strong> {{ $hospital->nombre_hospital }}</h5>
                    <br>
                    <p class="card-text text-dark"><strong>RUC:</strong> {{ $hospital->ruc }}</p>
                    <p class="card-text text-dark"><strong>Teléfono de Contacto:</strong> {{ $hospital->telefono_contacto }}</p>
                    <p class="card-text text-dark"><strong>Dirección:</strong> {{ $hospital->direccion }}</p>
                    <p class="card-text text-dark"><strong>Correo de Contacto:</strong> {{ $hospital->correo_contacto }}</p>
                    <p class="card-text text-dark"><strong>Tipo de Hospital:</strong> {{ $hospital->tipo_hospital }}</p>
                    <p class="card-text text-dark"><strong>Número de Camas:</strong> {{ $hospital->numero_camas }}</p>
                    <p class="card-text text-dark"><strong>Nivel de Atención:</strong> {{ $hospital->nivel_atencion }}</p>
                </div>
                     @can('editar-hospital')
                 <div class="row p-2">
                     <div class="col-2 p-2 ">
                       <button class="btn btn-info" data-toggle="modal" data-target="#editHospitalModal{{ $hospital->id }}">
                         Editar
                       </button>
                      </div>
                      @endcan
                      @can('borrar-hospital')
                     <div class="col-2 p-2 ">
                       <form action="{{ route('hospitales.destroy', $hospital->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                         <button type="submit" class="btn btn-danger " onclick="return confirm('¿Estás seguro de que deseas eliminar este hospital?');">
                           Eliminar
                         </button>
                       </form>
                    </div>
                    @endcan
                 </div>
              
            </div>
        </div>
        @endforeach

    </div>
    @endcan


          <!-- Modal para Crear Configuración Hospitalaria -->
        @can('crear-hospital')
       <div class="modal fade" id="createHospitalModal" tabindex="-1" role="dialog" aria-labelledby="createHospitalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="createHospitalModalLabel">Crear Configuración del Hospital</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hospitales.store') }}" method="POST">
                    @csrf
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

                     <div class="row">
                         <div class="form-group col-4">
                            <label for="nombre_hospital">Nombre del Hospital <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre_hospital" required>
                           </div>
                        <div class="form-group col-4">
                            <label for="ruc">RUC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ruc" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="telefono_contacto">Teléfono de Contacto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="telefono_contacto" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="direccion" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="correo_contacto">Correo de Contacto <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="correo_contacto" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="tipo_hospital">Tipo de Hospital <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tipo_hospital" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="numero_camas">Número de Camas <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="numero_camas" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="nivel_atencion">Nivel de Atención <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nivel_atencion" required>
                        </div>
                         </div>
                        
                        <p class="text-muted">
                            <small><span class="text-danger">*Atención*</span> Asegúrate de que los datos ingresados sean correctos, ya que esta configuración afectará el funcionamiento general del sistema hospitalario.</small>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Configuración</button>
                    </div>
                </form>
            </div>
        </div>
       </div>
       @endcan

       <!-- Modal para Editar Configuración Hospitalaria -->
         @can('editar-hospital')
      @foreach ($hospitales as $hospital)
  <div class="modal fade" id="editHospitalModal{{ $hospital->id }}" tabindex="-1" role="dialog" aria-labelledby="editHospitalModalLabel{{ $hospital->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
            <div class="modal-header btn-primary">
                <div class="row">
                    <div class="col-8">
                        <h5 class="modal-title text-white" id="editHospitalModalLabel{{ $hospital->id }}">Editar Configuración del Hospital: {{ $hospital->nombre_hospital }}</h5>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('hospitales.update', $hospital->id) }}">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->

                   <div class="row">
      <div class="form-group col-4">
        <label for="nombre_hospital">Nombre del Hospital <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('nombre_hospital') is-invalid @enderror" name="nombre_hospital" value="{{ old('nombre_hospital', $hospital->nombre_hospital) }}" required>
        @error('nombre_hospital')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="ruc">RUC <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('ruc') is-invalid @enderror" name="ruc" value="{{ old('ruc', $hospital->ruc) }}" required>
        @error('ruc')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="telefono_contacto">Teléfono de Contacto <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('telefono_contacto') is-invalid @enderror" name="telefono_contacto" value="{{ old('telefono_contacto', $hospital->telefono_contacto) }}" required>
        @error('telefono_contacto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="direccion">Dirección <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion', $hospital->direccion) }}" required>
        @error('direccion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="correo_contacto">Correo de Contacto <span class="text-danger">*</span></label>
        <input type="email" class="form-control @error('correo_contacto') is-invalid @enderror" name="correo_contacto" value="{{ old('correo_contacto', $hospital->correo_contacto) }}" required>
        @error('correo_contacto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="tipo_hospital">Tipo de Hospital <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('tipo_hospital') is-invalid @enderror" name="tipo_hospital" value="{{ old('tipo_hospital', $hospital->tipo_hospital) }}" required>
        @error('tipo_hospital')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="numero_camas">Número de Camas <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('numero_camas') is-invalid @enderror" name="numero_camas" value="{{ old('numero_camas', $hospital->numero_camas) }}" required>
        @error('numero_camas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-4">
        <label for="nivel_atencion">Nivel de Atención <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('nivel_atencion') is-invalid @enderror" name="nivel_atencion" value="{{ old('nivel_atencion', $hospital->nivel_atencion) }}" required>
        @error('nivel_atencion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


                    <p class="text-muted">
                        <small><span class="text-danger">*Atención*</span> Asegúrate de que los datos ingresados sean correctos, ya que esta configuración afectará el funcionamiento general del sistema hospitalario.</small>
                    </p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Configuración</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@endcan

</div>
@stop


  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

  
  <!-- JS de DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

 <!-- CDN de Buttons para DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>




  <script>

   

  </script>
  @stop

    
</body>
</html>


   