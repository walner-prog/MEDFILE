<div>
    <h3 class="text-dark">Pacientes por Enfermedad Común</h3>

    <!-- Filtros de búsqueda por año y mes -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <input type="number" class="form-control" wire:model="searchAnio" placeholder="Buscar por año..." />
        </div>
        <div class="col-lg-6">
            <select class="form-control" wire:model="searchMes">
                <option value="">Seleccionar mes</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Tabla de pacientes -->
    @if ($pacientes->count() > 0)
        <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2 table-striped table-bordered">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <tr>
                    <th class="text-indigo-600">Nombre</th>
                    <th class="text-indigo-600">Apelliudo</th>
                    <th class="text-indigo-600">Edad</th>
                    <th class="text-indigo-600">Enfermedad Crónica</th>
                    <th class="text-indigo-600">Porcentaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                    @php
                        $badgeClass = $porcentaje >= 50 ? 'bg-success' : 'bg-warning';
                    @endphp
                    <tr>
                        <td class="text-primary font-weight-bold">{{ $paciente->primer_nombre }}</td>
                        <td class=" text-primary font-weight-bold">{{ $paciente->primer_apellido }}</td>
                        <td class=" text-primary">{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }}</td>
                        <td>{{ $enfermedad->enfermedades_cronicas }}</td>
                        <td>
                            <span class="badge {{ $badgeClass }}">
                                {{ number_format($porcentaje, 2) }}%
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Agrega los enlaces de paginación -->
        <div class="mt-3">
            {{ $pacientes->links() }}
        </div>
    @else
        <div class="alert alert-warning mt-3">
            No se encontraron pacientes con la enfermedad seleccionada.
        </div>
    @endif
</div>
