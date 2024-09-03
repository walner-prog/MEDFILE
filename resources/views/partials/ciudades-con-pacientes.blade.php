<div class="container">
    <h1>Ciudades con Pacientes</h1>

    @if($ciudadesConPacientes->isEmpty())
        <p>No se encontraron ciudades con pacientes registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ciudad</th>
                    <th>Total de Pacientes</th>
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