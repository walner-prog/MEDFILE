
@extends('layouts.app_portal')

@section('content')
 
<div class="container">
    
  
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
   @endif
   @if (session('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
   @endif
   @if (session('delete'))
    <div class="alert alert-warning">{{ session('delete') }}</div>
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
  
  <div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
            <ol id="breadcrumb" class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/medfile-pacientes') }}">Hogar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
            </ol>
        </nav>
    </div>
  </div>
<div class="container">
    <div class="card p-2">
        <div class="row">
            <div class="col-lg-3">
                <h1>Autoevaluación Psicológica</h1>  
            </div>
            <div class="col-lg-6 ">
                 <!-- Botón para abrir el modal -->
               <button type="button" class="btn btn-info text-right text-white" data-bs-toggle="modal" data-bs-target="#infoModal">
                 Información y Ayuda
              </button>
            </div>
            <div class="col-lg-3">
                
             <!-- Botón para abrir el modal -->
           <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalConfidencialidad">
                 Ver Política de Confidencialidad
            </button>

            </div>
        </div>
          
    <form action="{{ route('autoevaluacion.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Horas de Sueño -->
            <div class="col-lg-6 mb-3">
                <label for="horas_sueno" class="form-label">Horas de Sueño</label>
                <input type="number" class="form-control" name="horas_sueno" id="horas_sueno" required min="0" max="24">
                @error('horas_sueno')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Historia de Enfermedad Actual -->
            <div class="col-lg-6 mb-3">
                <label for="historia_enfermedad_actual" class="form-label">
                    Historia de Enfermedad Actual 
                    <small class="text-muted">(Describe tus síntomas actuales, diagnósticos recientes, y cualquier tratamiento que estés recibiendo. Es importante mencionar si hay enfermedades crónicas, pero también incluir cualquier condición aguda o temporal que estés enfrentando.)</small>
                </label>
                <textarea class="form-control" name="historia_enfermedad_actual" id="historia_enfermedad_actual" required></textarea>
                @error('historia_enfermedad_actual')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>

        <div class="row">
            <!-- Enfermedades Crónicas -->
            <div class="col-lg-6 mb-3">
                <label for="enfermedades_cronicas" class="form-label">Enfermedades Crónicas</label>
                <select class="form-select" name="enfermedades_cronicas" id="enfermedades_cronicas" required>
                    <option value="" disabled selected>Selecciona una enfermedad</option>
                    <option value="insuficiencia_renal_cronica">Insuficiencia Renal Crónica</option>
                    <option value="cancer">Cáncer (varios tipos)</option>
                    <option value="cancer_prostata">Cáncer de Próstata</option>
                    <option value="cirrosis">Cirrosis Hepática</option>
                    <option value="presion_arterial">Hipertensión Arterial</option>
                    <option value="diabetes">Diabetes Mellitus</option>
                    <option value="asma">Asma</option>
                    <option value="epoc">Enfermedad Pulmonar Obstructiva Crónica (EPOC)</option>
                    <option value="artritis">Artritis (varios tipos)</option>
                    <option value="hipotiroidismo">Hipotiroidismo</option>
                    <option value="hipertiroidismo">Hipertiroidismo</option>
                    <option value="enfermedad_coronaria">Enfermedad Coronaria</option>
                    <option value="acv">Accidente Cerebrovascular (ACV)</option>
                    <option value="osteoporosis">Osteoporosis</option>
                    <option value="insuficiencia_cardiaca">Insuficiencia Cardíaca</option>
                    <option value="glaucoma">Glaucoma</option>
                    <option value="enfermedades_renales">Enfermedades Renales (varios tipos)</option>
                    <option value="esclerosis_multiplex">Esclerosis Múltiple</option>
                    <option value="parkinson">Enfermedad de Parkinson</option>
                    <option value="alzheimer">Enfermedad de Alzheimer</option>
                    <option value="fibromialgia">Fibromialgia</option>
                </select>
            </div>
            
            <!-- Diagnósticos Médicos -->
            <div class="col-lg-6 mb-3">
                <label for="diagnostico_medico" class="form-label">Diagnóstico Médico (si aplica)</label>
                <input type="text" class="form-control" name="diagnostico_medico" id="diagnostico_medico">
            </div>
        </div>

        <div class="row">
            <!-- Nivel de Estrés -->
            <div class="col-lg-6 mb-3">
                <label for="nivel_estres" class="form-label">Nivel de Estrés (1 a 10)</label>
                <input type="number" class="form-control" name="nivel_estres" id="nivel_estres" min="1" max="10" required>
            </div>
            <!-- Síntomas de Ansiedad o Depresión -->
            <div class="col-lg-6 mb-3">
                <label for="sintomas_mentales" class="form-label">Síntomas de Ansiedad o Depresión</label>
                <textarea class="form-control" name="sintomas_mentales" id="sintomas_mentales"></textarea>
            </div>
        </div>

        <div class="row">
            <!-- Calidad de Vida -->
            <div class="col-lg-12 mb-3">
                <label for="calidad_vida" class="form-label">¿Cómo describirías tu calidad de vida en general?</label>
                <textarea class="form-control" name="calidad_vida" id="calidad_vida" rows="2"></textarea>
            </div>

            <div class="col-lg-12">
                @php
                    $preguntas = [
                        "¿Ha podido concentrarse bien en lo que hace?",
                        "¿Sus preocupaciones le han hecho perder mucho sueño?",
                        "¿Ha sentido que está jugando un papel útil en la vida?",
                        "¿Se ha sentido capaz de tomar decisiones?",
                        "¿Se ha sentido constantemente agobiado y en tensión?",
                        "¿Ha sentido que no puede superar sus dificultades?",
                        "¿Ha sido capaz de disfrutar sus actividades normales de cada día?",
                        "¿Ha sido capaz de hacer frente a sus problemas?",
                        "¿Se ha sentido triste o deprimido?",
                        "¿Ha perdido confianza en sí mismo?",
                        "¿Ha pensado que usted es una persona que no vale para nada?",
                        "¿Se siente razonablemente feliz considerando todas las circunstancias?"
                    ];
                @endphp
            
                <div class="row">
                    @foreach ($preguntas as $index => $pregunta)
                        <div class="col-lg-3 mb-3"> <!-- Cambiar a col-lg-4 -->
                            <label class="form-label">{{ $pregunta }}</label>
                            <div>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="pregunta_{{ $index + 1 }}" value="sí" required> Sí
                                </label>
                                <label class="form-check-label ms-3">
                                    <input class="form-check-input" type="radio" name="pregunta_{{ $index + 1 }}" value="no" required> No
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>

        <!-- Botón de Enviar -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary">Enviar Autoevaluación</button>
            </div>
        </div>
    </form>
    </div>



    <!-- Modal -->
     
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Orientación sobre la Autoevaluación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>La autoevaluación psicológica es un proceso importante para evaluar tu bienestar emocional y físico. Si has notado alguno de los siguientes síntomas, te recomendamos que busques ayuda profesional:</p>
                    <ul>
                        <li>Niveles de estrés persistentes (puntuación alta en la escala de estrés).</li>
                        <li>Síntomas de ansiedad o depresión que afectan tu vida diaria.</li>
                        <li>Problemas graves para dormir, como insomnio o falta de sueño reparador.</li>
                        <li>Emociones intensas o cambios de humor que no puedes controlar.</li>
                        <li>Enfermedades crónicas que están afectando tu salud mental o calidad de vida.</li>
                    </ul>
                    <p>Si sientes que necesitas hablar con un profesional, no dudes en contactar a un psicólogo o médico especializado. Ellos pueden brindarte la orientación y el tratamiento que necesitas.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
 
    

   <!-- Modal de Confidencialidad -->
   
   <div class="modal fade" id="modalConfidencialidad" tabindex="-1" aria-labelledby="modalConfidencialidadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfidencialidadLabel">Confidencialidad de sus Datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    En <strong>MEDFILE</strong>, valoramos su privacidad y estamos comprometidos a proteger sus datos personales. La información que usted proporciona será utilizada únicamente con los siguientes propósitos:
                </p>
                <ul>
                    <li>Evaluar su estado de salud actual.</li>
                    <li>Ofrecerle recomendaciones personalizadas basadas en su historial médico.</li>
                    <li>Realizar seguimiento de su progreso a lo largo del tiempo.</li>
                    <li>Proporcionar asistencia en futuras consultas médicas.</li>
                </ul>
                <p>
                    Sus datos serán almacenados de manera segura y solo serán accesibles por personal autorizado. Nunca compartiremos su información con terceros sin su consentimiento explícito, excepto cuando sea requerido por la ley.
                </p>
                <p>
                    Si tiene preguntas sobre cómo se utilizan sus datos o desea conocer más sobre nuestras políticas de privacidad, no dude en comunicarse con nosotros.
                    <small class="text-muted">
                        Para más información, contáctenos a: <a href="mailto:info@medfile.com">info@medfile.com</a>
                    </small>
                    
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Entiendo y Acepto</button>
            </div>
        </div>
    </div>
</div>


    
</div>


<br>

    </div>
@endsection
@section('css')
   <style>
    .search-bar {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}
.card {
  border-radius: 15px;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.card-title {
  font-size: 1.5rem;
}

.card-text {
  font-size: 1.1rem;
}

.b-pagination {
  justify-content: center;
}

.services {
  text-align: center;
}

.btn {
  width: 100%;
  transition: background-color 0.3s ease;
}

.btn:hover {
  filter: brightness(90%);
}


.bt-cyan {
  background-color: #06b6d4; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario {
  background-color: #0071bc; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario:hover {
  background-color: #09466FFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-indigo {
  background-color: #9F1FFBFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-indigo:hover {
  background-color: #720394FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario {
  background-color: #7ac943; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario:hover {
  background-color: #63A534FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-tercer {
  background-color: #29abe2; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-tercer:hover {
  background-color: #2187B3FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}
   </style>
@stop