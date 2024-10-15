@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

@section('content')
<div class="container" >
   
    
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
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fa-solid fa-calendar-check fa-2x mb-1 mr-2"></i> Detalle de la Cita del Paciente</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información de la Cita</h5>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Nombres y Apellidos: </strong> 
                                    <span>{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->segundo_nombre }} {{ $cita->paciente->primer_apellido }}  {{ $cita->paciente->segundo_apellido }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Expediente:</strong> 
                                    <span>{{ $cita->paciente->no_expediente }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Fecha de la Cita:</strong> 
                                    <span>{{ $cita->fecha_cita }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Hora de la Cita:</strong> 
                                    <span>{{ $cita->hora_cita }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Doctor Asignado:</strong> 
                                    <span>{{ $cita->doctor->primer_nombre }} {{ $cita->doctor->primer_apellido }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Especialidad:</strong> 
                                    <span>{{ $cita->doctor->especialidad->nombre }}</span> 
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Tipo de Cita:</div>
                                <div class="col-sm-8">{{ $cita->tipo_cita ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Estado de la Cita:</div>
                                <div class="col-sm-8">{{ $cita->estado ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Notas:</div>
                                <div class="col-sm-8">{{ $cita->notas ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Establecimiento de Salud:</div>
                                <div class="col-sm-8">{{ $cita->paciente->establecimiento_salud ?? 'No disponible' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
 
</div>
@endsection
