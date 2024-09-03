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
    
  @section('title', 'MEDFILE')
  
  
  
  

  @section('content')
  <div class="container mt-2">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de Emergecias</li>
                </ol>
            </nav>
        </div>
        
    </div>
    
     
      <div class="row">
        <div class="col-lg-2">
            @can('create', App\Models\Emergencia::class)
            <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createemergenciasForm">
                <i class="fas fa-plus"></i> Crear 
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
  
      <div class="table-responsive">
        <table id="emergenciasTable" class="min-w-full border border-gray-300 shadow-md rounded-lg p-2">
            <thead class="from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Nombre</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Segundo Nombre</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Apellido</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Segundo Apellido</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Cédula</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                </tr>
            </thead>
            <hr>
            <tbody class="divide-y divide-gray-200">
                {{-- Los datos se cargan acá dinámicamente por datatable server-side --}}
            </tbody>
        </table>
        
    </div>




     <div class="modal fade" id="createemergenciasForm" tabindex="-1" role="dialog" aria-labelledby="createemergenciaModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="modal-title text-white" id="createIngresoEgresoFormModalLabel">Crear Registro de Ingreso de Emergencia</h5>
                        </div>
      
                        <div id="datos-paciente" class="mb-3">
                            <h4>Datos del Paciente</h4>
                            <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                                <div class="mb-2">
                                    <strong class="color-primario">
                                        <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                                    </strong>
                                    <span id="info_no_expediente" class="text-danger"></span>
                                </div>
                                <div class="mb-2">
                                    <strong class="text-primary ml-2">
                                        <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                                    </strong>
                                    <span id="info_primer_nombre" class="text-secondary"></span>
                                    <span id="info_segundo_nombre" class="text-secondary"></span>
                                    <span id="info_primer_apellido" class="text-secondary"></span>
                                    <span id="info_segundo_apellido" class="text-secondary"></span>
                                    <strong class="text-primary ml-2">Edad:</strong>
                                    <span id="info_edad" class="text-secondary"></span>
                                    <strong class="text-primary ml-2">Sexo:</strong>
                                    <span id="info_sexo" class="text-secondary"></span>
                                    <strong class="text-primary ml-2">No. Cédula:</strong>
                                    <span id="info_no_cedula" class="text-secondary"></span>
                                    <strong class="text-primary ml-2">No. INSS:</strong>
                                    <span id="info_no_inss" class="text-secondary"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('emergencias.store') }}" method="POST">
                        @csrf
      
                        <div class="row">
                            <!-- Campo para buscar y seleccionar un paciente -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="buscar_paciente" class="bold">Buscar Paciente</label>
                                    <i class="fa-solid fa-magnifying-glass fa-1x mb-1"></i>
                                    <input type="text" class="form-control" id="buscar_paciente" placeholder="Buscar por nombre, cédula o expediente">
                                </div>
                                <div id="lista_pacientes" class="list-group"></div>
                            </div>
      
                            <div class="col-lg-6" hidden>
                                <div class="form-group">
                                    <label for="paciente_id">Paciente seleccionado  </label>
                                    <select class="form-control" id="paciente_id" name="paciente_id" required>
                                     
                                    </select>
                                    @if ($errors->has('paciente_id'))
                                        <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                    @endif
                                </div>
                            
                            </div> 
    
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="paciente_id_id">ID Paciente seleccionado<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="paciente_id_id" name="paciente_id" value="{{ old('paciente_id_id') }}" required readonly>
                                        @if ($errors->has('paciente_id_id'))
                                            <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Existing input fields -->
                            
                            <div class="col-lg-3" >
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control edit_imput" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                                    @if ($errors->has('fecha'))
                                        <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="no_expediente">No. Expediente</label>
                                    <input type="text" class="form-control edit_imput" id="no_expediente" name="no_expediente" value="{{ old('no_expediente') }}" required>
                                    @if ($errors->has('no_expediente'))
                                        <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input type="time" class="form-control edit_imput" id="hora" name="hora" value="{{ old('hora') }}" required>
                                    @if ($errors->has('hora'))
                                        <div class="text-danger">{{ $errors->first('hora') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="unidad_salud">Unidad de Salud</label>
                                    <input type="text" class="form-control edit_imput" id="unidad_salud" name="unidad_salud" value="{{ old('unidad_salud') }}" required>
                                    @if ($errors->has('unidad_salud'))
                                        <div class="text-danger">{{ $errors->first('unidad_salud') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="primer_nombre">Primer Nombre</label>
                                   <input type="text" class="form-control edit_imput" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
                                   @if ($errors->has('primer_nombre'))
                                       <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                   @endif
                               </div>
                           
                           </div>
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="segundo_nombre">Segundo Nombre</label>
                                       <input type="text" class="form-control edit_imput" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" required>
                                       @if ($errors->has('segundo_nombre'))
                                           <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                       @endif
                                   </div>
                           </div>
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="primer_apellido">Primer Apellido</label>
                                   <input type="text" class="form-control edit_imput" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}">
                                   @if ($errors->has('primer_apellido'))
                                       <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                   @endif
                               </div>
                           </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input type="text" class="form-control edit_imput" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                                    @if ($errors->has('segundo_apellido'))
                                        <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" class="form-control edit_imput" id="edad" name="edad" value="{{ old('edad') }}" required>
                                    @if ($errors->has('edad'))
                                        <div class="text-danger">{{ $errors->first('edad') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control edit_imput" id="sexo" name="sexo" required>
                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @if ($errors->has('sexo'))
                                        <div class="text-danger">{{ $errors->first('sexo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="sala_servicio">Sala/Servicio</label>
                                    <input type="text" class="form-control edit_imput" id="sala_servicio" name="sala_servicio" value="{{ old('sala_servicio') }}">
                                    @if ($errors->has('sala_servicio'))
                                        <div class="text-danger">{{ $errors->first('sala_servicio') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="cama">Cama</label>
                                    <input type="text" class="form-control edit_imput" id="cama" name="cama" value="{{ old('cama') }}">
                                    @if ($errors->has('cama'))
                                        <div class="text-danger">{{ $errors->first('cama') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ocupacion">Ocupación</label>
                                    <input type="text" class="form-control edit_imput" id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}">
                                    @if ($errors->has('ocupacion'))
                                        <div class="text-danger">{{ $errors->first('ocupacion') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="direccion_residencia">Dirección de Residencia</label>
                                    <input type="text" class="form-control edit_imput" id="direccion_residencia" name="direccion_residencia" value="{{ old('direccion_residencia') }}">
                                    @if ($errors->has('direccion_residencia'))
                                        <div class="text-danger">{{ $errors->first('direccion_residencia') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="localidad">Localidad</label>
                                    <input type="text" class="form-control edit_imput" id="localidad" name="localidad" value="{{ old('localidad') }}">
                                    @if ($errors->has('localidad'))
                                        <div class="text-danger">{{ $errors->first('localidad') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control edit_imput" id="departamento" name="departamento" value="{{ old('departamento') }}">
                                    @if ($errors->has('departamento'))
                                        <div class="text-danger">{{ $errors->first('departamento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control edit_imput" id="telefono" name="telefono" value="{{ old('telefono') }}">
                                    @if ($errors->has('telefono'))
                                        <div class="text-danger">{{ $errors->first('telefono') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- New input fields -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="no_inss">No. INSS</label>
                                    <input type="text" class="form-control edit_imput" id="no_inss" name="no_inss" value="{{ old('no_inss') }}">
                                    @if ($errors->has('no_inss'))
                                        <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="no_cedula">No. Cédula</label>
                                    <input type="text" class="form-control edit_imput" id="no_cedula" name="no_cedula" value="{{ old('no_cedula') }}">
                                    @if ($errors->has('no_cedula'))
                                        <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="medio_llegada">Medio de Llegada</label>
                                    <input type="text" class="form-control edit_imput" id="medio_llegada" name="medio_llegada" value="{{ old('medio_llegada') }}">
                                    @if ($errors->has('medio_llegada'))
                                        <div class="text-danger">{{ $errors->first('medio_llegada') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="causa_accidente_violencia">Causa de Accidente/Violencia</label>
                                    <input type="text" class="form-control edit_imput" id="causa_accidente_violencia" name="causa_accidente_violencia" value="{{ old('causa_accidente_violencia') }}">
                                    @if ($errors->has('causa_accidente_violencia'))
                                        <div class="text-danger">{{ $errors->first('causa_accidente_violencia') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="causa_tratamiento">Causa de Tratamiento</label>
                                    <input type="text" class="form-control edit_imput" id="causa_tratamiento" name="causa_tratamiento" value="{{ old('causa_tratamiento') }}">
                                    @if ($errors->has('causa_tratamiento'))
                                        <div class="text-danger">{{ $errors->first('causa_tratamiento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="lugar_accidente_violencia">Lugar de Accidente/Violencia</label>
                                    <input type="text" class="form-control edit_imput" id="lugar_accidente_violencia" name="lugar_accidente_violencia" value="{{ old('lugar_accidente_violencia') }}">
                                    @if ($errors->has('lugar_accidente_violencia'))
                                        <div class="text-danger">{{ $errors->first('lugar_accidente_violencia') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="vif">VIF</label>
                                    <input type="text" class="form-control edit_imput" id="vif" name="vif" value="{{ old('vif') }}">
                                    @if ($errors->has('vif'))
                                        <div class="text-danger">{{ $errors->first('vif') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="direccion_avisar">Dirección para Avisar</label>
                                    <input type="text" class="form-control edit_imput" id="direccion_avisar" name="direccion_avisar" value="{{ old('direccion_avisar') }}">
                                    @if ($errors->has('direccion_avisar'))
                                        <div class="text-danger">{{ $errors->first('direccion_avisar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="parentesco">Parentesco</label>
                                    <input type="text" class="form-control edit_imput" id="parentesco" name="parentesco" value="{{ old('parentesco') }}">
                                    @if ($errors->has('parentesco'))
                                        <div class="text-danger">{{ $errors->first('parentesco') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="telefono_responsable">Teléfono del Responsable</label>
                                    <input type="text" class="form-control edit_imput" id="telefono_responsable" name="telefono_responsable" value="{{ old('telefono_responsable') }}">
                                    @if ($errors->has('telefono_responsable'))
                                        <div class="text-danger">{{ $errors->first('telefono_responsable') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="localidad_avisar">Localidad para Avisar</label>
                                    <input type="text" class="form-control edit_imput" id="localidad_avisar" name="localidad_avisar" value="{{ old('localidad_avisar') }}">
                                    @if ($errors->has('localidad_avisar'))
                                        <div class="text-danger">{{ $errors->first('localidad_avisar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="departamento_avisar">Departamento para Avisar</label>
                                    <input type="text" class="form-control edit_imput" id="departamento_avisar" name="departamento_avisar" value="{{ old('departamento_avisar') }}">
                                    @if ($errors->has('departamento_avisar'))
                                        <div class="text-danger">{{ $errors->first('departamento_avisar') }}</div>
                                    @endif
                                </div>
                            </div>
                            {{-- campos que hacian falta --}}
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="peso">Peso del paciente</label>
                                    <input type="number" class="form-control edit_imput" id="peso" name="peso" value="{{ old('peso') }}" required>
                                    @if ($errors->has('peso'))
                                        <div class="text-danger">{{ $errors->first('peso') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="talla">Talla del paciente</label>
                                    <input type="number" class="form-control edit_imput" id="talla" name="talla" value="{{ old('talla') }}" required>
                                    @if ($errors->has('talla'))
                                        <div class="text-danger">{{ $errors->first('talla') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="temperatura">Temperatura del paciente</label>
                                    <input type="number" class="form-control edit_imput" id="temperatura" name="temperatura" value="{{ old('temperatura') }}" required>
                                    @if ($errors->has('temperatura'))
                                        <div class="text-danger">{{ $errors->first('temperatura') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_quien_atiende">Nombre quien atiende</label>
                                    <input type="text" class="form-control" id="nombre_quien_atiende" name="nombre_quien_atiende" value="{{ old('nombre_quien_atiende') }}">
                                    @if ($errors->has('nombre_quien_atiende'))
                                        <div class="text-danger">{{ $errors->first('nombre_quien_atiende') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="frecuencia_cardiaca">Frecuencia Cardíaca</label>
                                    <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" value="{{ old('frecuencia_cardiaca') }}">
                                    @if ($errors->has('frecuencia_cardiaca'))
                                        <div class="text-danger">{{ $errors->first('frecuencia_cardiaca') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="frecuencia_respiratoria">Frecuencia Respiratoria</label>
                                    <input type="number" class="form-control" id="frecuencia_respiratoria" name="frecuencia_respiratoria" value="{{ old('frecuencia_respiratoria') }}">
                                    @if ($errors->has('frecuencia_respiratoria'))
                                        <div class="text-danger">{{ $errors->first('frecuencia_respiratoria') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="examen_fisico">Examen Físico</label>
                                    <input type="text" class="form-control" id="examen_fisico" name="examen_fisico" value="{{ old('examen_fisico') }}">
                                    @if ($errors->has('examen_fisico'))
                                        <div class="text-danger">{{ $errors->first('examen_fisico') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico">Diagnóstico</label>
                                    <input type="text" class="form-control" id="diagnostico" name="diagnostico" value="{{ old('diagnostico') }}">
                                    @if ($errors->has('diagnostico'))
                                        <div class="text-danger">{{ $errors->first('diagnostico') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="planes">Planes</label>
                                    <input type="text" class="form-control" id="planes" name="planes" value="{{ old('planes') }}">
                                    @if ($errors->has('planes'))
                                        <div class="text-danger">{{ $errors->first('planes') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico_egreso">Diagnóstico de Egreso</label>
                                    <input type="text" class="form-control" id="diagnostico_egreso" name="diagnostico_egreso" value="{{ old('diagnostico_egreso') }}">
                                    @if ($errors->has('diagnostico_egreso'))
                                        <div class="text-danger">{{ $errors->first('diagnostico_egreso') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="tipo_urgencia">Tipo de Urgencia</label>
                                    <select class="form-control" id="tipo_urgencia" name="tipo_urgencia">
                                        <option value="" disabled selected>Seleccione una opción</option>
                                        <option value="Médica" {{ old('tipo_urgencia') == 'Médica' ? 'selected' : '' }}>Médica</option>
                                        <option value="Quirúrgica" {{ old('tipo_urgencia') == 'Quirúrgica' ? 'selected' : '' }}>Quirúrgica</option>
                                        <option value="Gineco-Obstétrica" {{ old('tipo_urgencia') == 'Gineco-Obstétrica' ? 'selected' : '' }}>Gineco-Obstétrica</option>
                                        <option value="Otra" {{ old('tipo_urgencia') == 'Otra' ? 'selected' : '' }}>Otra</option>
                                    </select>
                                    @if ($errors->has('tipo_urgencia'))
                                        <div class="text-danger">{{ $errors->first('tipo_urgencia') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="destino_paciente">Destino del Paciente</label>
                                    <select class="form-control" id="destino_paciente" name="destino_paciente">
                                        <option value="" disabled selected>Seleccione una opción</option>
                                        <option value="Alta" {{ old('destino_paciente') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                        <option value="En observación" {{ old('destino_paciente') == 'En observación' ? 'selected' : '' }}>En observación</option>
                                        <option value="Falleció" {{ old('destino_paciente') == 'Falleció' ? 'selected' : '' }}>Falleció</option>
                                        <option value="Abandono" {{ old('destino_paciente') == 'Abandono' ? 'selected' : '' }}>Abandono</option>
                                    </select>
                                    @if ($errors->has('destino_paciente'))
                                        <div class="text-danger">{{ $errors->first('destino_paciente') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" class="form-control" id="referencia" name="referencia" value="{{ old('referencia') }}">
                                    @if ($errors->has('referencia'))
                                        <div class="text-danger">{{ $errors->first('referencia') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="hospitalizacion">Hospitalización</label>
                                    <input type="text" class="form-control" id="hospitalizacion" name="hospitalizacion" value="{{ old('hospitalizacion') }}">
                                    @if ($errors->has('hospitalizacion'))
                                        <div class="text-danger">{{ $errors->first('hospitalizacion') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="consulta_externa">Consulta Externa</label>
                                    <input type="text" class="form-control" id="consulta_externa" name="consulta_externa" value="{{ old('consulta_externa') }}">
                                    @if ($errors->has('consulta_externa'))
                                        <div class="text-danger">{{ $errors->first('consulta_externa') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="fuga">Fuga</label>
                                    <input type="text" class="form-control" id="fuga" name="fuga" value="{{ old('fuga') }}">
                                    @if ($errors->has('fuga'))
                                        <div class="text-danger">{{ $errors->first('fuga') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="salida_exigida">Salida Exigida</label>
                                    <input type="text" class="form-control" id="salida_exigida" name="salida_exigida" value="{{ old('salida_exigida') }}">
                                    @if ($errors->has('salida_exigida'))
                                        <div class="text-danger">{{ $errors->first('salida_exigida') }}</div>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
           
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
      </div>




  @stop
  
  
  @section('css')
     
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')


 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

$(document).ready(function() {
    $('#emergenciasTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/emergencias') }}",
        columns: [
            { data: 'id' },
            { data: 'no_expediente',
                render: function (data, type, row) {
                 return `<span class="text-primary font-weight-bold">${data}</span> <span class="badge badge-info">EXP</span>`;
               },
            },
            { data: 'primer_nombre' },
            { data: 'segundo_nombre' },
            { data: 'primer_apellido' },
            { data: 'segundo_apellido' },
            { data: 'no_cedula',
                render: function (data, type, row) {
                 return `<span class="text-danger font-weight-bold">${data}</span> <span class="badge badge-info">Cedula</span>`;
               },
            },
           
            { data: 'btn', orderable: false, searchable: false }
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
            sProcessing: "Procesando...",
        },
        lengthMenu: [[5, 15,50, -1], [5, 15, 50, "Todos"]],
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
                customize: function (doc) {
                    doc.content.splice(0, 1, {
                        text: [
                            { text: 'Tabla de emergencias\n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                            { text: 'Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '\n', fontSize: 12, italics: true },
                            { text: 'Usuario: ' + '{{ Auth::user()->name }}' + '\n\n', fontSize: 12, italics: true }
                        ]
                    });
                    doc['footer'] = (function(page, pages) {
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
                    });
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
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<h3>Tabla de emergencias</h3>' +
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
                text: '<i class="fas fa-eye"> ',
                titleAttr: 'Ocultar columna',
                className: 'bg-dark'
            },
        ],
    });

     // Manejar la eliminación de registros con SweetAlert
     $('#emergenciasTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('emergencias') }}/" + id;
        
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
                        $('#emergenciasTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Eliminado!',
                            'El dato  ha sido eliminado.',
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
});


    document.addEventListener('DOMContentLoaded', function () {
        function showAlert(message, icon, type) {
            Swal.fire({
                title: message,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }

        @if(session('info'))
            showAlert('{{ session('info') }}', 'success', 'success');
        @endif

        @if(session('update'))
            showAlert('{{ session('update') }}', 'info', 'info');
        @endif

        @if(session('delete'))
            showAlert('{{ session('delete') }}', 'error', 'error');
        @endif
    });
  
$(document).ready(function() {
     $('#paciente_id').change(function() {
        var pacienteId = $(this).val();
        if (pacienteId) {
            $.ajax({
                url: '/api/pacientes/' + pacienteId,
                type: 'GET',
                success: function(response) {
                   
                
                    $('#paciente_id_id').val(response.id);
                    $('#no_expediente').val(response.no_expediente);
                    $('#primer_nombre').val(response.primer_nombre);
                    $('#segundo_nombre').val(response.segundo_nombre);
                    $('#primer_apellido').val(response.primer_apellido);
                    $('#segundo_apellido').val(response.segundo_apellido);
                    $('#edad').val(response.edad);
                 
                    $('#sexo').val(response.sexo);
                    $('#no_cedula').val(response.no_cedula);
                    $('#no_inss').val(response.no_inss);
                    $('#estado_civil').val(response.estado_civil);
                    $('#raza_etnia').val(response.raza_etnia);
                    $('#escolaridad').val(response.escolaridad);
                    $('#categoria_paciente').val(response.categoria);
                    $('#direccion_residencia').val(response.direccion_residencia);
                    $('#localidad').val(response.localidad);
                    $('#municipio').val(response.municipio);
                    $('#departamento').val(response.departamento);
                    $('#ocupacion').val(response.ocupacion);
                    $('#urgencia_avisar').val(response.responsable_emergencia);
                    $('#direccion_telefono_avisar').val(response.telefono_responsable);
                    $('#parentesco').val(response.parentesco);
                    $('#empleador').val(response.empleador);
                    $('#direccion_empleador').val(response.direccion_empleador);
                  
                   
                  
                    
                    // Rellena los demás campos aquí si es necesario

                     // Rellena el contenedor de información del paciente
                     $('#info_no_expediente').text(response.no_expediente);
                    $('#info_primer_nombre').text(response.primer_nombre);
                    $('#info_segundo_nombre').text(response.segundo_nombre);
                    $('#info_primer_apellido').text(response.primer_apellido);
                    $('#info_segundo_apellido').text(response.segundo_apellido);
                    $('#info_edad').text(response.edad);
                    $('#info_fecha_nacimiento').text(response.fecha_nacimiento);
                    $('#info_sexo').text(response.sexo);
                    $('#info_no_cedula').text(response.no_cedula);
                    $('#info_no_inss').text(response.no_inss);
                }
            });
        }
    });
});

     //buscar paciente mediante ajax
   $(document).ready(function() {
    function fetchPacientes(page = 1) {
        var query = $('#buscar_paciente').val();
        if (query.length > 2) {
            $.ajax({
                url: "{{ route('buscarPaciente') }}",
                type: "GET",
                data: {'query': query, 'page': page},
                success: function(data) {
                    $('#lista_pacientes').empty();
                    if (data.data.length > 0) {
                        $.each(data.data, function(index, paciente) {
                            $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action custom-list-item" data-id="' + paciente.id + '">' + paciente.primer_nombre + ' ' + paciente.primer_apellido + ' ' + paciente.segundo_apellido + ' (' + paciente.no_cedula + ')</a>');
                        });

                        var pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
                        if (data.prev_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page - 1) + '">Anterior</a></li>';
                        }
                        for (var i = 1; i <= data.last_page; i++) {
                            pagination += '<li class="page-item ' + (i === data.current_page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                        }
                        if (data.next_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page + 1) + '">Siguiente</a></li>';
                        }
                        pagination += '</ul></nav>';

                        $('#lista_pacientes').append(pagination);
                    } else {
                        $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action disabled">No se encontraron resultados</a>');
                    }
                }
            });
        } else {
            $('#lista_pacientes').empty();
        }
    }

    $('#buscar_paciente').on('keyup', function() {
        fetchPacientes();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        fetchPacientes(page);
    });

    $(document).on('click', '.list-group-item-action', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nombre = $(this).text();

        // Limpia el select de pacientes y añade la nueva opción seleccionada
        $('#paciente_id').empty().append('<option value="' + id + '" selected>' + nombre + '</option>');

        // Dispara el cambio en el select de pacientes
        $('#paciente_id').change();
        $('#lista_pacientes').empty();
        $('#buscar_paciente').val('');
    });

    $('#paciente_id').change(function() {
        var pacienteId = $(this).val();
        if (pacienteId) {
            $.ajax({
                url: '/api/pacientes/' + pacienteId,
                type: 'GET',
                success: function(response) {
                 
                    $('#no_expediente').val(response.no_expediente);
                    $('#edad').val(response.edad);
                   
                    $('#sexo').val(response.sexo);
                    $('#no_cedula').val(response.no_cedula);
                    $('#no_inss').val(response.no_inss);
                    $('#primer_nombre').val(response.primer_nombre);
                  

                    // Aquí se realiza la comprobación para la historia clínica
                    //verificarHistoriaClinica(pacienteId);
                }
            });
        }
    });

    function verificarHistoriaClinica(pacienteId) {
        $.ajax({
            url: '/api/historias-clinicas/comprobar/' + pacienteId,
            type: 'GET',
            success: function(response) {
                if (response.existe) {
                    var fechaCreacion = new Date(response.fecha_creacion);
                    var ahora = new Date();
                    var diferenciaTiempo = Math.abs(ahora - fechaCreacion);
                    var diasTranscurridos = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24));

                    Swal.fire({
                        title: '¡Paciente con Historia Clínica!',
                        text: `Este paciente ya tiene una historia clínica creada el ${response.fecha_creacion}. Han transcurrido ${diasTranscurridos} días desde entonces.`,
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    }
});

  </script>
  @stop
    
</body>
</html>
   




