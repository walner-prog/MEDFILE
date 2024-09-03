
<!-- resources/views/partials/doctores-con-promedio-consultas.blade.php -->

<div class="container mt-4">
    <h1 class="h3 mb-4">Promedio de Consultas por Doctor</h1>
    <p class="lead">El promedio de consultas por doctor es: <strong>{{ number_format($promedioConsultas, 2) }}</strong></p>

    <h2 class="h4 mb-4">Listado de Doctores</h2>
    <div class="list-group">
        @foreach ($doctores_promedio as $doctor)
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $doctor->primer_nombre }} {{ $doctor->primer_apellido }}</h5>
                    <p class="mb-1 text-muted">Número de Consultas:   <span class="badge bg-info rounded-pill">{{ $doctor->consultas_count }}</span></p>
                </div>
              
            </a>
        @endforeach
    </div>
</div>
