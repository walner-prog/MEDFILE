@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

@section('content')
<div class="container">

    <style id="default-styles">
        strong, .font-weight-bold {
            color: #002939  !important;
        }
    </style>
    
    <style id="custom-styles" disabled>
        strong, .font-weight-bold {
            color: white !important;
        }
        span, .col-sm-8 {
            color: rgb(196, 196, 196) !important;
        }
        .card-body {
            background-color: #002939 !important;
        }
    </style>
    
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4><i class="fa-solid fa-calendar fa-2x mb-1 mr-2"></i> Información del Horario</h4>
            </div>
            <div class="card-body">
                <div class="row mb-2 p-2 border border-1 border-info">
                    <div class="col-md-6">
                        <h5 class="text-white">Detalles del Horario</h5>
    
                        <!-- Mostrar información básica del horario -->
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Día de la Semana:</div>
                            <div class="col-sm-8">{{ ucfirst($horario->dia_semana) }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Hora de Inicio:</div>
                            <div class="col-sm-8">{{ $horario->hora_inicio }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Hora de Fin:</div>
                            <div class="col-sm-8">{{ $horario->hora_fin }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Duración de la Cita (min):</div>
                            <div class="col-sm-8">{{ $horario->duracion_cita }} minutos</div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <h5 class="text-white">Doctor y Consultorio</h5>
    
                        <!-- Información del doctor -->
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Doctor:</div>
                            <div class="col-sm-8">
                                {{ $horario->doctor->primer_nombre }} {{ $horario->doctor->segundo_nombre }} 
                                {{ $horario->doctor->primer_apellido }} {{ $horario->doctor->segundo_apellido }} 
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Especialidad:</div>
                            <div class="col-sm-8">{{ $horario->doctor->especialidad->nombre }}</div>
                        </div>
    
                        <!-- Información del consultorio -->
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Consultorio:</div>
                            <div class="col-sm-8">{{ $horario->consultorio->nombre }} <br>   Ubicacion : <span class=" text-muted">({{ $horario->consultorio->ubicacion }})</span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Capacidad:</div>
                            <div class="col-sm-8">{{ $horario->consultorio->capacidad }} personas</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Teléfono Consultorio:</div>
                            <div class="col-sm-8">{{ $horario->consultorio->telefono }}</div>
                        </div>
                    </div>
                </div>
    
                <!-- Botón para regresar a la lista de horarios -->
                <div class="mt-3">
                    <a href="{{ route('horarios-doctor.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Regresar a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
