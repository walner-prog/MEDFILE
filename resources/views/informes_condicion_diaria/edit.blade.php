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
            <a class="text-white" href="{{ route('informes_condicion_diaria.index') }}">
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
                            <h5 class="modal-title text-white" id="editInformeCondicionDiariaFormLabel{{ $informe->id }}">Editar Informe de Condición Diaria del Paciente</h5>
                        </div>
                        <div id="datos-paciente" class="mb-3">
                            <h4>Datos del Paciente</h4>
                            <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                                <div class="mb-2">
                                    <strong class="color-primario"><i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:</strong> 
                                    <span id="info_no_expediente" class="text-danger">{{ $paciente->no_expediente }}</span>
                                </div>
                                <div class="mb-2">
                                  
                                        
                                  
                                    <strong class="text-primary ml-2"><i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:</strong> 
                                    <span id="info_primer_nombre" class="text-secondary">{{ $paciente->primer_nombre }}</span>
                                    <span id="info_segundo_nombre" class="text-secondary">{{ $paciente->segundo_nombre }}</span>
                                    <span id="info_primer_apellido" class="text-secondary">{{ $paciente->primer_apellido }}</span>
                                    <span id="info_segundo_apellido" class="text-secondary">{{ $paciente->segundo_apellido }}</span>
                                    
                                
    
                                    <strong class="text-primary ml-2">Servicio:</strong> 
                                    <span id="info_servicio" class="text-secondary">{{ $informe->servicio }}</span>
    
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
                    <form method="POST" action="{{ route('informes_condicion_diaria.update', $informe->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="paciente_id">ID Paciente</label>
                                <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $informe->paciente_id }}" required readonly>
                                @if ($errors->has('paciente_id'))
                                    <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3 ml-auto">
                                <label for="no_expediente">No. Expediente <span class=" text-danger">*</span></label>
                                <input type="text" name="no_expediente" id="no_expediente" class="form-control edit_input text-dark" value="{{ old('no_expediente', $informe->no_expediente ?? '') }}" readonly>
                                @if ($errors->has('no_expediente'))
                                    <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="fecha">Fecha <span class=" text-danger">*</span></label>
                                <input type="date" name="fecha" id="fecha" class="form-control edit_input text-dark" value="{{ old('fecha', $informe->fecha ?? '') }}">
                                @if ($errors->has('fecha'))
                                    <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="servicio">Servicio <span class=" text-danger">*</span></label>
                                <input type="text" name="servicio" id="servicio" class="form-control edit_input text-dark" value="{{ old('servicio', $informe->servicio ?? '') }}">
                                @if ($errors->has('servicio'))
                                    <div class="text-danger">{{ $errors->first('servicio') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="sala">Sala <span class=" text-danger">*</span></label>
                                <input type="text" name="sala" id="sala" class="form-control edit_input text-dark" value="{{ old('sala', $informe->sala ?? '') }}">
                                @if ($errors->has('sala'))
                                    <div class="text-danger">{{ $errors->first('sala') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="fecha_hora_condicion">Fecha y Hora de la Condición <span class=" text-danger">*</span></label>
                                <input type="datetime-local" name="fecha_hora_condicion" id="fecha_hora_condicion" class="form-control edit_input text-dark" value="{{ old('fecha_hora_condicion', $informe->fecha_hora_condicion ?? '') }}">
                                @if ($errors->has('fecha_hora_condicion'))
                                    <div class="text-danger">{{ $errors->first('fecha_hora_condicion') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="tratamiento">Tratamiento <span class=" text-danger">*</span></label>
                                <textarea name="tratamiento" id="tratamiento" class="form-control edit_input text-dark">{{ old('tratamiento', $informe->tratamiento ?? '') }}</textarea>
                                @if ($errors->has('tratamiento'))
                                    <div class="text-danger">{{ $errors->first('tratamiento') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="procedimientos">Procedimientos <span class=" text-danger">*</span></label>
                                <textarea name="procedimientos" id="procedimientos" class="form-control edit_input text-dark">{{ old('procedimientos', $informe->procedimientos ?? '') }}</textarea>
                                @if ($errors->has('procedimientos'))
                                    <div class="text-danger">{{ $errors->first('procedimientos') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="brindada_por">Brindada por <span class=" text-danger">*</span></label>
                                <input type="text" name="brindada_por" id="brindada_por" class="form-control edit_input text-dark" value="{{ old('brindada_por', $informe->brindada_por ?? '') }}">
                                @if ($errors->has('brindada_por'))
                                    <div class="text-danger">{{ $errors->first('brindada_por') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="recibida_por">Recibida por <span class=" text-danger">*</span></label>
                                <input type="text" name="recibida_por" id="recibida_por" class="form-control edit_input text-dark" value="{{ old('recibida_por', $informe->recibida_por ?? '') }}">
                                @if ($errors->has('recibida_por'))
                                    <div class="text-danger">{{ $errors->first('recibida_por') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-lg-3">
                                <label for="firma_quien_recibe">Firma de quien recibe <span class=" text-danger">*</span></label>
                                <input type="text" name="firma_quien_recibe" id="firma_quien_recibe" class="form-control edit_input text-dark" value="{{ old('firma_quien_recibe', $informe->firma_quien_recibe ?? '') }}">
                                @if ($errors->has('firma_quien_recibe'))
                                    <div class="text-danger">{{ $errors->first('firma_quien_recibe') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Actualizar Informe</button>
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