

<section>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
     
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/admin_c <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />ustom.css') }}">
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
    
@extends('adminlte::page')

@section('title', 'AdminSalud')



@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0 text-light">
                    <li class="breadcrumb-item">Inicio</li>
                    <li class="breadcrumb-item active" aria-current="page">Editar de Cita</li>
                </ol>
            </nav>
        </div>
    </div>
     <div class="row mb-3">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('citas.index') }}">
                <button class="btn btn-info ">
                    <i class="fas fa-house-medical-circle-check"></i> Regresar
                </button>
            </a>
           
        </div>
        <div class="col-lg-10 text-right">
        </div>
     </div>

      
                    
     <div class="card">
        <form action="{{ route('citas.update', $cita->id) }}" method="POST" id="citaForm">
            @csrf
            @method('PUT')
    
            <div class="row p-2">
                <!-- Columna de paciente (oculto) -->
                <div class="col-lg-6" hidden>
                    <div class="form-group">
                        <label for="paciente_id">Paciente seleccionado</label>
                        <select class="form-control" id="paciente_id" name="paciente_id" required>
                            <option value="{{ $cita->paciente->id }}" selected>{{ $cita->paciente->nombre_completo }}</option>
                        </select>
                        @if ($errors->has('paciente_id'))
                            <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                        @endif
                    </div>
                </div>
    
                <!-- Mostrar ID del paciente seleccionado (readonly) -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="paciente_id_id" class="font-weight-bold">ID Paciente Seleccionado</label>
                        <input type="number" class="form-control" id="paciente_id_id" name="paciente_id" value="{{ $cita->paciente_id }}" readonly required>
                        @if ($errors->has('paciente_id'))
                            <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                        @endif
                    </div>
                </div>
        
    
                <!-- Selección de doctor con Select2 -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="doctor_id" class="font-weight-bold">Doctor</label>
                        <select class="form-control select2" id="doctor_id" name="doctor_id" required>
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->id }}" {{ $doctor->id == $cita->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->primer_nombre }}  {{ $doctor->segundo_nombre }} 
                                     {{ $doctor->primer_apellido }}  {{ $doctor->segundo_apellido }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                            <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                        @endif
                    </div>
                </div>
           
    
          
                <!-- Validaciones personalizadas de fecha y hora -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_cita" class="font-weight-bold">Fecha <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" value="{{ $cita->fecha_cita }}" required>
                        @if ($errors->has('fecha_cita'))
                            <div class="text-danger">{{ $errors->first('fecha_cita') }}</div>
                        @endif
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hora_cita" class="font-weight-bold">Hora de la cita <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="hora_cita" name="hora_cita" value="{{ $cita->hora_cita }}" required>
                        @if ($errors->has('hora_cita'))
                            <div class="text-danger">{{ $errors->first('hora_cita') }}</div>
                        @endif
                    </div>
                </div>
            
    
          
                <!-- Tipo de Cita -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_cita" class="font-weight-bold">Tipo de Cita <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipo_cita" name="tipo_cita" required>
                            <option value="consulta" {{ $cita->tipo_cita == 'consulta' ? 'selected' : '' }}>Consulta</option>
                            <option value="control" {{ $cita->tipo_cita == 'control' ? 'selected' : '' }}>Control</option>
                            <option value="emergencia" {{ $cita->tipo_cita == 'emergencia' ? 'selected' : '' }}>Emergencia</option>
                        </select>
                        @if ($errors->has('tipo_cita'))
                            <div class="text-danger">{{ $errors->first('tipo_cita') }}</div>
                        @endif
                    </div>
                </div>
    
                <!-- Estado de la Cita -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado" class="font-weight-bold">Estado <span class="text-danger">*</span></label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="por confirmar" {{ $cita->estado == 'por confirmar' ? 'selected' : '' }}>Por Confirmar</option>
                            <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="en progreso" {{ $cita->estado == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                            <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            <option value="realizada" {{ $cita->estado == 'realizada' ? 'selected' : '' }}>Realizada</option>
                        </select>
                        @if ($errors->has('estado'))
                            <div class="text-danger">{{ $errors->first('estado') }}</div>
                        @endif
                    </div>
                </div>
         
    
         
                <!-- Descripción de la Cita -->
                <div class="col-10">
                    <div class="form-group">
                        <label for="descripcion_cita" class="font-weight-bold">Descripción</label>
                        <textarea class="form-control" id="descripcion_cita" name="descripcion_cita" rows="3">{{ $cita->descripcion_cita }}</textarea>
                    </div>
                </div>
    
                <!-- Duración de la Cita -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duracion" class="font-weight-bold">Duración de la cita <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="duracion" name="duracion" value="{{ $cita->duracion }}" required>
                        @if ($errors->has('duracion'))
                            <div class="text-danger">{{ $errors->first('duracion') }}</div>
                        @endif
                    </div>
                </div>
            </div>
    
            <!-- Botones de Acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar Cita</button>
            </div>
        </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/es.js"></script>

    <script>
    $(document).ready(function() {
        // Inicializar Select2 para los doctores
        $('#doctor_id').select2({
            language: "es",
            placeholder: "Seleccione un médico",
            allowClear: true
        });


        // Validación de fecha y hora antes de enviar el formulario
        $('#citaForm').submit(function(e) {
            let fechaCita = new Date($('#fecha_cita').val());
            let hoy = new Date();

            if (fechaCita < hoy) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la fecha',
                    text: 'La fecha de la cita no puede ser anterior a hoy.'
                });
            }
        });

        // Mostrar SweetAlert al enviar correctamente
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Cita actualizada!',
                text: '{{ session('success') }}',
            });
        @endif
    });
</script>

<script>
    $(document).ready(function () {
        // Validar y ajustar la hora al momento de cambiar
        $('#hora_cita').on('change', function () {
            let selectedTime = $(this).val();
            
            // Extraemos las horas y minutos del valor seleccionado
            let [hours, minutes] = selectedTime.split(':');
            hours = parseInt(hours);
            minutes = parseInt(minutes);
            
            // Ajustar minutos a intervalos de 30 minutos
            let originalTime = selectedTime;
            if (minutes < 15) {
                minutes = '00';
            } else if (minutes >= 15 && minutes < 45) {
                minutes = '30';
            } else {
                // Redondear hacia la siguiente hora
                minutes = '00';
                hours = (hours + 1) % 24; // Ajustar para que no pase de 24 horas
            }
    
            // Formatear la nueva hora
            let adjustedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);
    
            // Si se hizo un ajuste en la hora, mostramos la alerta
            if (adjustedTime !== originalTime) {
                Swal.fire({
                    icon: 'info',
                    title: 'Ajuste de Horario',
                    text: `El horario fue ajustado automáticamente a las ${adjustedTime}. Las citas deben ser en intervalos de 30 minutos.`,
                    showConfirmButton: true,
                    timer: 5000 // El alert se cierra automáticamente después de 5 segundos
                });
            }
    
            // Asignar el nuevo valor al campo de hora
            $(this).val(adjustedTime);
    
            // Validar que la hora esté entre 08:00 y 20:00
            let startTime = '08:00';
            let endTime = '20:00';
    
            if (adjustedTime < startTime || adjustedTime > endTime) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hora inválida',
                    text: 'La hora de la cita debe estar entre las 8:00 a.m. y las 8:00 p.m.',
                });
                $(this).val(''); // Limpiar el valor si es inválido
            }
        });
    });
    
    
    </script>
@stop
</section>