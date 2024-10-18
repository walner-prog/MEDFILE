<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/logo-sin-fondo.png') }}" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MEDFILE') }}</title>
    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('storage/logo-sin-fondo.png') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
<!-- Dentro del head -->
<script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Dentro del head -->
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <!-- CSS de AdminLTE -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

  
</head>
<body>
    <div id="app">
       

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
    <!-- Antes de cerrar el body -->
<script src="{{ asset('js/sweetalert2.js') }}"></script>

</body>
</html>
