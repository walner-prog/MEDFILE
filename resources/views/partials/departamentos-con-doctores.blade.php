
<div class="container mt-4">
  

    <!-- Acordeón para Departamentos con Doctores -->
    <div id="accordionConDoctores">
        <h3 class="text-dark">Departamentos con Doctores</h3>
        @foreach ($departamentosConDoctores as $departamento)
            <div class="card">
                <div class="card-header" id="headingConDoctores{{ $departamento->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseConDoctores{{ $departamento->id }}" aria-expanded="true" aria-controls="collapseConDoctores{{ $departamento->id }}">
                            Departamento: {{ $departamento->nombre }} ({{ $departamento->doctores_count }} Doctores)
                        </button>
                    </h5>
                </div>

                <div id="collapseConDoctores{{ $departamento->id }}" class="collapse" aria-labelledby="headingConDoctores{{ $departamento->id }}" data-parent="#accordionConDoctores">
                    <div class="card-body">
                        <!-- Tabla de Doctores -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código del Doctor</th>
                                    <th>Nombre del Doctor</th>
                                    <th>Apellido del Doctor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departamento->doctores as $doctor)
                                    <tr>
                                        <td>{{ $doctor->codigo }}</td>
                                        <td>{{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }}</td>
                                        <td>{{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Acordeón para Departamentos sin Doctores -->
    <div id="accordionSinDoctores" class="mt-4">
        <h3>Departamentos Sin Doctores</h3>
        @foreach ($departamentosSinDoctores as $departamento)
            <div class="card">
                <div class="card-header" id="headingSinDoctores{{ $departamento->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSinDoctores{{ $departamento->id }}" aria-expanded="true" aria-controls="collapseSinDoctores{{ $departamento->id }}">
                            Departamento: {{ $departamento->nombre }}
                        </button>
                    </h5>
                </div>

                <div id="collapseSinDoctores{{ $departamento->id }}" class="collapse" aria-labelledby="headingSinDoctores{{ $departamento->id }}" data-parent="#accordionSinDoctores">
                    <div class="card-body">
                        <p>No hay doctores asignados a este departamento.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
