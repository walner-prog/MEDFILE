
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
     
    @extends('adminlte::page')
    
  @section('title', 'MEDFILE')
  
  
  
  

  @section('content')
  <div class="container mt-2" >
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
                </ol>
            </nav>
        </div>
        
    </div>

    <div class="row">
        <div class="col-12 text-center">
            <img 
            src="{{ asset('storage/banner-medfile.jpeg') }}" 
            alt="logo" 
            class="img-fluid mb-4" 
            style="max-width: 100%; height: auto;">
        </div>
    </div>
    
    
     <div class="row">
        <div class="col-lg-2 d-flex justify-content-star">
           
                <a href="{{ route('upload-file.view') }}" class="btn btn-primary">
                    Analizar Examenes con la IA
                </a>
        </div>

       
        <div class="col-lg-6   text-right mr-auto">
            
            <h4 class="mb-2 text-dark">Consulta de pacientes  registrados </h4>
            
        </div>
           <div class="col-lg-2 d-flex justify-content-end align-items-center">
            <a href="{{ route('historias-clinicas.ia') }}" class="btn btn-primary">
                Analizar Historias Clínicas con IA
            </a>
            
          
        </div>
        
     </div>
     
      
    
    <br>
<div class="row">
    <!-- Campo para buscar y seleccionar un paciente -->
    <div class="col-lg-6 mx-auto">
      <div class="form-group d-flex align-items-center">
        <i class="fa-solid fa-magnifying-glass fa-1x mb-1 mr-2"></i>
        <input type="text" class="form-control" id="buscar_paciente" autocomplete="off" placeholder="Buscar por nombre, cédula o expediente">
      </div>
      <small class="form-text text-muted">
        En el campo de búsqueda, al ingresar el nombre, cédula, o número de expediente, el sistema comenzará a filtrar automáticamente los registros disponibles en tiempo real, mostrando coincidencias relevantes para facilitar la selección del paciente deseado.
      </small>
    <div id="lista_pacientes" class="list-group"></div>


    <div class="col-lg-6" hidden>
        <div class="form-group">
            <label for="paciente_id">Paciente seleccionado</label>
            <select class="form-control" id="paciente_id" name="paciente_id" required>
                <!-- Opciones llenadas por AJAX -->
            </select>
            @if ($errors->has('paciente_id'))
                <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
            @endif
        </div>
    </div> 
</div> 
<br>

  <div class="table table-responsive mt-2">
    <table class="min-w-full text-white table-bordered   border border-gray-300 shadow-md rounded-lg p-2" id="paciente_table">
        <thead class=" table- text-white">
            <tr>
                <th class="table-paciente"><i class="fas fa-file-alt "></i> No. Expediente</th>
                <th class="table-paciente"><i class="fas fa-user"></i> Nombre Completo</th>
                <th class="table-paciente"><i class="fas fa-user"></i> Apellido Completo</th>
                <th class="table-paciente"><i class="fas fa-birthday-cake"></i> Edad</th>
                <th class="table-paciente"><i class="fas fa-venus-mars"></i> Sexo</th>
                <th class="table-paciente"><i class="fas fa-id-card"></i> No. Cédula</th>
                <th class="table-paciente"><i class="fas fa-id-badge"></i> No. INSS</th>
                <th class="table-paciente"><i class="fas fa-heart"></i> Estado Civil</th>
                <th class="table-paciente"><i class="fas fa-users"></i> Raza/Etnia</th>
                <th class="table-paciente"><i class="fas fa-graduation-cap"></i> Escolaridad</th>
                <th class="table-paciente"><i class="fas fa-layer-group"></i> Categoría</th> 
               
            </tr>
        </thead>
        <tbody class=" card-cyan">
            <!-- Los detalles del paciente se insertarán aquí -->
        </tbody>
    </table>
  </div>
    
  
    <div class="row ml-2">

        <div id="datos-paciente" class="mb-3  mx-auto">
            <h4 class="ml-2">Datos del Paciente</h4>
            <div class="p-3 mb-2 border rounded datos-pacientes ">
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
    $('#paciente_id').change(function() {
        var pacienteId = $(this).val();
        if (pacienteId) {
            $.ajax({
                url: '/api/pacientes/' + pacienteId,
                type: 'GET',
                success: function(response) {
                    var historiaClinicaId = response.historia_clinica_id;

                    var newRow = `
                        <tr class="table-lago ">
                            <td>${response.no_expediente}</td>
                            <td>${response.primer_nombre} ${response.segundo_nombre}</td>
                            <td>${response.primer_apellido} ${response.segundo_apellido}</td>
                            <td>${response.edad}</td>
                            <td>${response.sexo}</td>
                            <td>${response.no_cedula}</td>
                            <td>${response.no_inss}</td>
                            <td>${response.estado_civil}</td>
                            <td>${response.raza_etnia}</td>
                            <td>${response.escolaridad}</td>
                            <td>${response.categoria}</td>
                            
                          
                        </tr>
                    `;

                    // Añade la nueva fila a la tabla
                    $('#paciente_table tbody').html(newRow);
                }
            });
        }
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
                    // Actualiza los datos del paciente
                    $('#info_no_expediente').text(response.no_expediente);
                    $('#info_primer_nombre').text(response.primer_nombre);
                    $('#info_segundo_nombre').text(response.segundo_nombre);
                    $('#info_primer_apellido').text(response.primer_apellido);
                    $('#info_segundo_apellido').text(response.segundo_apellido);
                    $('#info_edad').text(response.edad);
                    $('#info_sexo').text(response.sexo);
                    $('#info_no_cedula').text(response.no_cedula);
                    $('#info_no_inss').text(response.no_inss);

                    // Comprueba si existe una historia clínica asociada
                    if (response.tiene_historia_clinica) {
                        // Inserta el botón en el DOM
                        $('#button-container').html(`
                            <a href="/pacientes/${pacienteId}/historia_clinica" target="_blank" class="btn btn-purple btn-sm d-inline-block mr-2" style="height: auto">
                                Ver Historia Clínica
                            </a>
                        `);
                    } else {
                        $('#button-container').html(`
                            <span class="text-white alert-danger p-2 d-inline-block mr-2">Este paciente no tiene una historia clínica.</span>
                        `);
                    }

                    // Comprueba si existe un registro de admisión o egreso hospitalario asociado
                    if (response.tiene_registro_admision_egreso) {
                        // Inserta el botón en el DOM
                        $('#button-admision-container').html(`
                            <a href="/pacientes/${pacienteId}/registro_admision_egreso" target="_blank" class="btn btn-green btn-sm d-inline-block" style="height: auto">
                                Ver Registro de Admisión/Egreso
                            </a>
                        `);
                    } else {
                        $('#button-admision-container').html(`
                            <span class="text-white alert-danger p-2 d-inline-block">Este paciente no tiene un registro de admisión o egreso hospitalario.</span>
                        `);
                    }
                }
            });
        }
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
                    $('#municipio').val(response.municipio);
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
    
  