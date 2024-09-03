<div class="container">
    <h1 class="mb-4">Pacientes Filtrados</h1>

    @if($pacientes->isEmpty())
        <div class="alert alert-info" role="alert">
            No se encontraron pacientes con los criterios especificados.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No. Expediente</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Enfermedad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->no_expediente }}</td>
                            <td>{{ $paciente->primer_nombre }} {{ $paciente->primer_apellido }}</td>
                            <td>{{ $paciente->edad }}</td>
                            <td>{{ $paciente->sexo }}</td>
                            <td>{{ $paciente->direccion_residencia }}</td>
                            <td>{{ $paciente->municipio }}</td>
                            <td>
                                @foreach($paciente->historiasClinicas as $historia)
                                    {{ $historia->enfermedades_cronicas }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{ $pacientes->links() }}
    
</div>