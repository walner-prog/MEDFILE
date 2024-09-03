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
<body>
    
</body>
</html>
    
  @extends('adminlte::page')
    
  @section('title', 'MEDFILE')
  
  
  
  

  @section('content')
  <div class="container mt-2">
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Estadiscas de  Doctores</li>
                </ol>
            </nav>
        </div>
        
    </div>
    
     <div class="row">
        <div class="col-lg-2">
           
        </div>

       
        <div class="col-lg-6   text-right mr-auto">
            <h4 class="mb-2 text-dark">Consulte datos estadisticos  </h4>
        </div>
        <div class="col-lg-2 d-flex justify-content-end align-items-center">

        </div>
        
     </div>
     
   
    
    <br>
    

    <div class="container">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul id="data-nav" class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-target="doctores_especialidad_con_mas_doctores">Especialidad con Más Doctores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="doctores_recientes">Doctores Recientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="doctores-por-especialidad">Doctores por Especialidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="especialidades_con_doctores">Especialidades con Doctores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="departamentos_con_doctores">Departamentos con Doctores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="consulta_total_por_especialidad">Consulta Total por Especialidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="promedio_consultas_general">Promedio Consultas General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="doctores_con_promedio_consultas">Doctores con Promedio Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-target="promedio_consultas_por_especialidad">Promedio Consultas por Especialidad</a>
                    </li>
                </ul>
            </div>
        </nav>
        
    
        <!-- Contenedor dinámico donde se cargará el contenido -->
        <div id="content-area" class="mt-4">
            <!-- Aquí se cargará el contenido de las vistas parciales -->
        </div>
    </div>


    <div class="container">
        <h1>Doctores con Menos de {{ $maxPatients }} Pacientes</h1>

        @if($doctores->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Pacientes Asociados</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctores as $doctor)
                        <tr>
                            <td>{{ $doctor->id }}</td>
                            <td>{{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }} {{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }}</td>
                            <td>{{ $doctor->especialidad->nombre ?? 'No asignada' }}</td>
                            <td>{{ $doctor->pacientes_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $doctores->links() }}
        @else
            <p>No hay doctores con menos de {{ $maxPatients }} pacientes.</p>
        @endif
    </div>
</div>


    


  </div>

<br>
<br>

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


$( "#notify" ).click(function() {
         $( "#notification" ).fadeIn().delay(2000).fadeOut();
       });


    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif
    

//aca llenamos la tabla de doctor por su id 

$(document).ready(function() {
    $('#doctor_id').change(function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/api/doctores/' + doctorId,
                type: 'GET',
                success: function(response) {
                    var newRow = `
                        <tr class="bg-gradient-info">
                            <td>${response.codigo}</td>
                            <td>${response.primer_nombre} ${response.segundo_nombre}</td>
                            <td>${response.primer_apellido} ${response.segundo_apellido}</td>
                            <td>${response.especialidad || 'No disponible'}</td>
                            <td>${response.departamento || 'No disponible'}</td>
                            <td>${response.cedula}</td>
                            <td>${response.telefono}</td>
                            <td>${response.email}</td>
                            <td>${response.estado}</td>
                            <td>${response.fecha_contratacion}</td>
                        </tr>
                    `;

                    // Añade la nueva fila a la tabla
                    $('#doctor_table tbody').html(newRow);
                },
                error: function(xhr) {
                    console.error('Error al obtener los datos del doctor:', xhr.responseText);
                }
            });
        }
    });
});

// aca llenamos la card de doctor por su id 
$(document).ready(function() {
    $('#doctor_id').change(function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/api/doctores/' + doctorId,
                type: 'GET',
                success: function(response) {
                    // Actualiza los datos del doctor
                    $('#info_codigo').text(response.codigo);
                    $('#info_primer_nombre').text(response.primer_nombre);
                    $('#info_segundo_nombre').text(response.segundo_nombre);
                    $('#info_primer_apellido').text(response.primer_apellido);
                    $('#info_segundo_apellido').text(response.segundo_apellido);
                    $('#info_no_cedula').text(response.cedula);
                    $('#info_telefono').text(response.telefono);
                    $('#info_email').text(response.email);
                    $('#info_especialidad').text(response.especialidad);
                    $('#info_departamento').text(response.departamento);
                    $('#info_fecha_contratacion').text(response.fecha_contratacion);
                    $('#info_estado').text(response.estado);
                    $('#info_horario_trabajo').text(response.horario_trabajo);
                    $('#info_direccion').text(response.direccion);
                    $('#info_fecha_nacimiento').text(response.fecha_nacimiento);
                    $('#info_sexo').text(response.sexo);
                    $('#info_usuario_id').text(response.usuario_id);

                    // Comprueba si existe una especialidad asociada
                    if (response.especialidad) {
                        // Inserta el botón en el DOM
                        $('#button-especialidad-container').html(`
                            <a href="/especialidades/${response.especialidad_id}" target="_blank" class="btn btn-purple btn-sm d-inline-block mr-2" style="height: auto">
                                Ver Especialidad
                            </a>
                        `);
                    } else {
                        $('#button-especialidad-container').html(`
                            <span class="text-white alert-danger p-2 d-inline-block mr-2">Este doctor no tiene una especialidad asociada.</span>
                        `);
                    }

                    // Comprueba si existe un departamento asociado
                    if (response.departamento) {
                        // Inserta el botón en el DOM
                        $('#button-departamento-container').html(`
                            <a href="/departamentos/${response.departamento_id}" target="_blank" class="btn btn-green btn-sm d-inline-block" style="height: auto">
                                Ver Departamento
                            </a>
                        `);
                    } else {
                        $('#button-departamento-container').html(`
                            <span class="text-white alert-danger p-2 d-inline-block">Este doctor no tiene un departamento asociado.</span>
                        `);
                    }
                },
                error: function(xhr) {
                    // Manejo de errores
                    $('#info').html('<p class="text-danger">Error al obtener los datos del doctor.</p>');
                }
            });
        }
    });
});




