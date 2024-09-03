<div class="container mt-4">
    <h1 class="mb-4 text-dark">Listado de Doctores por Especialidad</h1>

    <div id="accordion">
        @foreach ($especialidades as $especialidad)
            <div class="card mb-2">
                <div class="card-header" id="heading{{ $especialidad->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left" data-toggle="collapse" data-target="#collapse{{ $especialidad->id }}" aria-expanded="true" aria-controls="collapse{{ $especialidad->id }}">
                            <strong>Especialidad:</strong> {{ $especialidad->nombre }} 
                            <span class="badge bg-primary float-right">{{ $especialidad->doctores_count }} Doctores</span>
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $especialidad->id }}" class="collapse" aria-labelledby="heading{{ $especialidad->id }}" data-parent="#accordion">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Código del Doctor</th>
                                    <th>Nombre del Doctor</th>
                                    <th>Apellido del Doctor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidad->doctores as $doctor)
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
</div>
