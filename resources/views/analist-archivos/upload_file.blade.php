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
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
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

    @section('title', 'file')
    
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
       
  
        <div class="container ">
            <div class="row">
                <div class="col-lg-7">
                    <h2>Subir Archivo para Análisis</h2>
                </div>
                <div class="col-lg-5 position-relative ">
                    <button id="helpButton" class="btn btn-info text-right ml-5">Ayuda</button>
                
                    <!-- Card de Ayuda -->
                    <div id="helpCard" class="card mt-3" style="display: none; position: absolute; top: 50px; left: 0; z-index: 1000;">
                        <div class="card-body text-center">
                           
                            <div class="d-flex justify-content-around  d-flex justify-content-center flex-wrap">
                                <button class="btn btn-secondary mr-1" data-bs-toggle="modal" data-bs-target="#ayudaModal">
                                    <i class="fas fa-question-circle"></i> Ayuda
                                </button>
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#usoCorrectoModal">
                                    <i class="fas fa-info-circle"></i> Uso Correcto
                                </button>
                                <button class="btn btn-secondary ml-1" data-bs-toggle="modal" data-bs-target="#limitacionesModal">
                                    <i class="fas fa-exclamation-triangle"></i> Limitaciones
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        

          <!-- Formulario de carga de archivos -->
<form id="uploadForm" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
    @csrf
    <div class="form-group mb-3">
        <label for="file" class="form-label">
            <i class="fas fa-file-upload"></i> Selecciona un archivo: 
            <strong class="text-danger fs-6"> (pdf, docx, xlsx, xls)</strong>
        </label>
        <input type="file" name="file" id="file" required class="form-control" accept=".pdf,.docx,.xlsx,.xls">
    </div>
    <div class="form-group mb-3">
        <label for="purpose" class="form-label">
            <i class="fas fa-pencil-alt"></i> Propósito:
        </label>
        <input type="text" name="purpose" id="purpose" required class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-upload"></i> Subir archivo
    </button>
</form>

<div id="result" class="mt-4"></div>

<!-- Spinner HTML -->
<div id="loadingSpinner" class="text-center" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="text-dark">Analizando...</p>
</div>
            
        </div>
    
            
        <div class="modal fade" id="ayudaModal" tabindex="-1" aria-labelledby="ayudaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ayudaModalLabel">Ayuda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>¿Cómo se envía el archivo?</h6>
                        <p class=" text-dark">
                            Para enviar un archivo, selecciona el archivo que deseas cargar desde tu dispositivo y haz clic en el botón "Subir archivo".
                        </p>
                        <h6>Tipos de archivos permitidos:</h6>
                        <ul>
                            <li>PDF (.pdf)</li>
                            <li>Word Document (.docx)</li>
                            <li>Excel (.xlsx, .xls)</li>
                        </ul>
                        <h6>Tamaño máximo del archivo:</h6>
                        <p class=" text-dark">
                            El tamaño máximo permitido para cada archivo es de 512 MB.
                        </p>
                        <h6>Respuesta esperada:</h6>
                        <p class=" text-dark">
                            Una vez que el archivo haya sido procesado, recibirás un análisis del contenido del archivo junto con el nombre y la ubicación del archivo cargado.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
<!-- Modal Uso Correcto -->
<div class="modal fade" id="usoCorrectoModal" tabindex="-1" aria-labelledby="usoCorrectoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usoCorrectoModalLabel">Uso Correcto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Información sobre el Uso Correcto del Sistema</h6>
                <p class=" text-dark">
                    Para garantizar el uso efectivo de este sistema y maximizar sus beneficios en la gestión de registros médicos, siga las siguientes recomendaciones:
                </p>
                <ul>
                    <li><strong>Entrada de Datos:</strong> Asegúrese de que todos los datos ingresados sean precisos y completos. Esto mejorará la calidad de los análisis generados.</li>
                    <li><strong>Formato de Archivos:</strong> Utilice los formatos de archivo permitidos (PDF, DOCX, XLSX, XLS) para asegurar una carga y procesamiento adecuados.</li>
                    <li><strong>Capacitación:</strong> Proporcione capacitación a los usuarios sobre cómo utilizar todas las funciones del sistema para evitar errores y aprovechar al máximo sus capacidades.</li>
                    <li><strong>Revisión de Resultados:</strong> Revise siempre los resultados y análisis generados por el sistema en conjunto con un profesional de la salud para asegurar diagnósticos y decisiones informadas.</li>
                    <li><strong>Actualización Regular:</strong> Mantenga el sistema y los datos actualizados para beneficiarse de las últimas mejoras y funcionalidades.</li>
                </ul>
                <p class=" text-dark">
                    Siguiendo estas pautas, contribuirá al éxito del sistema y mejorará la atención al paciente.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Limitaciones -->
