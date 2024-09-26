
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

      
@extends('adminlte::page')

@section('title', 'MEDFILE')




@section('content')
<div class="container mt-4">
    <br>

    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0 text-light">
                    <li class="breadcrumb-item">Inicio</li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de Horarios</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createHorarioForm">
                <i class="fas fa-plus"></i> Crear Horario
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    @if (session('error'))
    <div class="alert alert-danger">
     {{ session('error') }}
    </div>
 @endif

    <div class="row">
        <div class="col-lg-12">
         
            <div class="table-responsive">
                <table id="horariosTable" class=" table-bordered w-100  p-2 min-w-full border border-gray-300 shadow-md rounded-lg p-2">
                    <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white p-2">
                        <tr>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Doctor</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Especialidad</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Consultorio</th>

                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Hora Inicio</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Hora Fin</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Duración de Cita</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Día de la Semana</th>
                            <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horarios as $horario)
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->id }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->doctor->primer_nombre }} {{ $horario->doctor->primer_apellido }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->doctor->especialidad->nombre ?? 'Sin Especialidad' }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->consultorio->nombre ?? 'Sin Consultorio' }}</td>
                            
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->hora_inicio }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->hora_fin }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $horario->duracion_cita }} minutos</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ ucfirst($horario->dia_semana) }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">
                                <!-- Botón para mostrar el detalle del horario -->
                                <a href="{{ route('horarios-doctor.show', $horario->id) }}" class="btn btn-info btn-sm">Ver</a>
                
                                <!-- Botón para editar el horario (modal) -->
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editHorarioForm{{ $horario->id }}">Editar</button>
                
                                <!-- Formulario para eliminar el horario -->
                                <form action="{{ route('horarios-doctor.destroy', $horario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        
                       <!-- Modal para editar horario -->
                       <div class="modal fade" id="editHorarioForm{{ $horario->id }}" tabindex="-1" role="dialog" aria-labelledby="editHorarioFormModalLabel{{ $horario->id }}" aria-hidden="true">
                           <div class="modal-dialog modal-lg" role="document">
                               <div class="modal-content">
                                   <div class="modal-header bg-primary">
                                       <h5 class="modal-title text-white" id="editHorarioFormModalLabel{{ $horario->id }}">Editar Horario</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <form action="{{ route('horarios-doctor.update', $horario->id) }}" method="POST">
                                           @csrf
                                           @method('PUT') <!-- Usamos el método PUT para actualizar -->
                                       
                                           <div class="row">
                                               <!-- Campo Día de la Semana -->
                                               <div class="col-lg-3">
                                                   <div class="form-group">
                                                       <label for="dia_semana">Día de la Semana</label>
                                                       <select name="dia_semana" id="dia_semana" class="form-control" required>
                                                           <option value="">Selecciona un día</option>
                                                           <option value="lunes" {{ old('dia_semana', $horario->dia_semana) == 'lunes' ? 'selected' : '' }}>Lunes</option>
                                                           <option value="martes" {{ old('dia_semana', $horario->dia_semana) == 'martes' ? 'selected' : '' }}>Martes</option>
                                                           <option value="miercoles" {{ old('dia_semana', $horario->dia_semana) == 'miercoles' ? 'selected' : '' }}>Miércoles</option>
                                                           <option value="jueves" {{ old('dia_semana', $horario->dia_semana) == 'jueves' ? 'selected' : '' }}>Jueves</option>
                                                           <option value="viernes" {{ old('dia_semana', $horario->dia_semana) == 'viernes' ? 'selected' : '' }}>Viernes</option>
                                                           <option value="sabado" {{ old('dia_semana', $horario->dia_semana) == 'sabado' ? 'selected' : '' }}>Sábado</option>
                                                           <option value="domingo" {{ old('dia_semana', $horario->dia_semana) == 'domingo' ? 'selected' : '' }}>Domingo</option>
                                                       </select>
                                                       @if ($errors->has('dia_semana'))
                                                           <div class="text-danger">{{ $errors->first('dia_semana') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                       
                                               <!-- Campo Hora Inicio -->
                                               <div class="col-lg-3">
                                                   <div class="form-group">
                                                       <label for="hora_inicio">Hora Inicio</label>
                                                       <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                                                       @if ($errors->has('hora_inicio'))
                                                           <div class="text-danger">{{ $errors->first('hora_inicio') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                       
                                               <!-- Campo Hora Fin -->
                                               <div class="col-lg-3">
                                                   <div class="form-group">
                                                       <label for="hora_fin">Hora Fin</label>
                                                       <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', $horario->hora_fin) }}" required>
                                                       @if ($errors->has('hora_fin'))
                                                           <div class="text-danger">{{ $errors->first('hora_fin') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                       
                                               <!-- Campo Duración de la Cita -->
                                               <div class="col-lg-3">
                                                   <div class="form-group">
                                                       <label for="duracion_cita">Duración de la Cita (min)</label>
                                                       <input type="number" name="duracion_cita" id="duracion_cita" class="form-control" value="{{ old('duracion_cita', $horario->duracion_cita) }}" required>
                                                       @if ($errors->has('duracion_cita'))
                                                           <div class="text-danger">{{ $errors->first('duracion_cita') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                       
                                           <!-- Campo Doctor -->
                                           <div class="row">
                                               <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="doctor_id">Doctor</label>
                                                       <select class="form-control" id="doctor_id" name="doctor_id" required>
                                                           <option value="">Selecciona un doctor</option>
                                                           @foreach ($doctores as $doctor)
                                                               <option value="{{ $doctor->id }}" {{ old('doctor_id', $horario->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                                   {{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }} 
                                                                   {{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }} - Especialidad: {{ $doctor->especialidad_id }}
                                                               </option>
                                                           @endforeach
                                                       </select>
                                                       @if ($errors->has('doctor_id'))
                                                           <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                       
                                               <!-- Campo Consultorio -->
                                               <div class="col-lg-6">
                                                   <div class="form-group">
                                                       <label for="consultorio_id">Consultorio</label>
                                                       <select class="form-control" id="consultorio_id" name="consultorio_id" required>
                                                           <option value="">Selecciona un consultorio</option>
                                                           @foreach ($consultorios as $consultorio)
                                                               <option value="{{ $consultorio->id }}" {{ old('consultorio_id', $horario->consultorio_id) == $consultorio->id ? 'selected' : '' }}>
                                                                   {{ $consultorio->nombre }} - Ubicación: {{ $consultorio->ubicacion }}
                                                               </option>
                                                           @endforeach
                                                       </select>
                                                       @if ($errors->has('consultorio_id'))
                                                           <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                       
                                           <!-- Botones de acción -->
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                               <button type="submit" class="btn btn-primary">Actualizar Horario</button>
                                           </div>
                                       </form>
                                       
                                   </div>
                               </div>
                           </div>
                       </div>
       
                       @endforeach
                   </tbody>
                </table>
             </div>

        </div>
        <br>
        <div class="col-lg-12 mt-5">

            <div class="card">
                <div class=" card-header from-green-500 to-green-600 text-white text-center  p-2">
                    <h3 class="text-lg font-semibold card-title ">Calendario de Atención de Doctores</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="consultorio_id">Consultorio</label>
                            <select class="form-control" id="consultorio_select" name="consultorio_id" required>
                                <option value="">Selecciona un consultorio</option>
                                @foreach ($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">
                                        {{  $consultorio->nombre . "- Ubicacion: ". $consultorio->ubicacion }} 
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('consultorio_id'))
                                <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                            @endif
                        </div>
                       
                    </div>
                        
                    <div class=" text-white" id="consultorio_info"></div>
                   
                    <hr>
                    <div class="overflow-x-auto">
                        
                    </div>
                    
                </div>
            </div>
            

        </div>
    </div>
      
        <!-- Modal para crear horario -->
        <div class="modal fade" id="createHorarioForm" tabindex="-1" role="dialog" aria-labelledby="createHorarioFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="createHorarioFormModalLabel">Crear Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('horarios-doctor.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Campo Día de la Semana -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="dia_semana">Día de la Semana</label>
                                    <select name="dia_semana" id="dia_semana" class="form-control" required>
                                        <option value="">Selecciona un día</option>
                                        <option value="lunes">Lunes</option>
                                        <option value="martes">Martes</option>
                                        <option value="miercoles">Miércoles</option>
                                        <option value="jueves">Jueves</option>
                                        <option value="viernes">Viernes</option>
                                        <option value="sabado">Sábado</option>
                                        <option value="domingo">Domingo</option>
                                    </select>
                                    @if ($errors->has('dia_semana'))
                                        <div class="text-danger">{{ $errors->first('dia_semana') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="consultorio_id">Consultorio</label>
                                    <select class="form-control" id="consultorio_select" name="consultorio_id" required>
                                        <option value="">Selecciona un consultorio</option>
                                        @foreach ($consultorios as $consultorio)
                                            <option value="{{ $consultorio->id }}">
                                                {{  $consultorio->nombre . "- Ubicacion: ". $consultorio->ubicacion }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('consultorio_id'))
                                        <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                                    @endif
                                </div>
                               
                            </div>
                    
                            <!-- Campo Hora Inicio -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="hora_inicio">Hora Inicio</label>
                                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
                                    @if ($errors->has('hora_inicio'))
                                        <div class="text-danger">{{ $errors->first('hora_inicio') }}</div>
                                    @endif
                                </div>
                            </div>
                    
                            <!-- Campo Hora Fin -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="hora_fin">Hora Fin</label>
                                    <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
                                    @if ($errors->has('hora_fin'))
                                        <div class="text-danger">{{ $errors->first('hora_fin') }}</div>
                                    @endif
                                </div>
                            </div>
                    
                            <!-- Campo Duración de la Cita -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="duracion_cita">Duración de la Cita (min)</label>
                                    <input type="number" name="duracion_cita" id="duracion_cita" class="form-control" value="{{ old('duracion_cita', 30) }}" required>
                                    @if ($errors->has('duracion_cita'))
                                        <div class="text-danger">{{ $errors->first('duracion_cita') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                        <!-- Campo Doctor -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="doctor_id">Doctor</label>
                                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                                        <option value="">Selecciona un doctor</option>
                                        @foreach ($doctores as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }} 
                                                {{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }}
                                                {{ $doctor->especialidad_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('doctor_id'))
                                        <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                                    @endif
                                </div>
                            </div>

                           
                        </div>
                    
                        <!-- Botones de acción -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear Horario</button>
                        </div>
                    </form>
                    
                </div>
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
            { data: 'paciente_id' },
            { data: 'doctor_id' },
            { data: 'especialidad_id' },
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
<script>
   $('#consultorio_select').on('change', function () {
        var consultorio_id = $('#consultorio_select').val();
        //alert(consultorio_id);

        var url = "{{ route('horarios-doctor-consultorio', ':id') }}";
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
@stop
    
</body>
</html>





