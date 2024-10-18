
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
     
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
     
      @livewireStyles
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
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
    
</body>
</html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
             

    @section('css')
     
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
     
      @livewireStyles
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  @extends('adminlte::page')
    
  @section('title', 'admision-hospitalaria')




  @section('content')
  <div class="container mt-4 toggle-container">

   
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registros de Admision y Egreso Hospitalarios </li>
                </ol>
            </nav>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-2">
            @can('create', App\Models\RegistroAdmisionEgresoHospitalario::class)
            <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createIngresoEgresoForm">
                <i class="fas fa-plus"></i> Crear Registro
            </button>
            @endcan
        </div>

        <div class="col-lg-2">
           
        </div>
        <div class="col-lg-2">
            
        </div>
        <div class="col-lg-2 text-right">
           
        </div>
        
    </div>
 

    
      
  
      @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if (session('info'))
          <div class="alert alert-success">{{ session('info') }}</div>
      @endif
      @if (session('delete'))
          <div class="alert alert-warning">{{ session('delete') }}</div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
  

      <div class="table-responsive">
        <table id="admisionEgresoTable" class="min-w-full border border-gray-300 shadow-md rounded-lg p-2">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Nombre</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Apellido</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Edad</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Diagnóstico</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Ingreso</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Fecha de Egreso</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200" style="width: 200px">Acciones</th>
                </tr>
            </thead>
            <hr>
            <tbody class="divide-y divide-gray-200">
                <!-- Los datos se cargarán dinámicamente aquí -->
            </tbody>
        </table>
        
      </div>

      
      <div class="modal fade" id="createIngresoEgresoForm" tabindex="-1" role="dialog" aria-labelledby="createIngresoEgresoFormModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="modal-title text-white" id="createIngresoEgresoFormModalLabel">Crear Registro de Ingreso o Egreso Hospitalario</h4>
                        </div>
      
                        <div id="datos-paciente" class="mb-3">
                          
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
                    <form action="{{ route('registro_admision_hospitalario.store') }}" method="POST">
                        @csrf
                       
                        <div class="row">
                            <!-- Campos para mantener la información del paciente -->
                            <div class="col-3 form-group" hidden>
                                <label for="primer_nombre">Primer Nombre</label>
                                <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" readonly>
                                @if ($errors->has('primer_nombre'))
                                    <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="segundo_nombre">Segundo Nombre</label>
                                <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" readonly>
                                @if ($errors->has('segundo_nombre'))
                                    <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="primer_apellido">Primer Apellido</label>
                                <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" readonly>
                                @if ($errors->has('primer_apellido'))
                                    <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}" readonly>
                                @if ($errors->has('segundo_apellido'))
                                    <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                @endif
                            </div>
                        </div>
      
                        <div class="row">
                    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="buscar_paciente" class="bold">Buscar Paciente</label>
                                    <i class="fa-solid fa-magnifying-glass fa-1x mb-1"></i>
                                    <input type="text" class="form-control" autocomplete="off" id="buscar_paciente" placeholder="Buscar por nombre, cédula o expediente">
                                </div>
                                <div id="lista_pacientes" class="list-group"></div>
                            </div>
        
                            <div class="col-lg-6" hidden>
                                <div class="form-group">
                                    <label for="paciente_id">Paciente seleccionado  </label>
                                    <select class="form-control" id="paciente_id" name="paciente_id" >
                                     
                                    </select>
                                    @if ($errors->has('paciente_id'))
                                        <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                    @endif
                                </div>
                            </div> 
        
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="paciente_id_id">ID Paciente seleccionado<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="paciente_id_id" name="paciente_id" value="{{ old('paciente_id_id') }}"  readonly>
                                        @if ($errors->has('paciente_id_id'))
                                            <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        <div class="row p-2">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="no_expediente">No. Expediente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_expediente" name="no_expediente" value="{{ old('no_expediente') }}" required readonly>
                                    @if ($errors->has('no_expediente'))
                                        <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                           
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="no_cedula">No. Cédula <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_cedula" name="no_cedula" value="{{ old('no_cedula') }}" required readonly>
                                    @if ($errors->has('no_cedula'))
                                        <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="estado_civil">Estado Civil <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="estado_civil" name="estado_civil" value="{{ old('estado_civil') }}" required readonly>
                                    @if ($errors->has('estado_civil'))
                                        <div class="text-danger">{{ $errors->first('estado_civil') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="escolaridad">Escolaridad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="escolaridad" name="escolaridad" value="{{ old('escolaridad') }}" required readonly>
                                    @if ($errors->has('escolaridad'))
                                        <div class="text-danger">{{ $errors->first('escolaridad') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                              
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="categoria_paciente">Categoría del Paciente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoria_paciente" name="categoria_paciente" value="{{ old('categoria_paciente') }}" required readonly>
                                    @if ($errors->has('categoria_paciente'))
                                        <div class="text-danger">{{ $errors->first('categoria_paciente') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="no_inss">No. INSS <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_inss" name="no_inss" value="{{ old('no_inss') }}" required readonly>
                                    @if ($errors->has('no_inss'))
                                        <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control edit_imput" id="sexo" name="sexo" required readonly>
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
                                    <label for="direccion_residencia">Dirección de Residencia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion_residencia" name="direccion_residencia" value="{{ old('direccion_residencia') }}" required>
                                    @if ($errors->has('direccion_residencia'))
                                        <div class="text-danger">{{ $errors->first('direccion_residencia') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="localidad">Localidad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="localidad" name="localidad" value="{{ old('localidad') }}" required readonly>
                                    @if ($errors->has('localidad'))
                                        <div class="text-danger">{{ $errors->first('localidad') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="municipio">Municipio <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="municipio" name="municipio" value="{{ old('municipio') }}" required readonly>
                                    @if ($errors->has('municipio'))
                                        <div class="text-danger">{{ $errors->first('municipio') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="departamento">Departamento <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="departamento" name="departamento" value="{{ old('departamento') }}" required readonly>
                                    @if ($errors->has('departamento'))
                                        <div class="text-danger">{{ $errors->first('departamento') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="raza_etnia">Raza/Etnia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="raza_etnia" name="raza_etnia" value="{{ old('raza_etnia') }}" required readonly>
                                    @if ($errors->has('raza_etnia'))
                                        <div class="text-danger">{{ $errors->first('raza_etnia') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                        </div>
                        
                        
                        <div class="row">
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="edad">Edad <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edad" name="edad" value="{{ old('edad') }}" required readonly>
                                    @if ($errors->has('edad'))
                                        <div class="text-danger">{{ $errors->first('edad') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}" required readonly>
                                    @if ($errors->has('ocupacion'))
                                        <div class="text-danger">{{ $errors->first('ocupacion') }}</div>
                                    @endif
                                </div>
                            </div>
                         
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="parentesco">Parentesco <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="parentesco" name="parentesco" value="{{ old('parentesco') }}" required readonly>
                                    @if ($errors->has('parentesco'))
                                        <div class="text-danger">{{ $errors->first('parentesco') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="urgencia_avisar">Persona a Avisar en Caso de Urgencia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="urgencia_avisar" name="urgencia_avisar" value="{{ old('urgencia_avisar') }}" required>
                                    @if ($errors->has('urgencia_avisar'))
                                        <div class="text-danger">{{ $errors->first('urgencia_avisar') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="direccion_telefono_avisar">Dirección y Teléfono para Avisar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion_telefono_avisar" name="direccion_telefono_avisar" value="{{ old('direccion_telefono_avisar') }}" required>
                                    @if ($errors->has('direccion_telefono_avisar'))
                                        <div class="text-danger">{{ $errors->first('direccion_telefono_avisar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="empleador">Empleador <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="empleador" name="empleador" value="{{ old('empleador') }}" required >
                                    @if ($errors->has('empleador'))
                                        <div class="text-danger">{{ $errors->first('empleador') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="direccion_empleador">Dirección del Empleador <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion_empleador" name="direccion_empleador" value="{{ old('direccion_empleador') }}" required>
                                    @if ($errors->has('direccion_empleador'))
                                        <div class="text-danger">{{ $errors->first('direccion_empleador') }}</div>
                                    @endif
                                </div>
                            </div>
                         
                                
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_madre">Nombre de la Madre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}" required >
                                    @if ($errors->has('nombre_madre'))
                                        <div class="text-danger">{{ $errors->first('nombre_madre') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                           

                        </div>

                        <div class="row">

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_padre">Nombre del Padre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}" required>
                                    @if ($errors->has('nombre_padre'))
                                        <div class="text-danger">{{ $errors->first('nombre_padre') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="establecimiento_salud">Establecimiento de Salud <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="establecimiento_salud" name="establecimiento_salud" value="{{ old('establecimiento_salud') }}" required>
                                    @if ($errors->has('establecimiento_salud'))
                                        <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nacionalidad">Nacionalidad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="{{ old('nacionalidad') }}" required>
                                    @if ($errors->has('nacionalidad'))
                                        <div class="text-danger">{{ $errors->first('nacionalidad') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="ingreso">Ingreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ingreso" name="ingreso" value="{{ old('ingreso') }}" required>
                                    @if ($errors->has('ingreso'))
                                        <div class="text-danger">{{ $errors->first('ingreso') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                         
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="municipio_distrito">Municipio/Distrito <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="municipio_distrito" name="municipio_distrito" value="{{ old('municipio_distrito') }}" required>
                                    @if ($errors->has('municipio_distrito'))
                                        <div class="text-danger">{{ $errors->first('municipio_distrito') }}</div>
                                    @endif
                                </div>
                            </div>
                       

                       
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico_ingreso">Diagnóstico de Ingreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="diagnostico_ingreso" name="diagnostico_ingreso" value="{{ old('diagnostico_ingreso') }}" required>
                                    @if ($errors->has('diagnostico_ingreso'))
                                        <div class="text-danger">{{ $errors->first('diagnostico_ingreso') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="forma_llegada_hospital">Forma de Llegada al Hospital <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="forma_llegada_hospital" name="forma_llegada_hospital" value="{{ old('forma_llegada_hospital') }}" required>
                                    @if ($errors->has('forma_llegada_hospital'))
                                        <div class="text-danger">{{ $errors->first('forma_llegada_hospital') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="reingreso_mismo_diagnostico">Reingreso por el Mismo Diagnóstico <span class="text-danger">*</span></label>
                                    <select class="form-control" id="reingreso_mismo_diagnostico" name="reingreso_mismo_diagnostico" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="1" {{ old('reingreso_mismo_diagnostico') == 1 ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('reingreso_mismo_diagnostico') == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    @if ($errors->has('reingreso_mismo_diagnostico'))
                                        <div class="text-danger">{{ $errors->first('reingreso_mismo_diagnostico') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="sitio_ingreso_hospitalario">Sitio de Ingreso Hospitalario <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sitio_ingreso_hospitalario" name="sitio_ingreso_hospitalario" value="{{ old('sitio_ingreso_hospitalario') }}" required>
                                    @if ($errors->has('sitio_ingreso_hospitalario'))
                                        <div class="text-danger">{{ $errors->first('sitio_ingreso_hospitalario') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="egreso_fecha">Fecha de Egreso <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="egreso_fecha" name="egreso_fecha" value="{{ old('egreso_fecha') }}" required>
                                    @if ($errors->has('egreso_fecha'))
                                        <div class="text-danger">{{ $errors->first('egreso_fecha') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="egreso_hora">Hora de Egreso <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="egreso_hora" name="egreso_hora" value="{{ old('egreso_hora') }}" required>
                                    @if ($errors->has('egreso_hora'))
                                        <div class="text-danger">{{ $errors->first('egreso_hora') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico_egreso">Diagnóstico de Egreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="diagnostico_egreso" name="diagnostico_egreso" value="{{ old('diagnostico_egreso') }}" required>
                                    @if ($errors->has('diagnostico_egreso'))
                                        <div class="text-danger">{{ $errors->first('diagnostico_egreso') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico_egreso_principal">Diagnóstico Principal de Egreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="diagnostico_egreso_principal" name="diagnostico_egreso_principal" value="{{ old('diagnostico_egreso_principal') }}" required>
                                    @if ($errors->has('diagnostico_egreso_principal'))
                                        <div class="text-danger">{{ $errors->first('diagnostico_egreso_principal') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="diagnostico_egreso_complementarios">Diagnósticos Complementarios de Egreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="diagnostico_egreso_complementarios" name="diagnostico_egreso_complementarios" value="{{ old('diagnostico_egreso_complementarios') }}" required>
                                    @if ($errors->has('diagnostico_egreso_complementarios'))
                                        <div class="text-danger">{{ $errors->first('diagnostico_egreso_complementarios') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="cirugias_realizadas">Cirugías Realizadas <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="cirugias_realizadas" name="cirugias_realizadas" required>{{ old('cirugias_realizadas') }}</textarea>
                                    @if ($errors->has('cirugias_realizadas'))
                                        <div class="text-danger">{{ $errors->first('cirugias_realizadas') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_admisionista">Nombre del Admisionista <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre_admisionista" name="nombre_admisionista" value="{{ old('nombre_admisionista') }}" required>
                                    @if ($errors->has('nombre_admisionista'))
                                        <div class="text-danger">{{ $errors->first('nombre_admisionista') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="dias_estancia">Días de Estancia <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="dias_estancia" name="dias_estancia" value="{{ old('dias_estancia') }}" required>
                                    @if ($errors->has('dias_estancia'))
                                        <div class="text-danger">{{ $errors->first('dias_estancia') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="causa_trauma">Causa del Trauma</label>
                                    <input type="text" class="form-control" id="causa_trauma" name="causa_trauma" value="{{ old('causa_trauma') }}">
                                    @if ($errors->has('causa_trauma'))
                                        <div class="text-danger">{{ $errors->first('causa_trauma') }}</div>
                                    @endif
                                </div>
                            </div>
                            

                        </div>

                        <div class="row">
                            
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="accidente_trabajo">Accidente de Trabajo</label>
                                    <input type="checkbox" class="form-check-input ml-4" id="accidente_trabajo" name="accidente_trabajo" {{ old('accidente_trabajo') ? 'checked' : '' }}>
                                    @if ($errors->has('accidente_trabajo'))
                                        <div class="text-danger">{{ $errors->first('accidente_trabajo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="de_trayecto">De Trayecto</label>
                                    <input type="checkbox" class="form-check-input ml-4" id="de_trayecto" name="de_trayecto" {{ old('de_trayecto') ? 'checked' : '' }}>
                                    @if ($errors->has('de_trayecto'))
                                        <div class="text-danger">{{ $errors->first('de_trayecto') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="enfermedad_laboral">Enfermedad Laboral</label>
                                    <input type="checkbox" class="form-check-input ml-4" id="enfermedad_laboral" name="enfermedad_laboral" {{ old('enfermedad_laboral') ? 'checked' : '' }}>
                                    @if ($errors->has('enfermedad_laboral'))
                                        <div class="text-danger">{{ $errors->first('enfermedad_laboral') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                           
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="infeccion_intrahospitalaria">Infección Intrahospitalaria</label>
                                    <input type="checkbox" class="form-check-input ml-4" id="infeccion_intrahospitalaria" name="infeccion_intrahospitalaria" {{ old('infeccion_intrahospitalaria') ? 'checked' : '' }}>
                                    @if ($errors->has('infeccion_intrahospitalaria'))
                                        <div class="text-danger">{{ $errors->first('infeccion_intrahospitalaria') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="referido_otro_establecimiento">Referido a Otro Establecimiento</label>
                                    <input type="text" class="form-control" id="referido_otro_establecimiento" name="referido_otro_establecimiento" value="{{ old('referido_otro_establecimiento') }}">
                                    @if ($errors->has('referido_otro_establecimiento'))
                                        <div class="text-danger">{{ $errors->first('referido_otro_establecimiento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nombre_medico">Nombre del Médico <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre_medico" name="nombre_medico" value="{{ old('nombre_medico') }}" required>
                                    @if ($errors->has('nombre_medico'))
                                        <div class="text-danger">{{ $errors->first('nombre_medico') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="sello_medico_ingreso">Sello del Médico de Ingreso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sello_medico_ingreso" name="sello_medico_ingreso" value="{{ old('sello_medico_ingreso') }}" required>
                                    @if ($errors->has('sello_medico_ingreso'))
                                        <div class="text-danger">{{ $errors->first('sello_medico_ingreso') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Ingreso/Egreso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    

    
 
   
  </div>
 
  
  @stop
  
  
  
  
  
  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
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
    $('#admisionEgresoTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/registro_admision_hospitalario') }}",
        columns: [
            { data: 'id' },
            { data: 'no_expediente',
                render: function (data, type, row) {
                    return `<span class="text-primary font-weight-bold">${data}</span> <span class="badge badge-info">EXP</span>`;
                },
            },
            { data: 'primer_nombre' },
            { data: 'primer_apellido' },
            { data: 'edad' },
            { data: 'diagnostico_ingreso' },
            { data: 'ingreso'},
              
            { data: 'egreso_fecha' },
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
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
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
                            { text: 'Admisión y Egreso Hospitalario \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                            { text: 'Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '\n', fontSize: 12, italics: true },
                            { text: 'Usuario: ' + '{{ Auth::user()->name }}' + '\n\n', fontSize: 12, italics: true }
                        ]
                    });
                    doc.footer = function(page, pages) {
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
                        };
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
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<h3>Admisión y Egreso Hospitalario</h3>' +
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
                text: '<i class="fas fa-eye"></i> ',
                titleAttr: 'Ocultar columna',
                className: 'bg-dark'
            },
        ],
    });

    // Manejar la eliminación de registros con SweetAlert
    $('#admisionEgresoTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('registro_admision_hospitalario') }}/" + id;
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás recuperar este registro!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        );
                        $('#admisionEgresoTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'No se pudo eliminar el registro.',
                            'error'
                        );
                    }
                });
            }
        });
    });
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
                    $('#municipio_distrito').val(response.municipio);
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

// para editar 
// este codigo es para buscar por ajax en tiempo real los pacientes para las historis clinicas 

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
</section>



