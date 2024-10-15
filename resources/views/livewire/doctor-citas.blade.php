<div>
    <h2>Mis Citas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->primer_apellido }}</td>
                    <td>{{ $cita->especialidad->nombre }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->notas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($citas->isEmpty())
        <div class="alert alert-warning">
            No tienes citas agendadas.
        </div>
    @endif
</div>
