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
    <div class="col">
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
            <ol id="breadcrumb" class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Hogar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row">
    <div class="col-lg-6" data-aos="fade-up">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Información Personal</h5>

                <!-- Mostrar la foto del paciente si tiene, si no un ícono por defecto -->
                <div class="text-center mb-4">
                    @if($paciente->foto)
                        <img src="{{ asset('images/' . $paciente->foto) }}" alt="Foto de Paciente" class="rounded-circle" width="150">
                    @else
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    @endif
                </div>

                <p><strong>Nombre:</strong> {{ $paciente->primer_nombre }}</p>
                <p><strong>Segundo Nombre:</strong> {{ $paciente->segundo_nombre }}</p>
                <p><strong>Apellido:</strong> {{ $paciente->primer_apellido }}</p>
                <p><strong>Segundo Apellido:</strong> {{ $paciente->segundo_apellido }}</p>
                <p><strong>No. Expediente:</strong> {{ $paciente->no_expediente }}</p>
                <p><strong>Email:</strong> {{ $paciente->correo }}</p>
                <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                <p><strong>Edad:</strong> {{ $paciente->edad }}</p>
                <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                <p><strong>Estado Civil:</strong> {{ $paciente->estado_civil }}</p>
                <p><strong>Ocupación:</strong> {{ $paciente->ocupacion }}</p>

                <!-- Agrega más campos según sea necesario -->

                <a href="{{ route('pacientes.logout') }}" class="btn btn-danger">Cerrar Sesión</a>
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