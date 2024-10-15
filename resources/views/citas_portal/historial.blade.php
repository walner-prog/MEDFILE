<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')

@section('content')
 
<div class="container">
    
  
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if (session('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
@endif
@if (session('delete'))
    <div class="alert alert-warning">{{ session('delete') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
            <ol id="breadcrumb" class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Hogar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Historial de citas</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row">
    <div class="col-lg-12" data-aos="fade-up">
        <div class="card">
            <div class="card-body">
                <h1>Mis Citas</h1>
                <div class=" table-responsive">
                @if($citas->isEmpty())
                    <div class="alert alert-info">
                        No tienes citas agendadas.
                    </div>
                @else
              

              
            <table id="citasTable" class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-4 table-striped">
                    <thead class="from-green-500 to-green-600 text-white">
                            <tr>
                                <th class="primario"><i class="fas fa-calendar-day"></i> Fecha</th>
                                <th class="primario"><i class="fas fa-clock"></i> Hora</th>
                                <th class="primario"><i class="fas fa-user-md"></i> Doctor</th>
                                <th class="primario"><i class="fas fa-user"></i> Paciente</th>
                                <th class="primario"><i class="fas fa-file-medical"></i> Tipo de Cita</th>
                                <th class="primario"><i class="fas fa-flag"></i> Estado</th>
                                <th class="primario"><i class="fas fa-flag"></i> Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citas as $cita)
                            <tr @click="abrirModal({{ $cita->id }})">
                                <td>{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}</td>
                                <td>{{ $cita->doctor->primer_nombre ?? 'No asignado' }} {{ $cita->doctor->primer_apellido ?? 'No asignado' }}</td>
                                <td>{{ $cita->paciente->primer_nombre ?? 'No asignado' }} {{ $cita->paciente->primer_apellido ?? 'No asignado' }}</</td>
                                <td>{{ $cita->tipo_cita ?? 'Sin tipo' }}</td>
                                <td>
                                    <span class="badgee {{ $cita->fecha_cita < \Carbon\Carbon::now() ? 'badge-success' : 'badge-warning' }}">
                                        {{ $cita->fecha_cita < \Carbon\Carbon::now() ? 'Completada' : 'Pendiente' }}
                                    </span>
                                </td>
                                
                            </tr>
                        @endforeach
                        
                        </tbody>
            </table>
                @endif
            </div>
             </div>

             <!-- Estadísticas de Citas -->
<div class="mt-4" data-aos="fade-up" data-aos-duration="500">
    <h3 class="mb-3 text-left">Estadísticas de Citas</h3>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Resumen de Citas</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="alert alert-info text-center">
                        <h4 class="mb-0 text-muted">{{ $citas->count() }}</h4>
                        <p class="mb-0 ">Total de citas</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert alert-warning text-center">
                        <h4 class="mb-0 text-muted">
                            {{ $citas->filter(fn($cita) => $cita->fecha_cita >= \Carbon\Carbon::now())->count() }}
                        </h4>
                        <p class="mb-0 ">Citas pendientes</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert alert-success text-center">
                        <h4 class="mb-0 text-muted">
                            {{ $citas->filter(fn($cita) => $cita->fecha_cita < \Carbon\Carbon::now())->count() }}
                        </h4>
                        <p class="mb-0 ">Citas completadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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