<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
       {{--  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> 
        
        
         <div class="card">
            <div class="card-body bt-secunadrio">
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <i class="fa-sharp fa-solid fa-notes-medical fa-2x mb-1"></i>
                        <div>Notas Médicas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-flask fa-2x mb-1"></i>
                        <div>Laboratorio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-user-nurse fa-2x mb-1"></i>
                        <div>Enfermera</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-vials fa-2x mb-1"></i>
                        <div>Viales</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-users-medical fa-2x mb-1"></i>
                        <div>Equipo Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-x-ray fa-2x mb-1"></i>
                        <div>Rayos X</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-wheelchair-move fa-2x mb-1"></i>
                        <div>Wheelchair</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-weight-scale fa-2x mb-1"></i>
                        <div>Balanza</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-wave-pulse fa-2x mb-1"></i>
                        <div>Frecuencia</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-vial-circle-check fa-2x mb-1"></i>
                        <div>Pruebas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-thermometer fa-2x mb-1"></i>
                        <div>Termómetro</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-syringe fa-2x mb-1"></i>
                        <div>Jeringa</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-suitcase-medical fa-2x mb-1"></i>
                        <div>Kit Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-stretcher fa-2x mb-1"></i>
                        <div>Camilla</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-staff-snake fa-2x mb-1"></i>
                        <div>Esculapio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-prescription-bottle-medical fa-2x mb-1"></i>
                        <div>Recetas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-pills fa-2x mb-1"></i>
                        <div>Medicamentos</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-microscope fa-2x mb-1"></i>
                        <div>Microscopio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-house-medical-circle-check fa-2x mb-1"></i>
                        <div>Centro Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-hospital-user fa-2x mb-1"></i>
                        <div>Paciente</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-heart-pulse fa-2x mb-1"></i>
                        <div>Cardiología</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-folder-medical fa-2x mb-1"></i>
                        <div>Historia Clínica</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-comment-medical fa-2x mb-1"></i>
                        <div>Consulta</div>
                    </div>
                </div>
            </div>
              <br>
            
            
       </div>--}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
    <!-- Antes de cerrar el body -->
<script src="{{ asset('js/sweetalert2.js') }}"></script>

</body>
</html>