// aca tengo el buscador para doctor 

$(document).ready(function() {
    function fetchDoctores(page = 1) {
        var query = $('#buscar_doctor').val();
        if (query.length > 2) {
            $.ajax({
                url: "{{ route('buscardoctor') }}",
                type: "GET",
                data: {'query': query, 'page': page},
                success: function(data) {
                    $('#lista_doctores').empty();
                    if (data.data.length > 0) {
                        $.each(data.data, function(index, doctor) {
                            $('#lista_doctores').append('<a href="#" class="list-group-item list-group-item-action custom-list-item" data-id="' + doctor.id + '">' + doctor.primer_nombre + ' ' + doctor.segundo_nombre + ' ' + doctor.primer_apellido + ' ' + doctor.segundo_apellido + ' (' + doctor.cedula + ')</a>');
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

                        $('#lista_doctores').append(pagination);
                    } else {
                        $('#lista_doctores').append('<a href="#" class="list-group-item list-group-item-action disabled">No se encontraron resultados</a>');
                    }
                }
            });
        } else {
            $('#lista_doctores').empty();
        }
    }

    $('#buscar_doctor').on('keyup', function() {
        fetchDoctores();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        fetchDoctores(page);
    });

    $(document).on('click', '.list-group-item-action', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nombre = $(this).text();

        $('#doctor_id').empty().append('<option value="' + id + '" selected>' + nombre + '</option>');
        $('#doctor_id').change();
        $('#lista_doctores').empty();
        $('#buscar_doctor').val('');
    });

    $('#doctor_id').change(function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/api/doctores/' + doctorId,
                type: 'GET',
                success: function(response) {
                    $('#codigo').val(response.codigo);
                    $('#especialidad').val(response.especialidad);
                    $('#departamento').val(response.departamento);
                    $('#primer_nombre').val(response.primer_nombre);
                    $('#segundo_nombre').val(response.segundo_nombre);
                    $('#primer_apellido').val(response.primer_apellido);
                    $('#segundo_apellido').val(response.segundo_apellido);
                    $('#no_cedula').val(response.cedula);
                    $('#telefono').val(response.telefono);
                }
            });
        }
    });

    function verificarEspecialidad(doctorId) {
        $.ajax({
            url: '/api/doctores/comprobar-especialidad/' + doctorId,
            type: 'GET',
            success: function(response) {
                if (response.tiene_especialidad) {
                    var fechaAsignacion = new Date(response.fecha_asignacion);
                    var ahora = new Date();
                    var diferenciaTiempo = Math.abs(ahora - fechaAsignacion);
                    var diasTranscurridos = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24));

                    Swal.fire({
                        title: '¡Doctor con Especialidad!',
                        text: `Este doctor tiene una especialidad asignada el ${response.fecha_asignacion}. Han transcurrido ${diasTranscurridos} días desde entonces.`,
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#data-nav .nav-link').forEach(function(navLink) {
        navLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Quitar la clase active de todos los enlaces y agregarla al enlace actual
            document.querySelectorAll('#data-nav .nav-link').forEach(function(link) {
                link.classList.remove('active');
            });
            navLink.classList.add('active');

            // Obtener el target del enlace
            const target = navLink.getAttribute('data-target');

            // Hacer la petición AJAX para cargar el contenido
            fetch(`${target}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('content-area').innerHTML = html;
                })
                .catch(error => console.error('Error al cargar el contenido:', error));
        });
    });

    // Cargar el contenido inicial (puedes elegir cuál se carga primero)
    document.querySelector('#data-nav .nav-link.active').click();
});

  </script>
  @stop
</section>



