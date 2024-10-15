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
                <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row">
    <div class="col-lg-12" data-aos="fade-up">
        <div class="card">
            <div class="card-body">
                <h1>Mis Citas</h1>
        
                <div class="container mt-5">
                    <h4 class="mb-4 text-left">Notificaciones Pendientes</h4>
        
                    @if ($notificaciones->isNotEmpty())
                    <div class="list-group">
                        @foreach ($notificaciones as $notificacion)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1 text-success text-left">Recordatorio de Cita</h5>
                                    <p class="mb-1 text-left">
                                        Tienes una cita con el Dr. {{ $notificacion->doctor->primer_nombre }} {{ $notificacion->doctor->primer_apellido }} 
                                        el {{ \Carbon\Carbon::parse($notificacion->fecha_cita)->translatedFormat('d \d\e F \d\e Y') }} 
                                        a las {{ $notificacion->hora_cita }}.
                                    </p>
                                    <small class="text-muted text-left">Fecha: {{ \Carbon\Carbon::parse($notificacion->fecha_cita)->translatedFormat('d \d\e F \d\e Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="alert alert-success">
                            No tienes notificaciones pendientes.
                        </div>
                    @endif
        
                    <h2>Historial de Notificaciones</h2>
        
                    <table id="citasTable" class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-4 table-striped">
                        <thead class="from-green-500 to-green-600 text-white">
                            <tr>
                                <th class="primario"><i class="fas fa-calendar-day"></i> Fecha</th>
                                <th class="primario"><i class="fas fa-clock"></i> Hora</th>
                                <th class="primario"><i class="fas fa-user-md"></i> Doctor</th>
                                <th class="primario"><i class="fas fa-user"></i> Paciente</th>
                                <th class="primario"><i class="fas fa-file-medical"></i> Tipo de Cita</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historialNotificaciones as $historia)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($historia->fecha_cita)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($historia->hora_cita)->format('H:i') }}</td>
                                    <td>{{ $historia->doctor->primer_nombre }} {{ $historia->doctor->primer_apellido }}</td>
                                    <td>{{ $historia->paciente->primer_nombre }} {{ $historia->paciente->primer_apellido }}</td>
                                    <td>{{ $historia->tipo_cita ?? 'Sin tipo' }}</td>
                                    <td>
                                        <span class="badge {{ $historia->fecha_cita < \Carbon\Carbon::now() ? 'badge-success' : 'badge-warning' }}">
                                            {{ $historia->fecha_cita < \Carbon\Carbon::now() ? 'Completada' : 'Pendiente' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="mb-4 text-left">Recordatorios de Medicamentos</h4>
                            <div class="table-responsive" data-aos="fade-up" data-aos-duration="500">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="primario text-white">Medicamento</th>
                                            <th scope="col" class="primario text-white">Dosis</th>
                                            <th scope="col" class="primario text-white">Frecuencia</th>
                                            <th scope="col" class="primario text-white">Fecha</th>
                                            <th scope="col" class="primario text-white">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Aquí puedes agregar las filas para los recordatorios de medicamentos -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
                        <div class="col-lg-4"> 
                            <div class="mt-4 card mb-1 p-1">
                                <h5 class="mb-4 text-center mt-2">Agregar Recordatorio Personalizado</h5>
                              
                                    @csrf
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text"><i class="fas fa-pills"></i></span>
                                        <input type="text" name="medicamento" class="form-control" placeholder="Nombre del Medicamento" required />
                                    </div>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text"><i class="fas fa-syringe"></i></span>
                                        <input type="text" name="dosis" class="form-control" placeholder="Dosis" required />
                                    </div>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="text" name="frecuencia" class="form-control" placeholder="Ej. Cada 8 horas" required />
                                    </div>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" name="fecha" class="form-control" required />
                                    </div>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="time" name="hora" class="form-control" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Agregar Recordatorio</button>
                                </form>
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