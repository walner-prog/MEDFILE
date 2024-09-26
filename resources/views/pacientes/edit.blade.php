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
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <div class="row">
       <div class="col-lg-2 ">
           
        <a class="text-white" href="{{ route('pacientes.index') }}">
            <button class="btn btn-info ">
                <i class="fas fa-house-medical-circle-check"></i> Regresar
            </button>
        </a>
       
             
       </div>
       <div class="col-lg-10 text-right">
         
            
       </div>
    </div>
     
   

    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
              <div class="row">
                  <div class="col-lg-8">
                      <h5 class="modal-title text-white" id="editAdmisionEgresoFormLabel{{ $paciente->id }}">Editar Registro de identificacion del paciente</h5>
                    
                  </div>
                  <div id="datos-paciente" class="mb-3">
                      <h4>Datos del Paciente</h4>
                      <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                          <div class="mb-2">
                              <strong class="color-primario">
                                  <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                              </strong> 
                              <span id="info_no_expediente" class="text-danger">{{ $paciente->no_expediente }}</span>
                          </div>
                          <div class="mb-2">
                              <strong class="text-primary ml-2">
                                  <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                              </strong> 
                              <span id="info_primer_nombre" class="text-secondary">{{ $paciente->primer_nombre }}</span>
                              <span id="info_segundo_nombre" class="text-secondary">{{ $paciente->segundo_nombre }}</span>
                              <span id="info_primer_apellido" class="text-secondary">{{ $paciente->primer_apellido }}</span>
                              <span id="info_segundo_apellido" class="text-secondary">{{ $paciente->segundo_apellido }}</span>
                              
                              <strong class="text-primary ml-2">Edad:</strong> 
                              <span id="info_edad" class="text-secondary">{{ $paciente->edad }}</span>
                              
                              <strong class="text-primary ml-2">No. Cédula:</strong> 
                              <span id="info_no_cedula" class="text-secondary">{{ $paciente->no_cedula }}</span>
                              
                              <strong class="text-primary ml-2">No. INSS:</strong> 
                              <span id="info_no_inss" class="text-secondary">{{ $paciente->no_inss }}</span>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>
          <div class="modal-body">
            <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="no_expediente">No. Expediente</label>
                                <input type="text" class="form-control" name="no_expediente" value="{{ old('no_expediente', $paciente->no_expediente) }}" required>
                                @if ($errors->has('no_expediente'))
                                    <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="{{ old('fecha', $paciente->fecha) }}" required>
                                @if ($errors->has('fecha'))
                                    <div class="text-danger">{{ $errors->first('fecha') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="establecimiento_salud">Establecimiento de Salud</label>
                                <input type="text" class="form-control" name="establecimiento_salud" value="{{ old('establecimiento_salud', $paciente->establecimiento_salud) }}" required>
                                @if ($errors->has('establecimiento_salud'))
                                    <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="primer_nombre">Primer Nombre</label>
                                <input type="text" class="form-control" name="primer_nombre" value="{{ old('primer_nombre', $paciente->primer_nombre) }}" required>
                                @if ($errors->has('primer_nombre'))
                                    <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="segundo_nombre"> Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundo_nombre" value="{{ old('segundo_nombre', $paciente->segundo_nombre) }}" required>
                                @if ($errors->has('segundo_nombre'))
                                    <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="primer_apellido">Primer Apellido</label>
                                <input type="text" class="form-control" name="primer_apellido" value="{{ old('primer_apellido', $paciente->primer_apellido) }}" required>
                                @if ($errors->has('primer_apellido'))
                                    <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundo_apellido" value="{{ old('segundo_apellido', $paciente->segundo_apellido) }}">
                                @if ($errors->has('segundo_apellido'))
                                    <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
                                @if ($errors->has('fecha_nacimiento'))
                                    <div class="text-danger">{{ $errors->first('fecha_nacimiento') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="edad">Edad</label>
                                <input type="number" class="form-control" name="edad" value="{{ old('edad', $paciente->edad) }}" required>
                                @if ($errors->has('edad'))
                                    <div class="text-danger">{{ $errors->first('edad') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select class="form-control" name="sexo" required>
                                    <option value="M" {{ old('sexo', $paciente->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('sexo', $paciente->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @if ($errors->has('sexo'))
                                    <div class="text-danger">{{ $errors->first('sexo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="raza_etnia">Raza/Etnia</label>
                                <select class="form-control" name="raza_etnia" 
                                >
                                    <option value="">Seleccione una raza/etnia</option>
                                    <option value="Mestizos" {{ old('raza_etnia', $paciente->raza_etnia) == 'Mestizos' ? 'selected' : '' }}>Mestizos</option>
                                    <option value="Miskitu (Miskitos)" {{ old('raza_etnia', $paciente->raza_etnia) == 'Miskitu (Miskitos)' ? 'selected' : '' }}>Miskitu (Miskitos)</option>
                                    <option value="Matagalpa" {{ old('raza_etnia', $paciente->raza_etnia) == 'Matagalpa' ? 'selected' : '' }}>Matagalpa</option>
                                    <option value="Creole / Afro descendiente" {{ old('raza_etnia', $paciente->raza_etnia) == 'Creole / Afro descendiente' ? 'selected' : '' }}>Creole / Afro descendiente</option>
                                    <option value="Subtiava" {{ old('raza_etnia', $paciente->raza_etnia) == 'Subtiava' ? 'selected' : '' }}>Subtiava</option>
                                    <option value="Nahua" {{ old('raza_etnia', $paciente->raza_etnia) == 'Nahua' ? 'selected' : '' }}>Nahua</option>
                                    <option value="Chorotega" {{ old('raza_etnia', $paciente->raza_etnia) == 'Chorotega' ? 'selected' : '' }}>Chorotega</option>
                                    <option value="Mayangna" {{ old('raza_etnia', $paciente->raza_etnia) == 'Mayangna' ? 'selected' : '' }}>Mayangna</option>
                                    <option value="Nicarao" {{ old('raza_etnia', $paciente->raza_etnia) == 'Nicarao' ? 'selected' : '' }}>Nicarao</option>
                                    <option value="Garifuna" {{ old('raza_etnia', $paciente->raza_etnia) == 'Garifuna' ? 'selected' : '' }}>Garifuna</option>
                                    <option value="Rama" {{ old('raza_etnia', $paciente->raza_etnia) == 'Rama' ? 'selected' : '' }}>Rama</option>
                                    <option value="Otros" {{ old('raza_etnia', $paciente->raza_etnia) == 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @if ($errors->has('raza_etnia'))
                                    <div class="text-danger">{{ $errors->first('raza_etnia') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="no_cedula">No. Cédula</label>
                                <input type="text" class="form-control" name="no_cedula" value="{{ old('no_cedula', $paciente->no_cedula) }}" required>
                                @if ($errors->has('no_cedula'))
                                    <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <select class="form-control" name="estado_civil" required>
                                    <option value="">Seleccione un estado civil</option>
                                    <option value="Soltero" {{ old('estado_civil', $paciente->estado_civil) == 'Soltero' ? 'selected' : '' }}>Soltero(a)</option>
                                    <option value="Casado" {{ old('estado_civil', $paciente->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado(a)</option>
                                    <option value="Divorciado" {{ old('estado_civil', $paciente->estado_civil) == 'Divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                    <option value="Viudo" {{ old('estado_civil', $paciente->estado_civil) == 'Viudo' ? 'selected' : '' }}>Viudo(a)</option>
                                    <option value="Unión Libre" {{ old('estado_civil', $paciente->estado_civil) == 'Unión Libre' ? 'selected' : '' }}>Unión Libre</option>
                                    <option value="Separado" {{ old('estado_civil', $paciente->estado_civil) == 'Separado' ? 'selected' : '' }}>Separado(a)</option>
                                </select>
                                @if ($errors->has('estado_civil'))
                                    <div class="text-danger">{{ $errors->first('estado_civil') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" required>
                                @if ($errors->has('telefono'))
                                    <div class="text-danger">{{ $errors->first('telefono') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" value="{{ old('correo', $paciente->correo) }}">
                                @if ($errors->has('correo'))
                                    <div class="text-danger">{{ $errors->first('correo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select class="form-control" name="categoria" required>
                                    <option value="">Seleccione categoría</option>
                                    <option value="Asegurados Activos CMP-MINSA" {{ old('categoria', $paciente->categoria) == 'Asegurados Activos CMP-MINSA' ? 'selected' : '' }}>Asegurados Activos CMP-MINSA</option>
                                    <option value="Jubilados" {{ old('categoria', $paciente->categoria) == 'Jubilados' ? 'selected' : '' }}>Jubilados</option>
                                    <option value="Asegurado Activo IPSS" {{ old('categoria', $paciente->categoria) == 'Asegurado Activo IPSS' ? 'selected' : '' }}>Asegurado Activo IPSS</option>
                                    <option value="Otros" {{ old('categoria', $paciente->categoria) == 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @if ($errors->has('categoria'))
                                    <div class="text-danger">{{ $errors->first('categoria') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control" name="departamento" value="{{ old('departamento', $paciente->departamento) }}" required>
                                @if ($errors->has('departamento'))
                                    <div class="text-danger">{{ $errors->first('departamento') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="municipio">Municipio</label>
                                <input type="text" class="form-control" name="municipio" value="{{ old('municipio', $paciente->municipio) }}" required>
                                @if ($errors->has('municipio'))
                                    <div class="text-danger">{{ $errors->first('municipio') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="direccion">Dirección Paciente</label>
                                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $paciente->direccion) }}" required>
                                @if ($errors->has('direccion'))
                                    <div class="text-danger">{{ $errors->first('direccion') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="empleador">Empleador</label>
                                <input type="text" class="form-control" name="empleador" value="{{ old('empleador', $paciente->empleador) }}">
                                @if ($errors->has('empleador'))
                                    <div class="text-danger">{{ $errors->first('empleador') }}</div>
                                @endif
                            </div>
                        </div>
                       
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nombre_responsable">Nombre del Responsable</label>
                                <input type="text" class="form-control" name="nombre_responsable" value="{{ old('nombre_responsable', $paciente->nombre_responsable) }}" required>
                                @if ($errors->has('nombre_responsable'))
                                    <div class="text-danger">{{ $errors->first('nombre_responsable') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="telefono_responsable">Teléfono del Responsable</label>
                                <input type="text" class="form-control" name="telefono_responsable" value="{{ old('telefono_responsable', $paciente->telefono_responsable) }}" required>
                                @if ($errors->has('telefono_responsable'))
                                    <div class="text-danger">{{ $errors->first('telefono_responsable') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="direccion_responsable">Dirección del Responsable</label>
                                <input type="text" class="form-control" name="direccion_responsable" value="{{ old('direccion_responsable', $paciente->direccion_responsable) }}" required>
                                @if ($errors->has('direccion_responsable'))
                                    <div class="text-danger">{{ $errors->first('direccion_responsable') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="foto">Foto del Paciente</label>
                                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                            </div>
        
                            <div class="col-sm-8">
                            
                                @if($paciente->foto)
                                <img src="{{ asset('images/' . $paciente->foto) }}" alt="Foto de Paciente" width="150">
                                 @else
                                <p>No hay foto disponible</p>
                               @endif
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
     </div>

<br>

    </div>    
  </div>

  @endsection
  
  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

  
  <!-- JS de DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

 
  @stop

</body>
</html>
    
 
  