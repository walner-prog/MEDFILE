<div class="container mt-4">
    <!-- Doctores con la Especialidad Más Frecuente -->
    <div class="mb-5">
        <h1 class="h3 mb-4 text-dark">Doctores con la Especialidad Más Frecuente</h1>
        @if($especialidadConMasDoctores)
            <div class="list-group">
                @foreach ($doctores as $doctor)
                    <div class="list-group-item d-flex justify-content-between align-items-center mb-3 shadow-sm bg-white rounded border border-light">
                        <div>
                            <h5 class="mb-1 text-primary">{{ $doctor->primer_nombre }} {{ $doctor->segundo_nombre }} {{ $doctor->primer_apellido }} {{ $doctor->segundo_apellido }}</h5>
                            <p class="mb-1 text-muted">Especialidad: {{ $especialidadConMasDoctores->nombre }}</p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm">Ver Detalles</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info" role="alert">
                No se encontraron doctores para la especialidad más frecuente.
            </div>
        @endif
    </div>
</div>
