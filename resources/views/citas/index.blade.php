
<!DOCTYPE html>
<html lang="en">
    <head>
       
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
   
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
<div class="container mt-4 toggle-container">
    <br>

    <!-- Breadcrumb Navigation -->
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0 text-light">
                    <li class="breadcrumb-item">Inicio</li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de Citas</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Create Cita Button -->
    <div class="row">
        <div class="col-lg-2">
            @can('create', App\Models\Cita::class)
            <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createCitaForm">
                <i class="fas fa-plus"></i> Crear Cita
            </button>
            @endcan
        </div>
    </div>

    <!-- Session Feedback -->
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

    <!-- Citas Table -->
    <div class="table-responsive">
        <table id="citasTable" class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2">
            <thead class="from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200"># Expediente</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Paciente</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Doctor</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Especialidad</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Fecha</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Hora</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Estado</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                </tr>
            </thead>
            <tbody class="bordered-rows divide-y divide-gray-200">
                <!-- Data dynamically loaded via server-side Datatable -->
            </tbody>
        </table>
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

    <!-- Create Appointment Modal -->
    <div class="modal fade" id="createCitaForm" tabindex="-1" role="dialog" aria-labelledby="createCitaFormModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row w-100">
                        <div class="col-lg-8">
                            <h5 class="modal-title text-white" id="createCitaFormModalLabel">Programar Nueva Cita Médica</h5>
                        </div>
                        <div id="datos-paciente" class="col-lg-12 mt-3">
                            <h4 class="text-white">Datos del Paciente</h4>
                            <div class="p-3 mb-2 border rounded datos-pacientes bg-light">
                                <!-- Patient Info -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('citas.store') }}" method="POST" id="citaForm">
                        @csrf
                        <!-- Form Content -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cita</button>
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
    $('#citasTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/citas') }}", // Reemplaza con la URL correcta para tu API de citas
 columns: [
    { data: 'id' },
    { data: 'no_expediente',
        render: function (data, type, row) {
            return `<span class="text-primary font-weight-bold">${data}</span> <span class="badge badge-info">EXP</span>`;
        },
    },
    { data: 'paciente_id' }, // Asumiendo que tienes un método 'nombre_completo' en el modelo Paciente
    { data: 'doctor_id' },   // Similar para el doctor
    { data: 'especialidad_id' }, // Para mostrar el nombre de la especialidad del doctor
    { data: 'fecha_cita' },
    { data: 'hora_cita' },
    { data: 'estado' },
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
                            { text: 'Tabla de Citas \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                            '<h3>Tabla de Citas</h3>' +
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
        ]
    });

    // Manejar la eliminación de registros con SweetAlert
    $('#citasTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('citas') }}/" + id;
        
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
                        $('#citasTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Eliminado!',
                            'La cita ha sido eliminada.',
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


$(document).ready(function() {
    // Función para cargar los pacientes
  

    // Función para cargar los doctores
    function cargarDoctores() {
        $.ajax({
            url: "{{ url('api/doctores/citas') }}",
            method: 'GET',
            success: function(data) {
                var $selectDoctor = $('#doctor_id');
                $selectDoctor.empty(); // Limpiar el select antes de cargar nuevos datos
                $selectDoctor.append('<option value="">Seleccionar doctor...</option>'); // Agregar una opción predeterminada
                $.each(data, function(index, doctor) {
                    $selectDoctor.append(`<option value="${doctor.id}">${doctor.primer_nombre} ${doctor.segundo_nombre} ${doctor.primer_apellido} ${doctor.segundo_apellido} - ${doctor.especialidad_id}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar los doctores:', error);
            }
        });
    }
    
    // Cargar especialidades
    $.ajax({
        url: '/api/especialidades/citas',
        method: 'GET',
        success: function(data) {
            $('#especialidad_id').empty();
            $('#especialidad_id').append('<option value="" disabled selected>Seleccione una Especialidad</option>');
            data.forEach(function(especialidad) {
                $('#especialidad_id').append('<option value="'+ especialidad.id +'">'+ especialidad.nombre +'</option>');
            });
        },
        error: function() {
            alert('Error al cargar especialidades.');
        }
    });

    

    // Llamar a las funciones para cargar los datos cuando la página esté lista
    cargarDoctores();
   
  
});





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
    document.addEventListener('DOMContentLoaded',function (){
        const fechaReservaInput=document.getElementById('fecha_cita');

        //Escuchar el evento de cambio en el campo de fecha reserva
        fechaReservaInput.addEventListener('change',function (){
            let selectedDate=this.value;//Obtener la Fecha seleccionada
            //Obtener la fecha actual en formato ISO (yyyy-mm-dd)
            let today=new Date().toISOString().slice(0,10);
            //Verificar si la fecha seleccionada es anterior a la fecha actual
            if (selectedDate < today){
                //Si es así, establecer la fecha seleccionada en null
                this.value=null;
                alert ('No se puede reservar en una fecha pasada.');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const horaReservaInput = document.getElementById('hora_cita');

        horaReservaInput.addEventListener('change', function () {
            let selectedTime = this.value; // Obtener el valor de la hora seleccionada

            // Asegurar que solo se capture la parte de la hora
            if (selectedTime) {
                selectedTime = selectedTime.split(':'); // Dividir la cadena en horas y minutos
                selectedTime = selectedTime[0] + ':00'; // Conservar solo la hora, ignorar los minutos
                this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
            }

            // Verificar si la hora seleccionada está fuera del rango permitido
            if (selectedTime < '08:00' || selectedTime > '20:00') {
                // Si es así, establecer la hora seleccionada en null
                this.value = null;
                alert('Por favor, seleccione una hora entre las 08:00 y las 20:00.');
            }
        });
    });
</script>

<script>
    
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
                            $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action custom-list-item" data-id="' + paciente.id + '">' + paciente.primer_nombre + ' ' + paciente.segundo_nombre + ' ' + paciente.primer_apellido + ' ' + paciente.segundo_apellido + ' (' + paciente.no_cedula + ')</a>');
                        });

                        var pagination = '<nav class="pagination-container" aria-label="Page navigation"><ul class="pagination">';
                        
                        if (data.prev_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="1">Primera</a></li>';
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page - 1) + '">Anterior</a></li>';
                        }

                        var startPage = Math.max(data.current_page - 2, 1);
                        var endPage = Math.min(data.current_page + 2, data.last_page);

                        if (startPage > 1) {
                            pagination += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }

                        for (var i = startPage; i <= endPage; i++) {
                            pagination += '<li class="page-item ' + (i === data.current_page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                        }

                        if (endPage < data.last_page) {
                            pagination += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }

                        if (data.next_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page + 1) + '">Siguiente</a></li>';
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + data.last_page + '">Última</a></li>';
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

        $('#paciente_id').empty().append('<option value="' + id + '" selected>' + nombre + '</option>');
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
                    // Actualiza otros campos con la información del paciente
                $('#paciente_id_id').val(response.id);
                // Agrega aquí el resto de los campos
                    $('#no_expediente').val(response.no_expediente);
                    $('#edad').val(response.edad);
                    $('#sexo').val(response.sexo);
                    $('#no_cedula').val(response.no_cedula);
                    $('#no_inss').val(response.no_inss);
                    $('#primer_nombre').val(response.primer_nombre);
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





