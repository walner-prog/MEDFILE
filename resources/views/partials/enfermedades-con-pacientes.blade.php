
<div class="container">
    <h1>Enfermedades con Pacientes y  número de pacientes por cada enfermedad crónica</h1>

    @if($enfermedadesConPacientes->isEmpty())
        <p>No se encontraron enfermedades registradas con pacientes.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Enfermedad</th>
                    <th>Total de Pacientes</th>
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