


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Pacientes con la Enfermedad Más Común</h1>
            
            @if(is_null($enfermedad))
                <div class="alert alert-warning">
                    No se encontraron enfermedades registradas.
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Enfermedad Más Común
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $enfermedad->enfermedades_cronicas }}
                            <span class="badge bg-info">{{ $porcentaje }}% de los pacientes</span>
                        </h5>
                        
                        <!-- Canvas para la gráfica -->
                        <div>
                            <canvas id="enfermedadChart"></canvas>
                        </div>
                    </div>
                </div>

                @if($pacientes->isEmpty())
                    <div class="alert alert-info">
                        No se encontraron pacientes con esta enfermedad.
                    </div>
                @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Código</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->primer_nombre }}</td>
                                    <td>{{ $paciente->primer_apellido }}</td>
                                    <td>{{ $paciente->no_expediente }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>
</div>

