<div class="container mt-4 mb-5">
    <h3>Pacientes para Análisis IA</h3>

    <!-- Campo de búsqueda -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar por N° Expediente o Cédula"
               wire:model="search"> <!-- Vincula el campo de búsqueda a la propiedad search -->
    </div>

    @if ($noResults)
        <div class="alert alert-warning">No se encontraron resultados.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N° Expediente</th>
                    <th>Nombres y Apellidos</th>
                    <th>Cedula</th>
                    <th>Edad</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->no_expediente }}</td>
                        <td>
                            {{ $paciente->primer_nombre }} 
                            {{ $paciente->segundo_nombre }} 
                            {{ $paciente->primer_apellido }} 
                            {{ $paciente->segundo_apellido }}
                        </td>
                        <td>{{ $paciente->no_cedula }}</td>
                        <td>{{ $paciente->edad }}</td>
                        <td>
                            @if ($paciente->historiasClinicas->isNotEmpty())
                                <a href="{{ route('mostrar.historia', $paciente->historiasClinicas->first()->id) }}" class="btn btn-primary">
                                    IA Historia Clínica
                                </a>
                            @else
                                <span class="text-muted">Sin analis</span>
                            @endif
                        </td>
                        <td>
                            @if ($paciente->historiasClinicas->isNotEmpty())
                            <a href="{{ route('historias_clinicas.show',$paciente->historiasClinicas->first()->id) }}" class="btn btn-primary" target="blank">Ver Historia Clínica</a>
                            @else
                                <span class="text-muted">Sin historia clínica</span>
                            @endif
                        </td>
                        
                        

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div>
            {{ $pacientes->links() }} <!-- Esto generará los enlaces de paginación -->
        </div>
    @endif
</div>
