{{-- @extends('layouts.app') --}}

<section>
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
     
   
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
        @livewireStyles
    </head>
    
@extends('adminlte::page')

@section('title', 'AdminSalud')



@section('content')
<div class="container">
    <br>
     <div class="row">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('doctores.index') }}">
                <button class="btn btn-info ">
                    <i class="fas fa-house-medical-circle-check"></i> Regresar
                </button>
            </a>
           
        </div>
        <div class="col-lg-10 text-right">
           <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider round">
                  <i class="fas fa-sun icon-light"></i>
                  <i class="fas fa-moon icon-dark"></i>
                </span>
                <span id="mode-text"></span>
              </label>
             
        </div>
     </div>

     <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="modal-title text-white" id="editDoctorFormLabel{{ $doctor->id }}">Editar Doctor</h5>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('doctores.update', $doctor->id) }}">
                    @csrf
                    @method('PUT') 
    
                    <div class="col-lg-3 form-group">
                        <label for="usuario_id">Usuario</label>
                        <input type="text" class="form-control" id="usuario_id" name="usuario_id" value="{{ old('usuario_id', $doctor->usuario ? $doctor->usuario->name : '') }}" readonly>
                        @if ($errors->has('usuario_id'))
                            <div class="text-danger">{{ $errors->first('usuario_id') }}</div>
                        @endif
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-lg-3 form-group">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $doctor->codigo) }}" readonly>
                            @if ($errors->has('codigo'))
                                <div class="text-danger">{{ $errors->first('codigo') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="primer_nombre">Primer Nombre</label>
                            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $doctor->primer_nombre) }}" required>
                            @if ($errors->has('primer_nombre'))
                                <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="segundo_nombre">Segundo Nombre</label>
                            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $doctor->segundo_nombre) }}">
                            @if ($errors->has('segundo_nombre'))
                                <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="primer_apellido">Primer Apellido</label>
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $doctor->primer_apellido) }}" required>
                            @if ($errors->has('primer_apellido'))
                                <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="segundo_apellido">Segundo Apellido</label>
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $doctor->segundo_apellido) }}">
                            @if ($errors->has('segundo_apellido'))
                                <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', $doctor->cedula) }}" required>
                            @if ($errors->has('cedula'))
                                <div class="text-danger">{{ $errors->first('cedula') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $doctor->telefono) }}">
                            @if ($errors->has('telefono'))
                                <div class="text-danger">{{ $errors->first('telefono') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $doctor->email) }}" required>
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="especialidad_id">Especialidad</label>
                            <select class="form-control" id="especialidad_id" name="especialidad_id">
                                <option value="">Seleccionar Especialidad</option>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}" {{ old('especialidad_id', $doctor->especialidad_id) == $especialidad->id ? 'selected' : '' }}>
                                        {{ $especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('especialidad_id'))
                                <div class="text-danger">{{ $errors->first('especialidad_id') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="departamento_id">Departamento</label>
                            <select class="form-control" id="departamento_id" name="departamento_id">
                                <option value="">Seleccionar Departamento</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}" {{ old('departamento_id', $doctor->departamento_id) == $departamento->id ? 'selected' : '' }}>
                                        {{ $departamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('departamento_id'))
                                <div class="text-danger">{{ $errors->first('departamento_id') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="fecha_contratacion">Fecha de Contratación</label>
                            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion', $doctor->fecha_contratacion) }}">
                            @if ($errors->has('fecha_contratacion'))
                                <div class="text-danger">{{ $errors->first('fecha_contratacion') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo" {{ old('estado', $doctor->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado', $doctor->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @if ($errors->has('estado'))
                                <div class="text-danger">{{ $errors->first('estado') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="horario_trabajo">Horario de Trabajo</label>
                            <input type="text" class="form-control" id="horario_trabajo" name="horario_trabajo" value="{{ old('horario_trabajo', $doctor->horario_trabajo) }}">
                            @if ($errors->has('horario_trabajo'))
                                <div class="text-danger">{{ $errors->first('horario_trabajo') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $doctor->direccion) }}">
                            @if ($errors->has('direccion'))
                                <div class="text-danger">{{ $errors->first('direccion') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="foto">Foto</label>
                            <input type="text" class="form-control" id="foto" name="foto" value="{{ old('foto', $doctor->foto) }}">
                            @if ($errors->has('foto'))
                                <div class="text-danger">{{ $errors->first('foto') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $doctor->fecha_nacimiento) }}">
                            @if ($errors->has('fecha_nacimiento'))
                                <div class="text-danger">{{ $errors->first('fecha_nacimiento') }}</div>
                            @endif
                        </div>
    
                        <div class="col-lg-3 form-group">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="">Seleccionar Sexo</option>
                                <option value="M" {{ old('sexo', $doctor->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $doctor->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @if ($errors->has('sexo'))
                                <div class="text-danger">{{ $errors->first('sexo') }}</div>
                            @endif
                        </div>
                        
    
                    </div>
    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                      
                </form>
            </div>
        </div>
    </div>
    
    

 <br>



  </div>
</div>


 
@stop



@section('js')
   
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script>
// Check for saved user theme preference
const currentTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
if (currentTheme) {
    document.body.classList.add(currentTheme + '-mode');
    document.getElementById('theme-toggle').checked = currentTheme === 'dark';
}

const toggleSwitch = document.getElementById('theme-toggle');

function switchTheme(e) {
    if (e.target.checked) {
        document.body.classList.add('dark-mode');
        document.body.classList.remove('light-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.add('light-mode');
        document.body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    }
}

toggleSwitch.addEventListener('change', switchTheme);


// Initial call to set the date and time
updateDateTime();

// Update date and time every second
setInterval(updateDateTime, 1000);


</script>
@stop
</section>