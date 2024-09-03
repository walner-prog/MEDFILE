{{-- @extends('layouts.app') --}}

<section>
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
     
   
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
        @livewireStyles
    </head>
    
@extends('adminlte::page')

@section('title', 'AdminSalud')



@section('content')
<div class="container">
    <br>
     <div class="row">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('lista_problemas.index') }}">
                <button class="btn btn-info ">
                    <i class="fas fa-house-medical-circle-check"></i> Regresar
                </button>
            </a>
           
        </div>
        <div class="col-lg-10 text-right">
           <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round">
                  <i class="fas fa-sun icon-light"></i>
                  <i class="fas fa-moon icon-dark"></i>
                </span>
                <span id="mode-text"></span>
              </label>
             
        </div>
     </div>

    
    
  
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="modal-title text-white" id="editListaProblemaFormLabel{{ $listaProblema->id }}">Editar Problema</h5>
                        </div>
                        <div id="datos-paciente" class="mb-3">
                            <h4>Datos del Paciente</h4>
                            <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                                <div class="mb-2">
                                    <strong class="color-primario">
                                        <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                                    </strong> 
                                    <span id="info_no_expediente" class="text-danger">{{ $listaProblema->no_expediente }}</span>
                                </div>
                                <div class="mb-2">
                                    <strong class="text-primary ml-2">
                                        <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                                    </strong> 
                                    <span id="info_primer_nombre" class="text-secondary">{{ $listaProblema->primer_nombre }}</span>
                                    <span id="info_segundo_nombre" class="text-secondary">{{ $listaProblema->segundo_nombre }}</span>
                                    <span id="info_primer_apellido" class="text-secondary">{{ $listaProblema->primer_apellido }}</span>
                                    <span id="info_segundo_apellido" class="text-secondary">{{ $listaProblema->segundo_apellido }}</span>
                                    
                                    <strong class="text-primary ml-2">Edad:</strong> 
                                    <span id="info_edad" class="text-secondary">{{ $listaProblema->edad }}</span>
                                    
                                    <strong class="text-primary ml-2">No. Cédula:</strong> 
                                    <span id="info_no_cedula" class="text-secondary">{{ $paciente->no_cedula }}</span>
                                    
                                    <strong class="text-primary ml-2">No. INSS:</strong> 
                                    <span id="info_no_inss" class="text-secondary">{{ $paciente->no_inss }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-body">
                    <form method="POST" action="{{ route('lista_problemas.update', $listaProblema->id) }}">
                        @csrf
                        @method('PUT')

                           
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="primer_nombre">Primer Nombre</label>
                                <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $listaProblema->primer_nombre) }}" readonly>
                                @if ($errors->has('primer_nombre'))
                                    <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                @endif
                            </div>
            
                            <div class="col-3 form-group">
                                <label for="segundo_nombre">Segundo Nombre</label>
                                <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $listaProblema->segundo_nombre) }}" readonly>
                                @if ($errors->has('segundo_nombre'))
                                    <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                @endif
                            </div>
            
                            <div class="col-3 form-group">
                                <label for="primer_apellido">Primer Apellido</label>
                                <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $listaProblema->primer_apellido) }}" readonly>
                                @if ($errors->has('primer_apellido'))
                                    <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                @endif
                            </div>
            
                            <div class="col-3 form-group">
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $listaProblema->segundo_apellido) }}" readonly>
                                @if ($errors->has('segundo_apellido'))
                                    <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                @endif
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="paciente_id">ID Paciente</label>
                                <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $listaProblema->paciente_id }}" required readonly>
                                @if ($errors->has('paciente_id'))
                                    <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3 ml-auto">
                                <label for="no_expediente">No. Expediente <span class=" text-danger">*</span></label>
                                <input type="text" name="no_expediente" id="no_expediente" class="form-control edit_input text-dark" value="{{ old('no_expediente', $listaProblema->no_expediente ?? '') }}" readonly>
                                @if ($errors->has('no_expediente'))
                                    <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="fecha">Fecha <span class=" text-danger">*</span></label>
                                <input type="date" name="fecha" id="fecha" class="form-control edit_input text-dark" value="{{ old('fecha', $listaProblema->fecha ?? '') }}">
                                @if ($errors->has('fecha'))
                                    <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="edad">Edad <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control edit_imput text-dark" id="edad" name="edad" value="{{ old('edad', $listaProblema->edad) }}" required>
                                    @if ($errors->has('edad'))
                                        <div class="text-danger">{{ $errors->first('edad') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="servicio">Servicio <span class=" text-danger">*</span></label>
                                <input type="text" name="servicio" id="servicio" class="form-control edit_input text-dark" value="{{ old('servicio', $listaProblema->servicio ?? '') }}">
                                @if ($errors->has('servicio'))
                                    <div class="text-danger">{{ $errors->first('servicio') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="sala">Sala <span class=" text-danger">*</span></label>
                                <input type="text" name="sala" id="sala" class="form-control edit_input text-dark" value="{{ old('sala', $listaProblema->sala ?? '') }}">
                                @if ($errors->has('sala'))
                                    <div class="text-danger">{{ $errors->first('sala') }}</div>
                                @endif
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="establecimiento_salud">Establecimiento de Salud</label>
                                    <input type="text" name="establecimiento_salud" id="establecimiento_salud" class="form-control edit_input text-dark" value="{{ old('establecimiento_salud', $listaProblema->establecimiento_salud ?? '') }}">
                                    @if ($errors->has('establecimiento_salud'))
                                        <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                                    @endif
                                </div>
                            </div>
                        
                            
                        </div>
    
                        <div class="row">
                            <div class="col-lg-8">
                                <label for="nombre_problema">Nombre del Problema <span class=" text-danger">*</span></label>
                                <input type="text" name="nombre_problema" id="nombre_problema" class="form-control edit_input text-dark" value="{{ old('nombre_problema', $listaProblema->nombre_problema ?? '') }}">
                                @if ($errors->has('nombre_problema'))
                                    <div class="text-danger">{{ $errors->first('nombre_problema') }}</div>
                                @endif
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group d-flex align-items-center mb-2">
                                    <div class="custom-control custom-checkbox mr-3">
                                        <input type="checkbox" class="custom-control-input" id="inactivo" name="inactivo" value="1"
                                            {{ old('inactivo', $listaProblema->inactivo) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="inactivo">Inactivo</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="resuelto" name="resuelto" value="1"
                                            {{ old('resuelto', $listaProblema->resuelto) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="resuelto">Resuelto</label>
                                    </div>
                                </div>
                            </div>
                            
                            
                   
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Actualizar Problema</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    

 <br>



  </div>
</div>


    @livewireScripts
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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


// Initial call to set the date and time
updateDateTime();

// Update date and time every second
setInterval(updateDateTime, 1000);


</script>
@stop
</section>