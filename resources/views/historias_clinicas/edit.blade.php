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
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item active"aria-current="page">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Historias Clinicas </li>
                    <li class="breadcrumb-item " >Edit</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <br>
     <div class="row">
        <div class="col-lg-2 ">
            <a class="text-white" href="{{ route('historias_clinicas.index') }}">
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
                       <h5 class="modal-title text-white" id="edithistorias_clinicasModalLabel{{ $historiasClinica->id }}">Editar Registro de Emergencia de {{ $historiasClinica->primer_nombre }} {{ $historiasClinica->primer_apellido }}</h5>
                   </div>
                   <div id="datos-paciente" class="mb-3" >
                       <h4>Datos del Paciente</h4>
                      
                       <div class="p-3 mb-2  border rounded  datos-pacientes  bg-white ">
                           <div class="mb-2">
                          <strong class="color-primario"> <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:</strong> <span id="info_no_expediente" class="text-danger">{{ $historiasClinica->paciente->no_expediente }}</span>
                           </div>
                           <div class="mb-2">
                               <strong class="text-primary ml-2">
                                   <i class="fa-solid fa-hospital-user"></i> Nombres y Apellidos:
                               </strong> 
                               <span id="info_primer_nombre" class="text-secondary">{{ $historiasClinica->paciente->primer_nombre }}</span>
                               <span id="info_segundo_nombre" class="text-secondary">{{ $historiasClinica->paciente->segundo_nombre }}</span>
                               <span id="info_primer_apellido" class="text-secondary">{{ $historiasClinica->paciente->primer_apellido }}</span>
                               <span id="info_segundo_apellido" class="text-secondary">{{ $historiasClinica->paciente->segundo_apellido }}</span>
                           
                               <strong class="text-primary ml-2">Edad:</strong> 
                               <span id="info_edad" class="text-secondary">{{ $historiasClinica->paciente->edad }}</span>
                           
                               <strong class="text-primary ml-2">Sexo:</strong> 
                               <span id="info_sexo" class="text-secondary">{{ $historiasClinica->paciente->sexo }}</span>
                           
                               <strong class="text-primary ml-2">No. Cédula:</strong> 
                               <span id="info_no_cedula" class="text-secondary">{{ $historiasClinica->paciente->no_cedula }}</span>
                           
                               <strong class="text-primary ml-2">No. INSS:</strong> 
                               <span id="info_no_inss" class="text-secondary">{{ $historiasClinica->paciente->no_inss }}</span>
                           </div>
                          
                         
                       </div>
                       
                   
                   </div>
                   
                  
               </div>
           </div>

           <div class="modal-body">
               <form method="POST" action="{{ route('historias_clinicas.update', $historiasClinica->id) }}">
                   @csrf
                   @method('PUT')
                   <div class="form-group">
                       <label for="paciente_id">ID Paciente</label>
                       <input type="text" class="form-control edit_imput" id="paciente_id" name="paciente_id" value="{{ $historiasClinica->paciente_id }}" required readonly>
                       @if ($errors->has('paciente_id'))
                           <div class="text-danger">{{ $errors->first('paciente_id') }}</div>
                       @endif
                   </div>
                   <div id="stepedit1" class="step">
                      
                      
                       <div class="row">
                         
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="escolaridad">Escolaridad <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="escolaridad" name="escolaridad" value="{{ old('escolaridad', $historiasClinica->escolaridad) }}" required>
                                   @if ($errors->has('escolaridad'))
                                       <div class="text-danger">{{ $errors->first('escolaridad') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="direccion_habitual">Dirección habitual <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="direccion_habitual" name="direccion_habitual" value="{{ old('direccion_habitual', $historiasClinica->direccion_habitual) }}" required>
                                   @if ($errors->has('direccion_habitual'))
                                       <div class="text-danger">{{ $errors->first('direccion_habitual') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="hora">Hora <span class="text-danger">*</span></label>
                                   <input type="time" class="form-control edit_imput text-dark" id="hora" name="hora" value="{{ old('hora', $historiasClinica->hora) }}">
                                   @if ($errors->has('hora'))
                                       <div class="text-danger">{{ $errors->first('hora') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="sala">Sala <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="sala" name="sala" value="{{ old('sala', $historiasClinica->sala) }}">
                                   @if ($errors->has('sala'))
                                       <div class="text-danger">{{ $errors->first('sala') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="is_ingresado" name="is_ingresado" {{ old('is_ingresado', $historiasClinica->is_ingresado) ? 'checked' : '' }}>
                                   <label class="form-check-label" for="is_ingresado">Paciente Ingresado (Si - No)</label>
                               </div>
                               <div id="no_cama_container" class="col-lg-3" >
                                   <div class="form-group">
                                       <label for="no_cama">No. de Cama <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="no_cama" name="no_cama" value="{{ old('no_cama', $historiasClinica->no_cama) }}">
                                       @if ($errors->has('no_cama'))
                                           <div class="text-danger">{{ $errors->first('no_cama') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="lugar_nacimiento">Lugar de Nacimiento <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="lugar_nacimiento" name="lugar_nacimiento" value="{{ old('lugar_nacimiento', $historiasClinica->lugar_nacimiento) }}">
                                   @if ($errors->has('lugar_nacimiento'))
                                       <div class="text-danger">{{ $errors->first('lugar_nacimiento') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="procedencia">Procedencia <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="procedencia" name="procedencia" value="{{ old('procedencia', $historiasClinica->procedencia) }}">
                                   @if ($errors->has('procedencia'))
                                       <div class="text-danger">{{ $errors->first('procedencia') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="religion">Religión <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="religion" name="religion" value="{{ old('religion', $historiasClinica->religion) }}">
                                   @if ($errors->has('religion'))
                                       <div class="text-danger">{{ $errors->first('religion') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                          
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="nombre_padre">Nombre del Padre <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre', $historiasClinica->nombre_padre) }}">
                                   @if ($errors->has('nombre_padre'))
                                       <div class="text-danger">{{ $errors->first('nombre_padre') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="fuente_informacion">Fuente de Información <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="fuente_informacion" name="fuente_informacion" value="{{ old('fuente_informacion', $historiasClinica->fuente_informacion) }}">
                                   @if ($errors->has('fuente_informacion'))
                                       <div class="text-danger">{{ $errors->first('fuente_informacion') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="profesion_oficio">Profesión u Oficio <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="profesion_oficio" name="profesion_oficio" value="{{ old('profesion_oficio', $historiasClinica->profesion_oficio) }}">
                                   @if ($errors->has('profesion_oficio'))
                                       <div class="text-danger">{{ $errors->first('profesion_oficio') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="nombre_madre">Nombre de la Madre <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre', $historiasClinica->nombre_madre) }}">
                                   @if ($errors->has('nombre_madre'))
                                       <div class="text-danger">{{ $errors->first('nombre_madre') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="confiabilidad">Confiabilidad <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="confiabilidad" name="confiabilidad" value="{{ old('confiabilidad', $historiasClinica->confiabilidad) }}">
                                   @if ($errors->has('confiabilidad'))
                                       <div class="text-danger">{{ $errors->first('confiabilidad') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>
                       
                   </div>

                <div id="stepedit" class="step" >
                        <div class="row">
                           <!-- Motivo de Consulta -->
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="motivo_consulta">Motivo de Consulta <span class="text-danger">*</span></label>
                                   <textarea  id="motivo_consulta"  class="form-control edit_imput text-dark" name="motivo_consulta">{{ old('motivo_consulta', $historiasClinica->motivo_consulta) }}</textarea>
                                   @if ($errors->has('motivo_consulta'))
                                       <div class="text-danger">{{ $errors->first('motivo_consulta') }}</div>
                                   @endif
                               </div>
                           </div>
                   
                           <!-- Historia de la Enfermedad Actual -->
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="historia_enfermedad_actual">Historia de la Enfermedad Actual <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="historia_enfermedad_actual" name="historia_enfermedad_actual">{{ old('historia_enfermedad_actual', $historiasClinica->historia_enfermedad_actual) }}</textarea>
                                   @if ($errors->has('historia_enfermedad_actual'))
                                       <div class="text-danger">{{ $errors->first('historia_enfermedad_actual') }}</div>
                                   @endif
                               </div>
                           </div>
                   
                           <!-- Interrogatorio por Aparatos y Sistemas -->
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="interrogatorio_aparatos_sistemas">Interrogatorio por Aparatos y Sistemas <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="interrogatorio_aparatos_sistemas" name="interrogatorio_aparatos_sistemas">{{ old('interrogatorio_aparatos_sistemas', $historiasClinica->interrogatorio_aparatos_sistemas) }}</textarea>
                                   @if ($errors->has('interrogatorio_aparatos_sistemas'))
                                       <div class="text-danger">{{ $errors->first('interrogatorio_aparatos_sistemas') }}</div>
                                   @endif
                               </div>
                           </div>
                   
                           <!-- Inmunizaciones Completas -->
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="inmunizaciones_completas">Inmunizaciones Completas <span class="text-danger">*</span></label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="inmunizaciones_completas" name="inmunizaciones_completas" value="1" {{ old('inmunizaciones_completas', $historiasClinica->inmunizaciones_completas) ? 'checked' : '' }}>
                                   @if ($errors->has('inmunizaciones_completas'))
                                       <div class="text-danger">{{ $errors->first('inmunizaciones_completas') }}</div>
                                   @endif
                               </div>
                               <div id="detalle_inmunizaciones_container"  {{ old('inmunizaciones_completas', $historiasClinica->inmunizaciones_completas)  }};">
                                   <div class="form-group">
                                       <label for="detalle_inmunizaciones">Detalle de Inmunizaciones</label>
                                       <textarea class="form-control edit_imput text-dark" id="detalle_inmunizaciones" name="detalle_inmunizaciones">{{ old('detalle_inmunizaciones', $historiasClinica->detalle_inmunizaciones) }}</textarea>
                                       @if ($errors->has('detalle_inmunizaciones'))
                                           <div class="text-danger">{{ $errors->first('detalle_inmunizaciones') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                   
                           <!-- Horas de Sueño -->
                           <div class="col-lg-1">
                               <div class="form-group">
                                   <label for="horas_sueno">Horas de Sueño <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="horas_sueno" name="horas_sueno" value="{{ old('horas_sueno', $historiasClinica->horas_sueno) }}">
                                   @if ($errors->has('horas_sueno'))
                                       <div class="text-danger">{{ $errors->first('horas_sueno') }}</div>
                                   @endif
                               </div>
                           </div>
                   
                           <!-- Horas Laborales -->
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="horas_laborales">Horas Laborales <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="horas_laborales" name="horas_laborales" value="{{ old('horas_laborales', $historiasClinica->horas_laborales) }}">
                                   @if ($errors->has('horas_laborales'))
                                       <div class="text-danger">{{ $errors->first('horas_laborales') }}</div>
                                   @endif
                               </div>
                           </div>
                   
                           <!-- Antecedentes familiares patológicos -->
                           <h4 class="fw-bold">Antecedentes familiares patológicos:</h4>
                           <hr>
                           <div class="row">
                               <div class="col-lg-6 ">
                                   <div class="form-group">
                                       <label for="enfermedades_hereditarias">Enfermedades Hereditarias <span class="text-danger">*</span></label>
                                       <textarea class="form-control" id="enfermedades_hereditarias" name="enfermedades_hereditarias" rows="5">{{ old('enfermedades_hereditarias', $historiasClinica->enfermedades_hereditarias ?? '') }}</textarea>
                                       @if ($errors->has('enfermedades_hereditarias'))
                                           <div class="text-danger">{{ $errors->first('enfermedades_hereditarias') }}</div>
                                       @endif
                                   </div>
                               </div>
                           
                   
                               <div class="col-lg-6 ">
                                   <div class="form-group">
                                       <label for="enfermedades_infecto_contagiosas">Enfermedades Infecto-Contagiosas <span class="text-danger">*</span></label>
                                       <textarea class="form-control" id="enfermedades_infecto_contagiosas" name="enfermedades_infecto_contagiosas" rows="5">{{ old('enfermedades_infecto_contagiosas', $historiasClinica->enfermedades_infecto_contagiosas ?? '') }}</textarea>
                                       @if ($errors->has('enfermedades_infecto_contagiosas'))
                                           <div class="text-danger">{{ $errors->first('enfermedades_infecto_contagiosas') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               
                               
                           </div>

                   
                           

                       </div>


                       <div id="" class="step" style="">
                           
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="tipo_hora_actividad_fisica">Tipo y Hora de Actividad Física <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="tipo_hora_actividad_fisica" name="tipo_hora_actividad_fisica">{{ old('tipo_hora_actividad_fisica', $historiasClinica->tipo_hora_actividad_fisica) }}</textarea>
                                   @if ($errors->has('tipo_hora_actividad_fisica'))
                                       <div class="text-danger">{{ $errors->first('tipo_hora_actividad_fisica') }}</div>
                                   @endif
                               </div>
                           </div>
                           <!-- Mensaje explicativo -->
                           <div id="infoMessage" class="alert alert-info" role="alert" style="display: none;">
                               Por favor, complete los campos según corresponda. Marque las opciones relevantes para que se muestren los campos adicionales necesarios.
                           </div>
                           <!-- Botón para mostrar/ocultar el mensaje -->
                           <button type="button" class="btn btn-info" id="toggleInfoMessage">
                               Mostrar/Ocultar Instrucciones
                           </button>
                           <div class="row">
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="tabaco">Uso de Tabaco <span class="text-danger">*</span></label>
                                       <input type="checkbox" class="w-25 edit_imput text-dark" id="tabaco" name="tabaco" value="1" {{ old('tabaco', $historiasClinica->tabaco) ? 'checked' : '' }}>
                                       @if ($errors->has('tabaco'))
                                           <div class="text-danger">{{ $errors->first('tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="alcohol">Uso de Alcohol <span class="text-danger">*</span></label>
                                       <input type="checkbox" class="w-25 edit_imput text-dark" id="alcohol" name="alcohol" value="1" {{ old('alcohol', $historiasClinica->alcohol) ? 'checked' : '' }}>
                                       @if ($errors->has('alcohol'))
                                           <div class="text-danger">{{ $errors->first('alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="drogas_ilegales">Uso de Drogas Ilegales <span class="text-danger">*</span></label>
                                       <input type="checkbox" class="w-25 edit_imput text-dark" id="drogas_ilegales" name="drogas_ilegales" value="1" {{ old('drogas_ilegales', $historiasClinica->drogas_ilegales) ? 'checked' : '' }}>
                                       @if ($errors->has('drogas_ilegales'))
                                           <div class="text-danger">{{ $errors->first('drogas_ilegales') }}</div>
                                       @endif
                                   </div>
                               </div>
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="farmacos">Uso de Fármacos <span class="text-danger">*</span></label>
                                       <input type="checkbox" class="w-25 edit_imput text-dark" id="farmacos" name="farmacos" value="1" {{ old('farmacos', $historiasClinica->farmacos) ? 'checked' : '' }}>
                                       @if ($errors->has('farmacos'))
                                           <div class="text-danger">{{ $errors->first('farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       
                           <div class="row tabaco-fields-edi" >

                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="tipo_tabaco">Tipo de Tabaco <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_tabaco" name="tipo_tabaco" value="{{ old('tipo_tabaco', $historiasClinica->tipo_tabaco) }}">
                                       @if ($errors->has('tipo_tabaco'))
                                           <div class="text-danger">{{ $errors->first('tipo_tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_tabaco">Edad de Inicio del Tabaco <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_tabaco" name="edad_inicio_tabaco" value="{{ old('edad_inicio_tabaco', $historiasClinica->edad_inicio_tabaco) }}">
                                       @if ($errors->has('edad_inicio_tabaco'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_tabaco">Cantidad/Frecuencia de Tabaco <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_tabaco" name="cantidad_frecuencia_tabaco" value="{{ old('cantidad_frecuencia_tabaco', $historiasClinica->cantidad_frecuencia_tabaco) }}">
                                       @if ($errors->has('cantidad_frecuencia_tabaco'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_tabaco">Edad de Abandono del Tabaco <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_tabaco" name="edad_abandono_tabaco" value="{{ old('edad_abandono_tabaco', $historiasClinica->edad_abandono_tabaco) }}">
                                       @if ($errors->has('edad_abandono_tabaco'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_tabaco">Duración del Hábito del Tabaco <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_tabaco" name="duracion_habito_tabaco" value="{{ old('duracion_habito_tabaco', $historiasClinica->duracion_habito_tabaco) }}">
                                       @if ($errors->has('duracion_habito_tabaco'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_tabaco') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       
                           <div class="row alcohol-fields-edi" style="">
                               <div class="col-lg-2"> 
                                   <div class="form-group">
                                       <label for="tipo_alcohol">Tipo de Alcohol <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_alcohol" name="tipo_alcohol" value="{{ old('tipo_alcohol', $historiasClinica->tipo_alcohol) }}">
                                       @if ($errors->has('tipo_alcohol'))
                                           <div class="text-danger">{{ $errors->first('tipo_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_alcohol">Cantidad/Frecuencia de Alcohol <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_alcohol" name="cantidad_frecuencia_alcohol" value="{{ old('cantidad_frecuencia_alcohol', $historiasClinica->cantidad_frecuencia_alcohol) }}">
                                       @if ($errors->has('cantidad_frecuencia_alcohol'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_alcohol">Edad de Inicio del Alcohol <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_alcohol" name="edad_inicio_alcohol" value="{{ old('edad_inicio_alcohol', $historiasClinica->edad_inicio_alcohol) }}">
                                       @if ($errors->has('edad_inicio_alcohol'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_alcohol">Edad de Abandono del Alcohol <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_alcohol" name="edad_abandono_alcohol" value="{{ old('edad_abandono_alcohol', $historiasClinica->edad_abandono_alcohol) }}">
                                       @if ($errors->has('edad_abandono_alcohol'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_alcohol">Duración del Hábito de Alcohol <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_alcohol" name="duracion_habito_alcohol" value="{{ old('duracion_habito_alcohol', $historiasClinica->duracion_habito_alcohol) }}">
                                       @if ($errors->has('duracion_habito_alcohol'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       
                           <div class="row drogas-fields-edi" >
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="tipo_drogas">Tipo de Drogas <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_drogas" name="tipo_drogas" value="{{ old('tipo_drogas', $historiasClinica->tipo_drogas) }}">
                                       @if ($errors->has('tipo_drogas'))
                                           <div class="text-danger">{{ $errors->first('tipo_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_drogas">Cantidad/Frecuencia de Drogas <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_drogas" name="cantidad_frecuencia_drogas" value="{{ old('cantidad_frecuencia_drogas', $historiasClinica->cantidad_frecuencia_drogas) }}">
                                       @if ($errors->has('cantidad_frecuencia_drogas'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_drogas">Edad de Inicio de Drogas <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_drogas" name="edad_inicio_drogas" value="{{ old('edad_inicio_drogas', $historiasClinica->edad_inicio_drogas) }}">
                                       @if ($errors->has('edad_inicio_drogas'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_drogas">Edad de Abandono de Drogas <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_drogas" name="edad_abandono_drogas" value="{{ old('edad_abandono_drogas', $historiasClinica->edad_abandono_drogas) }}">
                                       @if ($errors->has('edad_abandono_drogas'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_drogas">Duración del Hábito de Drogas <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_drogas" name="duracion_habito_drogas" value="{{ old('duracion_habito_drogas', $historiasClinica->duracion_habito_drogas) }}">
                                       @if ($errors->has('duracion_habito_drogas'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       
                           <div class="row farmacos-fields-edi" style="">
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="tipo_farmacos">Tipo de Fármacos <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_farmacos" name="tipo_farmacos" value="{{ old('tipo_farmacos', $historiasClinica->tipo_farmacos) }}">
                                       @if ($errors->has('tipo_farmacos'))
                                           <div class="text-danger">{{ $errors->first('tipo_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_farmacos">Cantidad/Frecuencia de Fármacos <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_farmacos" name="cantidad_frecuencia_farmacos" value="{{ old('cantidad_frecuencia_farmacos', $historiasClinica->cantidad_frecuencia_farmacos) }}">
                                       @if ($errors->has('cantidad_frecuencia_farmacos'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_farmacos">Edad de Inicio de Fármacos <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_farmacos" name="edad_inicio_farmacos" value="{{ old('edad_inicio_farmacos', $historiasClinica->edad_inicio_farmacos) }}">
                                       @if ($errors->has('edad_inicio_farmacos'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_farmacos">Edad de Abandono de Fármacos <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_farmacos" name="edad_abandono_farmacos" value="{{ old('edad_abandono_farmacos', $historiasClinica->edad_abandono_farmacos) }}">
                                       @if ($errors->has('edad_abandono_farmacos'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                       
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_farmacos">Duración del Hábito de Fármacos <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_farmacos" name="duracion_habito_farmacos" value="{{ old('duracion_habito_farmacos', $historiasClinica->duracion_habito_farmacos) }}">
                                       @if ($errors->has('duracion_habito_farmacos'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       </div>

                     
                       <h4 class="ml-2">Antecedentes personales patológicos (Registrar Fechas)</h4>
                       <div class="row p-2">
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="enfermedades_infecto">Enfermedades infecto-contagiosas previas <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_infecto" name="enfermedades_infecto">{{ old('enfermedades_infecto', $historiasClinica->enfermedades_infecto) }}</textarea>
                                   @if ($errors->has('enfermedades_infecto'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_infecto') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="enfermedades_cronicas">Enfermedades Crónicas <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_cronicas" name="enfermedades_cronicas">{{ old('enfermedades_cronicas', $historiasClinica->enfermedades_cronicas) }}</textarea>
                                   @if ($errors->has('enfermedades_cronicas'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_cronicas') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="cirugias_previas">Cirugías Previas <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="cirugias_previas" name="cirugias_previas">{{ old('cirugias_previas', $historiasClinica->cirugias_previas) }}</textarea>
                                   @if ($errors->has('cirugias_previas'))
                                       <div class="text-danger">{{ $errors->first('cirugias_previas') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="hospitalizaciones">Hospitalizaciones <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="hospitalizaciones" name="hospitalizaciones">{{ old('hospitalizaciones', $historiasClinica->hospitalizaciones) }}</textarea>
                                   @if ($errors->has('hospitalizaciones'))
                                       <div class="text-danger">{{ $errors->first('hospitalizaciones') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>

                       <h4 class=" ml-2">Antecendetes gineco-obstétricos  (Si aplica <span class=" text-danger">*</span>)</h4>

                       <div class="row p-2">
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="menarca">Menarca</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="menarca" name="menarca" value="{{ old('menarca', $historiasClinica->menarca) }}">
                                   @if ($errors->has('menarca'))
                                       <div class="text-danger">{{ $errors->first('menarca') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="gesta">Gesta</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="gesta" name="gesta" value="{{ old('gesta', $historiasClinica->gesta) }}">
                                   @if ($errors->has('gesta'))
                                       <div class="text-danger">{{ $errors->first('gesta') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="fur">FUR</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="fur" name="fur" value="{{ old('fur', $historiasClinica->fur) }}">
                                   @if ($errors->has('fur'))
                                       <div class="text-danger">{{ $errors->first('fur') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="inicio_vida_sexual">Inicio de Vida Sexual</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="inicio_vida_sexual" name="inicio_vida_sexual" value="{{ old('inicio_vida_sexual', $historiasClinica->inicio_vida_sexual) }}">
                                   @if ($errors->has('inicio_vida_sexual'))
                                       <div class="text-danger">{{ $errors->first('inicio_vida_sexual') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="para">PARA</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="para" name="para" value="{{ old('para', $historiasClinica->para) }}">
                                   @if ($errors->has('para'))
                                       <div class="text-danger">{{ $errors->first('para') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="cesarea">Cesárea</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="cesarea" name="cesarea" value="{{ old('cesarea', $historiasClinica->cesarea) }}">
                                   @if ($errors->has('cesarea'))
                                       <div class="text-danger">{{ $errors->first('cesarea') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="num_companeros_sexuales">Número de Compañeros Sexuales</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="num_companeros_sexuales" name="num_companeros_sexuales" value="{{ old('num_companeros_sexuales', $historiasClinica->num_companeros_sexuales) }}">
                                   @if ($errors->has('num_companeros_sexuales'))
                                       <div class="text-danger">{{ $errors->first('num_companeros_sexuales') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="aborto">Aborto</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="aborto" name="aborto" value="{{ old('aborto', $historiasClinica->aborto) }}">
                                   @if ($errors->has('aborto'))
                                       <div class="text-danger">{{ $errors->first('aborto') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="legrado">Legrado</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="legrado" name="legrado" value="{{ old('legrado', $historiasClinica->legrado) }}">
                                   @if ($errors->has('legrado'))
                                       <div class="text-danger">{{ $errors->first('legrado') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="semanas_amenorrea">Semanas de Amenorrea</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="semanas_amenorrea" name="semanas_amenorrea" value="{{ old('semanas_amenorrea', $historiasClinica->semanas_amenorrea) }}">
                                   @if ($errors->has('semanas_amenorrea'))
                                       <div class="text-danger">{{ $errors->first('semanas_amenorrea') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="menopausia">Menopausia</label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="menopausia" name="menopausia" value="1" {{ old('menopausia', $historiasClinica->menopausia) ? 'checked' : '' }}>
                                   @if ($errors->has('menopausia'))
                                       <div class="text-danger">{{ $errors->first('menopausia') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="fecha_menopausia">Fecha de Menopausia</label>
                                   <input type="date" class="form-control edit_imput text-dark" id="fecha_menopausia" name="fecha_menopausia" value="{{ old('fecha_menopausia', $historiasClinica->fecha_menopausia) }}">
                                   @if ($errors->has('fecha_menopausia'))
                                       <div class="text-danger">{{ $errors->first('fecha_menopausia') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="planificacion_familiar">Planificación Familiar</label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="planificacion_familiar" name="planificacion_familiar" value="1" {{ old('planificacion_familiar', $historiasClinica->planificacion_familiar) ? 'checked' : '' }}>
                                   @if ($errors->has('planificacion_familiar'))
                                       <div class="text-danger">{{ $errors->first('planificacion_familiar') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="metodo_planificacion">Método de Planificación</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="metodo_planificacion" name="metodo_planificacion" value="{{ old('metodo_planificacion', $historiasClinica->metodo_planificacion) }}">
                                   @if ($errors->has('metodo_planificacion'))
                                       <div class="text-danger">{{ $errors->first('metodo_planificacion') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="sustitucion_hormonal">Sustitución Hormonal</label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="sustitucion_hormonal" name="sustitucion_hormonal" value="1" {{ old('sustitucion_hormonal', $historiasClinica->sustitucion_hormonal) ? 'checked' : '' }}>
                                   @if ($errors->has('sustitucion_hormonal'))
                                       <div class="text-danger">{{ $errors->first('sustitucion_hormonal') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="especificar_sustitucion_hormonal">Especificar Sustitución Hormonal</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="especificar_sustitucion_hormonal" name="especificar_sustitucion_hormonal" value="{{ old('especificar_sustitucion_hormonal', $historiasClinica->especificar_sustitucion_hormonal) }}">
                                   @if ($errors->has('especificar_sustitucion_hormonal'))
                                       <div class="text-danger">{{ $errors->first('especificar_sustitucion_hormonal') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="pap">PAP</label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="pap" name="pap" value="1" {{ old('pap', $historiasClinica->pap) ? 'checked' : '' }}>
                                   @if ($errors->has('pap'))
                                       <div class="text-danger">{{ $errors->first('pap') }}</div>
                                   @endif
                               </div>
                           </div>
                       
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="resultado_fecha_pap">Resultado/Fecha PAP</label>
                                   <input type="text" class="form-control edit_imput text-dark" id="resultado_fecha_pap" name="resultado_fecha_pap" value="{{ old('resultado_fecha_pap', $historiasClinica->resultado_fecha_pap) }}">
                                   @if ($errors->has('resultado_fecha_pap'))
                                       <div class="text-danger">{{ $errors->first('resultado_fecha_pap') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>

                       <div class="row p-2">
                           <div class="col-lg-12">
                               <div class="form-group">
                                   <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="trabajo_actual" name="trabajo_actual" value="1" {{ old('trabajo_actual', $historiasClinica->trabajo_actual) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="trabajo_actual">Trabaja Actualmente <span class="text-danger">*</span></label>
                                   </div>
                                   @if ($errors->has('trabajo_actual'))
                                       <div class="text-danger">{{ $errors->first('trabajo_actual') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>
                       
                       <div class="row p-2 " >
                           <div class="col-lg-3 form-group">
                               <label for="lugar_trabajo">Lugar de Trabajo <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="lugar_trabajo" name="lugar_trabajo" value="{{ old('lugar_trabajo', $historiasClinica->lugar_trabajo) }}">
                               @if ($errors->has('lugar_trabajo'))
                                   <div class="text-danger">{{ $errors->first('lugar_trabajo') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="area_labora">Área Laboral <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="area_labora" name="area_labora" value="{{ old('area_labora', $historiasClinica->area_labora) }}">
                               @if ($errors->has('area_labora'))
                                   <div class="text-danger">{{ $errors->first('area_labora') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="oficio_categoria">Oficio / Categoría <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="oficio_categoria" name="oficio_categoria" value="{{ old('oficio_categoria', $historiasClinica->oficio_categoria) }}">
                               @if ($errors->has('oficio_categoria'))
                                   <div class="text-danger">{{ $errors->first('oficio_categoria') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="anos_oficio_trabajo_actual">Años en el Oficio / Trabajo Actual <span class="text-danger">*</span></label>
                               <input type="number" class="form-control edit_input text-dark" id="anos_oficio_trabajo_actual" name="anos_oficio_trabajo_actual" value="{{ old('anos_oficio_trabajo_actual', $historiasClinica->anos_oficio_trabajo_actual) }}">
                               @if ($errors->has('anos_oficio_trabajo_actual'))
                                   <div class="text-danger">{{ $errors->first('anos_oficio_trabajo_actual') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="dia_laboral_horas">Horas por Día Laboral <span class="text-danger">*</span></label>
                               <input type="number" class="form-control edit_input text-dark" id="dia_laboral_horas" name="dia_laboral_horas" value="{{ old('dia_laboral_horas', $historiasClinica->dia_laboral_horas) }}">
                               @if ($errors->has('dia_laboral_horas'))
                                   <div class="text-danger">{{ $errors->first('dia_laboral_horas') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="tipo_horario">Tipo de Horario <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="tipo_horario" name="tipo_horario" value="{{ old('tipo_horario', $historiasClinica->tipo_horario) }}">
                               @if ($errors->has('tipo_horario'))
                                   <div class="text-danger">{{ $errors->first('tipo_horario') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="horas_semanales">Horas Semanales <span class="text-danger">*</span></label>
                               <input type="number" class="form-control edit_input text-dark" id="horas_semanales" name="horas_semanales" value="{{ old('horas_semanales', $historiasClinica->horas_semanales) }}">
                               @if ($errors->has('horas_semanales'))
                                   <div class="text-danger">{{ $errors->first('horas_semanales') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="descripcion_trabajo_actual">Descripción del Trabajo Actual <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="descripcion_trabajo_actual" name="descripcion_trabajo_actual">{{ old('descripcion_trabajo_actual', $historiasClinica->descripcion_trabajo_actual) }}</textarea>
                               @if ($errors->has('descripcion_trabajo_actual'))
                                   <div class="text-danger">{{ $errors->first('descripcion_trabajo_actual') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="exposicion_sustancias" name="exposicion_sustancias" value="1" {{ old('exposicion_sustancias', $historiasClinica->exposicion_sustancias) ? 'checked' : '' }}>
                                   <label class="form-check-label" for="exposicion_sustancias">Exposición a Sustancias <span class="text-danger">*</span></label>
                               </div>
                           </div>
                       
                           <div class="col-lg-3 form-group " >
                               <label for="descripcion_exposicion">Descripción de la Exposición <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="descripcion_exposicion" name="descripcion_exposicion">{{ old('descripcion_exposicion', $historiasClinica->descripcion_exposicion) }}</textarea>
                               @if ($errors->has('descripcion_exposicion'))
                                   <div class="text-danger">{{ $errors->first('descripcion_exposicion') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="frecuencia_intensidad_tarea">Frecuencia e Intensidad de la Tarea <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="frecuencia_intensidad_tarea" name="frecuencia_intensidad_tarea">{{ old('frecuencia_intensidad_tarea', $historiasClinica->frecuencia_intensidad_tarea) }}</textarea>
                               @if ($errors->has('frecuencia_intensidad_tarea'))
                                   <div class="text-danger">{{ $errors->first('frecuencia_intensidad_tarea') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="posicion_trabajo">Posición en el Trabajo <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="posicion_trabajo" name="posicion_trabajo" value="{{ old('posicion_trabajo', $historiasClinica->posicion_trabajo) }}">
                               @if ($errors->has('posicion_trabajo'))
                                   <div class="text-danger">{{ $errors->first('posicion_trabajo') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="trabajos_fuera_empleo" name="trabajos_fuera_empleo" value="1" {{ old('trabajos_fuera_empleo', $historiasClinica->trabajos_fuera_empleo) ? 'checked' : '' }}>
                                   <label class="form-check-label" for="trabajos_fuera_empleo">Trabajos Fuera del Empleo (Si - No) <span class="text-danger">*</span></label>
                               </div>
                           </div>
                       
                           <div class="col-lg-3 form-group " style="display: {{ old('trabajos_fuera_empleo', $historiasClinica->trabajos_fuera_empleo) ? 'block' : 'none' }};">
                               <label for="descripcion_trabajo_fuera_empleo">Descripción de Trabajos Fuera del Empleo <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="descripcion_trabajo_fuera_empleo" name="descripcion_trabajo_fuera_empleo">{{ old('descripcion_trabajo_fuera_empleo', $historiasClinica->descripcion_trabajo_fuera_empleo) }}</textarea>
                               @if ($errors->has('descripcion_trabajo_fuera_empleo'))
                                   <div class="text-danger">{{ $errors->first('descripcion_trabajo_fuera_empleo') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group " style="display: {{ old('horas_extras', $historiasClinica->horas_extras) ? 'block' : 'none' }};">
                               <label for="horas_extras">Horas extras</label>
                               <input type="text" class="form-control edit_input text-dark" id="horas_extras" name="horas_extras" value="{{ old('horas_extras', $historiasClinica->horas_extras) }}">
                               @if ($errors->has('horas_extras'))
                                   <div class="text-danger">{{ $errors->first('horas_extras') }}</div>
                               @endif
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-3 form-group">
                               <label for="antecedentes_laborales">¿Antecedentes Laborales? <span class="text-danger">*</span></label>
                               <select class="form-control edit_input text-dark" id="antecedentes_laborales" name="antecedentes_laborales">
                                   <option value="1" {{ old('antecedentes_laborales', $historiasClinica->antecedentes_laborales) == '1' ? 'selected' : '' }}>Sí</option>
                                   <option value="0" {{ old('antecedentes_laborales', $historiasClinica->antecedentes_laborales) == '0' ? 'selected' : '' }}>No</option>
                               </select>
                               @if ($errors->has('antecedentes_laborales'))
                                   <div class="text-danger">{{ $errors->first('antecedentes_laborales') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="fecha_inicio">Fecha de Inicio <span class="text-danger">*</span></label>
                               <input type="date" class="form-control edit_input text-dark" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $historiasClinica->fecha_inicio) }}">
                               @if ($errors->has('fecha_inicio'))
                                   <div class="text-danger">{{ $errors->first('fecha_inicio') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="fecha_conclusion">Fecha de Conclusión <span class="text-danger">*</span></label>
                               <input type="date" class="form-control edit_input text-dark" id="fecha_conclusion" name="fecha_conclusion" value="{{ old('fecha_conclusion', $historiasClinica->fecha_conclusion) }}">
                               @if ($errors->has('fecha_conclusion'))
                                   <div class="text-danger">{{ $errors->first('fecha_conclusion') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="puesto_trabajo">Puesto de Trabajo <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="puesto_trabajo" name="puesto_trabajo" value="{{ old('puesto_trabajo', $historiasClinica->puesto_trabajo) }}" placeholder="Describir productos, materiales u otros">
                               @if ($errors->has('puesto_trabajo'))
                                   <div class="text-danger">{{ $errors->first('puesto_trabajo') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="anos_trabajados">Años Trabajados <span class="text-danger">*</span></label>
                               <input type="number" class="form-control edit_input text-dark" id="anos_trabajados" name="anos_trabajados" value="{{ old('anos_trabajados', $historiasClinica->anos_trabajados) }}">
                               @if ($errors->has('anos_trabajados'))
                                   <div class="text-danger">{{ $errors->first('anos_trabajados') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       
                       <h4 class="mt-2 ml-4">Signos Vitales y Datos Antropométricos</h4>
                       <div class="row p-2">
                           <div class="col-lg-1 form-group">
                               <label for="fc"> (FC) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="fc" name="fc" value="{{ old('fc', $historiasClinica->fc) }}">
                               @if ($errors->has('fc'))
                                   <div class="text-danger">{{ $errors->first('fc') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="fr"> (FR) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="fr" name="fr" value="{{ old('fr', $historiasClinica->fr) }}">
                               @if ($errors->has('fr'))
                                   <div class="text-danger">{{ $errors->first('fr') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="ta"> (TA) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="ta" name="ta" value="{{ old('ta', $historiasClinica->ta) }}">
                               @if ($errors->has('ta'))
                                   <div class="text-danger">{{ $errors->first('ta') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="temperatura">TEM <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="temperatura" name="temperatura" value="{{ old('temperatura', $historiasClinica->temperatura) }}">
                               @if ($errors->has('temperatura'))
                                   <div class="text-danger">{{ $errors->first('temperatura') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="peso">Peso <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="peso" name="peso" value="{{ old('peso', $historiasClinica->peso) }}">
                               @if ($errors->has('peso'))
                                   <div class="text-danger">{{ $errors->first('peso') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="talla">Talla <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="talla" name="talla" value="{{ old('talla', $historiasClinica->talla) }}">
                               @if ($errors->has('talla'))
                                   <div class="text-danger">{{ $errors->first('talla') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="area_superficie_corporal"> (ASC) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="area_superficie_corporal" name="area_superficie_corporal" value="{{ old('area_superficie_corporal', $historiasClinica->area_superficie_corporal) }}">
                               @if ($errors->has('area_superficie_corporal'))
                                   <div class="text-danger">{{ $errors->first('area_superficie_corporal') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="imc"> (IMC) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="imc" name="imc" value="{{ old('imc', $historiasClinica->imc) }}">
                               @if ($errors->has('imc'))
                                   <div class="text-danger">{{ $errors->first('imc') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <h4 class="mt-1 ml-4">Aspecto general Cabeza y Cuello</h4>
                       
                       <div class="row p-2">
                           <div class="col-lg-3 form-group">
                               <label for="aspecto_general">Aspecto General <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="aspecto_general" name="aspecto_general" rows="3">{{ old('aspecto_general', $historiasClinica->aspecto_general) }}</textarea>
                               @if ($errors->has('aspecto_general'))
                                   <div class="text-danger">{{ $errors->first('aspecto_general') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="piel_mucosas">Piel y Mucosas <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="piel_mucosas" name="piel_mucosas" rows="3">{{ old('piel_mucosas', $historiasClinica->piel_mucosas) }}</textarea>
                               @if ($errors->has('piel_mucosas'))
                                   <div class="text-danger">{{ $errors->first('piel_mucosas') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="craneo">Cráneo <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="craneo" name="craneo" rows="3">{{ old('craneo', $historiasClinica->craneo) }}</textarea>
                               @if ($errors->has('craneo'))
                                   <div class="text-danger">{{ $errors->first('craneo') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="ojos">Ojos <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="ojos" name="ojos" rows="3">{{ old('ojos', $historiasClinica->ojos) }}</textarea>
                               @if ($errors->has('ojos'))
                                   <div class="text-danger">{{ $errors->first('ojos') }}</div>
                               @endif
                           </div>
                       </div>
                       

                       <div class="row p-2">
                           <!-- Orejas -->
                           <div class="col-lg-3 form-group">
                               <label for="orejas">Orejas <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="orejas" name="orejas" rows="3">{{ old('orejas', $historiasClinica->orejas ?? '') }}</textarea>
                               @if ($errors->has('orejas'))
                                   <div class="text-danger">{{ $errors->first('orejas') }}</div>
                               @endif
                           </div>
                           
                           <!-- Nariz -->
                           <div class="col-lg-3 form-group">
                               <label for="nariz">Nariz <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="nariz" name="nariz" rows="3">{{ old('nariz', $historiasClinica->nariz ?? '') }}</textarea>
                               @if ($errors->has('nariz'))
                                   <div class="text-danger">{{ $errors->first('nariz') }}</div>
                               @endif
                           </div>
                           
                           <!-- Boca -->
                           <div class="col-lg-3 form-group">
                               <label for="boca">Boca <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="boca" name="boca" rows="3">{{ old('boca', $historiasClinica->boca ?? '') }}</textarea>
                               @if ($errors->has('boca'))
                                   <div class="text-danger">{{ $errors->first('boca') }}</div>
                               @endif
                           </div>
                           
                           <!-- Cuello -->
                           <div class="col-lg-3 form-group">
                               <label for="cuello">Cuello <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="cuello" name="cuello" rows="3">{{ old('cuello', $historiasClinica->cuello ?? '') }}</textarea>
                               @if ($errors->has('cuello'))
                                   <div class="text-danger">{{ $errors->first('cuello') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <h4 class="mt-2 ml-4">Tórax</h4>
                       <div class="row p-2">
                           <!-- Caja Torácica -->
                           <div class="col-3 form-group">
                               <label for="caja_toracica">Caja Torácica <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="caja_toracica" name="caja_toracica" rows="3">{{ old('caja_toracica', $historiasClinica->caja_toracica ?? '') }}</textarea>
                               @if ($errors->has('caja_toracica'))
                                   <div class="text-danger">{{ $errors->first('caja_toracica') }}</div>
                               @endif
                           </div>
                           
                           <!-- Mamas -->
                           <div class="col-3 form-group">
                               <label for="mamas">Mamas <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="mamas" name="mamas" rows="3">{{ old('mamas', $historiasClinica->mamas ?? '') }}</textarea>
                               @if ($errors->has('mamas'))
                                   <div class="text-danger">{{ $errors->first('mamas') }}</div>
                               @endif
                           </div>
                           
                           <!-- Campos Pulmonares -->
                           <div class="col-3 form-group">
                               <label for="campos_pulmonares">Campos Pulmonares <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="campos_pulmonares" name="campos_pulmonares" rows="3">{{ old('campos_pulmonares', $historiasClinica->campos_pulmonares ?? '') }}</textarea>
                               @if ($errors->has('campos_pulmonares'))
                                   <div class="text-danger">{{ $errors->first('campos_pulmonares') }}</div>
                               @endif
                           </div>
                           
                           <!-- Cardíaco -->
                           <div class="col-3 form-group">
                               <label for="cardiaco">Cardíaco <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="cardiaco" name="cardiaco" rows="3">{{ old('cardiaco', $historiasClinica->cardiaco ?? '') }}</textarea>
                               @if ($errors->has('cardiaco'))
                                   <div class="text-danger">{{ $errors->first('cardiaco') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <h4 class="mt-2 ml-2">Otros Datos</h4>
                       <div class="row p-2">
                           <!-- Abdomen/Pelvis -->
                           <div class="col-3 form-group">
                               <label for="abdomen_pelvis">Abdomen/Pelvis <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="abdomen_pelvis" name="abdomen_pelvis" rows="3">{{ old('abdomen_pelvis', $historiasClinica->abdomen_pelvis ?? '') }}</textarea>
                               @if ($errors->has('abdomen_pelvis'))
                                   <div class="text-danger">{{ $errors->first('abdomen_pelvis') }}</div>
                               @endif
                           </div>
                           
                           <!-- Extremidades Superiores -->
                           <div class="col-3 form-group">
                               <label for="extremidades_superiores">Extremidades Superiores <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="extremidades_superiores" name="extremidades_superiores" rows="3">{{ old('extremidades_superiores', $historiasClinica->extremidades_superiores ?? '') }}</textarea>
                               @if ($errors->has('extremidades_superiores'))
                                   <div class="text-danger">{{ $errors->first('extremidades_superiores') }}</div>
                               @endif
                           </div>
                           
                           <!-- Extremidades Inferiores -->
                           <div class="col-3 form-group">
                               <label for="extremidades_inferiores">Extremidades Inferiores <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="extremidades_inferiores" name="extremidades_inferiores" rows="3">{{ old('extremidades_inferiores', $historiasClinica->extremidades_inferiores ?? '') }}</textarea>
                               @if ($errors->has('extremidades_inferiores'))
                                   <div class="text-danger">{{ $errors->first('extremidades_inferiores') }}</div>
                               @endif
                           </div>
                           
                           <!-- Genitourinario -->
                           <div class="col-3 form-group">
                               <label for="genitourinario">Genitourinario (Cuando aplique el caso) <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="genitourinario" name="genitourinario" rows="3">{{ old('genitourinario', $historiasClinica->genitourinario ?? '') }}</textarea>
                               @if ($errors->has('genitourinario'))
                                   <div class="text-danger">{{ $errors->first('genitourinario') }}</div>
                               @endif
                           </div>
                           
                           <!-- Examen Ginecológico -->
                           <div class="col-3 form-group">
                               <label for="examen_ginecologico">Examen Ginecológico <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="examen_ginecologico" name="examen_ginecologico" rows="3">{{ old('examen_ginecologico', $historiasClinica->examen_ginecologico ?? '') }}</textarea>
                               @if ($errors->has('examen_ginecologico'))
                                   <div class="text-danger">{{ $errors->first('examen_ginecologico') }}</div>
                               @endif
                           </div>
                           
                           <!-- Examen Neurológico -->
                           <div class="col-3 form-group">
                               <label for="examen_neurologico">Examen Neurológico <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="examen_neurologico" name="examen_neurologico" rows="3">{{ old('examen_neurologico', $historiasClinica->examen_neurologico ?? '') }}</textarea>
                               @if ($errors->has('examen_neurologico'))
                                   <div class="text-danger">{{ $errors->first('examen_neurologico') }}</div>
                               @endif
                           </div>
                           
                           <!-- Observaciones/Análisis -->
                           <div class="col-3 form-group">
                               <label for="observaciones_analisis">Observaciones/Análisis <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="observaciones_analisis" name="observaciones_analisis" rows="3">{{ old('observaciones_analisis', $historiasClinica->observaciones_analisis ?? '') }}</textarea>
                               @if ($errors->has('observaciones_analisis'))
                                   <div class="text-danger">{{ $errors->first('observaciones_analisis') }}</div>
                               @endif
                           </div>
                           
                           <!-- Diagnósticos/Problemas -->
                           <div class="col-3 form-group">
                               <label for="diagnosticos_problemas">Diagnósticos/Problemas <span class="text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="diagnosticos_problemas" name="diagnosticos_problemas" rows="3">{{ old('diagnosticos_problemas', $historiasClinica->diagnosticos_problemas ?? '') }}</textarea>
                               @if ($errors->has('diagnosticos_problemas'))
                                   <div class="text-danger">{{ $errors->first('diagnosticos_problemas') }}</div>
                               @endif
                           </div>
                           
                           <!-- Nombre del Elaborador -->
                           <div class="col-3 form-group">
                               <label for="nombre_elabora_historia">Nombre del Elaborador (Médico) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="nombre_elabora_historia" name="nombre_elabora_historia" value="{{ old('nombre_elabora_historia', $historiasClinica->nombre_elabora_historia ?? '') }}">
                               @if ($errors->has('nombre_elabora_historia'))
                                   <div class="text-danger">{{ $errors->first('nombre_elabora_historia') }}</div>
                               @endif
                           </div>
                           
                           <!-- Firma/Código/Sello -->
                           <div class="col-3 form-group">
                               <label for="firma_codigo_sello">Firma/Código/Sello (Médico) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="firma_codigo_sello" name="firma_codigo_sello" 
                                      value="{{ old('firma_codigo_sello', $historiasClinica->firma_codigo_sello ?? '') }}" pattern="\d{5}" title="El código debe tener exactamente 5 números" required>
                               @if ($errors->has('firma_codigo_sello'))
                                   <div class="text-danger">{{ $errors->first('firma_codigo_sello') }}</div>
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


  
@stop



@section('js')
  

@stop

    
</body>
</html>
   
   