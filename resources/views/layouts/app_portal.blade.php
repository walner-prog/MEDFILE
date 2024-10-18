<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ asset('assets/img/logo-sin-fondo.png') }}" type="image/png">

    <!-- AOS CSS -->


    @livewireStyles
    <link href="{{ asset('css/pacientes.css') }}" rel="stylesheet"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body id="app">
    @include('layouts.navbar')

    <div class=" mt-5">
        <br>
        @yield('content')
    </div>
  <!-- Incluir el footer solo si no se desactiva -->
  @if (!isset($hideFooter) || !$hideFooter)
      @include('layouts.footer')
  @endif


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    @livewireScripts
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
          document.addEventListener('DOMContentLoaded', function () {
        loadTheme(); // Cargar el tema guardado al iniciar la página
    });

    // Función para alternar entre temas
    function toggleTheme() {
        const body = document.getElementById('app');
        const themeIcon = document.getElementById('theme-icon');
        const isDarkTheme = body.classList.contains('dark-theme');

        // Alternar clases de tema
        if (isDarkTheme) {
            body.classList.remove('dark-theme');
            body.classList.add('light-theme');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.remove('light-theme');
            body.classList.add('dark-theme');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Función para cargar el tema desde localStorage
    function loadTheme() {
        const savedTheme = localStorage.getItem('theme');
        const body = document.getElementById('app');
        const themeIcon = document.getElementById('theme-icon');

        if (savedTheme === 'dark') {
            body.classList.add('dark-theme');
            body.classList.remove('light-theme');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        } else {
            body.classList.add('light-theme');
            body.classList.remove('dark-theme');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }
    }



   
    </script>
    

</body>

</html>
