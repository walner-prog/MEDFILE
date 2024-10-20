<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')
<head>
    <link
    rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
@section('content')
@if(session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif

 <div class="text-center mt-4 container-fluid">
       <!-- Tooltip de publicidad -->
<div id="tooltip" class="tooltip">
    <h5 class="tooltip-title">Mejora Tu Salud con IA</h5>
    <p>
        ¡Consulta a nuestra inteligencia artificial y recibe recomendaciones personalizadas para tu bienestar!
    </p>
    <button class="btn btn-success" onclick="startConsultation()">Comenzar Consulta</button>
</div>

        <!-- Carrusel de imágenes -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel"  data-aos="fade-down"
     data-aos-easing="linear"
     data-aos-duration="1000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('assets/img/medfile3.jpeg') }}" class="d-block w-100" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/img/medf.jpeg') }}" class="d-block w-100" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/img/medfile3.jpeg') }}" class="d-block w-100" alt="Imagen 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container-fluid" data-aos="fade-up">
    <div class="row mt-4 justify-content-center" data-aos-duration="500">
        <div class="col-md-12 mb-2">
            <!-- Puedes agregar contenido aquí si es necesario -->
        </div>
    </div>
</div>

<!-- Sección de Servicios -->
<div class="services mt-5 " data-aos="fade-up"
    data-aos-duration="1000">
    <h2 class="animate__animated animate__fadeInDown">Servicios Disponibles</h2>
    <p>Ofrecemos una plataforma fácil y accesible para que nuestros pacientes agenden citas, revisen su historial médico, y reciban notificaciones sobre sus citas pendientes.</p>
    <div class="row mt-4">
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Agendar Cita</h5>
                <p class="card-text">Agenda tu cita de manera rápida y sencilla.</p>
                <a href="{{ route('agendar.cita') }}" class="btn btn-primary">Agendar Cita</a>
            </div>
        </div>
    </div>

    <!-- Card 2: Historial de Citas -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Historial de Citas</h5>
                <p class="card-text">Consulta tu historial de citas fácilmente.</p>
                <a href="{{ route('historial.citas') }}" class="btn btn-primary">Ver Historial</a>
            </div>
        </div>
    </div>

    <!-- Card 3: Notificaciones -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Notificaciones</h5>
                <p class="card-text">Recibe notificaciones de tus citas pendientes.</p>
                <a href="{{ route('notificaciones.pendientes') }}" class="btn btn-primary">Ver Notificaciones</a>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="mental-health mt-5 border p-2 border-radius" data-aos="fade-up"
   data-aos-duration="1000">
    <h2 class="text-center">Apoyo en Salud Mental</h2>
    <p class="text-center">
        Nuestra plataforma ofrece un enfoque innovador en el cuidado de la salud mental, permitiendo a los pacientes acceder a recursos valiosos y apoyo personalizado.
    </p>

    <div class="row mt-4">
        <div class="col-lg-6 mb-1">
            <img src="{{ asset('assets/img/terapia.jpeg') }}" alt="Descripción de la imagen" class="img-fluid" />
        </div>

        <div class="col-md-6 mb-1">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Autoevaluaciones Interactivas</h5>
                    <p>
                        Realiza autoevaluaciones psicológicas diseñadas para ayudarte a evaluar tu estado emocional y mental en base a tu historial clínico. Estas evaluaciones están orientadas a identificar signos de estrés, ansiedad o depresión, especialmente si estás lidiando con alguna enfermedad.
                        <br> Además, te proporcionaremos recomendaciones personalizadas y, si es necesario, te sugeriremos contactar a un profesional de la salud mental para recibir apoyo.
                    </p>
                    <a href="{{ url('/auto-evaluacion') }}" class="btn bt-indigo w-50">Empezar Evaluación</a>
                </div>
            </div>
            <div class="card shadow text-center mt-5">
                <div class="card-body">
                    <h5 class="card-title">Terapias en Línea</h5>
                    <p>
                        Accede a sesiones de terapia en línea con profesionales certificados en salud mental desde la comodidad de tu hogar. Nuestras terapias virtuales están diseñadas para ofrecerte el apoyo emocional y psicológico que necesitas en momentos difíciles, ya sea que estés enfrentando estrés, ansiedad, depresión o problemas relacionados con una enfermedad. Las sesiones son confidenciales y flexibles, permitiendo que recibas atención personalizada sin importar tu ubicación.
                    </p>
                    <a href="{{ url('/terapia-en-linea') }}" class="btn bt-indigo w-50">Solicitar Terapia</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 mt-2 mb-2">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Agendar Cita</h5>
                    <p>
                        ¡Agendar tu cita médica nunca ha sido tan fácil! Solo sigue estos simples pasos: llena el formulario con tus datos y preferencias, selecciona la fecha y hora disponibles, y confirma tu cita en minutos. Además, podrás revisar fácilmente tus citas agendadas y acceder al historial completo de tus consultas previas, todo desde un solo lugar. Nuestro sistema te garantiza un proceso rápido, sencillo y totalmente accesible.
                    </p>
                    <a href="{{ url('/agendar-cita') }}" class="btn bt-primario w-50">Agenda Ahora</a>
                </div>
            </div>
            <div class="card shadow text-center mt-5 mb-2">
                <div class="card-body">
                    <h5 class="card-title">Consulta Médica Asistida por IA</h5>
                      <p>
                          Bienvenido a nuestra sección de consulta médica asistida por inteligencia artificial, diseñada para proporcionarte un apoyo integral en el cuidado de tu salud. A través de avanzados algoritmos y modelos de aprendizaje automático, nuestra IA te ofrece un análisis detallado de tus síntomas y condiciones, brindándote recomendaciones personalizadas basadas en información médica confiable. 
                      </p>
                         
                      <p>
                        Explora nuestras herramientas interactivas y accede a orientación profesional al alcance de tu mano. Aprende sobre estrategias de manejo de salud, técnicas de prevención y recursos informativos que te ayudarán a tomar decisiones informadas y proactivas sobre tu bienestar. ¡Tu salud es nuestra prioridad!
                    </p>

                    <a href="{{ url('/chat') }}" class="btn bt-tercer w-50">Consultar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('assets/img/citas.jpeg') }}" alt="Descripción de la imagen" class="img-fluid" />
        </div>
    </div>
 
