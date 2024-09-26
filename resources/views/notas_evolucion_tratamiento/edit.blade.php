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
    <section>
    
    
        @extends('adminlte::page')
        
        @section('title', 'AdminSalud')
        
        
        
        @section('content')
        <div class="container">
            <br>
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                            <li class="breadcrumb-item">Hogar</li>
                            <li class="breadcrumb-item active" aria-current="page">Registros de Lista de Problemas de pacientes Ingresados </li>
                            <li class="breadcrumb-item active" aria-current="page">Editar </li>
                        </ol>
                    </nav>
                </div>
                
            </div>
              
             <div class="row">
                <div class="col-lg-2 ">
                    <a class="text-white" href="{{ route('notas_evolucion_tratamiento.index') }}">
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
                                    <h5 class="modal-title text-white" id="editNotaEvolucionFormLabel{{ $nota->id }}">Editar Nota de Evolución</h5>
                                </div>
                                <div id="datos-paciente" class="mb-3">
                                    <h4>Datos del Paciente</h4>
                                    <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                                        <div class="mb-2">
                                            <strong class="color-primario">
                                                <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                                            </strong> 
                                            <span id="info_no_expediente" class="text-danger">{{ $nota->no_expediente }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <strong class="text-primary ml-2">
                                                <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                                            </strong> 
                                            <span id="info_primer_nombre" class="text-secondary">{{ $nota->primer_nombre }}</span>
                                            <span id="info_segundo_nombre" class="text-secondary">{{ $nota->segundo_nombre }}</span>
                                            <span id="info_primer_apellido" class="text-secondary">{{ $nota->primer_apellido }}</span>
                                            <span id="info_segundo_apellido" class="text-secondary">{{ $nota->segundo_apellido }}</span>
                                            
                                            <strong class="text-primary ml-2">Edad:</strong> 
                                            <span id="info_edad" class="text-secondary">{{ $paciente->edad }}</span>
                                            
                                            <strong class="text-primary ml-2">No. Cédula:</strong> 
                                            <span id="info_no_cedula" class="text-secondary">{{ $nota->no_cedula }}</span>
                                            
                                            <strong class="text-primary ml-2">No. INSS:</strong> 
                                            <span id="info_no_inss" class="text-secondary">{{ $nota->no_inss }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-body">
                            <form method="POST" action="{{ route('notas_evolucion_tratamiento.update', $nota->id) }}">
                                @csrf
                                @method('PUT')
        
                                <div class="form-group col-4">
                                    <label for="paciente_id">ID Paciente</label>
                                    <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $nota->paciente_id }}" required readonly>
                                    @if ($errors->has('paciente_id'))
                                        <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                                    @endif
                                </div>
            
                                <div class="row">
                                    <div class="col-lg-3 form-group">
                                        <label for="primer_nombre">Primer Nombre</label>
                                        <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $nota->primer_nombre) }}" readonly>
                                        @if ($errors->has('primer_nombre'))
                                            <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                                        @endif
                                    </div>
                    
                                    <div class="col-lg-3 form-group">
                                        <label for="segundo_nombre">Segundo Nombre</label>
                                        <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $nota->segundo_nombre) }}" readonly>
                                        @if ($errors->has('segundo_nombre'))
                                            <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                                        @endif
                                    </div>
                    
                                    <div class="col-lg-3 form-group">
                                        <label for="primer_apellido">Primer Apellido</label>
                                        <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $nota->primer_apellido) }}" readonly>
                                        @if ($errors->has('primer_apellido'))
                                            <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                                        @endif
                                    </div>
                    
                                    <div class="col-lg-3 form-group">
                                        <label for="segundo_apellido">Segundo Apellido</label>
                                        <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $nota->segundo_apellido) }}" readonly>
                                        @if ($errors->has('segundo_apellido'))
                                            <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-lg-3 form-group">
                                        <label for="no_expediente">No. Expediente <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-dark" id="no_expediente" name="no_expediente" value="{{ old('no_expediente', $nota->no_expediente) }}" readonly>
                                        @if ($errors->has('no_expediente'))
                                            <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-3 form-group">
                                        <label for="no_cedula">No. Cédula</label>
                                        <input type="text" class="form-control text-dark" id="no_cedula" name="no_cedula" value="{{ old('no_cedula', $nota->no_cedula) }}" readonly>
                                        @if ($errors->has('no_cedula'))
                                            <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                                        @endif
                                    </div>
            
                                    <div class="col-lg-3 form-group">
                                        <label for="no_inss">No. INSS</label>
                                        <input type="text" class="form-control text-dark" id="no_inss" name="no_inss" value="{{ old('no_inss', $nota->no_inss) }}" readonly>
                                        @if ($errors->has('no_inss'))
                                            <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-3 form-group">
                                        <label for="no_cama">No. Cama</label>
                                        <input type="text" class="form-control text-dark" id="no_cama" name="no_cama" value="{{ old('no_cama', $nota->no_cama) }}" >
                                        @if ($errors->has('no_cama'))
                                            <div class="text-danger">{{ $errors->first('no_cama') }}</div>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-lg-3 form-group">
                                        <label for="fecha_hora">Fecha y Hora <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control text-dark" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', $nota->fecha_hora) }}">
                                        @if ($errors->has('fecha_hora'))
                                            <div class="text-danger">{{ $errors->first('fecha_hora') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-lg-3 form-group">
                                        <label for="servicio">Servicio <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-dark" id="servicio" name="servicio" value="{{ old('servicio', $nota->servicio) }}">
                                        @if ($errors->has('servicio'))
                                            <div class="text-danger">{{ $errors->first('servicio') }}</div>
                                        @endif
                                    </div>
            
                                    <div class="col-lg-3 form-group">
                                        <label for="sala">Sala <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-dark" id="sala" name="sala" value="{{ old('sala', $nota->sala) }}">
                                        @if ($errors->has('sala'))
                                            <div class="text-danger">{{ $errors->first('sala') }}</div>
                                        @endif
                                    </div>
            
                                    <div class="col-lg-3 form-group">
                                        <label for="establecimiento_salud">Establecimiento de Salud</label>
                                        <input type="text" class="form-control text-dark" id="establecimiento_salud" name="establecimiento_salud" value="{{ old('establecimiento_salud', $nota->establecimiento_salud) }}">
                                        @if ($errors->has('establecimiento_salud'))
                                            <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="problemas_evolucion">Problemas de Evolución</label>
                                        <textarea class="form-control text-dark" id="problemas_evolucion" name="problemas_evolucion" rows="4">{{ old('problemas_evolucion', $nota->problemas_evolucion) }}</textarea>
                                        @if ($errors->has('problemas_evolucion'))
                                            <div class="text-danger">{{ $errors->first('problemas_evolucion') }}</div>
                                        @endif
                                    </div>
                                
                                    <div class="col-lg-6 form-group">
                                        <label for="planes">Planes</label>
                                        <textarea class="form-control text-dark" id="planes" name="planes" rows="4">{{ old('planes', $nota->planes) }}</textarea>
                                        @if ($errors->has('planes'))
                                            <div class="text-danger">{{ $errors->first('planes') }}</div>
                                        @endif
                                    </div>
                                
                                    <div class="col-lg-6 form-group">
                                        <label for="participantes_atencion">Participantes en la Atención</label>
                                        <textarea class="form-control text-dark" id="participantes_atencion" name="participantes_atencion" rows="4">{{ old('participantes_atencion', $nota->participantes_atencion) }}</textarea>
                                        @if ($errors->has('participantes_atencion'))
                                            <div class="text-danger">{{ $errors->first('participantes_atencion') }}</div>
                                        @endif
                                    </div>
                                
                                    <div class="col-lg-6 form-group">
                                        <label for="firma_codigo_profesional">Firma/Código Profesional</label>
                                        <input type="text" class="form-control text-dark" id="firma_codigo_profesional" name="firma_codigo_profesional" value="{{ old('firma_codigo_profesional', $nota->firma_codigo_profesional) }}">
                                        @if ($errors->has('firma_codigo_profesional'))
                                            <div class="text-danger">{{ $errors->first('firma_codigo_profesional') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
            
            
        
         <br>
        
        
        
          </div>
        </div>
        
        
            @livewireScripts
        @stop
        
        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop
        
        
        @section('js')
           
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
        
        
        @stop
        </section>
</body>
</html>

