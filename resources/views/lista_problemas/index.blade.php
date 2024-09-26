<!DOCTYPE html>
<html lang="en">
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
<body>
    
</body>
</html>
   
  @extends('adminlte::page')
    
  @section('title', 'MEDFILE')


  @section('content')
  <div class="container mt-4 toggle-container">
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registros de Lista de Problemas de pacientes Ingresados </li>
                </ol>
            </nav>
        </div>
        
    </div>
     <div class="row">
         <div class="col-lg-2">
             @can('create', App\Models\ListaProblema::class)
             <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createListaProblemasForm">
               <i class="fas fa-plus"></i> Crear Problema
           </button>
             @endcan
         </div>
 
         <div class="col-lg-2">
            
         </div>
         <div class="col-lg-2">
             
         </div>
         <div class="col-lg-2 text-right">
            
         </div>
         
     </div>
 
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
 
      <div class="table-responsive">
        <!-- HTML -->
<table id="listaProblemasTable" class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2">
    <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
        <tr>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Nombre</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Apellido</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Edad</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Servicio</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Sala</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Fecha</th>
            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <!-- DataTable will populate this -->
    </tbody>
</table>

     </div>

     
     <div class="modal fade" id="createListaProblemasForm" tabindex="-1" role="dialog" aria-labelledby="createListaProblemasFormModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="row">

                   <div class="col-lg-8">
                    <h5 class="modal-title text-white" id="createListaProblemasFormModalLabel">Crear Problema de Paciente</h5>
                   </div>
                    
                    <div id="datos-paciente" class="mb-3">
                        <h4>Datos del Paciente</h4>
                        <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
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
                        </div>
                    </div>
                    
                </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lista_problemas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-3 form-group" hidden>
                                <label for="primer_nombre">Primer Nombre</label>
                                <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" readonly>
                                @if ($errors->has('primer_nombre'))
                                    <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="segundo_nombre">Segundo Nombre</label>
                                <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" readonly>
                                @if ($errors->has('segundo_nombre'))
                                    <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="primer_apellido">Primer Apellido</label>
                                <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" readonly>
                                @if ($errors->has('primer_apellido'))
                                    <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-3 form-group" hidden>
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}" readonly>
                                @if ($errors->has('segundo_apellido'))
                                    <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="buscar_paciente" class="bold">Buscar Paciente</label>
                                    <i class="fa-solid fa-magnifying-glass fa-1x mb-1"></i>
                                    <input type="text" class="form-control" id="buscar_paciente" placeholder="Buscar por nombre, cédula o expediente">
                                </div>
                                <div id="lista_pacientes" class="list-group"></div>
                            </div>
        
                            <div class="col-lg-6" hidden>
                                <div class="form-group">
                                    <label for="paciente_id">Paciente seleccionado  </label>
                                    <select class="form-control" id="paciente_id" name="paciente_id" required>
                                     
                                    </select>
                                    @if ($errors->has('paciente_id'))
                                        <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                    @endif
                                </div>
                            </div> 
        
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="paciente_id_id">ID Paciente seleccionado<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="paciente_id_id" name="paciente_id" value="{{ old('paciente_id_id') }}" required readonly>
                                        @if ($errors->has('paciente_id_id'))
                                            <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                      
                        <div class="row">
                            <div class="col-lg-4 ml-auto">
                                <div class="form-group">
                                    <label for="no_expediente">No. Expediente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_expediente" name="no_expediente" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="edad">Edad <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edad" name="edad" required readonly>
                                    @if ($errors->has('edad'))
                                        <div class="text-danger">{{ $errors->first('edad') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="fecha">Fecha <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    @if ($errors->has('fecha'))
                                        <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                    @endif
                                </div>
                            </div>
                      
                     
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="servicio">Servicio</label>
                                    <input type="text" class="form-control" id="servicio" name="servicio">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="sala">Sala</label>
                                    <input type="text" class="form-control" id="sala" name="sala">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="establecimiento_salud">Establecimiento de Salud</label>
                                    <input type="text" class="form-control" id="establecimiento_salud" name="establecimiento_salud" value="{{ old('establecimiento_salud') }}">
                                </div>
                            </div>
                         
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre_problema">Nombre del Problema <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre_problema" name="nombre_problema" required>
                                    @if ($errors->has('nombre_problema'))
                                        <div class="text-danger">{{ $errors->first('nombre_problema') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-2">
                                    <label for="inactivo">Inactivo</label>
                                    <input type="checkbox" id="inactivo" name="inactivo" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="resuelto">Resuelto</label>
                                    <input type="checkbox" id="resuelto" name="resuelto" value="1">
                                </div>
                            </div>
                           

                           
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Problema</button>
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
    $('#listaProblemasTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/lista_problemas') }}",
        columns: [
            { data: 'id' },
            { data: 'no_expediente',
                render: function (data, type, row) {
                    return `<span class="text-primary font-weight-bold">${data}</span> <span class="badge badge-info">EXP</span>`;
                },
            },
            
            { data: 'primer_nombre' },
            { data: 'primer_apellido' },

            { data: 'edad' },
            { data: 'servicio' },
            { data: 'sala' },
            { data: 'fecha' },
          
            { data: 'btn', orderable: false, searchable: false }
            /*{ 
            data: null, // Para datos concatenados
            render: function (data, type, row) {
                return `${row.primer_nombre} ${row.segundo_nombre} ${row.primer_apellido} ${row.segundo_apellido}`;
            },
            title: 'Nombres Completos' // Opcional: Nombre de la columna en la tabla
            },*/
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
                            { text: 'Lista de Problemas \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                            '<h3>Lista de Problemas</h3>' +
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
        ],
    });

    // Manejar la eliminación de registros con SweetAlert
    $('#listaProblemasTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('lista_problemas') }}/" + id;
        
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
                        $('#listaProblemasTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Eliminado!',
                            'El problema ha sido eliminado.',
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

   

// este codigo es para buscar por ajax en tiempo real los pacientes para las historis clinicas 

   //buscar paciente mediante ajax
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
                            $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action custom-list-item" data-id="' + paciente.id + '">' + paciente.primer_nombre + ' ' + paciente.primer_apellido + ' ' + paciente.segundo_apellido + ' (' + paciente.no_cedula + ')</a>');
                        });

                        var pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
                        if (data.prev_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page - 1) + '">Anterior</a></li>';
                        }
                        for (var i = 1; i <= data.last_page; i++) {
                            pagination += '<li class="page-item ' + (i === data.current_page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                        }
                        if (data.next_page_url) {
                            pagination += '<li class="page-item"><a class="page-link" href="#" data-page="' + (data.current_page + 1) + '">Siguiente</a></li>';
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

        // Limpia el select de pacientes y añade la nueva opción seleccionada
        $('#paciente_id').empty().append('<option value="' + id + '" selected>' + nombre + '</option>');

        // Dispara el cambio en el select de pacientes
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
                  

                    // Aquí se realiza la comprobación para la historia clínica
                    //verificarHistoriaClinica(pacienteId);
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
</section>



