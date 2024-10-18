<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
</head>
<body>
       
@extends('adminlte::page')

@section('title', 'editar-medicamnetos')



@section('content')
<div class="container">
    <br>
    
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Registros control de medicamentos de pacientes Ingresados</li>
                    <li class="breadcrumb-item active" aria-current="page">editar-medicamnetos </li>
                </ol>
            </nav>
        </div>
        
    </div>
     <div class="row">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('control_medicamentos.index') }}">
                <button class="btn btn-info ">
                    <i class="fas fa-house-medical-circle-check"></i> Regresar
                </button>
            </a>
           
        </div>
        <div class="col-lg-10">
           
        </div>
     </div>

    
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="modal-title text-white" id="editControlMedicamentoFormLabel{{ $controle->id }}">Editar Control de Medicamentos para el Paciente</h4>
                        </div>
                        <div id="datos-paciente" class="mb-3 ">
                          
                            <div class="p-3 mb-2  border rounded  datos-pacientes  bg-white ">
                                <div class="mb-2">
                               <strong class="color-primario"> <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:</strong> <span id="info_no_expediente" class="text-danger">{{ $controle->no_expediente }}</span>
                                </div>
                                <div class="mb-2">
                                    <strong class="text-primary ml-2">
                                        <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                                    </strong> 
                                    <span id="info_primer_nombre" class="text-secondary">{{ $controle->primer_nombre }}</span>
                                    <span id="info_segundo_nombre" class="text-secondary">{{ $controle->segundo_nombre }}</span>
                                    <span id="info_primer_apellido" class="text-secondary">{{ $controle->primer_apellido }}</span>
                                    <span id="info_segundo_apellido" class="text-secondary">{{ $controle->segundo_apellido }}</span>
                                
                                    <strong class="text-primary ml-2">No_cama:</strong> 
                                    <span id="info_edad" class="text-secondary">{{ $controle->no_cama }}</span>
                                
                                    <strong class="text-primary ml-2">Servicio:</strong> 
                                    <span id="info_sexo" class="text-secondary">{{ $controle->servicio }}</span>
                                
                                    <strong class="text-primary ml-2">No. Cédula:</strong> 
                                    <span id="info_no_cedula" class="text-secondary">{{ $controle->no_cedula }}</span>
                                
                                    <strong class="text-primary ml-2">No. INSS:</strong> 
                                    <span id="info_no_inss" class="text-secondary">{{ $controle->no_inss }}</span>
                                </div>
                               
                              
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control_medicamentos.update', $controle->id) }}">
                        @csrf
                        @method('PUT') 
                      
                         <div class="row">
                                <div class="form-group">
                                    <label for="paciente_id">ID Paciente</label>
                                    <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $controle->paciente_id }}" required>
                                    @if ($errors->has('paciente_id'))
                                        <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                    @endif
                                </div>
        
                                <div class="col-3 form-group">
                                    <label for="primer_nombre">Primer Nombre</label>
                                    <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $controle->primer_nombre) }}" readonly>
                                    @if ($errors->has('primer_nombre'))
                                        <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                    @endif
                                </div>
                
                                <div class="col-3 form-group">
                                    <label for="segundo_nombre">Segundo Nombre</label>
                                    <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $controle->segundo_nombre) }}" readonly>
                                    @if ($errors->has('segundo_nombre'))
                                        <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                    @endif
                                </div>
                
                                <div class="col-3 form-group">
                                    <label for="primer_apellido">Primer Apellido</label>
                                    <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $controle->primer_apellido) }}" readonly>
                                    @if ($errors->has('primer_apellido'))
                                        <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                    @endif
                                </div>
                
                                <div class="col-3 form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $controle->segundo_apellido) }}" readonly>
                                    @if ($errors->has('segundo_apellido'))
                                        <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                    @endif
                                </div>
    
    
                              </div>
                             
    
                              <div class="row">
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="establecimiento_salud">Establecimiento de Salud</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="establecimiento_salud" name="establecimiento_salud" value="{{ old('establecimiento_salud', $controle->establecimiento_salud) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="no_expediente">No. Expediente</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="no_expediente" name="no_expediente" value="{{ old('no_expediente', $controle->no_expediente) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="no_cedula">No. Cédula</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="no_cedula" name="no_cedula" value="{{ old('no_cedula', $controle->no_cedula) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" class="form-control edit_imput text-dark" id="fecha" name="fecha" value="{{ old('fecha', $controle->fecha) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="hora">Hora</label>
                                        <input type="time" class="form-control edit_imput text-dark" id="hora" name="hora" value="{{ old('hora', $controle->hora) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="no_inss">No. INSS</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="no_inss" name="no_inss" value="{{ old('no_inss', $controle->no_inss) }}">
                                    </div>
                                </div>
    
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="servicio">Servicio</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="servicio" name="servicio" value="{{ old('servicio', $controle->servicio) }}">
                                        @if ($errors->has('servicio'))
                                            <div class="text-danger">{{ $errors->first('servicio') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="no_cama">No. Cama</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="no_cama" name="no_cama" value="{{ old('no_cama', $controle->no_cama) }}">
                                        @if ($errors->has('no_cama'))
                                            <div class="text-danger">{{ $errors->first('no_cama') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medicamentos_otros">Medicamentos Otros</label>
                                        <textarea class="form-control" id="medicamentos_otros" name="medicamentos_otros">{{ old('medicamentos_otros', $controle->medicamentos_otros) }}</textarea>
                                    </div>
                                </div>
                               
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="sala">Sala</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="sala" name="sala" value="{{ old('sala', $controle->sala) }}">
                                        @if ($errors->has('sala'))
                                            <div class="text-danger">{{ $errors->first('sala') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="fecha_medicamentos">Fecha Medicamentos</label>
                                        <input type="date" class="form-control edit_imput text-dark" id="fecha_medicamentos" name="fecha_medicamentos" value="{{ old('fecha_medicamentos', $controle->fecha_medicamentos) }}">
                                        @if ($errors->has('fecha_medicamentos'))
                                            <div class="text-danger">{{ $errors->first('fecha_medicamentos') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="hora_medicamentos">Hora Medicamentos</label>
                                        <input type="time" class="form-control edit_imput text-dark" id="hora_medicamentos" name="hora_medicamentos" value="{{ old('hora_medicamentos', $controle->hora_medicamentos) }}">
                                        @if ($errors->has('hora_medicamentos'))
                                            <div class="text-danger">{{ $errors->first('hora_medicamentos') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="medicamentos_stat_prn_preanestesico">Medicamentos STAT/PRN/Preanestésico</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="medicamentos_stat_prn_preanestesico" name="medicamentos_stat_prn_preanestesico" value="{{ old('medicamentos_stat_prn_preanestesico', $controle->medicamentos_stat_prn_preanestesico) }}">
                                        @if ($errors->has('medicamentos_stat_prn_preanestesico'))
                                            <div class="text-danger">{{ $errors->first('medicamentos_stat_prn_preanestesico') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="hora_medicamentos_stat_prn">Hora Medicamentos STAT/PRN</label>
                                        <input type="time" class="form-control edit_imput text-dark" id="hora_medicamentos_stat_prn" name="hora_medicamentos_stat_prn" value="{{ old('hora_medicamentos_stat_prn', $controle->hora_medicamentos_stat_prn) }}">
                                        @if ($errors->has('hora_medicamentos_stat_prn'))
                                            <div class="text-danger">{{ $errors->first('hora_medicamentos_stat_prn') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="fecha_medicamentos_stat_prn">Fecha Medicamentos STAT/PRN</label>
                                        <input type="date" class="form-control edit_imput text-dark" id="fecha_medicamentos_stat_prn" name="fecha_medicamentos_stat_prn" value="{{ old('fecha_medicamentos_stat_prn', $controle->fecha_medicamentos_stat_prn) }}">
                                        @if ($errors->has('fecha_medicamentos_stat_prn'))
                                            <div class="text-danger">{{ $errors->first('fecha_medicamentos_stat_prn') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group">
                                        <label for="nombre_enfermera_codigo">Nombre y Código de la Enfermera</label>
                                        <input type="text" class="form-control edit_imput text-dark" id="nombre_enfermera_codigo" name="nombre_enfermera_codigo" value="{{ old('nombre_enfermera_codigo', $controle->nombre_enfermera_codigo) }}">
                                        @if ($errors->has('nombre_enfermera_codigo'))
                                            <div class="text-danger">{{ $errors->first('nombre_enfermera_codigo') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <div class="modal-footer">
                              
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                    </form>
    
                   
        
                    
                </div>
    
               
            </div>
        </div>
    

 <br>



  </div>
</div>


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
  document.addEventListener("DOMContentLoaded", function () {
  const toggleSwitch = document.getElementById('theme-toggle');
  const modeText = document.getElementById('mode-text');
  const breadcrumb = document.getElementById('breadcrumb');

  function switchTheme(e) {
    if (e.target.checked) {
      // Tema oscuro
      document.body.classList.add('dark-mode');
      document.body.classList.remove('light-mode');
      modeText.textContent = 'modo claro';
      breadcrumb.classList.remove('bg-white', 'text-light');
      breadcrumb.classList.add('bg-dark', 'text-white');
      localStorage.setItem('theme', 'dark'); // Guardar la preferencia en localStorage
    } else {
      // Tema claro
      document.body.classList.add('light-mode');
      document.body.classList.remove('dark-mode');
      modeText.textContent = 'modo oscuro';
      breadcrumb.classList.remove('bg-dark', 'text-white');
      breadcrumb.classList.add('bg-white', 'text-light');
      localStorage.setItem('theme', 'light'); // Guardar la preferencia en localStorage
    }
  }

  // Aplicar el tema guardado en localStorage al cargar la página
  const currentTheme = localStorage.getItem('theme');

  if (currentTheme === 'dark') {
    toggleSwitch.checked = true;
    document.body.classList.add('dark-mode');
    document.body.classList.remove('light-mode');
    modeText.textContent = 'modo claro';
    breadcrumb.classList.remove('bg-white', 'text-light');
    breadcrumb.classList.add('bg-dark', 'text-white');
  } else if (currentTheme === 'light') {
    toggleSwitch.checked = false;
    document.body.classList.add('light-mode');
    document.body.classList.remove('dark-mode');
    modeText.textContent = 'modo oscuro';
    breadcrumb.classList.remove('bg-dark', 'text-white');
    breadcrumb.classList.add('bg-white', 'text-light');
  } else {
    // Si no hay tema guardado, aplicar el tema basado en la preferencia del sistema
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      toggleSwitch.checked = true;
      document.body.classList.add('dark-mode');
      breadcrumb.classList.remove('bg-white', 'text-light');
      breadcrumb.classList.add('bg-dark', 'text-white');
      modeText.textContent = 'modo claro';
    } else {
      toggleSwitch.checked = false;
      document.body.classList.add('light-mode');
      breadcrumb.classList.remove('bg-dark', 'text-white');
      breadcrumb.classList.add('bg-white', 'text-light');
      modeText.textContent = 'modo oscuro';
    }
  }

  // Event listener para el cambio de tema
  toggleSwitch.addEventListener('change', switchTheme);
});


// Initial call to set the date and time
updateDateTime();

// Update date and time every second
setInterval(updateDateTime, 1000);


</script>
@stop
</section>
</body>
</html>

<section>
