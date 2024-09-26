<div class="container">
    <h6>Ciudades con Pacientes</h6>

    @if($ciudadesConPacientes->isEmpty())
        <p>No se encontraron ciudades con pacientes registrados.</p>
    @else
        <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2">
            <thead class="from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Ciudad</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Total de Pacientes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ciudadesConPacientes as $ciudad)
                    <tr>
                        <td>{{ $ciudad->departamento }}</td>
                        <td>{{ $ciudad->pacientes_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Ciudades sin Pacientes</h2>

    @if($ciudadesSinPacientes->isEmpty())
        <p>No se encontraron ciudades sin pacientes registrados.</p>
    @else
        <ul>
            @foreach($ciudadesSinPacientes as $ciudad)
                <li>{{ $ciudad->localidad }}</li>
            @endforeach
        </ul>
    @endif
</div>