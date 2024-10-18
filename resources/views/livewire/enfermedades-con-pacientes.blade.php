<div>
    <h3 class="text-dark">Enfermedades Crónicas y Pacientes</h3>

    

    @if ($enfermedadesConPacientes->count() > 0)
    <div class="table-responsive">
        <table class=" p-2 table-bordered min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2 table-striped table-bordered">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <tr>
                    <th class=" p-1 text-indigo-600">Enfermedad Crónica</th>
                    <th class=" p-1 -indigo-600">Número de Pacientes</th>
                    <th class=" p-1 text-indigo-600">Estado</th> <!-- Nueva columna para estado -->
                </tr>
            </thead>
            <tbody>
                @foreach ($enfermedadesConPacientes as $enfermedad)
                    <tr>
                        <td class="p-1">
                            <span class="">{{ $enfermedad->enfermedades_cronicas }}</span>
                        </td>
                        <td class="p-1">
                            <span class="badge bg-primary">{{ $enfermedad->pacientes_count }}</span>
                        </td>
                        <td class="p-1">
                            <!-- Condición para mostrar diferentes badges -->
                            @if ($enfermedad->pacientes_count > 10)
                                <span class="badge bg-success">Alta</span>
                            @elseif ($enfermedad->pacientes_count > 5)
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
                    <td><strong>{{ $enfermedadesConPacientes->sum('pacientes_count') }}</strong></td>
                    <td></td> <!-- Columna vacía para el total -->
                </tr>
            </tfoot>
        </table>
    </div>
        

        <!-- Paginación -->
        <div class="mt-4">
            {{ $enfermedadesConPacientes->links() }} <!-- Esto genera los enlaces de paginación -->
        </div>
    @else
        <div class="alert alert-warning mt-3">
            No se encontraron registros de enfermedades crónicas.
        </div>
    @endif
</div>
