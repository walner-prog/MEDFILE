<!-- Registros de Admisión/Egreso -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Registros de Admisión/Egreso</h5>
            </div>
            <div class="card-body">
                <p>Total de registros: <strong>{{ $registrosAdmisionEgreso->total() }}</strong></p>
                @if($registrosAdmisionEgreso->count() > 0)
                    <ul class="list-group">
                        @foreach($registrosAdmisionEgreso as $registro)
                            <li class="list-group-item">
                                <a href="{{ route('registro_admision_hospitalario.show', $registro->id) }}">
                                    Ver Registro de Admisión/Egreso - <span class=" text-white"></span> {{ $registro->egreso_fecha }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <!-- Paginación -->
                    <nav aria-label="Page navigation">
                        {{ $registrosAdmisionEgreso->links('pagination::bootstrap-4') }}
                    </nav>
                    
                @else
                    <p>No hay registros de admisión o egreso disponibles.</p>
                @endif
            </div>
        </div>
    </div>
</div>
