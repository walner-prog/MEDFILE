<div id="app">
    <div class="bg-navbar">
        <div class="container navbar">
            <nav class="navbar fixed-top bg-navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ url('/medfile-pacientes') }}">
                    <img src="{{ asset('assets/img/logo-sin-fondo.png') }}" alt="Logo" class="logo img-fluid">
                </a>
                <button class="navbar-toggler bt-cyan" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon boton-nav"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-between w-100">
                        <li class="nav-item flex-grow-1 text-center">
                            <a class="nav-link" href="{{ url('/agendar-cita') }}">Agendar Cita</a>
                        </li>
                        <li class="nav-item flex-grow-1 text-center">
                            <a class="nav-link" href="{{ url('/citas-agendadas') }}">Citas Agendadas</a>
                        </li>
                        <li class="nav-item flex-grow-1 text-center">
                            <a class="nav-link" href="{{ url('/historial-citas') }}">Historial Citas</a>
                        </li>
                        <li class="nav-item flex-grow-1 text-center">
                            <a class="nav-link" href="{{ url('/notificaciones-pendientes') }}">Notificaciones Pendientes</a>
                        </li>
                        <li class="nav-item flex-grow-1 text-center">
                            <a class="nav-link" href="{{ url('/medfile-pacientes/quienes-somos') }}">Quienes Somos</a>
                        </li>

                        <div class="theme-toggle" onclick="toggleTheme()">
                            <i id="theme-icon" class="fas fa-sun"></i> <!-- Icono del tema -->
                        </div>

                        <div class="nav-item flex-grow-1 text-center mt-2 position-relative">
                            <i class="fas fa-bell" style="font-size: 24px; cursor: pointer;"></i>
                            <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle mr-5">3</span> <!-- Ejemplo de notificaciones -->
                        </div>


                        <!-- Mensajes -->
                        <div class="nav-item flex-grow-1 text-center mt-2 position-relative">
                            <i class="fas fa-envelope" style="font-size: 24px; cursor: pointer;"></i>
                            <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle">5</span> <!-- Ejemplo de mensajes -->
                        </div>

                        @if(Auth::guard('paciente')->check())
                        <div class="nav-item flex-grow-1 text-center mt-1 dropdown">
                            @if(Auth::guard('paciente')->user()->foto)
                                <!-- Mostrar la foto del paciente si tiene -->
                                <img src="{{ asset('images/' . Auth::guard('paciente')->user()->foto) }}" width="50" height="50" class="img-fluid rounded-circle" alt="Imagen de usuario" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            @else
                                <!-- Mostrar ícono de usuario si no tiene foto -->
                                <i class="fas fa-user-circle fa-3x" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                            @endif
                            
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.paciente') }}">Perfil</a></li>
                                <li>
                                    <!-- Formulario para cerrar sesión -->
                                    <form action="{{ route('pacientes.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                            
                        </div>
                    @else
                        <!-- Mostrar botón de inicio de sesión si no ha iniciado sesión -->
                        <li class="nav-item flex-grow-1 text-center mt-1">
                            <a class="nav-link" href="{{ route('pacientes.login') }}">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                    @endif
                    
                    
                    

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    
</div>
