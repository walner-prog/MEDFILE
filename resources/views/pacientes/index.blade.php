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
    
  @section('title', 'medfile-reegistro-de-pacientes')
  
  
  
  

  @section('content')
  <div class="container mt-2">
     
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
        <div class="col-lg-2">
            @can('crear-paciente', App\Models\Paciente::class)
            <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createPacienteForm">
                <i class="fas fa-plus"></i> Crear Paciente
            </button>
            @endcan
        </div>
        <div class="col-lg-2 ">

        </div>
        <div class="col-lg-2">
            
        </div>
        <div class="col-lg-2">
          
        </div>
        <div class="col-lg-2 text-right">
            
             
              
        </div>

    </div>
    
      
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      @if (session('info'))
          <div class="alert alert-success">
              {{ session('info') }}
          </div>
      @endif
     
      @if (session('delete'))
          <div class="alert alert-warning">
              {{ session('delete') }}
          </div>
      @endif
    
     
      @can('ver-paciente')
      <!-- Código o vista para ver un paciente -->
      
      @livewire('pacientes')
     @endcan
  
    
  
 



      
     <div class="modal fade" id="createPacienteForm" tabindex="-1" role="dialog" aria-labelledby="createPacienteModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                      <h4 class=4 text-white" id="createPacienteModalLabel">
                        Registro de Nuevo Paciente: Ingrese los Datos Personales y Médicos
                      </h4>
                      
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pacientes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="no_expediente">No. Expediente</label>
                                    <input type="text" class="form-control edit_imput" autocomplete="off" name="no_expediente" value="{{ old('no_expediente') }}" required>
                                    @if ($errors->has('no_expediente'))
                                        <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" autocomplete="off" class="form-control" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control edit_imput" name="fecha" value="{{ old('fecha') }}" required>
                                    @if ($errors->has('fecha'))
                                        <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="establecimiento_salud ">Centro </label>
                                    <input type="text" class="form-control edit_imput" name="establecimiento_salud" value="{{ old('establecimiento_salud') }}" required>
                                    @if ($errors->has('establecimiento_salud'))
                                        <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="primer_nombre">Primer Nombre</label>
                                    <input type="text" class="form-control edit_imput" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
                                    @if ($errors->has('primer_nombre'))
                                        <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="segundo_nombre">Segundo Nombre</label>
                                    <input type="text" class="form-control edit_imput" name="segundo_nombre" value="{{ old('segundo_nombre') }}" required>
                                    @if ($errors->has('segundo_nombre'))
                                        <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="primer_apellido">Primer Apellido</label>
                                    <input type="text" class="form-control edit_imput" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
                                    @if ($errors->has('primer_apellido'))
                                        <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input type="text" class="form-control edit_imput" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                                    @if ($errors->has('segundo_apellido'))
                                        <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control edit_imput" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                                    @if ($errors->has('fecha_nacimiento'))
                                        <div class="text-danger">{{ $errors->first('fecha_nacimiento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" class="form-control edit_imput" name="edad" value="{{ old('edad') }}" required>
                                    @if ($errors->has('edad'))
                                        <div class="text-danger">{{ $errors->first('edad') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control edit_imput" name="sexo" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                    @if ($errors->has('sexo'))
                                        <div class="text-danger">{{ $errors->first('sexo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="raza_etnia">Raza/Etnia</label>
                                    <select class="form-control edit_imput" name="raza_etnia" required>
                                        <option value="">Seleccione una raza/etnia</option>
                                        <option value="Mestizos">Mestizos</option>
                                        <option value="Miskitu (Miskitos)">Miskitu (Miskitos)</option>
                                        <option value="Matagalpa">Matagalpa</option>
                                        <option value="Creole / Afro descendiente">Creole / Afro descendiente</option>
                                        <option value="Subtiava">Subtiava</option>
                                        <option value="Nahua">Nahua</option>
                                        <option value="Chorotega">Chorotega</option>
                                        <option value="Mayangna">Mayangna</option>
                                        <option value="Nicarao">Nicarao</option>
                                        <option value="Garifuna">Garifuna</option>
                                        <option value="Rama">Rama</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    @if ($errors->has('raza_etnia'))
                                        <div class="text-danger">{{ $errors->first('raza_etnia') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="no_cedula">No. Cédula</label>
                                    <input type="text" class="form-control edit_imput" name="no_cedula" value="{{ old('no_cedula') }}" required>
                                    @if ($errors->has('no_cedula'))
                                        <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="categoria">Categoría</label>
                                    <select class="form-control  edit_imput" name="categoria" id="categoria" required>
                                        <option value="">Seleccione una categoría</option>
                                        <option value="Asegurados Activos CMP-MINSA">Asegurados Activos CMP-MINSA</option>
                                        <option value="Jubilados">Jubilados</option>
                                        <option value="Asegurado Activo IPSS">Asegurado Activo IPSS</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    @if ($errors->has('categoria'))
                                        <div class="text-danger">{{ $errors->first('categoria') }}</div>
                                    @endif
                                </div>
                            </div>
    
                           
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="no_inss">No. INSS</label>
                                    <input type="text" class="form-control edit_imput" name="no_inss" value="{{ old('no_inss') }}" required>
                                    @if ($errors->has('no_inss'))
                                        <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="estado_civil">Estado Civil</label>
                                    <select class="form-control edit_imput" name="estado_civil" required>
                                        <option value="">Seleccione un estado civil</option>
                                        <option value="Soltero">Soltero (a)</option>
                                        <option value="Casado">Casado (a)</option>
                                        <option value="Divorciado">Divorciado (a)</option>
                                        <option value="Viudo">Viudo (a)</option>
                                        <option value="Unión Libre">Unión Libre</option>
                                        <option value="Separado">Separado (a)</option>
                                    </select>
                                    @if ($errors->has('estado_civil'))
                                        <div class="text-danger">{{ $errors->first('estado_civil') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="escolaridad">Escolaridad</label>
                                    <input type="text" class="form-control edit_imput" name="escolaridad" value="{{ old('escolaridad') }}" required>
                                    @if ($errors->has('escolaridad'))
                                        <div class="text-danger">{{ $errors->first('escolaridad') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ocupacion">Ocupación</label>
                                    <input type="text" class="form-control edit_imput" name="ocupacion" value="{{ old('ocupacion') }}" required>
                                    @if ($errors->has('ocupacion'))
                                        <div class="text-danger">{{ $errors->first('ocupacion') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="direccion_residencia">Dirección Residencia</label>
                                    <input type="text" class="form-control edit_imput" name="direccion_residencia" value="{{ old('direccion_residencia') }}" required>
                                    @if ($errors->has('direccion_residencia'))
                                        <div class="text-danger">{{ $errors->first('direccion_residencia') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="localidad">Localidad</label>
                                        <input type="text" class="form-control edit_imput" name="localidad" value="{{ old('localidad') }}" required>
                                        @if ($errors->has('localidad'))
                                            <div class="text-danger">{{ $errors->first('localidad') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control edit_imput" name="telefono" value="{{ old('telefono') }}">
                                        @if ($errors->has('telefono'))
                                            <div class="text-danger">{{ $errors->first('telefono') }}</div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="email" class="form-control edit_imput" name="correo" value="{{ old('correo') }}">
                                        @if ($errors->has('correo'))
                                            <div class="text-danger">{{ $errors->first('correo') }}</div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control edit_imput" name="direccion" value="{{ old('direccion') }}">
                                        @if ($errors->has('direccion'))
                                            <div class="text-danger">{{ $errors->first('direccion') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="municipio">Municipio</label>
                                        <input type="text" class="form-control edit_imput" name="municipio" value="{{ old('municipio') }}" required>
                                        @if ($errors->has('municipio'))
                                            <div class="text-danger">{{ $errors->first('municipio') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_responsable">Nombre del Responsable</label>
                                    <input type="text" class="form-control edit_imput" name="nombre_responsable" value="{{ old('nombre_responsable') }}">
                                    @if ($errors->has('nombre_responsable'))
                                        <div class="text-danger">{{ $errors->first('nombre_responsable') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control edit_imput" name="departamento" value="{{ old('departamento') }}" required>
                                    @if ($errors->has('departamento'))
                                        <div class="text-danger">{{ $errors->first('departamento') }}</div>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="parentesco">Parentesco</label>
                                    <input type="text" class="form-control edit_imput" name="parentesco" value="{{ old('parentesco') }}" required>
                                    @if ($errors->has('parentesco'))
                                        <div class="text-danger">{{ $errors->first('parentesco') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="telefono_responsable">Teléfono Responsable</label>
                                    <input type="text" class="form-control edit_imput" name="telefono_responsable" value="{{ old('telefono_responsable') }}" required>
                                    @if ($errors->has('telefono_responsable'))
                                        <div class="text-danger">{{ $errors->first('telefono_responsable') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="direccion_responsable">Dirección Responsable</label>
                                    <input type="text" class="form-control edit_imput" name="direccion_responsable" value="{{ old('direccion_responsable') }}" required>
                                    @if ($errors->has('direccion_responsable'))
                                        <div class="text-danger">{{ $errors->first('direccion_responsable') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="empleador">Empleador</label>
                                    <input type="text" class="form-control edit_imput" name="empleador" value="{{ old('empleador') }}" required>
                                    @if ($errors->has('empleador'))
                                        <div class="text-danger">{{ $errors->first('empleador') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="direccion_empleador">Dirección Empleador</label>
                                    <input type="text" class="form-control edit_imput" name="direccion_empleador" value="{{ old('direccion_empleador') }}" required>
                                    @if ($errors->has('direccion_empleador'))
                                        <div class="text-danger">{{ $errors->first('direccion_empleador') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="foto">Foto (Tamaño carnet)</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                    @if ($errors->has('foto'))
                                        <div class="text-danger">{{ $errors->first('foto') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Paciente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    



  </div>
  @endsection
  
  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  @livewireScripts

 
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

<script src="{{ asset('js/custom.js') }}"></script>

  <script>
$(document).ready(function() {
    $('#pacientesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/pacientes') }}",
        columns: [
            { data: 'id' },
            {
                data: 'foto',
                render: function(data, type, row) {
                    if (data) {
                        return `<img src="/images/${data}" alt="Foto del Paciente" class="mr-1" style="width: 50px; height: 50px; border-radius: 50%;">`;
                    } else {
                        return `<i class="fa-solid fa-hospital-user fa-2x font-weight-bold ml-1"></i>`;
                    }
                },
                orderable: false, searchable: false
            },
            {
                data: 'no_expediente',
                render: function(data, type, row) {
                    return `<span class="text-primary font-weight-bold">${data}</span> <span class="badge badge-info">EXP</span>`;
                },
            },
            { data: 'primer_nombre' },
            { data: 'segundo_nombre' },
            { data: 'primer_apellido' },
            { data: 'segundo_apellido' },
            {
                data: 'no_cedula',
                render: function(data, type, row) {
                    return `<span class="text-danger font-weight-bold">${data}</span>`;
                },
            },
            {
                data: 'edad',
                render: function(data, type, row) {
                    return `<span class="text-success font-weight-bold">${data}</span>`;
                },
            },
            {
                data: 'btn',
                orderable: false, searchable: false,
                
            }
        ],
        language: {
            search: "Buscar ",
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            info: "Mostrando página _PAGE_ de _PAGES_",
            paginate: {
                previous: "Anterior ",
                next: "Siguiente",
                first: "Primero",
                last: "Último",
            },
            processing: "Procesando...",
        },
        lengthMenu: [[5, 20, 50, -1], [5, 20, 50, "Todos"]],
        fixedHeader: true,
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i>',
                titleAttr: 'Copiar',
                className: 'bg-secondary',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'bg-success',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'bg-danger',
                exportOptions: {
                    columns: ':not(:last-child)'
                },
                customize: function(doc) {
                    doc.content.splice(0, 1, {
                        text: [
                            { text: 'Tabla de Pacientes\n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                            { text: 'Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '\n', fontSize: 12, italics: true },
                            { text: 'Usuario: ' + '{{ Auth::user()->name }}' + '\n\n', fontSize: 12, italics: true }
                        ]
                    });
                    doc['footer'] = function(page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Fecha: ', { text: new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    };
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                className: 'bg-info',
                exportOptions: {
                    columns: ':not(:last-child)'
                },
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<h3>Tabla de Pacientes</h3>' +
                            '<p>Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '</p>' +
                            '<p>Usuario: ' + '{{ Auth::user()->name }}' + '</p>'
                        );

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-eye"></i>',
                titleAttr: 'Ocultar columna',
                className: 'bg-dark'
            },
        ],
    });

    if (typeof $ !== 'undefined') {
        // Tu código AJAX
        $('#pacientesTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var url = "{{ url('pacientes') }}/" + id;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#pacientesTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Eliminado!',
                                'El paciente ha sido eliminado.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Ocurrió un error: ' + error,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    } else {
        console.error('jQuery no está disponible.');
    }
});

  </script>
  <script>
    // Maneja el clic en el ícono de tres puntos
$(document).on('click', '.toggle-buttons', function() {
    var id = $(this).data('id');
    var buttonsDiv = $('#actionButtons-' + id);
    
    // Alterna entre mostrar y ocultar los botones
    buttonsDiv.toggleClass('d-none');
});

  </script>
  <style>
    .d-none {
    display: none;
     }

  </style>
  @stop





    
</body>
</html>
  