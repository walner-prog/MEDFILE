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
            <a class="text-white" href="{{ route('registro_admision_hospitalario.index') }}">
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
                         <h5 class="modal-title text-white" id="editAdmisionEgresoFormLabel{{ $admision->id }}">Editar Admisión/Egreso Hospitalario</h5>
                       
                     </div>
                     <div id="datos-paciente" class="mb-3">
                         <h4>Datos del Paciente</h4>
                         <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                             <div class="mb-2">
                                 <strong class="color-primario">
                                     <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                                 </strong> 
                                 <span id="info_no_expediente" class="text-danger">{{ $admision->no_expediente }}</span>
                             </div>
                             <div class="mb-2">
                                 <strong class="text-primary ml-2">
                                     <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                                 </strong> 
                                 <span id="info_primer_nombre" class="text-secondary">{{ $admision->primer_nombre }}</span>
                                 <span id="info_segundo_nombre" class="text-secondary">{{ $admision->segundo_nombre }}</span>
                                 <span id="info_primer_apellido" class="text-secondary">{{ $admision->primer_apellido }}</span>
                                 <span id="info_segundo_apellido" class="text-secondary">{{ $admision->segundo_apellido }}</span>
                                 
                                 <strong class="text-primary ml-2">Edad:</strong> 
                                 <span id="info_edad" class="text-secondary">{{ $admision->edad }}</span>
                                 
                                 <strong class="text-primary ml-2">No. Cédula:</strong> 
                                 <span id="info_no_cedula" class="text-secondary">{{ $admision->no_cedula }}</span>
                                 
                                 <strong class="text-primary ml-2">No. INSS:</strong> 
                                 <span id="info_no_inss" class="text-secondary">{{ $admision->no_inss }}</span>
                             </div>
                         </div>
                     </div>
                   
 
                 </div>
                
               
             </div>
             <div class="modal-body">
                
                 <form method="POST" action="{{ route('registro_admision_hospitalario.update', $admision->id) }}">
                     @csrf
                     @method('PUT')
 
                     <div class="form-group col-4" hidden>
                         <label for="paciente_id">ID Paciente</label>
                         <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $admision->paciente_id }}" required>
                         @if ($errors->has('paciente_id'))
                             <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                         @endif
                     </div>
                     <div class="row" hidden>
                         <div class="col-lg-3 form-group">
                             <label for="primer_nombre">Primer Nombre</label>
                             <input type="text" class="form-control text-dark" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $admision->primer_nombre) }}" readonly>
                             @if ($errors->has('primer_nombre'))
                                 <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                             @endif
                         </div>
         
                         <div class="col-lg-3 form-group">
                             <label for="segundo_nombre">Segundo Nombre</label>
                             <input type="text" class="form-control text-dark" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $admision->segundo_nombre) }}" readonly>
                             @if ($errors->has('segundo_nombre'))
                                 <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                             @endif
                         </div>
         
                         <div class="col-lg-3 form-group">
                             <label for="primer_apellido">Primer Apellido</label>
                             <input type="text" class="form-control text-dark" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $admision->primer_apellido) }}" readonly>
                             @if ($errors->has('primer_apellido'))
                                 <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                             @endif
                         </div>
         
                         <div class="col-lg-3 form-group">
                             <label for="segundo_apellido">Segundo Apellido</label>
                             <input type="text" class="form-control text-dark" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $admision->segundo_apellido) }}" readonly>
                             @if ($errors->has('segundo_apellido'))
                                 <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                             @endif
                         </div>
                     </div>
 
                   <div class="row" >
                     <div class="col-lg-3 form-group">
                         <label for="no_expediente">No. Expediente <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="no_expediente" name="no_expediente" value="{{ old('no_expediente', $admision->paciente->no_expediente) }}" readonly>
                         @if ($errors->has('no_expediente'))
                             <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="nacionalidad">Nacionalidad <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="nacionalidad" name="nacionalidad" value="{{ old('nacionalidad', $admision->nacionalidad) }}" readonly>
                         @if ($errors->has('nacionalidad'))
                             <div class="text-danger">{{ $errors->first('nacionalidad') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="no_cedula">No. Cédula <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="no_cedula" name="no_cedula" value="{{ old('no_cedula', $admision->no_cedula) }}" readonly>
                         @if ($errors->has('no_cedula'))
                             <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="estado_civil">Estado Civil <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="estado_civil" name="estado_civil" value="{{ old('estado_civil', $admision->estado_civil) }}" readonly>
                         @if ($errors->has('estado_civil'))
                             <div class="text-danger">{{ $errors->first('estado_civil') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="escolaridad">Escolaridad <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="escolaridad" name="escolaridad" value="{{ old('escolaridad', $admision->escolaridad) }}" readonly>
                         @if ($errors->has('escolaridad'))
                             <div class="text-danger">{{ $errors->first('escolaridad') }}</div>
                         @endif
                     </div>
 
                     <div class="col-lg-3 form-group">
                         <label for="categoria_paciente">Categoría Paciente <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="categoria_paciente" name="categoria_paciente" value="{{ old('categoria_paciente', $admision->categoria_paciente) }}" readonly>
                         @if ($errors->has('categoria_paciente'))
                             <div class="text-danger">{{ $errors->first('categoria_paciente') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="no_inss">No. INSS <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="no_inss" name="no_inss" value="{{ old('no_inss', $admision->no_inss) }}" readonly>
                         @if ($errors->has('no_inss'))
                             <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="sexo">Sexo <span class="text-danger">*</span></label>
                         <select class="form-control text-dark" id="sexo" name="sexo" >
                             <option value="M" {{ old('sexo', $admision->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                             <option value="F" {{ old('sexo', $admision->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                         </select>
                         @if ($errors->has('sexo'))
                             <div class="text-danger">{{ $errors->first('sexo') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="establecimiento_salud">Establecimiento de Salud <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="establecimiento_salud" name="establecimiento_salud" value="{{ old('establecimiento_salud', $admision->establecimiento_salud) }}">
                         @if ($errors->has('establecimiento_salud'))
                             <div class="text-danger">{{ $errors->first('establecimiento_salud') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="direccion_residencia">Dirección de Residencia <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="direccion_residencia" name="direccion_residencia" value="{{ old('direccion_residencia', $admision->direccion_residencia) }}">
                         @if ($errors->has('direccion_residencia'))
                             <div class="text-danger">{{ $errors->first('direccion_residencia') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="localidad">Localidad <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="localidad" name="localidad" value="{{ old('localidad', $admision->localidad) }}" readonly>
                         @if ($errors->has('localidad'))
                             <div class="text-danger">{{ $errors->first('localidad') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="municipio">Municipio <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="municipio" name="municipio" value="{{ old('municipio', $admision->municipio) }}" readonly>
                         @if ($errors->has('municipio'))
                             <div class="text-danger">{{ $errors->first('municipio') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="departamento">Departamento <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="departamento" name="departamento" value="{{ old('departamento', $admision->departamento) }}" readonly>
                         @if ($errors->has('departamento'))
                             <div class="text-danger">{{ $errors->first('departamento') }}</div>
                         @endif
                     </div>
 
                     <div class="col-lg-3 form-group">
                         <label for="raza_etnia">Raza/Etnia <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="raza_etnia" name="raza_etnia" value="{{ old('raza_etnia', $admision->raza_etnia) }}" readonly>
                         @if ($errors->has('raza_etnia'))
                             <div class="text-danger">{{ $errors->first('raza_etnia') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="edad">Edad <span class="text-danger">*</span></label>
                         <input type="number" class="form-control text-dark" id="edad" name="edad" value="{{ old('edad', $admision->edad) }}" readonly>
                         @if ($errors->has('edad'))
                             <div class="text-danger">{{ $errors->first('edad') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="ocupacion" name="ocupacion" value="{{ old('ocupacion', $admision->ocupacion) }}" readonly>
                         @if ($errors->has('ocupacion'))
                             <div class="text-danger">{{ $errors->first('ocupacion') }}</div>
                         @endif
                     </div>
                     
                    
 
                     <div class="col-lg-3 form-group">
                         <label for="urgencia_avisar">Urgencia a Avisar <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="urgencia_avisar" name="urgencia_avisar" value="{{ old('urgencia_avisar', $admision->urgencia_avisar) }}" readonly>
                         @if ($errors->has('urgencia_avisar'))
                             <div class="text-danger">{{ $errors->first('urgencia_avisar') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="direccion_telefono_avisar">Dirección y Teléfono de Avisar <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="direccion_telefono_avisar" name="direccion_telefono_avisar" value="{{ old('direccion_telefono_avisar', $admision->direccion_telefono_avisar) }}" readonly>
                         @if ($errors->has('direccion_telefono_avisar'))
                             <div class="text-danger">{{ $errors->first('direccion_telefono_avisar') }}</div>
                         @endif
                     </div>
 
                     <div class="col-lg-3 form-group">
                         <label for="nombre_madre">Nombre de la Madre <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre', $admision->nombre_madre) }}">
                         @if ($errors->has('nombre_madre'))
                             <div class="text-danger">{{ $errors->first('nombre_madre') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="nombre_padre">Nombre del Padre <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre', $admision->nombre_padre) }}">
                         @if ($errors->has('nombre_padre'))
                             <div class="text-danger">{{ $errors->first('nombre_padre') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="ingreso">Ingreso <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="ingreso" name="ingreso" value="{{ old('ingreso', $admision->ingreso) }}">
                         @if ($errors->has('ingreso'))
                             <div class="text-danger">{{ $errors->first('ingreso') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="empleador">Empleador <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="empleador" name="empleador" value="{{ old('empleador', $admision->empleador) }}">
                         @if ($errors->has('empleador'))
                             <div class="text-danger">{{ $errors->first('empleador') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="direccion_empleador">Dirección del Empleador <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="direccion_empleador" name="direccion_empleador" value="{{ old('direccion_empleador', $admision->direccion_empleador) }}">
                         @if ($errors->has('direccion_empleador'))
                             <div class="text-danger">{{ $errors->first('direccion_empleador') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="municipio_distrito">Municipio/Distrito <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="municipio_distrito" name="municipio_distrito" value="{{ old('municipio_distrito', $admision->municipio_distrito) }}">
                         @if ($errors->has('municipio_distrito'))
                             <div class="text-danger">{{ $errors->first('municipio_distrito') }}</div>
                         @endif
                     </div>
 
                     <div class="col-lg-3 form-group">
                         <label for="parentesco">Parentesco <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="parentesco" name="parentesco" value="{{ old('parentesco', $admision->parentesco) }}" readonly>
                         @if ($errors->has('parentesco'))
                             <div class="text-danger">{{ $errors->first('parentesco') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="diagnostico_ingreso">Diagnóstico de Ingreso <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="diagnostico_ingreso" name="diagnostico_ingreso" value="{{ old('diagnostico_ingreso', $admision->diagnostico_ingreso) }}">
                         @if ($errors->has('diagnostico_ingreso'))
                             <div class="text-danger">{{ $errors->first('diagnostico_ingreso') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="forma_llegada_hospital">Forma de Llegada al Hospital <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="forma_llegada_hospital" name="forma_llegada_hospital" value="{{ old('forma_llegada_hospital', $admision->forma_llegada_hospital) }}">
                         @if ($errors->has('forma_llegada_hospital'))
                             <div class="text-danger">{{ $errors->first('forma_llegada_hospital') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="reingreso_mismo_diagnostico">Reingreso con el Mismo Diagnóstico <span class="text-danger">*</span></label>
                         <input type="checkbox" id="reingreso_mismo_diagnostico" name="reingreso_mismo_diagnostico" {{ old('reingreso_mismo_diagnostico', $admision->reingreso_mismo_diagnostico) ? 'checked' : '' }}>
                         @if ($errors->has('reingreso_mismo_diagnostico'))
                             <div class="text-danger">{{ $errors->first('reingreso_mismo_diagnostico') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="sitio_ingreso_hospitalario">Sitio de Ingreso Hospitalario <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="sitio_ingreso_hospitalario" name="sitio_ingreso_hospitalario" value="{{ old('sitio_ingreso_hospitalario', $admision->sitio_ingreso_hospitalario) }}">
                         @if ($errors->has('sitio_ingreso_hospitalario'))
                             <div class="text-danger">{{ $errors->first('sitio_ingreso_hospitalario') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="nombre_medico">Nombre del Médico <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="nombre_medico" name="nombre_medico" value="{{ old('nombre_medico', $admision->nombre_medico) }}">
                         @if ($errors->has('nombre_medico'))
                             <div class="text-danger">{{ $errors->first('nombre_medico') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="sello_medico_ingreso">Sello Médico de Ingreso <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="sello_medico_ingreso" name="sello_medico_ingreso" value="{{ old('sello_medico_ingreso', $admision->sello_medico_ingreso) }}">
                         @if ($errors->has('sello_medico_ingreso'))
                             <div class="text-danger">{{ $errors->first('sello_medico_ingreso') }}</div>
                         @endif
                     </div>
 
                     <div class="col-lg-3 form-group">
                         <label for="egreso_fecha">Fecha de Egreso <span class="text-danger">*</span></label>
                         <input type="date" class="form-control text-dark" id="egreso_fecha" name="egreso_fecha" value="{{ old('egreso_fecha', $admision->egreso_fecha) }}">
                         @if ($errors->has('egreso_fecha'))
                             <div class="text-danger">{{ $errors->first('egreso_fecha') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="egreso_hora">Hora de Egreso <span class="text-danger">*</span></label>
                         <input type="time" class="form-control text-dark" id="egreso_hora" name="egreso_hora" value="{{ old('egreso_hora', $admision->egreso_hora) }}">
                         @if ($errors->has('egreso_hora'))
                             <div class="text-danger">{{ $errors->first('egreso_hora') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="diagnostico_egreso">Diagnóstico de Egreso <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="diagnostico_egreso" name="diagnostico_egreso" value="{{ old('diagnostico_egreso', $admision->diagnostico_egreso) }}">
                         @if ($errors->has('diagnostico_egreso'))
                             <div class="text-danger">{{ $errors->first('diagnostico_egreso') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="diagnostico_egreso_principal">Diagnóstico de Egreso Principal <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="diagnostico_egreso_principal" name="diagnostico_egreso_principal" value="{{ old('diagnostico_egreso_principal', $admision->diagnostico_egreso_principal) }}">
                         @if ($errors->has('diagnostico_egreso_principal'))
                             <div class="text-danger">{{ $errors->first('diagnostico_egreso_principal') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="diagnostico_egreso_complementarios">Diagnósticos de Egreso Complementarios <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="diagnostico_egreso_complementarios" name="diagnostico_egreso_complementarios" value="{{ old('diagnostico_egreso_complementarios', $admision->diagnostico_egreso_complementarios) }}">
                         @if ($errors->has('diagnostico_egreso_complementarios'))
                             <div class="text-danger">{{ $errors->first('diagnostico_egreso_complementarios') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="cirugias_realizadas">Cirugías Realizadas <span class="text-danger">*</span></label>
                         <textarea class="form-control text-dark" id="cirugias_realizadas" name="cirugias_realizadas">{{ old('cirugias_realizadas', $admision->cirugias_realizadas) }}</textarea>
                         @if ($errors->has('cirugias_realizadas'))
                             <div class="text-danger">{{ $errors->first('cirugias_realizadas') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="nombre_admisionista">Nombre del Admisiónista <span class="text-danger">*</span></label>
                         <input type="text" class="form-control text-dark" id="nombre_admisionista" name="nombre_admisionista" value="{{ old('nombre_admisionista', $admision->nombre_admisionista) }}">
                         @if ($errors->has('nombre_admisionista'))
                             <div class="text-danger">{{ $errors->first('nombre_admisionista') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="dias_estancia">Días de Estancia <span class="text-danger">*</span></label>
                         <input type="number" class="form-control text-dark" id="dias_estancia" name="dias_estancia" value="{{ old('dias_estancia', $admision->dias_estancia) }}">
                         @if ($errors->has('dias_estancia'))
                             <div class="text-danger">{{ $errors->first('dias_estancia') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="causa_trauma">Causa del Trauma</label>
                         <input type="text" class="form-control text-dark" id="causa_trauma" name="causa_trauma" value="{{ old('causa_trauma', $admision->causa_trauma) }}">
                         @if ($errors->has('causa_trauma'))
                             <div class="text-danger">{{ $errors->first('causa_trauma') }}</div>
                         @endif
                     </div>
                     
 
                     <div class="col-lg-3 form-group">
                         <label for="accidente_trabajo">Accidente de Trabajo</label>
                         <input type="checkbox" class="form-check-input ml-4" id="accidente_trabajo" name="accidente_trabajo" value="1" {{ old('accidente_trabajo', $admision->accidente_trabajo) ? 'checked' : '' }}>
                         @if ($errors->has('accidente_trabajo'))
                             <div class="text-danger">{{ $errors->first('accidente_trabajo') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="de_trayecto">Accidente de Trayecto</label>
                         <input type="checkbox" class="form-check-input ml-4" id="de_trayecto" name="de_trayecto" value="1" {{ old('de_trayecto', $admision->de_trayecto) ? 'checked' : '' }}>
                         @if ($errors->has('de_trayecto'))
                             <div class="text-danger">{{ $errors->first('de_trayecto') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="enfermedad_laboral">Enfermedad Laboral</label>
                         <input type="checkbox" class="form-check-input ml-4" id="enfermedad_laboral" name="enfermedad_laboral" value="1" {{ old('enfermedad_laboral', $admision->enfermedad_laboral) ? 'checked' : '' }}>
                         @if ($errors->has('enfermedad_laboral'))
                             <div class="text-danger">{{ $errors->first('enfermedad_laboral') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="infeccion_intrahospitalaria">Infección Intrahospitalaria</label>
                         <input type="checkbox" class="form-check-input ml-4" id="infeccion_intrahospitalaria" name="infeccion_intrahospitalaria" value="1" {{ old('infeccion_intrahospitalaria', $admision->infeccion_intrahospitalaria) ? 'checked' : '' }}>
                         @if ($errors->has('infeccion_intrahospitalaria'))
                             <div class="text-danger">{{ $errors->first('infeccion_intrahospitalaria') }}</div>
                         @endif
                     </div>
                     
                     <div class="col-lg-3 form-group">
                         <label for="referido_otro_establecimiento">Referido a Otro Establecimiento</label>
                         <input type="text" class="form-control text-dark" id="referido_otro_establecimiento" name="referido_otro_establecimiento" value="{{ old('referido_otro_establecimiento', $admision->referido_otro_establecimiento) }}">
                         @if ($errors->has('referido_otro_establecimiento'))
                             <div class="text-danger">{{ $errors->first('referido_otro_establecimiento') }}</div>
                         @endif
                     </div>
                     
                     
                   </div>
 
                     <div class="modal-footer">
                      
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