<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')

@section('content')
 
<div class="container">
    
  
      
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

<section id="quienes-somos" class="container my-5">
    <h2 class="text-center">Quiénes Somos</h2>
    
    <!-- Sección: Cómo nace MEDFILE -->
    <div class="row my-4">
        <div class="col-md-12">
            <h3>Cómo nace MEDFILE</h3>
            <p>
                MEDFILE es un sistema web hospitalario desarrollado con el objetivo de transformar la gestión de expedientes médicos y citas en Nicaragua. Nació de la necesidad de modernizar los procesos de atención al paciente, integrando tecnología avanzada y herramientas de inteligencia artificial para optimizar el flujo de trabajo en las instituciones de salud. Nuestro compromiso es proporcionar un servicio accesible y eficiente que apoye tanto a los profesionales de la salud como a los pacientes.
            </p>
        </div>
    </div>

    <!-- Sección: Visión y Misión -->
    <div class="row my-4">
        <div class="col-md-6">
            <h3>Visión</h3>
            <p>
                Ser la plataforma líder en gestión hospitalaria en Nicaragua, ofreciendo soluciones innovadoras que mejoren la calidad de atención médica y promuevan la salud integral de la población.
            </p>
        </div>
        <div class="col-md-6">
            <h3>Misión</h3>
            <p>
                Proporcionar un sistema integral que facilite la administración de expedientes, citas médicas y análisis de datos, empoderando a los profesionales de la salud para tomar decisiones informadas y rápidas en beneficio de sus pacientes.
            </p>
        </div>
    </div>

    <!-- Sección: Problemas y Soluciones -->
    <div class="row my-4">
        <div class="col-md-6">
            <h3>Problemas que analizamos</h3>
            <ul>
                <li>Dificultades en el acceso y manejo de expedientes médicos.</li>
                <li>Falta de seguimiento en citas médicas.</li>
                <li>Desconocimiento de la salud de los pacientes debido a la falta de análisis de datos.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Soluciones que damos</h3>
            <ul>
                <li>Gestión eficiente de expedientes médicos con acceso en tiempo real.</li>
                <li>Recordatorios automáticos de citas para pacientes y médicos.</li>
                <li>Análisis de datos mediante inteligencia artificial para mejorar la toma de decisiones clínicas.</li>
            </ul>
        </div>
    </div>

    <!-- Sección: Confiabilidad -->
    <div class="row my-4">
        <div class="col-md-12">
            <h3>Confiabilidad</h3>
            <p>
                En MEDFILE, garantizamos la seguridad y privacidad de la información médica de nuestros usuarios. Cumplimos con los estándares de protección de datos y trabajamos continuamente en mejorar nuestras tecnologías para asegurar que cada consulta y cada expediente esté protegido. Con nosotros, puedes confiar en que tu información está en buenas manos.
            </p>
        </div>
    </div>
    
    <!-- Sección: Escalabilidad de MEDFILE -->
    <div class="row my-4">
        <div class="col-md-12">
            <h3>Escalabilidad de MEDFILE</h3>
            <p>
                MEDFILE está diseñado para crecer junto con las necesidades de los centros de salud en Nicaragua. Nuestra arquitectura permite integrar nuevos módulos y funcionalidades a medida que surgen nuevas exigencias en el sector salud, asegurando que nuestros usuarios siempre cuenten con herramientas actualizadas y eficaces para su gestión.
            </p>
        </div>
    </div>
</section>

    
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