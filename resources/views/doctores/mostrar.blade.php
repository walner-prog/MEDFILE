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

  </head>
 
  @extends('adminlte::page')
    
  @section('title', 'buscar-doctores')
  
  
  
  

  @section('content')
  <div class="container mt-2">
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Doctores</li>
                </ol>
            </nav>
        </div>
        
    </div>

    <div class="row">
        <div class="col-lg-12  text-center mr-auto">
            <img 
            src="{{ asset('storage/medfile3.jpeg') }}" 
            alt="logo" 
            class="img-fluid mb-4" 
            style="max-width: 1080px; height: auto;">
        </div>
    </div>
    
     <div class="row">
        <div class="col-lg-2">
           
        </div>

       
        <div class="col-lg-6   text-right mr-auto">
            <h4 class="mb-2 text-dark">Buscar   Doctores   registrados </h4>
        </div>
        <div class="col-lg-2 d-flex justify-content-end align-items-center">

        </div>
        
     </div>
     
      
    
    <br>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="form-group d-flex align-items-center">
                <i class="fa-solid fa-magnifying-glass fa-1x mb-1 mr-2"></i>
                <input type="text" class="form-control" id="buscar_doctor" placeholder="Buscar por nombre, cédula o código">
            </div>
            <small class="form-text text-muted">
                En el campo de búsqueda, al ingresar el nombre, cédula, o código del doctor, el sistema comenzará a filtrar automáticamente los registros disponibles en tiempo real, mostrando coincidencias relevantes para facilitar la selección del doctor deseado.
            </small>
            <div id="lista_doctores" class="list-group"></div>
        </div>
    
        <div class="col-lg-6" hidden>
            <div class="form-group">
                <label for="doctor_id">Doctor seleccionado</label>
                <select class="form-control" id="doctor_id" name="doctor_id" required>
                    <!-- Opciones llenadas por AJAX -->
                </select>
                @if ($errors->has('doctor_id'))
                    <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="table table-responsive mt-2">
        <table class="table table-striped table-bordered shadow-lg p-2 table-sm" id="doctor_table">
            <thead class=" bg-primary">
                <tr>
                    <th class="table-paciente">Código</th>
                    <th class="table-paciente">Nombre Completo</th>
                    <th class="table-paciente">Apellido Completo</th>
                    <th class="table-paciente">Especialidad</th>
                    <th class="table-paciente">Departamento</th>
                    <th class="table-paciente">No. Cédula</th>
                    <th class="table-paciente">Teléfono</th>
                    <th class="table-paciente">Email</th>
                    <th class="table-paciente">Estado</th>
                    <th class="table-paciente">Fecha de Contratación</th>
                </tr>
            </thead>
            <tbody class="card-cyan">
                <!-- Los detalles del doctor se insertarán aquí -->
            </tbody>
        </table>
    </div>
    
    <div class="row ml-2">
        <div id="datos-doctor" class="mb-3 mx-auto">
            <h4 class="ml-2">Datos del Doctor</h4>
            <div class="p-3 mb-2 border rounded datos-doctor bg-white">
                <div class="mb-2">
                    <strong class="color-primario">
                        <i class="fa-sharp fa-solid fa-id-badge color-primario"></i> Código:
                    </strong>
                    <span id="info_codigo" class="text-danger"></span>
                </div>
                <div class="mb-2">
                    <strong class="text-primary ml-2">
                        <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                    </strong>
                    <span id="info_primer_nombre" class="text-secondary"></span>
                    <span id="info_segundo_nombre" class="text-secondary"></span>
                    <span id="info_primer_apellido" class="text-secondary"></span>
                    <span id="info_segundo_apellido" class="text-secondary"></span>

                    <strong class="text-primary ml-2">Especialidad:</strong>
                    <span id="info_especialidad" class="text-secondary"></span>
                    <strong class="text-primary ml-2">Departamento:</strong>
                    <span id="info_departamento" class="text-secondary"></span>
                    <strong class="text-primary ml-2">No. Cédula:</strong>
                    <span id="info_no_cedula" class="text-secondary"></span>
                    <strong class="text-primary ml-2">Teléfono:</strong>
                    <span id="info_telefono" class="text-secondary"></span>
                </div>
                 <div id="button-container" class="d-inline-block"></div>
                 <div id="button-admision-container" class="d-inline-block"></div>
            </div>
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





    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif
    

$(document).ready(function() {
    $('#doctor_id').change(function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/api/doctores/' + doctorId,
                type: 'GET',
                success: function(response) {
                    var newRow = `
                        <tr class="bg-gradient-info ">
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




  </script>
  @stop
</section>



