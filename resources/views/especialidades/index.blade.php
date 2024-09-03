<section>
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
    
  @section('title', 'MEDFILE')
  
  
  
  
  @section('content')
  <div class="container mt-2">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Gestion de Personal </li>
                </ol>
            </nav>
        </div>
        
    </div>
    
     <div class="row">
        <div class="col-lg-2">
           
        </div>

       
      
        <div class="col-lg-10 d-flex justify-content-end align-items-center">
            <div class="datetime badge badge-info p-2 mr-2" id="datetime"></div>
            <label class="switch mb-0">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round">
                    <i class="fas fa-sun icon-light"></i>
                    <i class="fas fa-moon icon-dark"></i>
                </span>
                <span id="mode-text"></span>
            </label>
        </div>
        
     </div>
  
      <div class="row">
          <div class="col-lg-2">
              @can('create', App\Models\Doctor::class)
              <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createEspecialidadModal">
                  <i class="fas fa-plus"></i> Crear 
              </button>
              @endcan
          </div>
         
          
        
      </div>
  
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      @if (session('info'))
          <div class="alert alert-success">
              {{ session('info') }}
          </div>
      @endif
  
      @if (session('delete'))
          <div class="alert alert-warning">
              {{ session('delete') }}
          </div>
      @endif
  
      @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif
     
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered shadow-lg" id="especialidadesTable">
            <thead class="card-green">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    
    <!-- Modal para Crear Especialidad -->
    <div class="modal fade" id="createEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="createEspecialidadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bt-teal">
                    <h5 class="modal-title text-white" id="createEspecialidadModalLabel">Crear Especialidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('especialidades.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Crear Especialidad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

  </div>
  @endsection
  
  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  @livewireScripts

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
    $('#especialidadesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/especialidades') }}", // Cambiar a la ruta de tu API para especialidades
        columns: [
            { data: 'id' },
            { data: 'nombre',
                render: function (data, type, row) {
                    return `<span class="text-primary font-weight-bold">${data}</span>`;
                },
            },
            { data: 'descripcion',
                render: function (data, type, row) {
                    return `<span class="font-weight-bold">${data}</span>`;
                },
            },
            { data: 'btn', orderable: false, searchable: false } // Asegúrate de que 'btn' esté definido en tu controlador
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
        lengthMenu: [[5, 20, 50, -1], [5, 20, 50, "Todos"]],
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
                            { text: 'Tabla de Especialidades\n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                            '<h3>Tabla de Especialidades</h3>' +
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
    $('#especialidadesTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('especialidades') }}/" + id;
        
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
                        $('#especialidadesTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Eliminado!',
                            'La especialidad ha sido eliminada.',
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


document.addEventListener('DOMContentLoaded', function () {
        function showAlert(message, icon, type) {
            Swal.fire({
                title: message,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }

        @if(session('info'))
            showAlert('{{ session('info') }}', 'success', 'success');
        @endif

        @if(session('update'))
            showAlert('{{ session('update') }}', 'info', 'info');
        @endif

        @if(session('delete'))
            showAlert('{{ session('delete') }}', 'error', 'error');
        @endif
    });

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





// Function to update date and time
function updateDateTime() {
    const now = new Date();
    const datetimeString = now.toLocaleString();
    document.getElementById('datetime').textContent = datetimeString;
}

// Initial call to set the date and time
updateDateTime();

// Update date and time every second
setInterval(updateDateTime, 1000);


  </script>
  @stop
</section>



