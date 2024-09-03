<div class="container mt-4">
    <h4 class="mb-3">Especialidades con Más Doctores</h4>
    @if($especialidades->isNotEmpty())
        @foreach($especialidades as $especialidad)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        {{ $especialidad->nombre }}
                       
                    </h5>
                    <p class="card-text">
                        <strong>Cantidad de Doctores:</strong>  <span class="badge bg-primary">{{ $especialidad->doctores_count }}</span> 
                    </p>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $especialidad->doctores_count }}%;" aria-valuenow="{{ $especialidad->doctores_count }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $especialidad->doctores_count }}%
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info" role="alert">
            No se encontraron especialidades.
        </div>
    @endif
</div>
