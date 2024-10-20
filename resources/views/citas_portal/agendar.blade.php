<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')

@section('content')
 
<div class="container">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />

  
      
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('info'))
<div class="alert alert-success">
    {{ session('info') }}
</div>
@endif

@if (session('delete'))
    <div class="alert alert-warning">
        {{ session('delete') }}
    </div>
@endif 

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
            <ol id="breadcrumb" class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Hogar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row" data-aos="fade-right"
     data-aos-offset="500"
     data-aos-easing="ease-in-sine">
    <!-- Imagen -->
    <div class="col-lg-6 mb-3">
        <img src="{{ asset('assets/img/citas.jpeg') }}" alt="Descripción de la imagen" class="img-fluid" />
    </div>

    <!-- Formulario con borde y íconos -->
    <div class="col-lg-6" >
        <div class="card">
            <div class="card-body">
                <form action="{{ route('citas.stores') }}" method="POST" id="citaForm">
                    @csrf
                    
                    <!-- Selección de Doctor -->
                    <div class="form-group">
                        <label for="doctor_id" class="font-weight-bold"><i class="fas fa-user-md"></i> Doctor</label>
                        <select class="form-control" id="doctor_id" name="doctor_id" required>
                            <option value="">Seleccionar doctor...</option>
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->primer_nombre }}
                                    {{ $doctor->segundo_nombre }} {{ $doctor->primer_apellido }}
                                    {{ $doctor->segundo_apellido }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                            <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                        @endif
                    </div>

                    <!-- Fecha de la Cita -->
                    <div class="form-group">
                        <label for="fecha_cita" class="font-weight-bold"><i class="fas fa-calendar-alt"></i> Fecha <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
                        @if ($errors->has('fecha_cita'))
                            <div class="text-danger">{{ $errors->first('fecha_cita') }}</div>
                        @endif
                    </div>

                    <!-- Hora de la Cita -->
                    <div class="form-group">
                        <label for="hora_cita" class="font-weight-bold"><i class="fas fa-clock"></i> Hora de la cita <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="hora_cita" name="hora_cita" required>
                        @if ($errors->has('hora_cita'))
                            <div class="text-danger">{{ $errors->first('hora_cita') }}</div>
                        @endif
                    </div>
                    <div id="horariosDisponibles"></div>

                    <!-- Tipo de Cita -->
                    <div class="form-group">
                        <label for="tipo_cita" class="font-weight-bold"><i class="fas fa-file-medical"></i> Tipo de Cita <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipo_cita" name="tipo_cita" required>
                            <option value="consulta">Consulta</option>
                            <option value="control">Control</option>
                            <option value="emergencia">Emergencia</option>
                        </select>
                        @if ($errors->has('tipo_cita'))
                            <div class="text-danger">{{ $errors->first('tipo_cita') }}</div>
                        @endif
                    </div>

                    <!-- Estado de la Cita -->
                    <div class="form-group">
                        <label for="estado" class="font-weight-bold"><i class="fas fa-flag"></i> Estado <span class="text-danger">*</span></label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="por confirmar">Por Confirmar</option>
                            <option value="confirmada">Confirmada</option>
                          
                        </select>
                        @if ($errors->has('estado'))
                            <div class="text-danger">{{ $errors->first('estado') }}</div>
                        @endif
                    </div>

                    

                    <!-- Duración de la Cita -->
                    <div class="form-group">
                        <label for="duracion" class="font-weight-bold"><i class="fas fa-hourglass-half"></i> Duración de la cita <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" value="30" id="duracion" name="duracion" readonly>
                        @if ($errors->has('duracion'))
                            <div class="text-danger">{{ $errors->first('duracion') }}</div>
                        @endif
                    </div>

                    <!-- Botones de Acción -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Guardar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>


<br>

    </div>
@endsection
@section('js')

<!-- Cargar jQuery (solo una vez) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables y extensiones -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    @livewireScripts

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<!-- Script de Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializa Select2
    $('#doctor_select').select2();

    // Detecta el cambio de doctor seleccionado y carga los horarios
    $('#doctor_select').change(function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/obtener_horarios_doctor/' + doctorId,
                type: 'GET',
                success: function(data) {
                    $('#horarios_disponibles').html(data); // Actualiza la tabla de horarios
                },
                error: function() {
                    alert('Error al obtener los horarios.');
                }
            });
        }
    });

    // Validación de la fecha de cita
    $('#fecha_cita').on('change', function() {
        const selectedDate = this.value;
        const today = new Date().toISOString().slice(0,10);
        if (selectedDate < today) {
            this.value = null;
            alert('No se puede reservar en una fecha pasada.');
        }
    });

    // Verificación de la hora de cita
    $('#hora_cita').on('change', function() {
        let selectedTime = this.value.split(':')[0] + ':00';
        this.value = selectedTime;
        if (selectedTime < '08:00' || selectedTime > '20:00') {
            this.value = null;
            alert('Seleccione una hora entre 08:00 y 20:00.');
        }
    });
});


@if(session('error'))
        <script>
            swal({
                title: "¡Error!",
                text: "{{ session('error') }}",
                icon: "error",
                button: "Cerrar",
                timer: 5000,
                closeOnClickOutside: false,
            });
        </script>
    @endif
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: [
            @foreach($citas as $cita)
            {
                title: '{{ $cita->title }}',
                start: '{{ \Carbon\Carbon::parse($cita->start)->format('Y-m-d') }}',
                end: '{{ \Carbon\Carbon::parse($cita->end)->format('Y-m-d') }}',
                color: '#e82216'
            },
            @endforeach
        ]
    });
    calendar.render();
});

 <script>
  AOS.init();
</script>




@stop

@section('css')
   <style>
    .search-bar {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}
.card {
  border-radius: 15px;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.card-title {
  font-size: 1.5rem;
}

.card-text {
  font-size: 1.1rem;
}

.b-pagination {
  justify-content: center;
}

.services {
  text-align: center;
}

.btn {
  width: 100%;
  transition: background-color 0.3s ease;
}

.btn:hover {
  filter: brightness(90%);
}


.bt-cyan {
  background-color: #06b6d4; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario {
  background-color: #0071bc; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario:hover {
  background-color: #09466FFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-indigo {
  background-color: #9F1FFBFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-indigo:hover {
  background-color: #720394FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario {
  background-color: #7ac943; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario:hover {
  background-color: #63A534FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-tercer {
  background-color: #29abe2; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-tercer:hover {
  background-color: #2187B3FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}
   </style>
@stop