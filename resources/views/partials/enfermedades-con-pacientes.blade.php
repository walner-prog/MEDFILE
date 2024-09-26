
<div class="container">
    <h6>Enfermedades con Pacientes y  número de pacientes por cada enfermedad crónica</h6>

    @if($enfermedadesConPacientes->isEmpty())
        <p>No se encontraron enfermedades registradas con pacientes.</p>
    @else
    <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2">
        <thead class="from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Enfermedad</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Total de Pacientes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enfermedadesConPacientes as $enfermedad)
                    <tr>
                        <td>{{ $enfermedad->enfermedades_cronicas }}</td>
                        <td>{{ $enfermedad->pacientes_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>