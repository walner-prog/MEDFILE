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
    <section>

 
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
                
              </div>
              
           </div>
        
            <div class="row">
                <div class="col-lg-2">
                    @can('create', App\Models\Doctor::class)
                    <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createDoctorForm">
                        <i class="fas fa-plus"></i> Crear Doctor
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
              <table id="doctoresTable" class="min-w-full border border-gray-300 shadow-md rounded-lg p-2">
                  <thead class="from-green-500 to-green-600 text-white">
                      <tr>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Código</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Nombre</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Apellido</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Cédula</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Teléfono</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Email</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Estado</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Especialidad</th>
                          <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                      </tr>
                  </thead>
                  <hr>
                  <tbody class="divide-y divide-gray-200">
                      {{-- Los datos se cargarán dinámicamente por DataTable server-side --}}
                  </tbody>
              </table>
              
            </div>
      
        <div class="modal fade" id="createDoctorForm" tabindex="-1" role="dialog" aria-labelledby="createDoctorModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header bt-teal">
                      <h5 class="modal-title text-white" id="createDoctorModalLabel">Crear Doctor</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('doctores.store') }}" method="POST">
                      @csrf
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="codigo">Código</label>
                                      <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" required>
                                      @if ($errors->has('codigo'))
                                          <div class="text-danger">{{ $errors->first('codigo') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label for="buscar_usuario" class="bold">Buscar Usuario</label>
                                      <i class="fa-solid fa-magnifying-glass fa-1x mb-1"></i>
                                      <input type="text" class="form-control" id="buscar_usuario" placeholder="Buscar por nombre o email">
                                  </div>
                                  <div id="lista_usuarios" class="list-group"></div>
                              </div>  
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="usuario_id">ID Usuario seleccionado<span class="text-danger">*</span></label>
                                      <input type="number" class="form-control" id="usuario_id_id" name="usuario_id" value="{{ old('usuario_id') }}" required readonly>
                                      @if ($errors->has('usuario_id'))
                                          <div class="text-danger">{{ $errors->first('usuario_id') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="primer_nombre">Primer Nombre</label>
                                      <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
                                      @if ($errors->has('primer_nombre'))
                                          <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="segundo_nombre">Segundo Nombre</label>
                                      <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}">
                                      @if ($errors->has('segundo_nombre'))
                                          <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="primer_apellido">Primer Apellido</label>
                                      <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
                                      @if ($errors->has('primer_apellido'))
                                          <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="segundo_apellido">Segundo Apellido</label>
                                      <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                                      @if ($errors->has('segundo_apellido'))
                                          <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="direccion">Dirección</label>
                                      <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                                      @if ($errors->has('direccion'))
                                          <div class="text-danger">{{ $errors->first('direccion') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="cedula">Cédula</label>
                                      <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}" required>
                                      @if ($errors->has('cedula'))
                                          <div class="text-danger">{{ $errors->first('cedula') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="telefono">Teléfono</label>
                                      <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                                      @if ($errors->has('telefono'))
                                          <div class="text-danger">{{ $errors->first('telefono') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                      @if ($errors->has('email'))
                                          <div class="text-danger">{{ $errors->first('email') }}</div>
                                      @endif
                                  </div>
                              </div>
                             
                            
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="departamento_id">Departamento</label>
                                      <select class="form-control" id="departamento_id" name="departamento_id">
                                          @foreach($departamentos as $departamento)
                                              <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('departamento_id'))
                                          <div class="text-danger">{{ $errors->first('departamento_id') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="fecha_contratacion">Fecha de Contratación</label>
                                      <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion') }}" required>
                                      @if ($errors->has('fecha_contratacion'))
                                          <div class="text-danger">{{ $errors->first('fecha_contratacion') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="estado">Estado</label>
                                      <select class="form-control" id="estado" name="estado" required>
                                          <option value="">Seleccionar Estado</option>
                                          <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                          <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                      </select>
                                      @if ($errors->has('estado'))
                                          <div class="text-danger">{{ $errors->first('estado') }}</div>
                                      @endif
                                  </div>
                              </div>
                              
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="horario_trabajo">Horario de Trabajo</label>
                                      <input type="text" class="form-control" id="horario_trabajo" name="horario_trabajo" value="{{ old('horario_trabajo') }}">
                                      @if ($errors->has('horario_trabajo'))
                                          <div class="text-danger">{{ $errors->first('horario_trabajo') }}</div>
                                      @endif
                                  </div>
                              </div>
      
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="especialidad_id">Especialidad</label>
                                      <select class="form-control" id="especialidad_id" name="especialidad_id">
                                          @foreach($especialidades as $especialidad)
                                              <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('especialidad_id'))
                                          <div class="text-danger">{{ $errors->first('especialidad_id') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="foto">Foto</label>
                                      <input type="text" class="form-control" id="foto" name="foto" value="{{ old('foto') }}">
                                      @if ($errors->has('foto'))
                                          <div class="text-danger">{{ $errors->first('foto') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                                      @if ($errors->has('fecha_nacimiento'))
                                          <div class="text-danger">{{ $errors->first('fecha_nacimiento') }}</div>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                  <div class="form-group">
                                      <label for="sexo">Sexo</label>
                                      <select class="form-control" id="sexo" name="sexo">
                                          <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                          <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                      </select>
                                      @if ($errors->has('sexo'))
                                          <div class="text-danger">{{ $errors->first('sexo') }}</div>
                                      @endif
                                  </div>
                              </div>
                              
      
                            
                              
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
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
          $('#doctoresTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url('api/doctores') }}", // Cambiar a la ruta de tu API para doctores
              columns: [
                  { data: 'id' },
                  { data: 'codigo',
                      render: function (data, type, row) {
                          return `<span class="text-primary font-weight-bold">${data}</span>`;
                      },
                  },
                  { data: 'primer_nombre',
                      render: function (data, type, row) {
                          return `<span class="font-weight-bold">${data}</span>`;
                      },
                  },
                 
                  { data: 'primer_apellido' },
                  { data: 'cedula',
                      render: function (data, type, row) {
                          return `<span class="text-danger font-weight-bold">${data}</span>`;
                      },
                  },
                  { data: 'telefono' },
                  { data: 'email' },
                  { data: 'estado' },
                  { data: 'especialidad', // Esta columna mostrará el nombre de la especialidad
                      render: function (data, type, row) {
                          return `<span class="text-success font-weight-bold">${data}</span>`;
                      }
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
                                  { text: 'Tabla de Doctores\n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                                  '<h3>Tabla de Doctores</h3>' +
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
           $('#doctoresTable').on('click', '.delete-btn', function() {
              var id = $(this).data('id');
              var url = "{{ url('doctores') }}/" + id;
              
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
                              $('#doctoresTable').DataTable().ajax.reload();
                              Swal.fire(
                                  'Eliminado!',
                                  'El doctor ha sido eliminado.',
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
      
      
      $(document).ready(function() {
          function fetchUsuarios(page = 1) {
              var query = $('#buscar_usuario').val();
              if (query.length > 2) {
                  $.ajax({
                      url: "{{ route('buscarusuario') }}",
                      type: "GET",
                      data: {'query': query, 'page': page},
                      success: function(data) {
                          $('#lista_usuarios').empty();
                          if (data.data.length > 0) {
                              $.each(data.data, function(index, usuario) {
                                  $('#lista_usuarios').append('<a href="#" class="list-group-item list-group-item-action custom-list-item" data-id="' + usuario.id + '">' + usuario.name + ' (' + usuario.email + ')</a>');
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
      
                              $('#lista_usuarios').append(pagination);
                          } else {
                              $('#lista_usuarios').append('<a href="#" class="list-group-item list-group-item-action disabled">No se encontraron resultados</a>');
                          }
                      }
                  });
              } else {
                  $('#lista_usuarios').empty();
              }
          }
      
          $('#buscar_usuario').on('keyup', function() {
              fetchUsuarios();
          });
      
          $(document).on('click', '.pagination a', function(e) {
              e.preventDefault();
              var page = $(this).data('page');
              fetchUsuarios(page);
          });
      
          $(document).on('click', '.list-group-item-action', function(e) {
              e.preventDefault();
              var id = $(this).data('id');
              var nombre = $(this).text();
      
              $('#usuario_id_id').val(id);
              $('#lista_usuarios').empty();
              $('#buscar_usuario').val('');
      
              // Hacer una solicitud para obtener los detalles del usuario seleccionado
              $.ajax({
                  url: '/api/usuarios/' + id,
                  type: 'GET',
                  success: function(response) {
                      $('#direccion').val(response.Direccion);
                      $('#email').val(response.email);
                      $('#telefono').val(response.Contacto);
                      // Actualiza otros campos según sea necesario
                  }
              });
          });
      });
      
      
      
        </script>
        @stop
      </section>
</body>
</html>




