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
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fa-solid fa-notes-medical fa-2x mb-1 mr-2"></i> Lista de Problemas del Paciente</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información del Paciente</h5>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Nombres y Apellidos: </strong> 
                                    <span>{{ $listaProblema->primer_nombre }} {{ $listaProblema->segundo_nombre }} {{ $listaProblema->primer_apellido }} {{ $listaProblema->segundo_apellido }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>No. Expediente:</strong> 
                                    <span>{{ $listaProblema->no_expediente }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Edad:</strong> 
                                    <span>{{ $listaProblema->edad }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Fecha:</strong> 
                                    <span>{{ $listaProblema->fecha }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Servicio:</strong> 
                                    <span>{{ $listaProblema->servicio }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Sala:</strong> 
                                    <span>{{ $listaProblema->sala }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Establecimiento de Salud:</strong> 
                                    <span>{{ $listaProblema->establecimiento_salud }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre del Problema:</div>
                                <div class="col-sm-8">{{ $listaProblema->nombre_problema }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Inactivo:</div>
                                <div class="col-sm-8">{{ $listaProblema->inactivo ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Resuelto:</div>
                                <div class="col-sm-8">{{ $listaProblema->resuelto ? 'Sí' : 'No' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
