<div>
    <h4>Pacientes con {{ $enfermedad }}</h4>
    <div class="row mb-3 p-1">
        <!-- Buscador por nombre -->
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Buscar por nombre" wire:model="searchNombre">
        </div>
        
        <!-- Filtro por fecha de nacimiento -->
        <div class="col-md-3">
            <input type="date" class="form-control" placeholder="Buscar por fecha" wire:model="searchFecha">
        </div>
        
        <!-- Filtro por edad mínima y máxima -->
        <div class="col-md-2">
            <input type="number" class="form-control" placeholder="Edad mínima" wire:model="edadMin">
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" placeholder="Edad máxima" wire:model="edadMax">
        </div>
    </div>

    <!-- Tabla de pacientes -->
    <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2 table-striped table-bordered">
        <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Edad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
                <tr>
                    <td class=" text-primary font-weight-bold">{{ $paciente->primer_nombre }}</td>
                    <td class=" text-primary font-weight-bold">{{ $paciente->primer_apellido }}</td>
                    <!-- Formatear fecha de nacimiento en la vista -->
                    <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <!-- Calcular edad -->
                    <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</td>
                    <td>
                        <!-- Condicional para mostrar diferentes badges -->
                        @php
                            $edad = \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age;
                        @endphp
                        @if($edad < 18)
                            <span class="badge badge-info">Menor de edad</span>
                        @elseif($edad >= 18 && $edad <= 60)
                            <span class="badge badge-success">Adulto</span>
                        @else
                            <span class="badge badge-warning">Mayor</span>
                        @endif

                        <!-- También puedes condicionar por enfermedades -->
                        @if($paciente->enfermedad_cronica)
                            <span class="badge badge-danger">Paciente Crónico</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron pacientes con {{ $enfermedad }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $pacientes->links() }}
    </div>

    <!-- Porcentaje de pacientes -->
    <div class="mt-3">
        <p class=" text-dark ">Total pacientes con {{ $enfermedad }}: <span class=" badge badge-danger">{{ $pacientes->total() }}</span> </p>
        <p class=" text-dark">Porcentaje sobre el total de pacientes: <span class=" badge badge-success">{{ number_format($porcentaje, 2) }}%</span> </p>
    </div>
</div>
