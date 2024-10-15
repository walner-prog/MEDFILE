<!DOCTYPE html>
<html lang="en">
 <head>
    
      <!-- Agrega esto en la sección head de tu HTML -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
           <!-- Otros encabezados -->
 
 @section('css')
  
   
   @livewireStyles
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
 <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop
   <!-- Otros elementos del encabezado... -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
 
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
    <div class="container mt-4 mb-5 toggle-container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol id="breadcrumb" class="breadcrumb mb-0 text-light">
                        <li class="breadcrumb-item">Hogar</li>
                        <li class="breadcrumb-item active" aria-current="page">Registro de Historias Clínicas</li>
                    </ol>
                </nav>
            </div>
        </div>
    
        <h3>Análisis y Recomendaciones usando IA de (MEDFILE)</h3>
    
        <h4>Datos del Paciente</h4>
        <div class="row mb-3 ia-row p-1">
            <div class="col-md-3">
                <p class="text-dark"><strong>N° Expediente:</strong> {{ $historiaClinica->paciente->no_expediente }}</p>
            </div>
            <div class="col-md-4 col-lg-5">
                <p class="text-dark"><strong>Nombres y Apellidos:</strong>
                    {{ $historiaClinica->paciente->primer_nombre }}
                    {{ $historiaClinica->paciente->segundo_nombre }}
                    {{ $historiaClinica->paciente->primer_apellido }}
                    {{ $historiaClinica->paciente->segundo_apellido }}
                </p>
            </div>
    
            <div class="col-md-4 col-lg-3">
                <p class="text-dark"><strong>Cédula:</strong> {{ $historiaClinica->paciente->no_cedula }}</p>
            </div>
    
            <div class="col-md-4 col-lg-1">
                <p class="text-dark"><strong>Edad:</strong> {{ $historiaClinica->paciente->edad }}</p>
            </div>
        </div>
    
        <h4>Detalles de la Historia Clínica</h4>
        <p class="text-dark"><strong>Motivo de Consulta:</strong> {{ $historiaClinica->motivo_consulta }}</p>
        <p class="text-dark"><strong>Historia de Enfermedad Actual:</strong> {{ $historiaClinica->historia_enfermedad_actual }}</p>
        <p class="text-dark"><strong>Diagnósticos:</strong> {{ $historiaClinica->diagnosticos_problemas }}</p>
    
        <!-- Botón para iniciar el análisis -->
        <button id="btn-analizar" class="btn btn-primary">Analizar Historia Clínica</button>
    
        <div id="spinner" style="display: none;">
            <p class=" text-muted">Analizando los datos...</p>
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        
        <!-- Espacio para mostrar los resultados -->
        <div id="resultados" style="display: none; margin-top: 20px;">
            <h3 id="titulo-resumen" class="text-dark">Resumen:</h3>
            <p class="text-dark" id="resumen"></p>
        
            <h3 id="titulo-recomendaciones" class="text-dark">Recomendaciones:</h3>
            <p class="text-dark" id="recomendaciones"></p>
        
            <h3 id="titulo-patrones" class="text-dark">Patrones detectados:</h3>
            <ul class="text-dark" id="patrones"></ul> <!-- Sección para patrones -->
        
            <h3 id="titulo-anomalias" class="text-dark">Anomalías detectadas:</h3>
            <ul class="text-dark" id="anomalías"></ul> <!-- Sección para anomalías -->
        </div>
        
    </div>
    @endsection
    
    @section('css')
       <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    @endsection
    
    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
    
    <!-- JS de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script src="{{ asset('js/custom.js') }}"></script>
    
    <script>
      document.getElementById('btn-analizar').addEventListener('click', function() {
    // Mostrar el spinner
    document.getElementById('spinner').style.display = 'block';
    
    // Ocultar los resultados mientras se cargan los nuevos datos
    document.getElementById('resultados').style.display = 'none';

    var historiaId = {{ $historiaClinica->id }};  // ID de la historia clínica

    // Realiza la solicitud AJAX para analizar la historia clínica
    fetch(`/historia-clinica/analizar/${historiaId}`)
        .then(response => response.json())
        .then(data => {
            // Ocultar el spinner
            document.getElementById('spinner').style.display = 'none';

            // Mostrar los resultados una vez que los datos se hayan cargado
            document.getElementById('resultados').style.display = 'block';

            // Mostrar los títulos
            document.getElementById('titulo-resumen').style.display = 'block';
            document.getElementById('titulo-recomendaciones').style.display = 'block';
            document.getElementById('titulo-patrones').style.display = 'block';
            document.getElementById('titulo-anomalias').style.display = 'block';

            // Mostrar los resultados en la página
            document.getElementById('resumen').innerText = data.resumen;
            document.getElementById('recomendaciones').innerText = data.recomendaciones;

            // Limpiar las listas de patrones y anomalías antes de rellenar
            const patronesList = document.getElementById('patrones');
            patronesList.innerHTML = ''; // Limpiar contenido anterior
            data.patrones.forEach(patron => {
                const li = document.createElement('li');
                li.innerText = patron.mensaje; // Mostrar mensaje de patrón
                patronesList.appendChild(li);
            });

            const anomaliasList = document.getElementById('anomalías');
            anomaliasList.innerHTML = ''; // Limpiar contenido anterior
            data.anomalías.forEach(anomalia => {
                const li = document.createElement('li');
                li.innerText = anomalia.mensaje; // Mostrar mensaje de anomalía
                anomaliasList.appendChild(li);
            });
        })
        .catch(error => {
            // Ocultar el spinner en caso de error
            document.getElementById('spinner').style.display = 'none';
            console.error('Error al analizar la historia clínica:', error);
        });
});

    </script>
    @endsection
    
</body>
</html>

 




