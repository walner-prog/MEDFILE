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
            <h4><i class="fa-solid fa-pills fa-2x mb-1 mr-2"></i> Control de Medicamentos del Paciente</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información del Control de Medicamentos</h5>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Nombres y Apellidos: </strong> <span>{{ $controle->primer_nombre }} {{ $controle->segundo_nombre }} {{ $controle->primer_apellido }}  {{ $controle->segundo_apellido }} </span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Expediente:</strong> <span>{{ $controle->no_expediente }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Fecha:</strong> <span>{{ $controle->fecha }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Hora:</strong> <span>{{ $controle->hora }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Establecimiento de Salud:</strong> <span>{{ $controle->establecimiento_salud }}</span> 
                                </div>
                               
                                <div class="mr-4">
                                    <strong>No. Cédula:</strong> <span>{{ $controle->no_cedula }}</span> 
                                </div>
                               
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Medicamentos Otros:</div>
                                <div class="col-sm-8">{{ $controle->medicamentos_otros ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Fecha Medicamentos:</div>
                                <div class="col-sm-8">{{ $controle->fecha_medicamentos ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Hora Medicamentos:</div>
                                <div class="col-sm-8">{{ $controle->hora_medicamentos ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Medicamentos Stat PRN Preanestésico:</div>
                                <div class="col-sm-8">{{ $controle->medicamentos_stat_prn_preanestesico ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Hora Medicamentos Stat PRN:</div>
                                <div class="col-sm-8">{{ $controle->hora_medicamentos_stat_prn ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Fecha Medicamentos Stat PRN:</div>
                                <div class="col-sm-8">{{ $controle->fecha_medicamentos_stat_prn ?? 'No disponible' }}</div>
                            </div>
    
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre de la Enfermera y Código:</div>
                                <div class="col-sm-8">{{ $controle->nombre_enfermera_codigo ?? 'No disponible' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
 
</div>
@endsection
