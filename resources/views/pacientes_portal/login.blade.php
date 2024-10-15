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

    <div class="row">
        <div class="col-lg-6" data-aos="fade-up">
       
            <img src="{{ asset('assets/img/logo-sin-fondo.png') }}" class="img-fluid"alt="Imagen 1">
        </div>
        <div class="col-lg-6 mb-5">
            <div class="agendar-cita" data-aos="fade-up">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
    
                <!-- Formulario de inicio de sesión -->
                <form action="{{ route('pacientes.login') }}" method="POST" class="needs-validation">
                    @csrf
                    <div class="form-group" data-aos="fade-up">
                        <label for="no_expediente">
                            <i class="fas fa-file-alt"></i> Número de Expediente:
                        </label>
                        <input
                            type="text"
                            name="no_expediente"
                            id="no_expediente"
                            class="form-control"
                            required
                            value="{{ old('no_expediente') }}"
                        />
                        @error('no_expediente')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
    
                    <div class="form-group mt-3" data-aos="fade-up">
                        <label for="password">
                            <i class="fas fa-lock"></i> Contraseña:
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required
                        />
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
    
                    <!-- Botón de Iniciar Sesión -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
    
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