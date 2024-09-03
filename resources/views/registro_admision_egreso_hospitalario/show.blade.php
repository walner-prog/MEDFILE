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
            <h4><i class="fa-solid fa-notes-medical fa-2x mb-1 mr-2"></i> Información de Ingreso o Egreso Hospitalario</h4>
        </div>
        <div class="card-body">
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Detalles del Registro</h5>
                    <hr>
                    <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                       
                        <div class="col-sm-4">
                            <div class="row mb-2 ">
                                <div class="col-sm-4 font-weight-bold">Nombre del Paciente:</div>
                                <div class="col-sm-8">{{ $admision->primer_nombre }} {{ $admision->segundo_nombre }} {{ $admision->primer_apellido }} {{ $admision->segundo_apellido }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">No. Expediente:</div>
                                <div class="col-sm-8">{{ $admision->no_expediente }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">No. Cédula:</div>
                                <div class="col-sm-8">{{ $admision->no_cedula }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Estado Civil:</div>
                                <div class="col-sm-8">{{ $admision->estado_civil }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Escolaridad:</div>
                                <div class="col-sm-8">{{ $admision->escolaridad }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Categoría del Paciente:</div>
                                <div class="col-sm-8">{{ $admision->categoria_paciente }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">No. INSS:</div>
                                <div class="col-sm-8">{{ $admision->no_inss }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Sexo:</div>
                                <div class="col-sm-8">{{ $admision->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Establecimiento de Salud:</div>
                                <div class="col-sm-8">{{ $admision->establecimiento_salud }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Dirección de Residencia:</div>
                                <div class="col-sm-8">{{ $admision->direccion_residencia }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Localidad:</div>
                                <div class="col-sm-8">{{ $admision->localidad }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Municipio:</div>
                                <div class="col-sm-8">{{ $admision->municipio }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Departamento:</div>
                                <div class="col-sm-8">{{ $admision->departamento }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Raza / Etnia:</div>
                                <div class="col-sm-8">{{ $admision->raza_etnia }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Edad:</div>
                                <div class="col-sm-8">{{ $admision->edad }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Ocupación:</div>
                                <div class="col-sm-8">{{ $admision->ocupacion }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre de la Madre:</div>
                                <div class="col-sm-8">{{ $admision->nombre_madre }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre del Padre:</div>
                                <div class="col-sm-8">{{ $admision->nombre_padre }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Urgencia a Avisar:</div>
                                <div class="col-sm-8">{{ $admision->urgencia_avisar }}</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                          

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Dirección / Teléfono a Avisar:</div>
                                <div class="col-sm-8">{{ $admision->direccion_telefono_avisar }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Ingreso:</div>
                                <div class="col-sm-8">{{ $admision->ingreso }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Empleador:</div>
                                <div class="col-sm-8">{{ $admision->empleador }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Dirección del Empleador:</div>
                                <div class="col-sm-8">{{ $admision->direccion_empleador }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Municipio / Distrito:</div>
                                <div class="col-sm-8">{{ $admision->municipio_distrito }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Parentesco:</div>
                                <div class="col-sm-8">{{ $admision->parentesco }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Diagnóstico de Ingreso:</div>
                                <div class="col-sm-8">{{ $admision->diagnostico_ingreso }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Forma de Llegada al Hospital:</div>
                                <div class="col-sm-8">{{ $admision->forma_llegada_hospital }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Reingreso con el Mismo Diagnóstico:</div>
                                <div class="col-sm-8">{{ $admision->reingreso_mismo_diagnostico ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Sitio de Ingreso Hospitalario:</div>
                                <div class="col-sm-8">{{ $admision->sitio_ingreso_hospitalario }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre del Médico:</div>
                                <div class="col-sm-8">{{ $admision->nombre_medico }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Sello Médico de Ingreso:</div>
                                <div class="col-sm-8">{{ $admision->sello_medico_ingreso }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Fecha de Egreso:</div>
                                <div class="col-sm-8">{{ \Carbon\Carbon::parse($admision->egreso_fecha)->format('Y-m-d') }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Hora de Egreso:</div>
                                <div class="col-sm-8">{{ \Carbon\Carbon::parse($admision->egreso_hora)->format('H:i') }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Diagnóstico de Egreso:</div>
                                <div class="col-sm-8">{{ $admision->diagnostico_egreso }}</div>
                            </div>

                        </div>
                        <div class="col-sm-4">
                           

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Diagnóstico Principal de Egreso:</div>
                                <div class="col-sm-8">{{ $admision->diagnostico_egreso_principal }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Diagnóstico Complementario de Egreso:</div>
                                <div class="col-sm-8">{{ $admision->diagnostico_egreso_complementarios }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Cirugías Realizadas:</div>
                                <div class="col-sm-8">{{ $admision->cirugias_realizadas }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Nombre del Admisionista:</div>
                                <div class="col-sm-8">{{ $admision->nombre_admisionista }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Días de Estancia:</div>
                                <div class="col-sm-8">{{ $admision->dias_estancia }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Accidente de Trabajo:</div>
                                <div class="col-sm-8">{{ $admision->accidente_trabajo ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Accidente de Trayecto:</div>
                                <div class="col-sm-8">{{ $admision->de_trayecto ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Enfermedad Laboral:</div>
                                <div class="col-sm-8">{{ $admision->enfermedad_laboral ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Causa del Trauma:</div>
                                <div class="col-sm-8">{{ $admision->causa_trauma }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Infección Intrahospitalaria:</div>
                                <div class="col-sm-8">{{ $admision->infeccion_intrahospitalaria ? 'Sí' : 'No' }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4 font-weight-bold">Referido a Otro Establecimiento:</div>
                                <div class="col-sm-8">{{ $admision->referido_otro_establecimiento }}</div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
