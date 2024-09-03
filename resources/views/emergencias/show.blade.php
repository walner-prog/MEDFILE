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
            <h4><i class="fa-solid fa-ambulance fa-2x mb-1 mr-2"></i> Informe de Emergencia del Paciente</h4>
        </div>
        <div class="card-body">
            <div class="row mb-2 p-2 border border-1 border-info">
                <div class="col-md-6">
                    <h5 class=" text-white ">Información Básica</h5>

                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Fecha:</div>
                        <div class="col-sm-8">{{ $emergencia->fecha }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Hora:</div>
                        <div class="col-sm-8">{{ $emergencia->hora }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">No. Expediente:</div>
                        <div class="col-sm-8">{{ $emergencia->no_expediente }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Unidad de Salud:</div>
                        <div class="col-sm-8">{{ $emergencia->unidad_salud }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Primer Nombre:</div>
                        <div class="col-sm-8">{{ $emergencia->primer_nombre }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Segundo Nombre:</div>
                        <div class="col-sm-8">{{ $emergencia->segundo_nombre }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Primer Apellido:</div>
                        <div class="col-sm-8">{{ $emergencia->primer_apellido }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Segundo Apellido:</div>
                        <div class="col-sm-8">{{ $emergencia->segundo_apellido }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Edad:</div>
                        <div class="col-sm-8">{{ $emergencia->edad }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Sexo:</div>
                        <div class="col-sm-8">{{ $emergencia->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Sala/Servicio:</div>
                        <div class="col-sm-8">{{ $emergencia->sala_servicio }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Cama:</div>
                        <div class="col-sm-8">{{ $emergencia->cama }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Ocupación:</div>
                        <div class="col-sm-8">{{ $emergencia->ocupacion }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección de Residencia:</div>
                        <div class="col-sm-8">{{ $emergencia->direccion_residencia }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Localidad:</div>
                        <div class="col-sm-8">{{ $emergencia->localidad }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Departamento:</div>
                        <div class="col-sm-8">{{ $emergencia->departamento }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Teléfono:</div>
                        <div class="col-sm-8">{{ $emergencia->telefono }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">No. INSS:</div>
                        <div class="col-sm-8">{{ $emergencia->no_inss }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">No. Cédula:</div>
                        <div class="col-sm-8">{{ $emergencia->no_cedula }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Medio de Llegada:</div>
                        <div class="col-sm-8">{{ $emergencia->medio_llegada }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Causa del Accidente/Violencia:</div>
                        <div class="col-sm-8">{{ $emergencia->causa_accidente_violencia }}</div>
                    </div>

                </div>
                <div class="col-md-6 ">
                    
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Causa del Tratamiento:</div>
                        <div class="col-sm-8">{{ $emergencia->causa_tratamiento }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Lugar del Accidente/Violencia:</div>
                        <div class="col-sm-8">{{ $emergencia->lugar_accidente_violencia }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">VIF:</div>
                        <div class="col-sm-8">{{ $emergencia->vif }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Peso:</div>
                        <div class="col-sm-8">{{ $emergencia->peso }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Talla:</div>
                        <div class="col-sm-8">{{ $emergencia->talla }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Temperatura:</div>
                        <div class="col-sm-8">{{ $emergencia->temperatura }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Frecuencia Cardíaca:</div>
                        <div class="col-sm-8">{{ $emergencia->frecuencia_cardiaca }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Frecuencia Respiratoria:</div>
                        <div class="col-sm-8">{{ $emergencia->frecuencia_respiratoria }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Examen Físico:</div>
                        <div class="col-sm-8">{{ $emergencia->examen_fisico }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Diagnóstico:</div>
                        <div class="col-sm-8">{{ $emergencia->diagnostico }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Planes:</div>
                        <div class="col-sm-8">{{ $emergencia->planes }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Diagnóstico de Egreso:</div>
                        <div class="col-sm-8">{{ $emergencia->diagnostico_egreso }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Tipo de Urgencia:</div>
                        <div class="col-sm-8">{{ $emergencia->tipo_urgencia }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Destino del Paciente:</div>
                        <div class="col-sm-8">{{ $emergencia->destino_paciente }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Referencia:</div>
                        <div class="col-sm-8">{{ $emergencia->referencia }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Hospitalización:</div>
                        <div class="col-sm-8">{{ $emergencia->hospitalizacion }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Consulta Externa:</div>
                        <div class="col-sm-8">{{ $emergencia->consulta_externa }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Fuga:</div>
                        <div class="col-sm-8">{{ $emergencia->fuga }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Salida Exigida:</div>
                        <div class="col-sm-8">{{ $emergencia->salida_exigida }}</div>
                    </div>
                    
                </div>

            </div>
            <div class="row mb-2 p-2 border border-1 border-info">
                <div class="col-md-6">
                    <h5 class=" text-white ">Información del Responsable</h5>

                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Parentesco:</div>
                        <div class="col-sm-8">{{ $emergencia->parentesco }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Teléfono del Responsable:</div>
                        <div class="col-sm-8">{{ $emergencia->telefono_responsable }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección del Responsable:</div>
                        <div class="col-sm-8">{{ $emergencia->direccion_avisar }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Localidad:</div>
                        <div class="col-sm-8">{{ $emergencia->localidad_avisar }}</div>
                    </div>
                    <div class="row mb-2 ">
                        <div class="col-sm-4 font-weight-bold">Departamento:</div>
                        <div class="col-sm-8">{{ $emergencia->departamento_avisar }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
