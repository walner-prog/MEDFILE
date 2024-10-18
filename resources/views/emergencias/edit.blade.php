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

@section('title', 'AdminSalud')



@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item active"aria-current="page">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Emergencias </li>
                    <li class="breadcrumb-item " >Edit</li>
                </ol>
            </nav>
        </div>
        
    </div>
     <div class="row">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('emergencias.index') }}">
                <button class="btn btn-info ">
                    <i class="fas fa-house-medical-circle-check"></i> Regresar
                </button>
            </a>
           
        </div>
        <div class="col-lg-10 text-right">
           
        </div>
     </div>

     @can('editar-emergencia')
     <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
              <div class="row">
                  <div class="col-lg-8">
                      <h5 class="modal-title text-white" id="editAdmisionEgresoFormLabel{{ $emergencia->id }}">Editar Admisión/Egreso Hospitalario</h5>
                    
                  </div>
                  <div id="datos-paciente" class="mb-3">
                      <h4>Datos del Paciente</h4>
                      <div class="p-3 mb-2 border rounded datos-pacientes bg-white">
                          <div class="mb-2">
                              <strong class="color-primario">
                                  <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:
                              </strong> 
                              <span id="info_no_expediente" class="text-danger">{{ $emergencia->no_expediente }}</span>
                          </div>
                          <div class="mb-2">
                              <strong class="text-primary ml-2">
                                  <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                              </strong> 
                              <span id="info_primer_nombre" class="text-secondary">{{ $emergencia->primer_nombre }}</span>
                              <span id="info_segundo_nombre" class="text-secondary">{{ $emergencia->segundo_nombre }}</span>
                              <span id="info_primer_apellido" class="text-secondary">{{ $emergencia->primer_apellido }}</span>
                              <span id="info_segundo_apellido" class="text-secondary">{{ $emergencia->segundo_apellido }}</span>
                              
                              <strong class="text-primary ml-2">Edad:</strong> 
                              <span id="info_edad" class="text-secondary">{{ $emergencia->edad }}</span>
                              
                              <strong class="text-primary ml-2">No. Cédula:</strong> 
                              <span id="info_no_cedula" class="text-secondary">{{ $emergencia->no_cedula }}</span>
                              
                              <strong class="text-primary ml-2">No. INSS:</strong> 
                              <span id="info_no_inss" class="text-secondary">{{ $emergencia->no_inss }}</span>
                          </div>
                      </div>
                  </div>
                

              </div>
              
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('emergencias.update', $emergencia->id) }}">
                  @csrf
                  @method('PUT') <!-- Use PUT method for updating -->
                  <input type="hidden" id="edit_emergencia_id" name="emergencia_id"> <!-- Hidden field for ID -->

                <div class="row">
     
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="paciente_id">ID Paciente</label>
                            <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $emergencia->paciente_id }}" required>
                            @if ($errors->has('paciente_id'))
                                <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                            @endif
                        </div>
                    </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control edit_imput" id="fecha" name="fecha" value="{{ $emergencia->fecha }}" required>
                            @if ($errors->has('fecha'))
                                <div class="text-danger">{{ $errors->first('fecha') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="no_expediente">No. Expediente</label>
                            <input type="text" class="form-control edit_imput" id="no_expediente" name="no_expediente" value="{{ $emergencia->no_expediente }}" required>
                            @if ($errors->has('no_expediente'))
                                <div class="text-danger">{{ $errors->first('no_expediente') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control edit_imput" id="hora" name="hora" value="{{ $emergencia->hora }}" required>
                            @if ($errors->has('hora'))
                                <div class="text-danger">{{ $errors->first('hora') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="unidad_salud">Unidad de Salud</label>
                            <input type="text" class="form-control edit_imput" id="unidad_salud" name="unidad_salud" value="{{ $emergencia->unidad_salud }}" required>
                            @if ($errors->has('unidad_salud'))
                                <div class="text-danger">{{ $errors->first('unidad_salud') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="primer_nombre">Primer Nombre</label>
                            <input type="text" class="form-control edit_imput" id="primer_nombre" name="primer_nombre" value="{{ $emergencia->primer_nombre }}" required>
                            @if ($errors->has('primer_nombre'))
                                <div class="text-danger">{{ $errors->first('primer_nombre') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="segundo_nombre">Segundo Nombre</label>
                            <input type="text" class="form-control edit_imput" id="segundo_nombre" name="segundo_nombre" value="{{ $emergencia->segundo_nombre }}" required>
                            @if ($errors->has('segundo_nombre'))
                                <div class="text-danger">{{ $errors->first('segundo_nombre') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="primer_apellido">Primer Apellido</label>
                            <input type="text" class="form-control edit_imput" id="primer_apellido" name="primer_apellido" value="{{ $emergencia->primer_apellido }}">
                            @if ($errors->has('primer_apellido'))
                                <div class="text-danger">{{ $errors->first('primer_apellido') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="segundo_apellido">Segundo Apellido</label>
                            <input type="text" class="form-control edit_imput" id="segundo_apellido" name="segundo_apellido" value="{{ $emergencia->segundo_apellido }}">
                            @if ($errors->has('segundo_apellido'))
                                <div class="text-danger">{{ $errors->first('segundo_apellido') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="edad">Edad</label>
                            <input type="number" class="form-control edit_imput" id="edad" name="edad" value="{{ $emergencia->edad }}" required>
                            @if ($errors->has('edad'))
                                <div class="text-danger">{{ $errors->first('edad') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <select class="form-control edit_imput" id="sexo" name="sexo" required>
                                <option value="M" {{ $emergencia->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ $emergencia->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @if ($errors->has('sexo'))
                                <div class="text-danger">{{ $errors->first('sexo') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="sala_servicio">Sala/Servicio</label>
                            <input type="text" class="form-control edit_imput" id="sala_servicio" name="sala_servicio" value="{{ $emergencia->sala_servicio }}">
                            @if ($errors->has('sala_servicio'))
                                <div class="text-danger">{{ $errors->first('sala_servicio') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="cama">Cama</label>
                            <input type="text" class="form-control edit_imput" id="cama" name="cama" value="{{ $emergencia->cama }}">
                            @if ($errors->has('cama'))
                                <div class="text-danger">{{ $errors->first('cama') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="ocupacion">Ocupación</label>
                            <input type="text" class="form-control edit_imput" id="ocupacion" name="ocupacion" value="{{ $emergencia->ocupacion }}">
                            @if ($errors->has('ocupacion'))
                                <div class="text-danger">{{ $errors->first('ocupacion') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="direccion_residencia">Dirección de Residencia</label>
                            <input type="text" class="form-control edit_imput" id="direccion_residencia" name="direccion_residencia" value="{{ $emergencia->direccion_residencia }}">
                            @if ($errors->has('direccion_residencia'))
                                <div class="text-danger">{{ $errors->first('direccion_residencia') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="localidad">Localidad</label>
                            <input type="text" class="form-control edit_imput" id="localidad" name="localidad" value="{{ $emergencia->localidad }}">
                            @if ($errors->has('localidad'))
                                <div class="text-danger">{{ $errors->first('localidad') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <input type="text" class="form-control edit_imput" id="departamento" name="departamento" value="{{ $emergencia->departamento }}">
                            @if ($errors->has('departamento'))
                                <div class="text-danger">{{ $errors->first('departamento') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control edit_imput" id="telefono" name="telefono" value="{{ $emergencia->telefono }}">
                            @if ($errors->has('telefono'))
                                <div class="text-danger">{{ $errors->first('telefono') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="nombre_responsable">Nombre del Responsable</label>
                            <input type="text" class="form-control edit_imput" id="nombre_responsable" name="nombre_responsable" value="{{ $emergencia->nombre_responsable }}">
                            @if ($errors->has('nombre_responsable'))
                                <div class="text-danger">{{ $errors->first('nombre_responsable') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="direccion_responsable">Dirección del Responsable</label>
                            <input type="text" class="form-control edit_imput" id="direccion_responsable" name="direccion_responsable" value="{{ $emergencia->direccion_responsable }}">
                            @if ($errors->has('direccion_responsable'))
                                <div class="text-danger">{{ $errors->first('direccion_responsable') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="no_inss">No. INSS</label>
                            <input type="text" class="form-control edit_imput" id="no_inss" name="no_inss" value="{{ $emergencia->no_inss }}">
                            @if ($errors->has('no_inss'))
                                <div class="text-danger">{{ $errors->first('no_inss') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="no_cedula">No. Cédula</label>
                            <input type="text" class="form-control edit_imput" id="no_cedula" name="no_cedula" value="{{ $emergencia->no_cedula }}">
                            @if ($errors->has('no_cedula'))
                                <div class="text-danger">{{ $errors->first('no_cedula') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="medio_llegada">Medio de Llegada</label>
                            <input type="text" class="form-control edit_imput" id="medio_llegada" name="medio_llegada" value="{{ $emergencia->medio_llegada }}">
                            @if ($errors->has('medio_llegada'))
                                <div class="text-danger">{{ $errors->first('medio_llegada') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="causa_accidente_violencia">Causa de Accidente/Violencia</label>
                            <input type="text" class="form-control edit_imput" id="causa_accidente_violencia" name="causa_accidente_violencia" value="{{ $emergencia->causa_accidente_violencia }}">
                            @if ($errors->has('causa_accidente_violencia'))
                                <div class="text-danger">{{ $errors->first('causa_accidente_violencia') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="causa_tratamiento">Causa de Tratamiento</label>
                            <input type="text" class="form-control edit_imput" id="causa_tratamiento" name="causa_tratamiento" value="{{ $emergencia->causa_tratamiento }}">
                            @if ($errors->has('causa_tratamiento'))
                                <div class="text-danger">{{ $errors->first('causa_tratamiento') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="lugar_accidente_violencia">Lugar de Accidente/Violencia</label>
                            <input type="text" class="form-control edit_imput" id="lugar_accidente_violencia" name="lugar_accidente_violencia" value="{{ $emergencia->lugar_accidente_violencia }}">
                            @if ($errors->has('lugar_accidente_violencia'))
                                <div class="text-danger">{{ $errors->first('lugar_accidente_violencia') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="vif">VIF</label>
                            <input type="text" class="form-control edit_imput" id="vif" name="vif" value="{{ $emergencia->vif }}">
                            @if ($errors->has('vif'))
                                <div class="text-danger">{{ $errors->first('vif') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="direccion_avisar">Dirección para Avisar</label>
                            <input type="text" class="form-control edit_imput" id="direccion_avisar" name="direccion_avisar" value="{{ $emergencia->direccion_avisar }}">
                            @if ($errors->has('direccion_avisar'))
                                <div class="text-danger">{{ $errors->first('direccion_avisar') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="parentesco">Parentesco</label>
                            <input type="text" class="form-control edit_imput" id="parentesco" name="parentesco" value="{{ $emergencia->parentesco }}">
                            @if ($errors->has('parentesco'))
                                <div class="text-danger">{{ $errors->first('parentesco') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="telefono_responsable">Teléfono del Responsable</label>
                            <input type="text" class="form-control edit_imput" id="telefono_responsable" name="telefono_responsable" value="{{ $emergencia->telefono_responsable }}">
                            @if ($errors->has('telefono_responsable'))
                                <div class="text-danger">{{ $errors->first('telefono_responsable') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="localidad_avisar">Localidad para Avisar</label>
                            <input type="text" class="form-control edit_imput" id="localidad_avisar" name="localidad_avisar" value="{{ $emergencia->localidad_avisar }}">
                            @if ($errors->has('localidad_avisar'))
                                <div class="text-danger">{{ $errors->first('localidad_avisar') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="departamento_avisar">Departamento para Avisar</label>
                            <input type="text" class="form-control edit_imput" id="departamento_avisar" name="departamento_avisar" value="{{ $emergencia->departamento_avisar }}">
                            @if ($errors->has('departamento_avisar'))
                                <div class="text-danger">{{ $errors->first('departamento_avisar') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="peso">Peso del paciente</label>
                            <input type="number" class="form-control edit_imput" id="peso" name="peso" value="{{ $emergencia->peso }}" required>
                            @if ($errors->has('peso'))
                                <div class="text-danger">{{ $errors->first('peso') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="talla">Talla del paciente</label>
                            <input type="number" class="form-control edit_imput" id="talla" name="talla" value="{{ $emergencia->talla }}" required>
                            @if ($errors->has('talla'))
                                <div class="text-danger">{{ $errors->first('talla') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="temperatura">Temperatura del paciente</label>
                            <input type="number" class="form-control edit_imput" id="temperatura" name="temperatura" value="{{ $emergencia->temperatura }}" required>
                            @if ($errors->has('temperatura'))
                                <div class="text-danger">{{ $errors->first('temperatura') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="nombre_quien_atiende">Nombre quien atiende</label>
                            <input type="text" class="form-control" id="nombre_quien_atiende" name="nombre_quien_atiende" value="{{ $emergencia->nombre_quien_atiende }}">
                            @if ($errors->has('nombre_quien_atiende'))
                                <div class="text-danger">{{ $errors->first('nombre_quien_atiende') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="frecuencia_cardiaca">Frecuencia Cardíaca</label>
                            <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" value="{{ $emergencia->frecuencia_cardiaca }}">
                            @if ($errors->has('frecuencia_cardiaca'))
                                <div class="text-danger">{{ $errors->first('frecuencia_cardiaca') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="frecuencia_respiratoria">Frecuencia Respiratoria</label>
                            <input type="number" class="form-control" id="frecuencia_respiratoria" name="frecuencia_respiratoria" value="{{ $emergencia->frecuencia_respiratoria }}">
                            @if ($errors->has('frecuencia_respiratoria'))
                                <div class="text-danger">{{ $errors->first('frecuencia_respiratoria') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="examen_fisico">Examen Físico</label>
                            <input type="text" class="form-control" id="examen_fisico" name="examen_fisico" value="{{ $emergencia->examen_fisico }}">
                            @if ($errors->has('examen_fisico'))
                                <div class="text-danger">{{ $errors->first('examen_fisico') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="diagnostico">Diagnóstico</label>
                            <input type="text" class="form-control" id="diagnostico" name="diagnostico" value="{{ old('diagnostico', $emergencia->diagnostico) }}">
                            @if ($errors->has('diagnostico'))
                                <div class="text-danger">{{ $errors->first('diagnostico') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="planes">Planes</label>
                            <input type="text" class="form-control" id="planes" name="planes" value="{{ old('planes', $emergencia->planes) }}">
                            @if ($errors->has('planes'))
                                <div class="text-danger">{{ $errors->first('planes') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="diagnostico_egreso">Diagnóstico de Egreso</label>
                            <input type="text" class="form-control" id="diagnostico_egreso" name="diagnostico_egreso" value="{{ old('diagnostico_egreso', $emergencia->diagnostico_egreso) }}">
                            @if ($errors->has('diagnostico_egreso'))
                                <div class="text-danger">{{ $errors->first('diagnostico_egreso') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tipo_urgencia">Tipo de Urgencia</label>
                            <input type="text" class="form-control" id="tipo_urgencia" name="tipo_urgencia" value="{{ old('tipo_urgencia', $emergencia->tipo_urgencia) }}">
                            @if ($errors->has('tipo_urgencia'))
                                <div class="text-danger">{{ $errors->first('tipo_urgencia') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="destino_paciente">Destino del Paciente</label>
                            <input type="text" class="form-control" id="destino_paciente" name="destino_paciente" value="{{ old('destino_paciente', $emergencia->destino_paciente) }}">
                            @if ($errors->has('destino_paciente'))
                                <div class="text-danger">{{ $errors->first('destino_paciente') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" value="{{ old('referencia', $emergencia->referencia) }}">
                            @if ($errors->has('referencia'))
                                <div class="text-danger">{{ $errors->first('referencia') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="hospitalizacion">Hospitalización</label>
                            <input type="text" class="form-control" id="hospitalizacion" name="hospitalizacion" value="{{ old('hospitalizacion', $emergencia->hospitalizacion) }}">
                            @if ($errors->has('hospitalizacion'))
                                <div class="text-danger">{{ $errors->first('hospitalizacion') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="consulta_externa">Consulta Externa</label>
                            <input type="text" class="form-control" id="consulta_externa" name="consulta_externa" value="{{ old('consulta_externa', $emergencia->consulta_externa) }}">
                            @if ($errors->has('consulta_externa'))
                                <div class="text-danger">{{ $errors->first('consulta_externa') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fuga">Fuga</label>
                            <input type="text" class="form-control" id="fuga" name="fuga" value="{{ old('fuga', $emergencia->fuga) }}">
                            @if ($errors->has('fuga'))
                                <div class="text-danger">{{ $errors->first('fuga') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="salida_exigida">Salida Exigida</label>
                            <input type="text" class="form-control" id="salida_exigida" name="salida_exigida" value="{{ old('salida_exigida', $emergencia->salida_exigida) }}">
                            @if ($errors->has('salida_exigida'))
                                <div class="text-danger">{{ $errors->first('salida_exigida') }}</div>
                            @endif
                        </div>
                    </div>
                    
                </div>

                  <div class="modal-footer">
                      
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
     @endcan
    
      

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

    
</body>
</html>

    