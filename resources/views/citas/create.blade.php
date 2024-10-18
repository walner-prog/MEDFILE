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
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
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
    
</head>
<body>
    
        
@extends('adminlte::page')

@section('title', 'crear-cita')



@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0 text-light">
                    <li class="breadcrumb-item">Inicio</li>
                    <li class="breadcrumb-item active" aria-current="page">Registrar  Cita</li>
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
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf
            <div class="container">
                <h4 class="text-primary mb-4">Registrar  Cita Medica</h4>
             <style>
                .select2-container {
                  width: 60% !important; /* Asegura que Select2 use el 100% del contenedor */
                   }
             </style>
                <div class="row mb-3">
                    <!-- Doctor -->
                    <div class="col-lg-6 col-md-12">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
                            <option value="">Seleccione un doctor</option>
                            @foreach ($doctores as $doctor)
                                <option class=" w-100" value="{{ $doctor->id }}">{{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }} 
                                    {{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
    
                    <!-- Paciente -->
                    <div class="col-lg-6 col-md-12">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select name="paciente_id" id="paciente_id" class="form-select @error('paciente_id') is-invalid @enderror" required>
                            <option value="">Seleccione un paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->primer_nombre }} {{ $paciente->segundo_nombre }}  
                                    {{ $paciente->primer_apellido }}  {{ $paciente->segundo_apellido }}</option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <!-- Fecha de Cita -->
                    <div class="col-lg-4 col-md-6">
                        <label for="fecha_cita" class="form-label">Fecha de Cita</label>
                        <input type="date" name="fecha_cita" id="fecha_cita" class="form-control @error('fecha_cita') is-invalid @enderror" required>
                        @error('fecha_cita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Hora de Cita -->
                    <div class="col-lg-4 col-md-6">
                        <label for="hora_cita" class="form-label">Hora de Cita</label>
                        <input type="time" name="hora_cita" id="hora_cita" class="form-control @error('hora_cita') is-invalid @enderror" required>
                        @error('hora_cita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Duración -->
                    <div class="col-lg-4 col-md-12">
                        <label for="duracion" class="form-label">Duración (minutos)</label>
                        <input type="number" name="duracion" id="duracion" class="form-control @error('duracion') is-invalid @enderror" required min="30">
                        @error('duracion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <!-- Tipo de Cita -->
                    <div class="col-lg-6 col-md-12">
                        <label for="tipo_cita" class="form-label">Tipo de Cita</label>
                        <input type="text" name="tipo_cita" id="tipo_cita" class="form-control @error('tipo_cita') is-invalid @enderror" required>
                        @error('tipo_cita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Estado -->
                    <div class="col-lg-6 col-md-12">
                        <label for="estado" class="form-control">Estado</label>
                        <select name="estado" id="estado" class="form-select form-select-lg @error('estado') is-invalid @enderror" required>
                            <option value="">Seleccione el estado</option>
                            <option value="por confirmar">Por Confirmar</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="en progreso">En Progreso</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="realizada">Realizada</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Crear Cita</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
                        


                          <!-- Doctor Calendar -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header from-green-500 to-green-600 text-white text-center p-2">
                    <h3 class="text-lg font-semibold card-title">Calendario de Atención de Doctores</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="consultorio_id">Consultorio</label>
                            <select class="form-control" id="consultorio_select" name="consultorio_id" required>
                                <option value="">Selecciona un consultorio</option>
                                @foreach ($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">
                                        {{ $consultorio->nombre . "- Ubicacion: " . $consultorio->ubicacion }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('consultorio_id'))
                                <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-white" id="consultorio_info"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Appointment Calendar -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header from-green-500 to-green-600 text-white text-center p-2">
                    <h3 class="text-lg font-semibold card-title">Calendario de Reservas de Citas Médicas</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="consultorio_id">Consultorio</label>
                            <select class="form-control" id="consultorio_select" name="consultorio_id" required>
                                <option value="">Selecciona un consultorio</option>
                                @foreach ($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">
                                        {{ $consultorio->nombre . "- Ubicacion: " . $consultorio->ubicacion }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('consultorio_id'))
                                <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
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
    
document.getElementById('fecha_cita').addEventListener('change', function() {
        const doctorId = document.getElementById('doctor_id').value;
        const fechaCita = document.getElementById('fecha_cita').value;

        if (doctorId && fechaCita) {
            fetch('/citas/obtener-horarios-disponibles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ doctor_id: doctorId, fecha_cita: fechaCita })
            })
            .then(response => response.json())
            .then(data => {
                const horariosDiv = document.getElementById('horariosDisponibles');
                horariosDiv.innerHTML = '';

                if (data.horarios.length > 0) {
                    data.horarios.forEach(horario => {
                        const horarioItem = document.createElement('p');
                        horarioItem.textContent = horario;
                        horariosDiv.appendChild(horarioItem);
                    });
                } else {
                    horariosDiv.innerHTML = '<p>No hay horarios disponibles para esta fecha.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

</script>
   
<script>
    $('#consultorio_select').on('change', function () {
         var consultorio_id = $('#consultorio_select').val();
         //alert(consultorio_id);
 
         var url = "{{ route('horarios-citas-consultorio', ':id') }}";
         url = url.replace(':id', consultorio_id);
 
         if (consultorio_id) {
             $.ajax({
                 url: url,
                 type: 'GET',
                 success: function (data) {
                     $('#consultorio_info').html(data);
                 },
                 error: function () {
                     alert('Error al obtener los datos del consultorio');
                 }
             });
         } else {
             $('#consultorio_info').html('');
         }
     });
 
 </script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: [
          @foreach($citas as $cita)
          {
            title: '{{ $cita->title }}',
            start: '{{ \Carbon\Carbon::parse( $cita->start)->format('Y-m-d') }}',
            end: '{{ \Carbon\Carbon::parse( $cita->end)->format('Y-m-d') }}',
        
            color: '#e82216'
          },
          @endforeach
        ]
      });
      calendar.render();
    });
  </script>

<script>
    $(document).ready(function() {
        // Inicializar select2 para el campo de doctor
        $('#doctor_id').select2({
            language: "es",
            placeholder: "Seleccione un médico",
            allowClear: true
        });

        // Inicializar select2 para el campo de paciente
        $('#paciente_id').select2({
            language: "es",
            placeholder: "Seleccione un paciente",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function () {
    // Validar fecha al momento de cambiar
    $('#fecha_cita').on('change', function () {
        let selectedDate = new Date($(this).val());
        let today = new Date();
        today.setHours(0, 0, 0, 0); // Poner la hora a las 00:00:00

        if (selectedDate < today) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha inválida',
                text: 'La fecha de la cita no puede ser menor que la fecha actual.',
            });
            $(this).val(''); // Limpiar el valor si es inválido
        }
    });

    // Validar hora al momento de cambiar
    $('#hora_cita').on('change', function () {
        let selectedTime = $(this).val();
        let startTime = '08:00'; // Hora mínima permitida
        let endTime = '20:00'; // Hora máxima permitida

        if (selectedTime < startTime || selectedTime > endTime) {
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
</body>
</html>
