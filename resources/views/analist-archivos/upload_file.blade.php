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
    
        <div class="container mt-5">
            <h2>Subir Archivo para Análisis</h2>
            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Selecciona un archivo: <strong class=" text-danger fs-1"> pdf,docx,xlsx,xls</strong> </label>
                    <input type="file" name="file" id="file" required class="form-control" accept=".pdf,.docx,.xlsx,.xls">
                </div>
                <div class="form-group">
                    <label for="purpose">Propósito:</label>
                    <input type="text" name="purpose" id="purpose" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Subir archivo</button>
            </form>
            
    
            <div id="result" class="mt-4"></div>
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
$(document).ready(function() {
    $('#uploadForm').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario
        
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
            }
        });
    });
});

    </script>
    
    
    
    @endsection
    
</body>
</html>

 




