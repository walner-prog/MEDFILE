   <!DOCTYPE html>
   <html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
              <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

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
            <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
    
      
             
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
   <body>

      
 
  @extends('adminlte::page')
    
  @section('title', 'historia clinica ')
  


  @section('content')
  <div class="container  mt-4 mb-5  toggle-container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de Historias Clinicas </li>
                </ol>
            </nav>
        </div>
        
    </div>
    
    
     <div class="row">
       <div class="col-lg-2">
           @can('crear-historia-clinica', App\Models\HistoriaClinica::class)
           <button class="btn btn-indigo mb-3" data-toggle="modal" data-target="#createhistoriaForm">
               <i class="fas fa-plus"></i> Crear 
           </button>
           @endcan
       </div>
       <div class="col-lg-2 ">
       </div>

       <div class="col-lg-2">
       </div>
       <div class="col-lg-2">
       </div>
       <div class="col-lg-2 text-right">
           
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
     

 
     
   
     @can('ver-historia-clinica')

         <!-- Código o vista para ver la historia clínica de un paciente -->
         <div class="table-responsive">
            <table id="historiaclinicaTable" class="min-w-full border border-gray-300 shadow-md rounded-lg p-2">
                <thead class="from-green-500 to-green-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Nombre #1</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Nombre #2</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Apellido #1</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Apellido #2</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Cédula</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Edad</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Sexo</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. INSS</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                    </tr>
                </thead>
                <hr>
                <tbody class="divide-y divide-gray-200">
                    {{-- Los datos se cargan acá dinámicamente por datatable server-side --}}
                </tbody>
            </table>
            
           </div>
     @endcan
    
 


   @if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif


      <div class="modal fade" id="createhistoriaForm" tabindex="-1" role="dialog" aria-labelledby="createhistoriaFormModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
           <div class="modal-header bg-primary">
               <div class="row">
                   <div class="col-lg-12 ">
                       
                   </div>
                   <div id="datos-paciente" class="mb-3 " >
                       <h4>Registrar Historia Clinica</h4>
                      
                       <div class="p-3 mb-2  border rounded  datos-pacientes bg-white ">
                           <div class="mb-2">
                          <strong class="color-primario"> <i class="fa-sharp fa-solid fa-notes-medical color-primario"></i> No. Expediente:</strong> <span id="info_no_expediente" class="text-danger"></span>
                           </div>
                           <div class="mb-2">

                               <strong class="text-primary ml-2">    <i class="fa-solid fa-hospital-user "></i> Nombres y Apellidos:</strong> <span id="info_primer_nombre" class="text-secondary"></span>
                               <span id="info_segundo_nombre" class="text-secondary"></span>
                               <span id="info_primer_apellido" class="text-secondary"></span>
                               <span id="info_segundo_apellido" class="text-secondary"></span>
                               <strong class="text-primary ml-2">Edad:</strong> <span id="info_edad" class="text-secondary"></span>
                               <strong class="text-primary ml-2">Sexo:</strong> <span id="info_sexo" class="text-secondary"></span>
                               <strong class="text-primary ml-2">No. Cédula:</strong> <span id="info_no_cedula" class="text-secondary"></span>
                               <strong class="text-primary ml-2">No. INSS:</strong> <span id="info_no_inss" class="text-secondary"></span>
                           </div>

                           <div id="alerta-historia" class="alert alert-warning d-none" role="alert">
                               <h5>¡Atención!</h5>
                               <p>Antes de crear una nueva historia clínica, asegúrate de lo siguiente:</p>
                               <ul>
                                   <li><strong>Identificación del Paciente:</strong> Verifica que los datos del paciente sean correctos y estén actualizados.</li>
                                   <li><strong>Actualización de Contactos de Emergencia:</strong> Comprueba que la información de contacto de emergencia esté actualizada.</li>
                                   <li><strong>Revisión de Citas y Procedimientos Previos:</strong> Revisa si el paciente tiene citas recientes o procedimientos programados.</li>
                               </ul>
                               <button type="button" class="btn btn-warning mt-2 btn-sm" id="cerrar-alerta">Cerrar Alerta</button>
                           </div>
                          
                         
                       </div>
                       
                   </div>
                   
                  
               </div>
           </div>
           <div class="modal-body">
               <form action="{{ route('historias_clinicas.store') }}" method="POST" id="multiStepForm">
                   @csrf
                   <div class="col-lg-12 text-right">
                 
                       <button type="button" class="btn btn-info mb-3" id="prevBtn" style="display:none;" onclick="showPrevStep()">Anterior</button>
                       <button type="button" class="btn btn-info mb-3" id="nextBtn" onclick="showNextStep()">Siguiente</button>
                       <button type="submit" class="btn btn-primary mb-3">Guardar</button>
                       <button type="button" class="btn btn-secondary mb-3" data-dismiss="modal">cerrar</button>
                    </div>
                   <div id="step1" class="step">
                       <div class="row">
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
       
                       </div>
                       
                     <div class="row">
                       <div class="col-lg-6">
                           <div class="form-group">
                               <label for="buscar_paciente" class="bold">Buscar Paciente</label>
                               <i class="fa-solid fa-magnifying-glass fa-1x mb-1"></i>
                               <input type="text" class="form-control" autocomplete="off" id="buscar_paciente" placeholder="Buscar por nombre, cédula o expediente">
                           </div>
                           <div id="lista_pacientes" class="list-group"></div>
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
                     
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="escolaridad">Escolaridad <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="escolaridad" name="escolaridad" value="{{ old('escolaridad') }}" required>
                               @if ($errors->has('escolaridad'))
                                   <div class="text-danger">{{ $errors->first('escolaridad') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="direccion">Dirección habitual <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                               @if ($errors->has('direccion'))
                                   <div class="text-danger">{{ $errors->first('direccion') }}</div>
                               @endif
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="hora">Hora <span class=" text-danger">*</span></label>
                               <input type="time" class="form-control edit_imput text-dark" id="hora" name="hora" value="{{ old('hora') }}">
                               @if ($errors->has('hora'))
                                   <div class="text-danger">{{ $errors->first('hora') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="sala">Sala <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="sala" name="sala" value="{{ old('sala') }}">
                               @if ($errors->has('sala'))
                                   <div class="text-danger">{{ $errors->first('sala') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       
                       
                       <div class="col-lg-3">
                           <div class="form-check">
                               <input type="checkbox" class="form-check-input" id="is_ingresado" name="is_ingresado">
                               <label class="form-check-label" for="is_ingresado">Paciente Ingresado (Si - No)</label>
                           </div>
                           <div id="no_cama_container" class="col-lg-3" style="display: none;">
                               <div class="form-group">
                                   <label for="no_cama">No. de Cama <span class=" text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="no_cama" name="no_cama" value="{{ old('no_cama') }}">
                                   @if ($errors->has('no_cama'))
                                       <div class="text-danger">{{ $errors->first('no_cama') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="lugar_nacimiento">Lugar de Nacimiento <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="lugar_nacimiento" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}">
                               @if ($errors->has('lugar_nacimiento'))
                                   <div class="text-danger">{{ $errors->first('lugar_nacimiento') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="procedencia">Procedencia <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="procedencia" name="procedencia" value="{{ old('procedencia') }}">
                               @if ($errors->has('procedencia'))
                                   <div class="text-danger">{{ $errors->first('procedencia') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="religion">Religión <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="religion" name="religion" value="{{ old('religion') }}">
                               @if ($errors->has('religion'))
                                   <div class="text-danger">{{ $errors->first('religion') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="nombre_padre">Nombre del Padre <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}">
                               @if ($errors->has('nombre_padre'))
                                   <div class="text-danger">{{ $errors->first('nombre_padre') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="fuente_informacion">Fuente de Información <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="fuente_informacion" name="fuente_informacion" value="{{ old('fuente_informacion') }}">
                               @if ($errors->has('fuente_informacion'))
                                   <div class="text-danger">{{ $errors->first('fuente_informacion') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="profesion_oficio">Profesión u Oficio <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="profesion_oficio" name="profesion_oficio" value="{{ old('profesion_oficio') }}">
                               @if ($errors->has('profesion_oficio'))
                                   <div class="text-danger">{{ $errors->first('profesion_oficio') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="nombre_madre">Nombre de la Madre <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}">
                               @if ($errors->has('nombre_madre'))
                                   <div class="text-danger">{{ $errors->first('nombre_madre') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label for="confiabilidad">Confiabilidad <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="confiabilidad" name="confiabilidad" value="{{ old('confiabilidad') }}">
                               @if ($errors->has('confiabilidad'))
                                   <div class="text-danger">{{ $errors->first('confiabilidad') }}</div>
                               @endif
                           </div>
                       </div>
                  
                      
                     </div>
                  
                   </div>

                   <div id="step2" class="step" style="display:none;">
                     <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="motivo_consulta">Motivo de Consulta <span class="text-danger">*</span></label>
                                <textarea id="motivo_consulta" class=" form-control" name="motivo_consulta">{{ old('motivo_consulta') }}</textarea>
                                @if ($errors->has('motivo_consulta'))
                                    <div class="text-danger">{{ $errors->first('motivo_consulta') }}</div>
                                @endif
                            </div>
                        </div>
                        
                       <div class="col-lg-6">
                           <div class="form-group">
                               <label for="historia_enfermedad_actual">Historia de la Enfermedad Actual <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="historia_enfermedad_actual" name="historia_enfermedad_actual">{{ old('historia_enfermedad_actual') }}</textarea>
                               @if ($errors->has('historia_enfermedad_actual'))
                                   <div class="text-danger">{{ $errors->first('historia_enfermedad_actual') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-4">
                           <div class="form-group">
                               <label for="interrogatorio_aparatos_sistemas">Interrogatorio por  Aparatos y Sistemas <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="interrogatorio_aparatos_sistemas" name="interrogatorio_aparatos_sistemas">{{ old('interrogatorio_aparatos_sistemas') }}</textarea>
                               @if ($errors->has('interrogatorio_aparatos_sistemas'))
                                   <div class="text-danger">{{ $errors->first('interrogatorio_aparatos_sistemas') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <div class="col-lg-2">
                           <div class="form-group">
                               <label for="inmunizaciones_completas">Inmunizaciones Completas <span class=" text-danger">*</span></label>
                               <input type="checkbox" class="w-50 edit_imput text-dark" id="inmunizaciones_completas" name="inmunizaciones_completas" value="1" {{ old('inmunizaciones_completas') ? 'checked' : '' }}>
                               @if ($errors->has('inmunizaciones_completas'))
                                   <div class="text-danger">{{ $errors->first('inmunizaciones_completas') }}</div>
                               @endif
                           </div>
                             
                       </div>
                       <div class="col-lg-3">
                        <div class="" id="detalle_inmunizaciones_container" style="display: none;">
                            <div class="form-group">
                                <label for="detalle_inmunizaciones">Detalle de Inmunizaciones</label>
                                <textarea class="form-control edit_imput text-dark" id="detalle_inmunizaciones" name="detalle_inmunizaciones">{{ old('detalle_inmunizaciones') }}</textarea>
                                @if ($errors->has('detalle_inmunizaciones'))
                                    <div class="text-danger">{{ $errors->first('detalle_inmunizaciones') }}</div>
                                @endif
                            </div>
                        </div>
                       </div>
                       
                       
                       <div class="col-lg-1">
                           <div class="form-group">
                               <label for="horas_sueno">Horas de Sueño <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_imput text-dark" id="horas_sueno" name="horas_sueno" value="{{ old('horas_sueno') }}">
                               @if ($errors->has('horas_sueno'))
                                   <div class="text-danger">{{ $errors->first('horas_sueno') }}</div>
                               @endif
                           </div>
                       </div>
                      
                       <div class="col-lg-2">
                           <div class="form-group">
                               <label for="horas_laborales">Horas Laborales <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_imput text-dark" id="horas_laborales" name="horas_laborales" value="{{ old('horas_laborales') }}">
                               @if ($errors->has('horas_laborales'))
                                   <div class="text-danger">{{ $errors->first('horas_laborales') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       <hr>
                       <div class="row text-center">
                         <div class="col-lg-10">
                            <h4 class=" fw-bold text-center">Antecedentes familiares patológicos:</h4>
                         </div>
                                       
                           <div class="col-lg-6 ">
                               <div class="form-group">
                                   <label for="enfermedades_hereditarias">Enfermedades Hereditarias <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_hereditarias" name="enfermedades_hereditarias" rows="8">{{ old('enfermedades_hereditarias') }}</textarea>
                                   @if ($errors->has('enfermedades_hereditarias'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_hereditarias') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-6  ">
                               <div class="form-group">
                                   <label for="enfermedades_infecto_contagiosas">Enfermedades Infecto-Contagiosas <span class="text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_infecto_contagiosas" name="enfermedades_infecto_contagiosas" rows="8">{{ old('enfermedades_infecto_contagiosas') }}</textarea>
                                   @if ($errors->has('enfermedades_infecto_contagiosas'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_infecto_contagiosas') }}</div>
                                   @endif
                               </div>
                           </div>
                           

                       </div>
                      
       
                       <div class="col-lg-6 ">
                           <div class="form-group">
                               <label for="tipo_hora_actividad_fisica">Tipo y Hora de Actividad Física  <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="tipo_hora_actividad_fisica" name="tipo_hora_actividad_fisica">{{ old('tipo_hora_actividad_fisica') }}</textarea>
                               @if ($errors->has('tipo_hora_actividad_fisica'))
                                   <div class="text-danger">{{ $errors->first('tipo_hora_actividad_fisica') }}</div>
                               @endif
                           </div>
                       </div>
                       
                       
                       
                     </div>

                    
                      
                    
                   </div>

                   <div id="step3" class="step" style="display:none;">
                         <!-- Mensaje explicativo -->
                       <div id="" class="alert alert-info" role="alert">
                         Por favor, complete los campos según corresponda. Marque las opciones relevantes para que se muestren los campos adicionales necesarios.
                      </div>
                      
                       <div class="row">
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="tabaco">Uso de Tabaco  <span class=" text-danger">*</span></label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="tabaco" name="tabaco" value="1" {{ old('tabaco') ? 'checked' : '' }}>
                                   @if ($errors->has('tabaco'))
                                       <div class="text-danger">{{ $errors->first('tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="alcohol">Uso de Alcohol  <span class=" text-danger">*</span></label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="alcohol" name="alcohol" value="1" {{ old('alcohol') ? 'checked' : '' }}>
                                   @if ($errors->has('alcohol'))
                                       <div class="text-danger">{{ $errors->first('alcohol') }}</div>
                                   @endif
                               </div>
                           </div>
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="drogas_ilegales">Uso de Drogas Ilegales  <span class=" text-danger">*</span></label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="drogas_ilegales" name="drogas_ilegales" value="1" {{ old('drogas_ilegales') ? 'checked' : '' }}>
                                   @if ($errors->has('drogas_ilegales'))
                                       <div class="text-danger">{{ $errors->first('drogas_ilegales') }}</div>
                                   @endif
                               </div>
                           </div>
                           <div class="col-lg-3">
                               <div class="form-group">
                                   <label for="farmacos">Uso de Fármacos  <span class=" text-danger">*</span></label>
                                   <input type="checkbox" class="w-25 edit_imput text-dark" id="farmacos" name="farmacos" value="1" {{ old('farmacos') ? 'checked' : '' }}>
                                   @if ($errors->has('farmacos'))
                                       <div class="text-danger">{{ $errors->first('farmacos') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>
                           
                       <div class="row tabaco-fields">
                           <div class="col-lg-2 ">
                               <div class="form-group">
                                   <label for="tipo_tabaco">Tipo de Tabaco  <span class=" text-danger">*</span></label>
                                   <input type="text" class="form-control edit_imput text-dark" id="tipo_tabaco" name="tipo_tabaco" value="{{ old('tipo_tabaco') }}">
                                   @if ($errors->has('tipo_tabaco'))
                                       <div class="text-danger">{{ $errors->first('tipo_tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="edad_inicio_tabaco">Edad de Inicio.  <span class=" text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_tabaco" name="edad_inicio_tabaco" value="{{ old('edad_inicio_tabaco') }}">
                                   @if ($errors->has('edad_inicio_tabaco'))
                                       <div class="text-danger">{{ $errors->first('edad_inicio_tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="cantidad_frecuencia_tabaco">Cantidad/Frecuencia.  <span class=" text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_tabaco" name="cantidad_frecuencia_tabaco" value="{{ old('cantidad_frecuencia_tabaco') }}">
                                   @if ($errors->has('cantidad_frecuencia_tabaco'))
                                       <div class="text-danger">{{ $errors->first('cantidad_frecuencia_tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="edad_abandono_tabaco">Edad de Abandono.  <span class=" text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_tabaco" name="edad_abandono_tabaco" value="{{ old('edad_abandono_tabaco') }}">
                                   @if ($errors->has('edad_abandono_tabaco'))
                                       <div class="text-danger">{{ $errors->first('edad_abandono_tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-2">
                               <div class="form-group">
                                   <label for="duracion_habito_tabaco">Duración del Hábito.  <span class=" text-danger">*</span></label>
                                   <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_tabaco" name="duracion_habito_tabaco" value="{{ old('duracion_habito_tabaco') }}">
                                   @if ($errors->has('duracion_habito_tabaco'))
                                       <div class="text-danger">{{ $errors->first('duracion_habito_tabaco') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>

                           <div class="row alcohol-fields">
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="tipo_alcohol">Tipo de Alcohol  <span class=" text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_alcohol" name="tipo_alcohol" value="{{ old('tipo_alcohol') }}">
                                       @if ($errors->has('tipo_alcohol'))
                                           <div class="text-danger">{{ $errors->first('tipo_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_alcohol">Cantidad/Frecuencia.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_alcohol" name="cantidad_frecuencia_alcohol" value="{{ old('cantidad_frecuencia_alcohol') }}">
                                       @if ($errors->has('cantidad_frecuencia_alcohol'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_alcohol">Edad de Inicio.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_alcohol" name="edad_inicio_alcohol" value="{{ old('edad_inicio_alcohol') }}">
                                       @if ($errors->has('edad_inicio_alcohol'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_alcohol">Edad de Abandono.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_alcohol" name="edad_abandono_alcohol" value="{{ old('edad_abandono_alcohol') }}">
                                       @if ($errors->has('edad_abandono_alcohol'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_alcohol">Duración del Hábito.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_alcohol" name="duracion_habito_alcohol" value="{{ old('duracion_habito_alcohol') }}">
                                       @if ($errors->has('duracion_habito_alcohol'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_alcohol') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                          
                           <div class="row drogas-fields">
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="tipo_drogas">Tipo de Drogas  <span class=" text-danger">*</span></label>
                                       <input type="text" class="form-control edit_imput text-dark" id="tipo_drogas" name="tipo_drogas" value="{{ old('tipo_drogas') }}">
                                       @if ($errors->has('tipo_drogas'))
                                           <div class="text-danger">{{ $errors->first('tipo_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_drogas">Cantidad/Frecuencia.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_drogas" name="cantidad_frecuencia_drogas" value="{{ old('cantidad_frecuencia_drogas') }}">
                                       @if ($errors->has('cantidad_frecuencia_drogas'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_inicio_drogas">Edad de Inicio.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_inicio_drogas" name="edad_inicio_drogas" value="{{ old('edad_inicio_drogas') }}">
                                       @if ($errors->has('edad_inicio_drogas'))
                                           <div class="text-danger">{{ $errors->first('edad_inicio_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_drogas">Edad de Abandono.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_drogas" name="edad_abandono_drogas" value="{{ old('edad_abandono_drogas') }}">
                                       @if ($errors->has('edad_abandono_drogas'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_drogas">Duración del Hábito.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_drogas" name="duracion_habito_drogas" value="{{ old('duracion_habito_drogas') }}">
                                       @if ($errors->has('duracion_habito_drogas'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_drogas') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>

                           <div class="row farmacos-fields">
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="edad_abandono_farmacos">Edad de Abandono.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="edad_abandono_farmacos" name="edad_abandono_farmacos" value="{{ old('edad_abandono_farmacos') }}">
                                       @if ($errors->has('edad_abandono_farmacos'))
                                           <div class="text-danger">{{ $errors->first('edad_abandono_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="cantidad_frecuencia_farmacos">Cantidad/Frecuencia.  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="cantidad_frecuencia_farmacos" name="cantidad_frecuencia_farmacos" value="{{ old('cantidad_frecuencia_farmacos') }}">
                                       @if ($errors->has('cantidad_frecuencia_farmacos'))
                                           <div class="text-danger">{{ $errors->first('cantidad_frecuencia_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-2">
                                   <div class="form-group">
                                       <label for="duracion_habito_farmacos">Duración del Hábito.  <span class=" text-danger">*</span> </label>
                                       <input type="number" class="form-control edit_imput text-dark" id="duracion_habito_farmacos" name="duracion_habito_farmacos" value="{{ old('duracion_habito_farmacos') }}">
                                       @if ($errors->has('duracion_habito_farmacos'))
                                           <div class="text-danger">{{ $errors->first('duracion_habito_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="num_medicamentos_actuales">Número de Medicamentos Actuales  <span class=" text-danger">*</span></label>
                                       <input type="number" class="form-control edit_imput text-dark" id="num_medicamentos_actuales" name="num_medicamentos_actuales" value="{{ old('num_medicamentos_actuales') }}">
                                       @if ($errors->has('num_medicamentos_actuales'))
                                           <div class="text-danger">{{ $errors->first('num_medicamentos_actuales') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-4">
                                   <div class="form-group">
                                       <label for="nombre_posologia_farmacos">Nombre y Posología de Fármacos  <span class=" text-danger">*</span></label>
                                       <textarea class="form-control edit_imput text-dark" id="nombre_posologia_farmacos" name="nombre_posologia_farmacos">{{ old('nombre_posologia_farmacos') }}</textarea>
                                       @if ($errors->has('nombre_posologia_farmacos'))
                                           <div class="text-danger">{{ $errors->first('nombre_posologia_farmacos') }}</div>
                                       @endif
                                   </div>
                               </div>
                               
                               <div class="col-lg-3">
                                   <div class="form-group">
                                       <label for="otros_habitos">Otros Hábitos  <span class=" text-danger">*</span></label>
                                       <textarea class="form-control edit_imput text-dark" id="otros_habitos" name="otros_habitos">{{ old('otros_habitos') }}</textarea>
                                       @if ($errors->has('otros_habitos'))
                                           <div class="text-danger">{{ $errors->first('otros_habitos') }}</div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                   </div>
                   
                   <div id="step4" class="step-bg-color"  style="display:none;">
                      
                       <div class="row p-2">
                        <div class="col-lg-10 text-center">
                            <h4 class=" ml-2">Antecedentes personales patológicos (Registrar Fechas )</h4>
                        </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="enfermedades_infecto">Enfermedades infecto-contagiosas previas  <span class=" text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_infecto" name="enfermedades_infecto">{{ old('enfermedades_infecto') }}</textarea>
                                   @if ($errors->has('enfermedades_infecto'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_infecto') }}</div>
                                   @endif
                               </div>
                           </div>
                           
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="enfermedades_cronicas">Enfermedades Crónicas <span class=" text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="enfermedades_cronicas" name="enfermedades_cronicas">{{ old('enfermedades_cronicas') }}</textarea>
                                   @if ($errors->has('enfermedades_cronicas'))
                                       <div class="text-danger">{{ $errors->first('enfermedades_cronicas') }}</div>
                                   @endif
                               </div>
                           </div>
       
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="cirugias_previas">Cirugías Previas <span class=" text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="cirugias_previas" name="cirugias_previas">{{ old('cirugias_previas') }}</textarea>
                                   @if ($errors->has('cirugias_previas'))
                                       <div class="text-danger">{{ $errors->first('cirugias_previas') }}</div>
                                   @endif
                               </div>
                           </div>
       
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label for="hospitalizaciones">Hospitalizaciones <span class=" text-danger">*</span></label>
                                   <textarea class="form-control edit_imput text-dark" id="hospitalizaciones" name="hospitalizaciones">{{ old('hospitalizaciones') }}</textarea>
                                   @if ($errors->has('hospitalizaciones'))
                                       <div class="text-danger">{{ $errors->first('hospitalizaciones') }}</div>
                                   @endif
                               </div>
                           </div>
                       </div>
                 
                           <!-- Campos de antecedentes gineco-obstétricos aquí -->
                           <h4 class=" ml-2">Antecendetes gineco-obstétricos  (Si aplica <span class=" text-danger">*</span>)</h4>
                               <div class="row p-2">

                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="menarca">Menarca </label>
                                           <input type="text" class="form-control edit_imput text-dark" id="menarca" name="menarca" value="{{ old('menarca') }}">
                                           @if ($errors->has('menarca'))
                                               <div class="text-danger">{{ $errors->first('menarca') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="gesta">Gesta</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="gesta" name="gesta" value="{{ old('gesta') }}">
                                           @if ($errors->has('gesta'))
                                               <div class="text-danger">{{ $errors->first('gesta') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="fur">FUR</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="fur" name="fur" value="{{ old('fur') }}">
                                           @if ($errors->has('fur'))
                                               <div class="text-danger">{{ $errors->first('fur') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="inicio_vida_sexual">Inicio de Vida Sexual</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="inicio_vida_sexual" name="inicio_vida_sexual" value="{{ old('inicio_vida_sexual') }}">
                                           @if ($errors->has('inicio_vida_sexual'))
                                               <div class="text-danger">{{ $errors->first('inicio_vida_sexual') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="para">PARA</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="para" name="para" value="{{ old('para') }}">
                                           @if ($errors->has('para'))
                                               <div class="text-danger">{{ $errors->first('para') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="cesarea">Cesárea</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="cesarea" name="cesarea" value="{{ old('cesarea') }}">
                                           @if ($errors->has('cesarea'))
                                               <div class="text-danger">{{ $errors->first('cesarea') }}</div>
                                           @endif
                                       </div>
                                   </div>
               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="num_companeros_sexuales">Número de Compañeros Sexuales</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="num_companeros_sexuales" name="num_companeros_sexuales" value="{{ old('num_companeros_sexuales') }}">
                                           @if ($errors->has('num_companeros_sexuales'))
                                               <div class="text-danger">{{ $errors->first('num_companeros_sexuales') }}</div>
                                           @endif
                                       </div>
                                   </div>
       
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="aborto">Aborto</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="aborto" name="aborto" value="{{ old('aborto') }}">
                                           @if ($errors->has('aborto'))
                                               <div class="text-danger">{{ $errors->first('aborto') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="legrado">Legrado</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="legrado" name="legrado" value="{{ old('legrado') }}">
                                           @if ($errors->has('legrado'))
                                               <div class="text-danger">{{ $errors->first('legrado') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="semanas_amenorrea">Semanas de Amenorrea</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="semanas_amenorrea" name="semanas_amenorrea" value="{{ old('semanas_amenorrea') }}">
                                           @if ($errors->has('semanas_amenorrea'))
                                               <div class="text-danger">{{ $errors->first('semanas_amenorrea') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-2">
                                       <div class="form-group">
                                           <label for="menopausia">Menopausia</label>
                                           <input type="checkbox" class="w-25 edit_imput text-dark" id="menopausia" name="menopausia" value="1" {{ old('menopausia') ? 'checked' : '' }}>
                                           @if ($errors->has('menopausia'))
                                               <div class="text-danger">{{ $errors->first('menopausia') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="fecha_menopausia">Fecha de Menopausia</label>
                                           <input type="date" class="form-control edit_imput text-dark" id="fecha_menopausia" name="fecha_menopausia" value="{{ old('fecha_menopausia') }}">
                                           @if ($errors->has('fecha_menopausia'))
                                               <div class="text-danger">{{ $errors->first('fecha_menopausia') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-2">
                                       <div class="form-group">
                                           <label for="planificacion_familiar">Planificación Familiar</label>
                                           <input type="checkbox" class="w-25 edit_imput text-dark" id="planificacion_familiar" name="planificacion_familiar" value="1" {{ old('planificacion_familiar') ? 'checked' : '' }}>
                                           @if ($errors->has('planificacion_familiar'))
                                               <div class="text-danger">{{ $errors->first('planificacion_familiar') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="metodo_planificacion">Método de Planificación</label>
                                           <input type="text" class=" form-control edit_imput text-dark" id="metodo_planificacion" name="metodo_planificacion" value="{{ old('metodo_planificacion') }}">
                                           @if ($errors->has('metodo_planificacion'))
                                               <div class="text-danger">{{ $errors->first('metodo_planificacion') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-2">
                                       <div class="form-group">
                                           <label for="sustitucion_hormonal">Sustitución Hormonal</label>
                                           <input type="checkbox" class="w-25 edit_imput text-dark" id="sustitucion_hormonal" name="sustitucion_hormonal" value="1" {{ old('sustitucion_hormonal') ? 'checked' : '' }}>
                                           @if ($errors->has('sustitucion_hormonal'))
                                               <div class="text-danger">{{ $errors->first('sustitucion_hormonal') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="especificar_sustitucion_hormonal">Especificar Sustitución Hormonal</label>
                                           <input type="text" class=" form-control edit_imput text-dark" id="especificar_sustitucion_hormonal" name="especificar_sustitucion_hormonal" value="{{ old('especificar_sustitucion_hormonal') }}">
                                           @if ($errors->has('especificar_sustitucion_hormonal'))
                                               <div class="text-danger">{{ $errors->first('especificar_sustitucion_hormonal') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-2">
                                       <div class="form-group">
                                           <label for="pap">PAP</label>
                                           <input type="checkbox" class="w-25 edit_imput text-dark" id="pap" name="pap" value="1" {{ old('pap') ? 'checked' : '' }}>
                                           @if ($errors->has('pap'))
                                               <div class="text-danger">{{ $errors->first('pap') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                           <label for="resultado_fecha_pap">Resultado/Fecha PAP</label>
                                           <input type="text" class="form-control edit_imput text-dark" id="resultado_fecha_pap" name="resultado_fecha_pap" value="{{ old('resultado_fecha_pap') }}">
                                           @if ($errors->has('resultado_fecha_pap'))
                                               <div class="text-danger">{{ $errors->first('resultado_fecha_pap') }}</div>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                          
                           
                               
               
                   </div>


                   <div id="step5" class="step step-bg-color" style="display:none;">
                       <div class="row p-2">
                        <div class="col-lg-12  alert alert-info">
                            <p class="text-white">
                                Si el paciente trabaja, por favor complete la siguiente información. Esto es crucial para evaluar su situación laboral y cualquier posible impacto en su salud.
                            </p>
                        </div>

                           <div class="form-group">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="trabajo_actual" name="trabajo_actual" value="1" {{ old('trabajo_actual') ? 'checked' : '' }}>
                                   <label class="form-check-label" for="trabajo_actual">Trabaja Actualmente <span class=" text-danger">*</span></label>
                               </div>
                           </div>
                       </div>

                       <div class="row p-2 trabajo-fields" style="display: {{ old('trabajo_actual') ? 'block' : 'none' }};">
                           <div class="col-lg-3 form-group p-1">
                               <label for="lugar_trabajo">Lugar de Trabajo <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="lugar_trabajo" name="lugar_trabajo" value="{{ old('lugar_trabajo') }}">
                               @if ($errors->has('lugar_trabajo'))
                                   <div class="text-danger">{{ $errors->first('lugar_trabajo') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="area_labora">Área Laboral <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="area_labora" name="area_labora" value="{{ old('area_labora') }}">
                               @if ($errors->has('area_labora'))
                                   <div class="text-danger">{{ $errors->first('area_labora') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="oficio_categoria">Oficio / Categoría <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="oficio_categoria" name="oficio_categoria" value="{{ old('oficio_categoria') }}">
                               @if ($errors->has('oficio_categoria'))
                                   <div class="text-danger">{{ $errors->first('oficio_categoria') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="anos_oficio_trabajo_actual">Años en el Oficio / Trabajo Actual <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_imput text-dark" id="anos_oficio_trabajo_actual" name="anos_oficio_trabajo_actual" value="{{ old('anos_oficio_trabajo_actual') }}">
                               @if ($errors->has('anos_oficio_trabajo_actual'))
                                   <div class="text-danger">{{ $errors->first('anos_oficio_trabajo_actual') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="dia_laboral_horas">Horas por Día Laboral <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_imput text-dark" id="dia_laboral_horas" name="dia_laboral_horas" value="{{ old('dia_laboral_horas') }}">
                               @if ($errors->has('dia_laboral_horas'))
                                   <div class="text-danger">{{ $errors->first('dia_laboral_horas') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="tipo_horario">Tipo de Horario <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="tipo_horario" name="tipo_horario" value="{{ old('tipo_horario') }}">
                               @if ($errors->has('tipo_horario'))
                                   <div class="text-danger">{{ $errors->first('tipo_horario') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="horas_semanales">Horas Semanales <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_imput text-dark" id="horas_semanales" name="horas_semanales" value="{{ old('horas_semanales') }}">
                               @if ($errors->has('horas_semanales'))
                                   <div class="text-danger">{{ $errors->first('horas_semanales') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <label for="descripcion_trabajo_actual">Descripción del Trabajo Actual <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="descripcion_trabajo_actual" name="descripcion_trabajo_actual">{{ old('descripcion_trabajo_actual') }}</textarea>
                               @if ($errors->has('descripcion_trabajo_actual'))
                                   <div class="text-danger">{{ $errors->first('descripcion_trabajo_actual') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group p-1">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="exposicion_sustancias" name="exposicion_sustancias" value="1" {{ old('exposicion_sustancias') ? 'checked' : '' }}>
                                   <label class="form-check-label" for="exposicion_sustancias">Exposición a Sustancias <span class=" text-danger">*</span></label>
                               </div>
                           </div>
                           
                           <div class="col-lg-3 form-group exposicion-fields" style="display: {{ old('exposicion_sustancias') ? 'block' : 'none' }};">
                               <label for="descripcion_exposicion">Descripción de la Exposición <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="descripcion_exposicion" name="descripcion_exposicion">{{ old('descripcion_exposicion') }}</textarea>
                               @if ($errors->has('descripcion_exposicion'))
                                   <div class="text-danger">{{ $errors->first('descripcion_exposicion') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="frecuencia_intensidad_tarea">Frecuencia e Intensidad de la Tarea <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="frecuencia_intensidad_tarea" name="frecuencia_intensidad_tarea">{{ old('frecuencia_intensidad_tarea') }}</textarea>
                               @if ($errors->has('frecuencia_intensidad_tarea'))
                                   <div class="text-danger">{{ $errors->first('frecuencia_intensidad_tarea') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="posicion_trabajo">Posición en el Trabajo <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_imput text-dark" id="posicion_trabajo" name="posicion_trabajo" value="{{ old('posicion_trabajo') }}">
                               @if ($errors->has('posicion_trabajo'))
                                   <div class="text-danger">{{ $errors->first('posicion_trabajo') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <div class="form-check">
                                   <input type="checkbox" class="form-check-input" id="trabajos_fuera_empleo" name="trabajos_fuera_empleo" value="1" {{ old('trabajos_fuera_empleo') ? 'checked' : '' }}>
                                   <label class="form-check-label" for="trabajos_fuera_empleo">Trabajos Fuera del Empleo (Si - No) <span class=" text-danger">*</span></label>
                               </div>
                           </div>
                           
                            <div class="col-lg-3 form-group trabajos-fields" style="display: {{ old('trabajos_fuera_empleo') ? 'block' : 'none' }};">
                               <label for="descripcion_trabajo_fuera_empleo">Descripción de Trabajos Fuera del Empleo <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_imput text-dark" id="descripcion_trabajo_fuera_empleo" name="descripcion_trabajo_fuera_empleo">{{ old('descripcion_trabajo_fuera_empleo') }}</textarea>
                               @if ($errors->has('descripcion_trabajo_fuera_empleo'))
                                   <div class="text-danger">{{ $errors->first('descripcion_trabajo_fuera_empleo') }}</div>
                               @endif
                           </div>
                           <div class="col-lg-3 form-group trabajos-fields" style="display: {{ old('horas_extras') ? 'block' : 'none' }};">
                               <label for="horas_extras">Horas extras  </label>
                               <input type="text" class="form-control edit_imput text-dark" id="horas_extras" name="horas_extras" value="{{ old('horas_extras') }}">
                               @if ($errors->has('horas_extras'))
                                   <div class="text-danger">{{ $errors->first('horas_extras') }}</div>
                               @endif
                           </div>
                           
                           
                       </div>
                       <div class="row">
                           <div class="col-lg-3 form-group">
                               <label for="antecedentes_laborales">¿Antecedentes Laborales? <span class=" text-danger">*</span></label>
                               <select class="form-control edit_input text-dark" id="antecedentes_laborales" name="antecedentes_laborales">
                                   <option value="1" {{ old('antecedentes_laborales') == '1' ? 'selected' : '' }}>Sí</option>
                                   <option value="0" {{ old('antecedentes_laborales') == '0' ? 'selected' : '' }}>No</option>
                               </select>
                               @if ($errors->has('antecedentes_laborales'))
                                   <div class="text-danger">{{ $errors->first('antecedentes_laborales') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="fecha_inicio">Fecha de Inicio <span class=" text-danger">*</span></label>
                               <input type="date" class="form-control edit_input text-dark" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}">
                               @if ($errors->has('fecha_inicio'))
                                   <div class="text-danger">{{ $errors->first('fecha_inicio') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="fecha_conclusion">Fecha de Conclusión <span class=" text-danger">*</span></label>
                               <input type="date" class="form-control edit_input text-dark" id="fecha_conclusion" name="fecha_conclusion" value="{{ old('fecha_conclusion') }}">
                               @if ($errors->has('fecha_conclusion'))
                                   <div class="text-danger">{{ $errors->first('fecha_conclusion') }}</div>
                               @endif
                           </div>

                           <div class="col-lg-3 form-group">
                               <label for="puesto_trabajo">Puesto de Trabajo <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="puesto_trabajo" name="puesto_trabajo" value="{{ old('puesto_trabajo') }}" placeholder="Describir productos,materiales u otros ">
                               @if ($errors->has('puesto_trabajo'))
                                   <div class="text-danger">{{ $errors->first('puesto_trabajo') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-3 form-group">
                               <label for="anos_trabajados">Años Trabajados <span class=" text-danger">*</span></label>
                               <input type="number" class="form-control edit_input text-dark" id="anos_trabajados" name="anos_trabajados" value="{{ old('anos_trabajados') }}">
                               @if ($errors->has('anos_trabajados'))
                                   <div class="text-danger">{{ $errors->first('anos_trabajados') }}</div>
                               @endif
                           </div>
                           
                          
                           
                       </div>
                      
                     </div>
                    <div id="step6" class="step-bg-color" style="display:none;">
                      
                       <div class="row p-2 justify-content-between d-flex">
                        <div class="col-lg-12 text-center">
                            <h4 class="mt-2 ml-4">Signos Vitales y Datos Antropométricos</h4>
                        </div>
                           <div class="col-lg-1 form-group">
                               <label for="fc"> (FC) <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="fc" name="fc" value="{{ old('fc') }}">
                               @if ($errors->has('fc'))
                                   <div class="text-danger">{{ $errors->first('fc') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="fr"> (FR) <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="fr" name="fr" value="{{ old('fr') }}">
                               @if ($errors->has('fr'))
                                   <div class="text-danger">{{ $errors->first('fr') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="ta"> (TA) <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="ta" name="ta" value="{{ old('ta') }}">
                               @if ($errors->has('ta'))
                                   <div class="text-danger">{{ $errors->first('ta') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="temperatura">TEM <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="temperatura" name="temperatura" value="{{ old('temperatura') }}">
                               @if ($errors->has('temperatura'))
                                   <div class="text-danger">{{ $errors->first('temperatura') }}</div>
                               @endif
                           </div>
                           <div class="col-lg-1 form-group">
                               <label for="peso">Peso <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="peso" name="peso" value="{{ old('peso') }}">
                               @if ($errors->has('peso'))
                                   <div class="text-danger">{{ $errors->first('peso') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="talla">Talla <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="talla" name="talla" value="{{ old('talla') }}">
                               @if ($errors->has('talla'))
                                   <div class="text-danger">{{ $errors->first('talla') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="area_superficie_corporal"> (ASC) <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="area_superficie_corporal" name="area_superficie_corporal" value="{{ old('area_superficie_corporal') }}">
                               @if ($errors->has('area_superficie_corporal'))
                                   <div class="text-danger">{{ $errors->first('area_superficie_corporal') }}</div>
                               @endif
                           </div>
                           
                           <div class="col-lg-1 form-group">
                               <label for="imc"> (IMC) <span class=" text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="imc" name="imc" value="{{ old('imc') }}">
                               @if ($errors->has('imc'))
                                   <div class="text-danger">{{ $errors->first('imc') }}</div>
                               @endif
                           </div>
                       </div>
                      
                     
                   
                       

                       <div class="row p-2">
                           <div class="col-lg-12 text-center">
                            <h4 class="mt-1 ml-4">Aspecto general Cabeza y Cuello</h4>
                           </div>
                           <div class="col-lg-3 form-group">
                               <label for="aspecto_general">Aspecto General <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="aspecto_general" name="aspecto_general" rows="3" >{{ old('aspecto_general') }}</textarea>
                               @if ($errors->has('aspecto_general'))
                                   <div class="text-danger">{{ $errors->first('aspecto_general') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="piel_mucosas">Piel y Mucosas <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="piel_mucosas" name="piel_mucosas" rows="3" >{{ old('piel_mucosas') }}</textarea>
                               @if ($errors->has('piel_mucosas'))
                                   <div class="text-danger">{{ $errors->first('piel_mucosas') }}</div>
                               @endif
                           </div>
                           <div class="col-lg-3 form-group">
                               <label for="craneo">Cráneo <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="craneo" name="craneo" rows="3">{{ old('craneo') }}</textarea>
                               @if ($errors->has('craneo'))
                                   <div class="text-danger">{{ $errors->first('craneo') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="ojos">Ojos <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="ojos" name="ojos" rows="3">{{ old('ojos') }}</textarea>
                               @if ($errors->has('ojos'))
                                   <div class="text-danger">{{ $errors->first('ojos') }}</div>
                               @endif
                           </div>
                       
                         
                       </div>
                       
                       <div class="row p-2">
                           <div class="col-lg-3 form-group">
                               <label for="orejas">Orejas <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="orejas" name="orejas" rows="3">{{ old('orejas') }}</textarea>
                               @if ($errors->has('orejas'))
                                   <div class="text-danger">{{ $errors->first('orejas') }}</div>
                               @endif
                           </div>
                           <div class="col-lg-3 form-group">
                               <label for="nariz">Nariz <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="nariz" name="nariz" rows="3">{{ old('nariz') }}</textarea>
                               @if ($errors->has('nariz'))
                                   <div class="text-danger">{{ $errors->first('nariz') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="boca">Boca <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="boca" name="boca" rows="3">{{ old('boca') }}</textarea>
                               @if ($errors->has('boca'))
                                   <div class="text-danger">{{ $errors->first('boca') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-3 form-group">
                               <label for="cuello">Cuello <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="cuello" name="cuello" rows="3">{{ old('cuello') }}</textarea>
                               @if ($errors->has('cuello'))
                                   <div class="text-danger">{{ $errors->first('cuello') }}</div>
                               @endif
                           </div>
                       </div>
                       <h4 class="mt-2 ml-4">Tórax </h4>
                       <div class="row p-2">
                           <div class="col-3 form-group">
                               <label for="caja_toracica">Caja Torácica <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="caja_toracica" name="caja_toracica" rows="3">{{ old('caja_toracica') }}</textarea>
                               @if ($errors->has('caja_toracica'))
                                   <div class="text-danger">{{ $errors->first('caja_toracica') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="mamas">Mamas <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="mamas" name="mamas" rows="3">{{ old('mamas') }}</textarea>
                               @if ($errors->has('mamas'))
                                   <div class="text-danger">{{ $errors->first('mamas') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="campos_pulmonares">Campos Pulmonares <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="campos_pulmonares" name="campos_pulmonares" rows="3">{{ old('campos_pulmonares') }}</textarea>
                               @if ($errors->has('campos_pulmonares'))
                                   <div class="text-danger">{{ $errors->first('campos_pulmonares') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="cardiaco">Cardíaco <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="cardiaco" name="cardiaco" rows="3">{{ old('cardiaco') }}</textarea>
                               @if ($errors->has('cardiaco'))
                                   <div class="text-danger">{{ $errors->first('cardiaco') }}</div>
                               @endif
                           </div>
                       </div>
                       <h4 class="mt-2 ml-2">Otros Datos</h4>
                       <div class="row p-2">
                           <div class="col-3 form-group">
                               <label for="abdomen_pelvis">Abdomen/Pelvis <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="abdomen_pelvis" name="abdomen_pelvis" rows="3">{{ old('abdomen_pelvis') }}</textarea>
                               @if ($errors->has('abdomen_pelvis'))
                                   <div class="text-danger">{{ $errors->first('abdomen_pelvis') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="extremidades_superiores">Extremidades Superiores <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="extremidades_superiores" name="extremidades_superiores" rows="3">{{ old('extremidades_superiores') }}</textarea>
                               @if ($errors->has('extremidades_superiores'))
                                   <div class="text-danger">{{ $errors->first('extremidades_superiores') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="extremidades_inferiores">Extremidades Inferiores <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="extremidades_inferiores" name="extremidades_inferiores" rows="3">{{ old('extremidades_inferiores') }}</textarea>
                               @if ($errors->has('extremidades_inferiores'))
                                   <div class="text-danger">{{ $errors->first('extremidades_inferiores') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="genitourinario">Genitourinario (Cuando aplique el caso)<span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="genitourinario" name="genitourinario" rows="3">{{ old('genitourinario') }}</textarea>
                               @if ($errors->has('genitourinario'))
                                   <div class="text-danger">{{ $errors->first('genitourinario') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="examen_ginecologico">Examen Ginecológico <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="examen_ginecologico" name="examen_ginecologico" rows="3">{{ old('examen_ginecologico') }}</textarea>
                               @if ($errors->has('examen_ginecologico'))
                                   <div class="text-danger">{{ $errors->first('examen_ginecologico') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="examen_neurologico">Examen Neurológico <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="examen_neurologico" name="examen_neurologico" rows="3">{{ old('examen_neurologico') }}</textarea>
                               @if ($errors->has('examen_neurologico'))
                                   <div class="text-danger">{{ $errors->first('examen_neurologico') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="observaciones_analisis">Observaciones/Análisis <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="observaciones_analisis" name="observaciones_analisis" rows="3">{{ old('observaciones_analisis') }}</textarea>
                               @if ($errors->has('observaciones_analisis'))
                                   <div class="text-danger">{{ $errors->first('observaciones_analisis') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-3 form-group">
                               <label for="diagnosticos_problemas">Diagnósticos/Problemas <span class=" text-danger">*</span></label>
                               <textarea class="form-control edit_input text-dark" id="diagnosticos_problemas" name="diagnosticos_problemas" rows="3">{{ old('diagnosticos_problemas') }}</textarea>
                               @if ($errors->has('diagnosticos_problemas'))
                                   <div class="text-danger">{{ $errors->first('diagnosticos_problemas') }}</div>
                               @endif
                           </div>
                       
                           <div class="col-lg-7 form-group">
                            <label for="doctor_id">Nombre del Elaborador (Médico) <span class="text-danger">*</span></label>
                            <select class="form-control select2 w-100" id="doctor_id" name="doctor_id" required>
                                <option value="">Seleccione un médico</option>
                                @foreach($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" data-codigo="{{ $doctor->codigo }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->primer_nombre }} {{ $doctor->primer_apellido }} 
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('doctor_id'))
                                <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                            @endif
                        </div>
                        
                        
                       

                           <div class="col-3 form-group">
                               <label for="firma_codigo_sello">Firma/Código/Sello (Medico) <span class="text-danger">*</span></label>
                               <input type="text" class="form-control edit_input text-dark" id="firma_codigo_sello" name="firma_codigo_sello" 
                                      value="{{ old('firma_codigo_sello') }}" pattern="\d{5}" title="El código debe tener exactamente 5 números" required>
                               @if ($errors->has('firma_codigo_sello'))
                                   <div class="text-danger">{{ $errors->first('firma_codigo_sello') }}</div>
                               @endif
                           </div>
                           
                       </div>
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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/es.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>


  <script>



$(document).ready(function() {
    $('#historiaclinicaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/historias_clinicas') }}", // hace una llamada ajax 
        columns: [
        { data: 'id' },
        { data: 'no_expediente', searchable: true,
            render: function (data, type, row) {
                return `<span class="text-primary font-weight-bold">${data}</span> `;
            }
        },
        { data: 'primer_nombre', searchable: true,
            render: function (data, type, row) {
                return `<span class="font-weight-bold">${data}</span>`;
            }
        },
        { data: 'segundo_nombre', searchable: true },
        { data: 'primer_apellido', searchable: true },
        { data: 'segundo_apellido', searchable: true },
        { data: 'no_cedula', searchable: true,
            render: function (data, type, row) {
                return `<span class="text-danger font-weight-bold">${data}</span>`;
            }
        },
        { data: 'edad', searchable: true },
        { data: 'sexo', searchable: true },
        { data: 'no_inss', searchable: true,
            render: function (data, type, row) {
                return `<span class="text-indigo font-weight-bold">${data}</span>`;
            }
        },
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
                            { text: 'Tabla de Historias clinicas \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                            '<h3>Tabla de Historias Clinicas</h3>' +
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
     $('#historiaclinicaTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var url = "{{ url('historias_clinicas') }}/" + id;
        
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
                        $('#historiaclinicaTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Eliminado!',
                            'El dato  ha sido eliminado.',
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
                  
                   
                  
                    
                    // Rellena los demás campos aquí si es necesario

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

// ********************* aca manejamos la divicion del form de crear /////////////

    var currentStep = 1;
    var totalSteps = 6; // Actualiza este valor según la cantidad de pasos que tengas

    function showStep(step) {
        for (var i = 1; i <= totalSteps; i++) {
            document.getElementById('step' + i).style.display = (i === step) ? 'block' : 'none';
        }
        document.getElementById('prevBtn').style.display = (step === 1) ? 'none' : 'inline';
        document.getElementById('nextBtn').style.display = (step === totalSteps) ? 'none' : 'inline';
        document.getElementById('submitBtn').style.display = (step === totalSteps) ? 'inline' : 'none';
    }

   function showNextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function showPrevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        showStep(currentStep);
    });

   

//  *********************código para ocultar y mostrar los campos de tabaco según el estado del checkbox. si es true se muestran ******** 
    $(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.tabaco-fields').hide();
    
    // Manejar el cambio en el checkbox
    $('#tabaco').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.tabaco-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.tabaco-fields').hide();
        }
    });
});
//**************ódigo para ocultar y mostrar los campos de alcohol según el estado del checkbox. si es true se muestran ******** 
$(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.alcohol-fields').hide();
    
    // Manejar el cambio en el checkbox
    $('#alcohol').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.alcohol-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.alcohol-fields').hide();
        }
    });

    // Manejar el estado inicial del checkbox (si ya está marcado al cargar la página)
    if ($('#alcohol').is(':checked')) {
        $('.alcohol-fields').show();
    }
});
//*******código para ocultar y mostrar los campos de drogas según el estado del checkbox. si es true se muestran ******** 
$(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.drogas-fields').hide();
    
    // Manejar el cambio en el checkbox
    $('#drogas_ilegales').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.drogas-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.drogas-fields').hide();
        }
    });

    // Manejar el estado inicial del checkbox (si ya está marcado al cargar la página)
    if ($('#drogas_ilegales').is(':checked')) {
        $('.drogas-fields').show();
    }
});

//*********código para ocultar y mostrar los campos de farmacos  según el estado del checkbox. si es true se muestran ******** 
$(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.farmacos-fields').hide();
    
    // Manejar el cambio en el checkbox
    $('#farmacos').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.farmacos-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.farmacos-fields').hide();
        }
    });

    // Manejar el estado inicial del checkbox (si ya está marcado al cargar la página)
    if ($('#farmacos').is(':checked')) {
        $('.farmacos-fields').show();
    }
});

   
         // funcion para mostrar los campos relacionados al trabajo si es true en el check
  function toggleTrabajoCampos() {
        const trabajoChecked = document.getElementById('trabajo_actual').checked;
        document.getElementById('trabajo_campos').style.display = trabajoChecked ? 'block' : 'none';
        // También oculta el campo de descripción de exposición si se desmarca el checkbox
        if (!trabajoChecked) {
            document.getElementById('exposicion_sustancias').checked = false;
            document.getElementById('descripcion_exposicion_div').style.display = 'none';
        }
    }

    function toggleDescripcionExposicion() {
        const exposicionChecked = document.getElementById('exposicion_sustancias').checked;
        document.getElementById('descripcion_exposicion_div').style.display = exposicionChecked ? 'block' : 'none';
    }

    // Inicializar la visibilidad de los campos al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        toggleTrabajoCampos();
        toggleDescripcionExposicion();
    });


    $(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.trabajo-fields').hide();

    // Manejar el cambio en el checkbox de trabajo actual
    $('#trabajo_actual').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.trabajo-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.trabajo-fields').hide();
        }
    });

    // Mostrar los campos adicionales si el checkbox está marcado al cargar la página
    if ($('#trabajo_actual').is(':checked')) {
        $('.trabajo-fields').show();
    }
});

$(document).ready(function() {
    // Ocultar los campos adicionales por defecto
    $('.exposicion-fields').hide();
    $('.trabajos-fields').hide();

    // Manejar el cambio en el checkbox de exposición a sustancias
    $('#exposicion_sustancias').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.exposicion-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.exposicion-fields').hide();
        }
    });

    // Manejar el cambio en el checkbox de trabajos fuera del empleo
    $('#trabajos_fuera_empleo').change(function() {
        if ($(this).is(':checked')) {
            // Mostrar los campos si el checkbox está marcado
            $('.trabajos-fields').show();
        } else {
            // Ocultar los campos si el checkbox no está marcado
            $('.trabajos-fields').hide();
        }
    });

    // Mostrar los campos adicionales si el checkbox está marcado al cargar la página
    if ($('#exposicion_sustancias').is(':checked')) {
        $('.exposicion-fields').show();
    }

    if ($('#trabajos_fuera_empleo').is(':checked')) {
        $('.trabajos-fields').show();
    }
});

// este codigo es para buscar por ajax en tiempo real los pacientes para las historis clinicas 

   $(document).ready(function() {
        $('#buscar_paciente').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: "{{ route('buscarPaciente') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data) {
                        $('#lista_pacientes').empty();
                        if (data.length > 0) {
                            $.each(data, function(index, paciente) {
                                $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action" data-id="' + paciente.id + '">' + paciente.primer_nombre + ' ' + paciente.primer_apellido + ' ' + paciente.segundo_apellido + ' (' + paciente.no_cedula + ')</a>');
                            });
                        } else {
                            $('#lista_pacientes').append('<a href="#" class="list-group-item list-group-item-action disabled">No se encontraron resultados</a>');
                        }
                    }
                });
            } else {
                $('#lista_pacientes').empty();
            }
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
                        $('#fecha_nacimiento').val(response.fecha_nacimiento);
                        $('#sexo').val(response.sexo);
                        $('#no_cedula').val(response.no_cedula);
                        $('#no_inss').val(response.no_inss);
                        $('#escolaridad').val(response.escolaridad);
                        $('#direccion').val(response.direccion);
                        $('#grupos_etnicos').val(response.raza_etnia);

                        // Rellena los demás campos aquí si es necesario
                    }
                });
            }
        });
     });

    
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
                    $('#fecha_nacimiento').val(response.fecha_nacimiento);
                    $('#sexo').val(response.sexo);
                    $('#no_cedula').val(response.no_cedula);
                    $('#no_inss').val(response.no_inss);
                    $('#escolaridad').val(response.escolaridad);
                    $('#direccion').val(response.direccion);
                    $('#grupos_etnicos').val(response.raza_etnia);

                    // Aquí se realiza la comprobación para la historia clínica
                    verificarHistoriaClinica(pacienteId);
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

    //****** con esta funcion muestro el input si el checked de no. cama es true 
  $(document).ready(function() {
    $('#is_ingresado').change(function() {
        if ($(this).is(':checked')) {
            $('#no_cama_container').show();
        } else {
            $('#no_cama_container').hide();
        }
    });
  });
   //****** con esta funcion muestro el input si el checked de inmunizaciones completas  es false 
$(document).ready(function() {
    $('#inmunizaciones_completas').change(function() {
        if ($(this).is(':checked')) {
            $('#detalle_inmunizaciones_container').hide();
        } else {
            $('#detalle_inmunizaciones_container').show();
        }
    });

    // Asegurarse de que el estado del campo se mantenga al recargar la página
    if (!$('#inmunizaciones_completas').is(':checked')) {
        $('#detalle_inmunizaciones_container').show();
    }
});

$(document).ready(function() {
    // Manejar el cambio en el checkbox de alcohol

    $('#tabaco').change(function() {
        $('.tabaco-fields-edit').toggle(this.checked);
    });

    $('#alcohol').change(function() {
        $('.alcohol-fields-edit').toggle(this.checked);
    });

    // Manejar el cambio en el checkbox de drogas
    $('#drogas_ilegales').change(function() {
        $('.drogas-fields-edit').toggle(this.checked);
    });

    // Manejar el cambio en el checkbox de fármacos
    $('#farmacos').change(function() {
        $('.farmacos-fields-edit').toggle(this.checked);
    });

    // Manejar el estado inicial de los checkboxes
    if ($('#tabaco').is(':checked')) {
        $('.tabaco-fields-edit').show();
    }
    if ($('#alcohol').is(':checked')) {
        $('.alcohol-fields-edit').show();
    }
    if ($('#drogas_ilegales').is(':checked')) {
        $('.drogas-fields-edit').show();
    }
    if ($('#farmacos').is(':checked')) {
        $('.farmacos-fields-edit').show();
    }

});


 </script>
  <script>
       $(document).ready(function() {
    // Inicializar select2
    $('#doctor_id').select2({
        language: "es",
        placeholder: "Seleccione un médico",
        allowClear: true
    });

    // Detectar el cambio en el select de doctor
    $('#doctor_id').on('change', function() {
        // Obtener el código del médico seleccionado
        var selectedDoctorCode = $('#doctor_id option:selected').data('codigo');
        
        // Rellenar el campo de Firma/Código/Sello con el código del doctor
        if (selectedDoctorCode) {
            $('#firma_codigo_sello').val(selectedDoctorCode);
        } else {
            // Si no hay médico seleccionado, limpiar el campo
            $('#firma_codigo_sello').val('');
        }
    });
});
  </script>

  @stop
    
   </body>
   </html>

    




