<div class="container mt-4">
    <h1 class="h3 mb-4 text-dark">Doctores Contratados en el Último Año</h1>
    <div class="list-group">
        @foreach ($doctoresyear as $doctor)
            <div class="list-group-item d-flex justify-content-between align-items-center mb-3 shadow-sm bg-light rounded">
                <div>
                    <h5 class="mb-1 text-primary">{{ $doctor->primer_nombre }} {{ $doctor->primer_apellido }}</h5>
                    <p class="mb-0 text-muted">Fecha de Contratación: {{ $doctor->fecha_contratacion }}</p>
                    <p class="mb-0 text-muted">
                        Tiempo en el Hospital: {{ $doctor->anios }} años {{ $doctor->meses }} meses
                    </p>
                </div>
                <span class="badge bg-success rounded-pill">Nuevo</span>
            </div>
        @endforeach
    </div>
</div>