<!-- Modal Limitaciones -->
<div class="modal fade" id="limitacionesModal" tabindex="-1" aria-labelledby="limitacionesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="limitacionesModalLabel">Limitaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Limitaciones del Sistema</h6>
                <p class=" text-dark">
                    Aunque el sistema está diseñado para proporcionar un análisis eficaz y útil de los datos médicos, existen algunas consideraciones que los usuarios deben tener en cuenta:
                </p>
                <ul>
                    <li><strong>Dependencia de la API:</strong> El sistema utiliza la API de OpenAI para realizar análisis avanzados. Aunque es un servicio robusto, su disponibilidad puede influir en el tiempo de respuesta.</li>
                    <li><strong>Calidad de los Datos de Entrada:</strong> La precisión de los resultados puede verse afectada por la calidad de los datos ingresados. Se recomienda proporcionar información completa y precisa para obtener los mejores resultados.</li>
                    <li><strong>Contexto Médico:</strong> Si bien el sistema es capaz de procesar información compleja, los usuarios deben tener en cuenta que las recomendaciones deben ser complementadas con el juicio clínico de los profesionales de la salud.</li>
                    <li><strong>Capacidad de Procesamiento:</strong> Hay límites en la cantidad de información que se puede procesar a la vez. Para un análisis más detallado, se puede dividir la información en partes más pequeñas.</li>
                </ul>
                <p class=" text-dark">
                    A pesar de estas consideraciones, el sistema se ha desarrollado con el objetivo de proporcionar un apoyo significativo en la toma de decisiones médicas, mejorando la calidad del servicio ofrecido a los pacientes. Siempre se recomienda la colaboración con profesionales de la salud para obtener el máximo beneficio de los resultados generados.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


    </div>
    @endsection
    
    @section('css')
       <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
       <style>
        .form-control {
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    
        .btn-primary {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
    
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    
        .spinner-border {
            animation: spin 1s linear infinite;
        }
    
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
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
$(document).ready(function() {
    $('#uploadForm').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario
        
        // Mostrar el spinner
        $('#loadingSpinner').show();

        // Crear un FormData para enviar el archivo
        var formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}'); // Agregar token CSRF

        $.ajax({
            url: '/upload-file',
            type: 'POST',
            data: formData,
            contentType: false, // Dejar que jQuery maneje el tipo de contenido
            processData: false, // Evitar que jQuery procese los datos
            success: function(response) {
                // Mostrar la respuesta en el div #result
                $('#result').html(`
                    <h5>Análisis Resultante:</h5>
                    <p class="text-dark"><strong>Archivo:</strong> ${response.filename}</p>
                    <p class="text-dark"><strong>Análisis:</strong> ${response.analysis}</p>
                `);

                // Limpiar el formulario
                $('#uploadForm')[0].reset();
            },
            error: function(xhr) {
                // Manejo de errores con SweetAlert
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Ocurrió un error al subir el archivo.';
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });
            },
            complete: function() {
                // Ocultar el spinner después de completar la solicitud
                $('#loadingSpinner').hide();
            }
        });
    });
});

    </script>
    
    <script>
        document.getElementById('helpButton').addEventListener('click', function() {
    var helpCard = document.getElementById('helpCard');
    if (helpCard.style.display === "none" || helpCard.style.display === "") {
        helpCard.style.display = "block";
    } else {
        helpCard.style.display = "none";
    }
});

    </script>
    
    @endsection
    
</body>
</html>

 




