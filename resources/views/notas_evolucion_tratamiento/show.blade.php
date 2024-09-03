@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

@section('content')
<div class="container">
    <style id="default-styles">
        strong, .font-weight-bold {
            color: #002939 !important;
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
            <h4><i class="fa-solid fa-notes-medical fa-2x mb-1 mr-2"></i> Nota de Evolución de Tratamiento</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información de la Nota de Evolución de Tratamiento</h5>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Nombre del Paciente: </strong> <span>{{ $nota->primer_nombre }} {{ $nota->segundo_nombre }} {{ $nota->primer_apellido }} {{ $nota->segundo_apellido }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Expediente:</strong> <span>{{ $nota->no_expediente }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Cédula:</strong> <span>{{ $nota->no_cedula }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Fecha y Hora:</strong> <span>{{ $nota->fecha_hora ? $nota->fecha_hora->format('Y-m-d H:i') : 'No disponible' }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Establecimiento de Salud:</strong> <span>{{ $nota->establecimiento_salud }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Servicio:</strong> <span>{{ $nota->servicio }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. Cama:</strong> <span>{{ $nota->no_cama }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>Sala:</strong> <span>{{ $nota->sala }}</span> 
                                </div>
                                <div class="mr-4">
                                    <strong>No. INSS:</strong> <span>{{ $nota->no_inss }}</span> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Problemas de Evolución:</div>
                                <div class="col-sm-8">{{ $nota->problemas_evolucion ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Planes:</div>
                                <div class="col-sm-8">{{ $nota->planes ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Participantes en la Atención:</div>
                                <div class="col-sm-8">{{ $nota->participantes_atencion ?? 'No disponible' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Firma y Código Profesional:</div>
                                <div class="col-sm-8">{{ $nota->firma_codigo_profesional ?? 'No disponible' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
