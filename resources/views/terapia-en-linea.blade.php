<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')

@section('content')
@if(session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif
<div class="container mt-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-primary">Terapia en Línea</h1>
      <button class="btn btn-outline-primary">Ver Historial de Terapias</button>
    </div>
  
    <!-- Card de información del terapeuta -->
    <div class="card mb-4">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="doctor-profile.jpg" alt="Foto del Terapeuta" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Dr. Juan Pérez</h5>
            <p class="card-text">Especialista en Psicología Clínica</p>
            <p class="card-text"><small class="text-muted">5 años de experiencia en terapias online</small></p>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Agendar nueva sesión -->
    <div class="card p-4 mb-4">
      <h3>Agendar una Nueva Sesión</h3>
      <form action="/agendar-terapia" method="POST">
        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha de la sesión</label>
          <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
          <label for="hora" class="form-label">Hora de la sesión</label>
          <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <div class="mb-3">
          <label for="tipo" class="form-label">Tipo de terapia</label>
          <select class="form-control" id="tipo" name="tipo" required>
            <option value="psicologica">Psicológica</option>
            <option value="fisioterapia">Fisioterapia</option>
            <option value="nutricional">Nutricional</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Agendar Sesión</button>
      </form>
    </div>
  
    <!-- Próxima sesión -->
    <div class="card p-4 mb-4">
      <h3>Tu Próxima Sesión</h3>
      <p><strong>Fecha:</strong> 20 de Octubre, 2024</p>
      <p><strong>Hora:</strong> 15:00 (Hora local)</p>
      <button class="btn btn-success">Unirse a la Sesión</button>
    </div>
  
    <!-- Historial de terapias pasadas -->
    <div class="card p-4">
      <h3>Historial de Terapias</h3>
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Sesión de Psicología - 10 Octubre 2024
          <span class="badge bg-primary w-100">Completada</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Sesión de Fisioterapia - 25 Septiembre 2024
          <span class="badge bg-primary w-100">Completada</span>
        </li>
        <!-- Más registros -->
      </ul>
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