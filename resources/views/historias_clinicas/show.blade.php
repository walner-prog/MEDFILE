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
            <h4><i class="fa-solid fa-id-card-clip fa-2x mb-1 mr-2"></i>Registro  de la Historia Clínica </h4>
            
           @can('ver-historia-clinica-pdf')
            <!-- Código o vista para ver la historia clínica en PDF -->
            <a href="{{ route('historias_clinicas.pdf', $historiaClinica->id) }}" class="btn btn-primary" target="_blank">
                Generar PDF
            </a>
           @endcan
           
            
        </div>
        <div class="card-body " >
            <div class="row text-dark">
                <div class="col-md-12">
                    <h5 class="text-center font-weight-bold">Información del Paciente </h5>
                    <hr>
                    <div class="row mb-2">
                       
                        
                            <div class="col-sm-8">
                                @if($historiaClinica->paciente && $historiaClinica->paciente->foto)
                                    <img src="{{ asset('images/' . $historiaClinica->paciente->foto) }}" alt="Foto de Paciente" width="150">
                                @else
                                    <i class="fa-solid fa-hospital-user fa-2x mb-1 font-weight-bold" style="font-size: 100px;"></i>
                                @endif
                            </div>
                            
                         
                        
                        <div class="mr-4 mt-2">
                          
                            <strong>    <i class="fa-solid fa-receipt fa-2x mb-1 mr-2 "></i> No. Expediente:</strong> <span class=" text-danger">{{ $historiaClinica->paciente->no_expediente }}</span> 
                           <strong class=" mr-2"><i class="fa-solid fa-file-waveform fa-2x mb-1 mr-2"></i></strong> 
                        </div>
                    </div>
                    
                </div>
            </div>    
                    <div class="row mb-2 mt-2">
                        <div class="col-sm-12 p-2 border border-1 border-info">
                            <div class="d-flex flex-wrap">
                                <div class="mr-4">
                                    <strong>Paciente ID:</strong> <span>{{ $historiaClinica->paciente->id }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Nombres y Apellidos:</strong>
                                    <span class="mr-3">
                                        {{ $historiaClinica->paciente->primer_nombre }} 
                                        {{ $historiaClinica->paciente->segundo_nombre }} 
                                        {{ $historiaClinica->paciente->primer_apellido }} 
                                        {{ $historiaClinica->paciente->segundo_apellido }}
                                    </span>
                                    <strong>Edad:</strong> <span class="mr-3">{{ $historiaClinica->paciente->edad }}</span>
                                    <strong>No. Cédula:</strong> <span class="mr-3">{{ $historiaClinica->paciente->no_cedula }}</span>
                                </div>
                                <div class="mr-4">
                                    <strong>Sexo:</strong> 
                                    <span>{{ $historiaClinica->paciente->sexo == 'M' ? 'Masculino' : ($historiaClinica->paciente->sexo == 'F' ? 'Femenino' : 'No especificado') }}</span>
                                </div>
                            </div>
                            
                        </div>


                    </div>

                <div class="row mb-2 mt-5 p-2 border border-1 border-info">
                          
                  <div class=" col-lg-6">
                        
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Teléfono:</div>
                        <div class="col-sm-8">{{ $historiaClinica->paciente->telefono ?? 'No disponible' }}</div>
                    </div>
                   
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">No. INSS:</div>
                        <div class="col-sm-8">{{ $historiaClinica->paciente->no_inss ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Sala:</div>
                        <div class="col-sm-8">{{ $historiaClinica->sala ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">No. Cama:</div>
                        <div class="col-sm-8">{{ $historiaClinica->no_cama ?? 'No disponible' }}</div>
                    </div>
               

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Procedencia:</div>
                        <div class="col-sm-8">{{ $historiaClinica->procedencia ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Religión:</div>
                        <div class="col-sm-8">{{ $historiaClinica->religion ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Grupos Étnicos:</div>
                        <div class="col-sm-8">{{ $historiaClinica->paciente->raza_etnia ?? 'No disponible' }}</div>
                    </div>

                  </div>

                  <div class="col-lg-6">
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Escolaridad:</div>
                        <div class="col-sm-8">{{ $historiaClinica->escolaridad ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Dirección Habitual:</div>
                        <div class="col-sm-8">{{ $historiaClinica->direccion_habitual ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Nombre del Padre:</div>
                        <div class="col-sm-8">{{ $historiaClinica->nombre_padre ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Fuente de Información:</div>
                        <div class="col-sm-8">{{ $historiaClinica->fuente_informacion ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Profesión/Oficio:</div>
                        <div class="col-sm-8">{{ $historiaClinica->profesion_oficio ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Nombre de la Madre:</div>
                        <div class="col-sm-8">{{ $historiaClinica->nombre_madre ?? 'No disponible' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Confiabilidad:</div>
                        <div class="col-sm-8">{{ $historiaClinica->confiabilidad ?? 'No disponible' }}</div>
                    </div>
                  </div>
                </div>
             
               <div class="row p-2 border border-1 border-info">
                 <div class="col-lg-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Motivo de Consulta:</div>
                        <div class="col-sm-8">{{ $historiaClinica->motivo_consulta ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Historia de Enfermedad Actual:</div>
                        <div class="col-sm-8">{{ $historiaClinica->historia_enfermedad_actual ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Interrogatorio Aparatos/Sistemas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->interrogatorio_aparatos_sistemas ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Enfermedades Infecciosas/Contagiosas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->enfermedades_infecto_contagiosas ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Enfermedades Hereditarias:</div>
                        <div class="col-sm-8">{{ $historiaClinica->enfermedades_hereditarias ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Inmunizaciones Completas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->inmunizaciones_completas ? 'Sí' : 'No' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Detalle de Inmunizaciones:</div>
                        <div class="col-sm-8">{{ $historiaClinica->detalle_inmunizaciones ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Horas de Sueño:</div>
                        <div class="col-sm-8">{{ $historiaClinica->horas_sueno ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Horas Laborales:</div>
                        <div class="col-sm-8">{{ $historiaClinica->horas_laborales ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Tipo de Hora/Actividad Física:</div>
                        <div class="col-sm-8">{{ $historiaClinica->tipo_hora_actividad_fisica ?? 'No disponible' }}</div>
                    </div>
                    <hr>

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Uso de Tabaco:</div>
                        <div class="col-sm-8">{{ $historiaClinica->tabaco ? 'Sí' : 'No' }}</div>
                    </div>
                    <hr>
                    @if($historiaClinica->tabaco)
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Tipo de Tabaco:</div>
                            <div class="col-sm-8">{{ $historiaClinica->tipo_tabaco }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Inicio:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_inicio_tabaco }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Cantidad/Frecuencia:</div>
                            <div class="col-sm-8">{{ $historiaClinica->cantidad_frecuencia_tabaco }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Abandono:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_abandono_tabaco }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Duración del Hábito:</div>
                            <div class="col-sm-8">{{ $historiaClinica->duracion_habito_tabaco }}</div>
                        </div>
                        <hr>
                    @endif
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Uso de Alcohol:</div>
                        <div class="col-sm-8">{{ $historiaClinica->alcohol ? 'Sí' : 'No' }}</div>
                    </div>
                    <hr>
                    @if($historiaClinica->alcohol)
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Tipo de Alcohol:</div>
                            <div class="col-sm-8">{{ $historiaClinica->tipo_alcohol }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Cantidad/Frecuencia:</div>
                            <div class="col-sm-8">{{ $historiaClinica->cantidad_frecuencia_alcohol }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Inicio:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_inicio_alcohol }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Abandono:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_abandono_alcohol }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Duración del Hábito:</div>
                            <div class="col-sm-8">{{ $historiaClinica->duracion_habito_alcohol }}</div>
                        </div>
                        <hr>
                    @endif

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Uso de Drogas Ilegales:</div>
                        <div class="col-sm-8">{{ $historiaClinica->drogas_ilegales ? 'Sí' : 'No' }}</div>
                    </div>
                    <hr>

                    @if($historiaClinica->drogas_ilegales)
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Tipo de Drogas:</div>
                            <div class="col-sm-8">{{ $historiaClinica->tipo_drogas ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Cantidad/Frecuencia:</div>
                            <div class="col-sm-8">{{ $historiaClinica->cantidad_frecuencia_drogas ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Inicio:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_inicio_drogas ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Abandono:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_abandono_drogas ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Duración del Hábito:</div>
                            <div class="col-sm-8">{{ $historiaClinica->duracion_habito_drogas ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                    @endif

                </div>
    
                </div>

            
               

                 <div class="row p-2 border border-1 border-info mt-3">
                    <div class="col-12">

                         
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Uso de Fármacos:</div>
                            <div class="col-sm-8">{{ $historiaClinica->farmacos ? 'Sí' : 'No' }}</div>
                        </div>
                        <hr>
                        @if($historiaClinica->farmacos)
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Cantidad/Frecuencia:</div>
                            <div class="col-sm-8">{{ $historiaClinica->cantidad_frecuencia_farmacos ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Edad de Abandono:</div>
                            <div class="col-sm-8">{{ $historiaClinica->edad_abandono_farmacos ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Duración del Hábito:</div>
                            <div class="col-sm-8">{{ $historiaClinica->duracion_habito_farmacos ?? 'No disponible' }}</div>
                        </div>
                        <hr>
                      @endif

                       <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Número de Medicamentos Actuales:</div>
                        <div class="col-sm-8">{{ $historiaClinica->num_medicamentos_actuales ?? 'No disponible' }}</div>
                      </div>
                      <hr>
                    
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Nombre y Posología de Fármacos:</div>
                        <div class="col-sm-8">{{ $historiaClinica->nombre_posologia_farmacos ?? 'No disponible' }}</div>
                     </div>
                     <hr>
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Enfermedades Infectocontagiosas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->enfermedades_infecto ?? 'No disponible' }}</div>
                     </div>
                     <hr>
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Otros Hábitos:</div>
                        <div class="col-sm-8">{{ $historiaClinica->otros_habitos ?? 'No disponible' }}</div>
                     </div>
                     <hr>
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Enfermedades Crónicas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->enfermedades_cronicas ?? 'No disponible' }}</div>
                     </div>
                     <hr>
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Cirugías Previas:</div>
                        <div class="col-sm-8">{{ $historiaClinica->cirugias_previas ?? 'No disponible' }}</div>
                     </div>
                     <hr>
                     <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Hospitalizaciones:</div>
                        <div class="col-sm-8">{{ $historiaClinica->hospitalizaciones ?? 'No disponible' }}</div>
                     </div>    
                     <hr>
                     

                @if($historiaClinica->sexo === 'F')

                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Examen Neurológico:</div>
                    <div class="col-sm-8">{{ $historiaClinica->examen_neurologico ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Mamas:</div>
                    <div class="col-sm-8">{{ $historiaClinica->mamas ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Menarca:</div>
                    <div class="col-sm-8">{{ $historiaClinica->menarca ?? 'No disponible' }}</div>
                </div>
                <hr>
            
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Gesta:</div>
                    <div class="col-sm-8">{{ $historiaClinica->gesta ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">FUR:</div>
                    <div class="col-sm-8">{{ $historiaClinica->fur ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Inicio de Vida Sexual:</div>
                    <div class="col-sm-8">{{ $historiaClinica->inicio_vida_sexual ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Para:</div>
                    <div class="col-sm-8">{{ $historiaClinica->para ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Cesárea:</div>
                    <div class="col-sm-8">{{ $historiaClinica->cesarea ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Número de Compañeros Sexuales:</div>
                    <div class="col-sm-8">{{ $historiaClinica->num_companeros_sexuales ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Aborto:</div>
                    <div class="col-sm-8">{{ $historiaClinica->aborto ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Legrado:</div>
                    <div class="col-sm-8">{{ $historiaClinica->legrado ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Semanas de Amenorrea:</div>
                    <div class="col-sm-8">{{ $historiaClinica->semanas_amenorrea ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Menopausia:</div>
                    <div class="col-sm-8">{{ $historiaClinica->menopausia ? 'Sí' : 'No' }}</div>
                </div>
                <hr>
                @if($historiaClinica->menopausia)
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Fecha de Menopausia:</div>
                        <div class="col-sm-8">{{ $historiaClinica->fecha_menopausia ? $historiaClinica->fecha_menopausia->format('d/m/Y') : 'No disponible' }}</div>
                    </div>
                    <hr>
                @endif
            
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Planificación Familiar:</div>
                    <div class="col-sm-8">{{ $historiaClinica->planificacion_familiar ? 'Sí' : 'No' }}</div>
                </div>
                <hr>
                @if($historiaClinica->planificacion_familiar)
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Método de Planificación:</div>
                        <div class="col-sm-8">{{ $historiaClinica->metodo_planificacion ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                @endif
            
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Sustitución Hormonal:</div>
                    <div class="col-sm-8">{{ $historiaClinica->sustitucion_hormonal ? 'Sí' : 'No' }}</div>
                </div>
                <hr>
                @if($historiaClinica->sustitucion_hormonal)
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Especificar Sustitución Hormonal:</div>
                        <div class="col-sm-8">{{ $historiaClinica->especificar_sustitucion_hormonal ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                @endif
            
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Papanicolaou (PAP):</div>
                    <div class="col-sm-8">{{ $historiaClinica->pap ? 'Sí' : 'No' }}</div>
                </div>
                <hr>
                @if($historiaClinica->pap)
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Resultado y Fecha del PAP:</div>
                        <div class="col-sm-8">{{ $historiaClinica->resultado_fecha_pap ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                @endif
            @endif

            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Trabajo Actual:</div>
                <div class="col-sm-8">{{ $historiaClinica->trabajo_actual ? 'Sí' : 'No' }}</div>
            </div>
            <hr>
            @if($historiaClinica->trabajo_actual)
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Lugar de Trabajo:</div>
                    <div class="col-sm-8">{{ $historiaClinica->lugar_trabajo ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Área en la que Labora:</div>
                    <div class="col-sm-8">{{ $historiaClinica->area_labora ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Oficio/Categoría:</div>
                    <div class="col-sm-8">{{ $historiaClinica->oficio_categoria ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Años en el Oficio/Trabajo Actual:</div>
                    <div class="col-sm-8">{{ $historiaClinica->anos_oficio_trabajo_actual ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Horas por Día Laboral:</div>
                    <div class="col-sm-8">{{ $historiaClinica->dia_laboral_horas ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Tipo de Horario:</div>
                    <div class="col-sm-8">{{ $historiaClinica->tipo_horario ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Horas Semanales:</div>
                    <div class="col-sm-8">{{ $historiaClinica->horas_semanales ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Descripción del Trabajo Actual:</div>
                    <div class="col-sm-8">{{ $historiaClinica->descripcion_trabajo_actual ?? 'No disponible' }}</div>
                </div>
                <hr>
                
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Exposición a Sustancias:</div>
                    <div class="col-sm-8">{{ $historiaClinica->exposicion_sustancias ? 'Sí' : 'No' }}</div>
                </div>
                <hr>
                @if($historiaClinica->exposicion_sustancias)
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Descripción de la Exposición:</div>
                        <div class="col-sm-8">{{ $historiaClinica->descripcion_exposicion ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Frecuencia e Intensidad de la Tarea:</div>
                        <div class="col-sm-8">{{ $historiaClinica->frecuencia_intensidad_tarea ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Posición en el Trabajo:</div>
                        <div class="col-sm-8">{{ $historiaClinica->posicion_trabajo ?? 'No disponible' }}</div>
                    </div>
                    <hr>
                  @endif
                @endif

                
            <div class="row mb-2 ">
                <div class="col-sm-4 font-weight-bold">Trabajos Fuera del Empleo:</div>
                <div class="col-sm-8">{{ $historiaClinica->trabajos_fuera_empleo ? 'Sí' : 'No' }}</div>
            </div>
            <hr>
            @if($historiaClinica->trabajos_fuera_empleo)
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Horas Extras:</div>
                    <div class="col-sm-8">{{ $historiaClinica->horas_extras ?? 'No disponible' }}</div>
                </div>
                <hr>
            @endif


            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Antecedentes Laborales:</div>
                <div class="col-sm-8">{{ $historiaClinica->antecedentes_laborales ? 'Sí' : 'No' }}</div>
            </div>
            <hr>
            @if($historiaClinica->antecedentes_laborales)
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Fecha de Inicio:</div>
                    <div class="col-sm-8">{{ $historiaClinica->fecha_inicio }}</div>

                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Puesto de Trabajo:</div>
                    <div class="col-sm-8">{{ $historiaClinica->puesto_trabajo ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Años Trabajados:</div>
                    <div class="col-sm-8">{{ $historiaClinica->anos_trabajados ?? 'No disponible' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">Fecha de Conclusión:</div>
                    <div class="col-sm-8">{{ $historiaClinica->fecha_conclusion }}</div>
                </div>
                <hr>
            @endif


            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Frecuencia Cardiaca (FC):</div>
                <div class="col-sm-8">{{ $historiaClinica->fc ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Frecuencia Respiratoria (FR):</div>
                <div class="col-sm-8">{{ $historiaClinica->fr ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Tensión Arterial (TA):</div>
                <div class="col-sm-8">{{ $historiaClinica->ta ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Temperatura:</div>
                <div class="col-sm-8">{{ $historiaClinica->temperatura ?? 'No disponible' }}</div>
            </div> 
            <hr>
            
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Peso:</div>
                <div class="col-sm-8">{{ $historiaClinica->peso ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Talla:</div>
                <div class="col-sm-8">{{ $historiaClinica->talla ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Área de Superficie Corporal:</div>
                <div class="col-sm-8">{{ $historiaClinica->area_superficie_corporal ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Índice de Masa Corporal (IMC):</div>
                <div class="col-sm-8">{{ $historiaClinica->imc ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Aspecto General:</div>
                <div class="col-sm-8">{{ $historiaClinica->aspecto_general ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Piel y Mucosas:</div>
                <div class="col-sm-8">{{ $historiaClinica->piel_mucosas ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Cráneo:</div>
                <div class="col-sm-8">{{ $historiaClinica->craneo ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Ojos:</div>
                <div class="col-sm-8">{{ $historiaClinica->ojos ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Orejas:</div>
                <div class="col-sm-8">{{ $historiaClinica->orejas ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Nariz:</div>
                <div class="col-sm-8">{{ $historiaClinica->nariz ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Boca:</div>
                <div class="col-sm-8">{{ $historiaClinica->boca ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Cuello:</div>
                <div class="col-sm-8">{{ $historiaClinica->cuello ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Caja Torácica:</div>
                <div class="col-sm-8">{{ $historiaClinica->caja_toracica ?? 'No disponible' }}</div>
            </div>
            
            <hr>
            
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Campos Pulmonares:</div>
                <div class="col-sm-8">{{ $historiaClinica->campos_pulmonares ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Cardiaco:</div>
                <div class="col-sm-8">{{ $historiaClinica->cardiaco ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Abdomen/Pelvis:</div>
                <div class="col-sm-8">{{ $historiaClinica->abdomen_pelvis ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Extremidades Superiores:</div>
                <div class="col-sm-8">{{ $historiaClinica->extremidades_superiores ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Extremidades Inferiores:</div>
                <div class="col-sm-8">{{ $historiaClinica->extremidades_inferiores ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Genitourinario:</div>
                <div class="col-sm-8">{{ $historiaClinica->genitourinario ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Examen Ginecológico:</div>
                <div class="col-sm-8">{{ $historiaClinica->examen_ginecologico ?? 'No disponible' }}</div>
            </div>
            
            <hr>
                        
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Observaciones del Análisis:</div>
                <div class="col-sm-8">{{ $historiaClinica->observaciones_analisis ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Diagnósticos/Problemas:</div>
                <div class="col-sm-8">{{ $historiaClinica->diagnosticos_problemas ?? 'No disponible' }}</div>
            </div>
            
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Nombre del Elaborador de la Historia:</div>
                <div class="col-sm-8">{{ $historiaClinica->nombre_elabora_historia ?? 'No disponible' }}</div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-sm-4 font-weight-bold">Firma/Código/Sello:</div>
                <div class="col-sm-8">{{ $historiaClinica->firma_codigo_sello ?? 'No disponible' }}</div>
            </div>
            
         </div>

                 <div class="mt-2">
                    <a href="{{ route('historias_clinicas.index') }}" class="btn btn-primary">Volver</a>
                </div>

              </div>
          </div>
   
        </div>
    </div>
        
 
</div>
@endsection
