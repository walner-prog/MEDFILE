@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
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
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fa-solid fa-notes-medical fa-2x mb-1 mr-2"></i> Informe de Condición Diaria del Paciente</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información del Informe</h5>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Fecha:</strong> <span>{{ $informe->fecha }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Servicio:</strong> <span>{{ $informe->servicio }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Sala:</strong> <span>{{ $informe->sala }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Expediente:</strong> <span>{{ $informe->no_expediente }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Fecha y Hora de la Condición:</strong> <span>{{ $informe->fecha_hora_condicion }}</span> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Tratamiento:</div>
                                <div class="col-sm-8">{{ $informe->tratamiento ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Procedimientos:</div>
                                <div class="col-sm-8">{{ $informe->procedimientos ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Brindada por:</div>
                                <div class="col-sm-8">{{ $informe->brindada_por ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Recibida por:</div>
                                <div class="col-sm-8">{{ $informe->recibida_por ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Firma de quien recibe:</div>
                                <div class="col-sm-8">{{ $informe->firma_quien_recibe ?? 'No disponible' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <strong class="text-primary"><i class="fa-solid fa-hospital-user"></i> Información del Paciente</strong>
                            <div class="row mt-3">
                                <div class="col-sm-4 font-weight-bold">Nombres y Apellidos:</div>
                                <div class="col-sm-8">{{ $informe->paciente->primer_nombre }} {{ $informe->paciente->segundo_nombre }} {{ $informe->paciente->primer_apellido }} {{ $informe->paciente->segundo_apellido }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Número de Cédula:</div>
                                <div class="col-sm-8">{{ $informe->paciente->no_cedula ?? 'No disponible' }}</div>
                            </div>
                            <!-- Agregar otros campos relevantes del paciente si es necesario -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
