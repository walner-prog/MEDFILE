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
            <h4><i class="fa-solid fa-user-md fa-2x mb-1 mr-2"></i> Información del Doctor</h4>
        </div>
        <div class="card-body">
            <div class="row mb-2 p-2 border border-1 border-info">
                <div class="col-md-6">
                    <h5 class="text-white">Información Básica</h5>

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Código:</div>
                        <div class="col-sm-8">{{ $doctor->codigo }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Edad:</div>
                        <div class="col-sm-8">{{ $age }} años</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Primer Nombre:</div>
                        <div class="col-sm-8">{{ $doctor->primer_nombre }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Segundo Nombre:</div>
                        <div class="col-sm-8">{{ $doctor->segundo_nombre }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Primer Apellido:</div>
                        <div class="col-sm-8">{{ $doctor->primer_apellido }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Segundo Apellido:</div>
                        <div class="col-sm-8">{{ $doctor->segundo_apellido }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Cédula:</div>
                        <div class="col-sm-8">{{ $doctor->cedula }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Teléfono:</div>
                        <div class="col-sm-8">{{ $doctor->telefono }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Email:</div>
                        <div class="col-sm-8">{{ $doctor->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Fecha de Contratación:</div>
                        <div class="col-sm-8">{{ $doctor->fecha_contratacion }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Estado:</div>
                        <div class="col-sm-8">{{ $doctor->estado }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Dirección:</div>
                        <div class="col-sm-8">{{ $doctor->direccion }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="text-white">Información Profesional</h5>

                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Especialidad:</div>
                        <div class="col-sm-8">{{ $doctor->especialidad->nombre }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Departamento:</div>
                        <div class="col-sm-8">{{ $doctor->departamento->nombre }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Horario de Trabajo:</div>
                        <div class="col-sm-8">{{ $doctor->horario_trabajo }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Usuario Asociado:</div>
                        <div class="col-sm-8">{{ $doctor->usuario->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Fecha de Nacimiento:</div>
                        <div class="col-sm-8">{{ $doctor->fecha_nacimiento }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Sexo:</div>
                        <div class="col-sm-8">{{ $doctor->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 font-weight-bold">Foto:</div>
                        <div class="col-sm-8">
                            @if($doctor->foto && file_exists(public_path($doctor->foto)))
                                <img src="{{ asset($doctor->foto) }}" alt="Foto del doctor" class="img-fluid" style="max-width: 150px; height: auto; border-radius: 50%;">
                            @else
                                {{-- Muestra un ícono si no se encuentra la imagen --}}
                                <i class="fa-solid fa-user-circle fa-5x text-secondary"></i>
                                <p>Foto no disponible o archivo no encontrado.</p>
                            @endif
                        </div>
                    </div>
                    
                    
                    
                    <p>Ruta en la BD: {{ $doctor->foto }}</p>
                     <p>Ruta completa: {{ public_path($doctor->foto) }}</p>

                </div>
            </div>
                  <div class="col-sm-8 font-weight-bold">
              <h1 >Detalles del Doctor</h1>
             <p>{{ $doctor_mayor_consulta->primer_nombre }} {{ $doctor_mayor_consulta->primer_apellido }}</p>
             <p>Consultas Realizadas: {{ $doctor_mayor_consulta->consultas_count }}</p>

            
                 
             
         

            </div>
        </div>
    </div>
</div>
@endsection
