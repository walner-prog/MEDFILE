<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        .bt-teal {
  background-color: #14b8a6; /* Teal 500 de Tailwind CSS para boton crear */
  color: white;

}
    </style>
    <div class="container  ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bt-teal text-dark">
                        <h4>Detalles del Paciente {{ $paciente->nombre }} {{ $paciente->primer_apellido }}</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Información Básica</h5>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">No. Expediente:</div>
                                    <div class="col-sm-8">{{ $paciente->no_expediente }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Fecha de Nacimiento:</div>
                                    <div class="col-sm-8">{{ $paciente->fecha_nacimiento }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Nombre:</div>
                                    <div class="col-sm-8">{{ $paciente->nombre }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Primer Apellido:</div>
                                    <div class="col-sm-8">{{ $paciente->primer_apellido }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Segundo Apellido:</div>
                                    <div class="col-sm-8">{{ $paciente->segundo_apellido }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Edad:</div>
                                    <div class="col-sm-8">{{ $paciente->edad }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Sexo:</div>
                                    <div class="col-sm-8">{{ $paciente->sexo == 'M' ? 'Masculino' : 'Femenino' }}</div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <h5>Información de Contacto</h5>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Teléfono:</div>
                                    <div class="col-sm-8">{{ $paciente->telefono }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Correo:</div>
                                    <div class="col-sm-8">{{ $paciente->correo }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Dirección:</div>
                                    <div class="col-sm-8">{{ $paciente->direccion }}</div>
                                </div>
                            </div>
                        </div>
    
                        <h5 class="mt-4">Información Adicional</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Establecimiento de Salud:</div>
                                    <div class="col-sm-8">{{ $paciente->establecimiento_salud }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">No. Cédula:</div>
                                    <div class="col-sm-8">{{ $paciente->no_cedula }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Categoría:</div>
                                    <div class="col-sm-8">{{ $paciente->categoria }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">No. INSS:</div>
                                    <div class="col-sm-8">{{ $paciente->no_inss }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Estado Civil:</div>
                                    <div class="col-sm-8">{{ $paciente->estado_civil }}</div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Escolaridad:</div>
                                    <div class="col-sm-8">{{ $paciente->escolaridad }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Ocupación:</div>
                                    <div class="col-sm-8">{{ $paciente->ocupacion }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Dirección de Residencia:</div>
                                    <div class="col-sm-8">{{ $paciente->direccion_residencia }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Localidad:</div>
                                    <div class="col-sm-8">{{ $paciente->localidad }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Municipio:</div>
                                    <div class="col-sm-8">{{ $paciente->municipio }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Departamento:</div>
                                    <div class="col-sm-8">{{ $paciente->departamento }}</div>
                                </div>
                            </div>
                        </div>
    
                        <h5 class="mt-4">Información del Responsable</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Responsable de Emergencia:</div>
                                    <div class="col-sm-8">{{ $paciente->responsable_emergencia }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Parentesco:</div>
                                    <div class="col-sm-8">{{ $paciente->parentesco }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Teléfono del Responsable:</div>
                                    <div class="col-sm-8">{{ $paciente->telefono_responsable }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Dirección del Responsable:</div>
                                    <div class="col-sm-8">{{ $paciente->direccion_responsable }}</div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Empleador:</div>
                                    <div class="col-sm-8">{{ $paciente->empleador }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Dirección del Empleador:</div>
                                    <div class="col-sm-8">{{ $paciente->direccion_empleador }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