</div>
<br>
  <script>
    // Función para mostrar el tooltip
   function showTooltip() {
    const tooltip = document.getElementById("tooltip");
    tooltip.style.display = "block"; // Muestra el tooltip
    tooltip.style.opacity = "1"; // Asegura que sea visible
  }

    // Verifica si el tooltip ha sido mostrado en los últimos 30 minutos
   function shouldShowTooltip() {
    const lastShownTime = localStorage.getItem("tooltipLastShown");
    const currentTime = new Date().getTime();

    // Si no hay registro, mostrar tooltip y guardar la hora actual
    if (!lastShownTime || currentTime - lastShownTime > 1800000) { // 1800000 ms = 30 min
        localStorage.setItem("tooltipLastShown", currentTime);
        return true;
    }
    return false;
}

// Detectar el desplazamiento y mostrar el tooltip si corresponde
window.addEventListener("scroll", function() {
    if (shouldShowTooltip()) {
        showTooltip();
    }
});

// Función para iniciar la consulta
function startConsultation() {
    // Aquí puedes redirigir al usuario a la página de consulta
    window.location.href = '/chat'; // Ajusta la URL según tu aplicación
}

   </script>
    </div>
@endsection
@section('css')
   <style>

.tooltip {
    display: none; /* Oculto por defecto */
    position: fixed; 
    bottom: 20px; 
    right: 20px; 
    background-color: #f9f9f9; 
    border: 1px solid #ccc; 
    border-radius: 5px; 
    padding: 15px; 
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    z-index: 1000;
    width: 300px; /* Ancho del tooltip */
    transition: opacity 0.3s; /* Efecto de transición */
}

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