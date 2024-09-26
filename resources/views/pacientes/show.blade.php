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
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4><i class="fa-solid fa-hospital-user fa-2x mb-1"></i> Registro de Identificación del Paciente</h4>
            

        </div>
        
        
        <div class="card-body">
            <div class="row text-dark  border border-1 border-info">
                <div class="col-md-6">
                    <h5 class=" text-left font-weight-bold">Información Básica</h5>
                    <hr>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">No. Expediente:</div>
                        <div class="col-sm-8">{{ $paciente->no_expediente }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Fecha de Nacimiento:</div>
                        <div class="col-sm-8">{{ $paciente->fecha_nacimiento }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Nombres:</div>
                        <div class="col-sm-8">{{ $paciente->primer_nombre }} {{ $paciente->segundo_nombre }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Apellidos:</div>
                        <div class="col-sm-8">{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Edad:</div>
                        <div class="col-sm-8">{{ $paciente->edad }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Sexo:</div>
                        <div class="col-sm-8">{{ $paciente->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5 class=" text-left font-weight-bold">Información de Contacto</h5>
                    <hr>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Teléfono:</div>
                        <div class="col-sm-8">{{ $paciente->telefono }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Correo:</div>
                        <div class="col-sm-8">{{ $paciente->correo }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección:</div>
                        <div class="col-sm-8">{{ $paciente->direccion }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Foto:</div>
                        <div class="col-sm-8">
                            
                            @if($paciente->foto)
                            <img src="{{ asset('images/' . $paciente->foto) }}" alt="Foto de Paciente" width="150">
                             @else
                            <p>No hay foto disponible</p>
                           @endif
                        </div>
                    </div>
                   
                </div>
            </div>

            <h5 class="text-center font-weight-bold mt-4">Información Adicional</h5>
            <hr>
            <div class="row border border-1 border-info">
                <div class="col-md-6">
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Establecimiento de Salud:</div>
                        <div class="col-sm-8">{{ $paciente->establecimiento_salud }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">No. Cédula:</div>
                        <div class="col-sm-8">{{ $paciente->no_cedula }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Categoría:</div>
                        <div class="col-sm-8">{{ $paciente->categoria }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">No. INSS:</div>
                        <div class="col-sm-8">{{ $paciente->no_inss }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Estado Civil:</div>
                        <div class="col-sm-8">{{ $paciente->estado_civil }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Escolaridad:</div>
                        <div class="col-sm-8">{{ $paciente->escolaridad }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Ocupación:</div>
                        <div class="col-sm-8">{{ $paciente->ocupacion }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección de Residencia:</div>
                        <div class="col-sm-8">{{ $paciente->direccion_residencia }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Localidad:</div>
                        <div class="col-sm-8">{{ $paciente->localidad }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Municipio:</div>
                        <div class="col-sm-8">{{ $paciente->municipio }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Departamento:</div>
                        <div class="col-sm-8">{{ $paciente->departamento }}</div>
                    </div>
                </div>
            </div>

            <h5 class="text-center font-weight-bold mt-4">Información del Responsable</h5>
            <hr>
            <div class="row  border border-1 border-info">
                <div class="col-md-6">
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Responsable de Emergencia:</div>
                        <div class="col-sm-8">{{ $paciente->responsable_emergencia }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Parentesco:</div>
                        <div class="col-sm-8">{{ $paciente->parentesco }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Teléfono del Responsable:</div>
                        <div class="col-sm-8">{{ $paciente->telefono_responsable }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección del Responsable:</div>
                        <div class="col-sm-8">{{ $paciente->direccion_responsable }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Empleador:</div>
                        <div class="col-sm-8">{{ $paciente->empleador }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Teléfono del Empleador:</div>
                        <div class="col-sm-8">{{ $paciente->telefono_empleador }}</div>
                    </div>
                    <div class="row mb-2 p-2 ">
                        <div class="col-sm-4 font-weight-bold">Dirección del Empleador:</div>
                        <div class="col-sm-8">{{ $paciente->direccion_empleador }}</div>
                    </div>
                </div>
            </div>

            <h5 class="text-center font-weight-bold mt-4">Otros Datos</h5>
            <hr>
            <div class="row mb-2 p-2 ">
                <div class="col-sm-4 font-weight-bold">Fecha de Creación:</div>
                <div class="col-sm-8">{{ $paciente->created_at->format('d-m-Y') }}</div>
            </div>
            <div class="row mb-2 p-2 ">
                <div class="col-sm-4 font-weight-bold">Última Actualización:</div>
                <div class="col-sm-8">{{ $paciente->updated_at->format('d-m-Y') }}</div>
            </div>
                    
           



            <div class="text-center mt-3">
              
              
                <a href="{{ route('pacientes.pdf', $paciente->id) }}" class="btn btn-primary">Descargar PDF</a>
            </div>
        </div>

    <br>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Registros de Admisión/Egreso</h5>
                    </div>
                   
                    <div class="card-body">
                        <p class=" text-white">Total de registros: <strong>{{ $registrosAdmisionEgreso->count() }}</strong></p>
                        @if($registrosAdmisionEgreso->count() > 0)
                            <ul class="list-group">
                                @foreach($registrosAdmisionEgreso as $registro)
                                    <li class="list-group-item">
                                        <a href="{{ route('registro_admision_hospitalario.show', $registro->id) }}" target="blank">
                                            Ver Registro de Admisión/Egreso - {{ $registro->egreso_fecha }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class=" text-white">No hay registros de admisión o egreso disponibles.</p>
                        @endif
                          <br>
                        @if($registroMasReciente)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Registro Más Reciente</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('registro_admision_hospitalario.show', $registroMasReciente->id) }}" class="btn btn-primary" target="blank">
                                            Ver Registro Más Reciente - {{ $registroMasReciente->egreso_fecha }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
    
    
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Registros de Historias Clinicas/Egreso</h5>
                </div>
                <div class="card-body">
                    <p class="text-white">Total de registros: <strong>{{ $historiasClinicas->count() }}</strong></p>
                    @if($historiasClinicas->count() > 0)
                        <ul class="list-group">
                            @foreach($historiasClinicas as $historia)
                                <li class="list-group-item">
                                    <a href="{{ route('historias_clinicas.show', $historia->id) }}">
                                        Ver Historia Clínica - {{ $historia->created_at->format('d-m-Y H:i:s') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class=" text-white">No hay registros de Registros de Historias Clinicas.</p>
                    @endif
                    <br>

                    @if($historiaMasReciente)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">Registro Más Reciente</h5>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('historias_clinicas.show', $historiaMasReciente->id) }}" class="btn btn-primary" target="blank">
                                        Ver Historia clinica  - {{ $historiaMasReciente->created_at }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endif
                </div>
              
    
                <h1>Detalles del Paciente</h1>
                <p class="text-dark">{{ $paciente_num_consulta->primer_nombre }} {{ $paciente_num_consulta->primer_apellido }}</p>
                <p class="text-dark">Consultas Realizadas:  {{ $paciente->consultas_count }}</p>
                
            </div>
        </div>

    </div>

    
    
   
</div>





        
</div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    const darkModeSwitch = document.querySelector("#dark-mode-switch");
    const defaultStyles = document.querySelector("#default-styles");
    const customStyles = document.querySelector("#custom-styles");

    darkModeSwitch.addEventListener("click", function() {
        customStyles.disabled = !customStyles.disabled;
        defaultStyles.disabled = !defaultStyles.disabled;
    });
</script>
@endsection
