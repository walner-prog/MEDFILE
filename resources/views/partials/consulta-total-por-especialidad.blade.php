<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm bg-light rounded">
                <div class="card-body">
                    <h2 class="card-title text-dark">Informe del Hospital</h2>
                    <p class="card-text text-muted">
                        El hospital cuenta con <strong>{{ $totalDoctores }}</strong> doctores.
                    </p>
                    <p class="card-text text-muted">
                        Distribución por especialidad:
                    </p>
                    <ul class="list-group list-group-flush">
                        @foreach ($especialidades as $especialidad)
                            <li class="list-group-item">
                                <strong>{{ $especialidad->nombre }}</strong>: 
                                {{ $especialidad->doctores_count }} doctores
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
