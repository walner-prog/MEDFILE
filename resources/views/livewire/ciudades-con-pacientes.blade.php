<div>
    <h3 class="text-dark">Ciudades y Pacientes</h3>

    <div class="mb-4">
        <input type="text" wire:model="searchCiudad" placeholder="Buscar por ciudad" class="form-control" />
    </div>

    @if ($ciudadesConPacientes->count() > 0)
        <div class="table-responsive">
            <table class="p-2 table-bordered min-w-full w-100 border border-gray-300 shadow-md rounded-lg table-striped">
                <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                    <tr>
                        <th class="p-1 text-indigo-600">Ciudad</th>
                        <th class="p-1 text-indigo-600">Número de Pacientes</th>
                        <th class="p-1 text-indigo-600">Estado</th> <!-- Nueva columna para estado -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ciudadesConPacientes as $ciudad)
                        <tr>
                            <td class="p-1">
                                <span>{{ $ciudad->departamento }}</span>
                            </td>
                            <td class="p-1">
                                <span class="badge bg-primary">{{ $ciudad->pacientes_count }}</span>
                            </td>
                            <td class="p-1">
                                <!-- Condición para mostrar diferentes badges -->
                                @if ($ciudad->pacientes_count > 10)
                                    <span class="badge bg-success">Alta</span>
                                @elseif ($ciudad->pacientes_count > 5)
                                    <span class="badge bg-warning">Media</span>
                                @else
                                    <span class="badge bg-danger">Baja</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total Pacientes:</strong></td>
                        <td><strong>{{ $ciudadesConPacientes->sum('pacientes_count') }}</strong></td>
                        <td></td> <!-- Columna vacía para el total -->
                    </tr>
                    <tr>
                        <td><strong>Total Hombres:</strong></td>
                        <td><strong>{{ $totalHombres }}</strong></td>
                        <td></td> <!-- Columna vacía para el total -->
                    </tr>
                    <tr>
                        <td><strong>Total Mujeres:</strong></td>
                        <td><strong>{{ $totalMujeres }}</strong></td>
                        <td></td> <!-- Columna vacía para el total -->
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $ciudadesConPacientes->links() }} <!-- Esto genera los enlaces de paginación -->
        </div>
    @else
        <div class="alert alert-warning mt-3">
            No se encontraron registros de ciudades con pacientes.
        </div>
    @endif
</div>
