<div class=" ">
    <h2 class="text-primary">Estadísticas de Historias Clínicas</h2>
    <p class=" text-dark">Total de Pacientes: 
        <span class="badge bg-info">{{ $totalPacientes }}</span>
    </p>
    <p class=" text-dark">Total de Historias Clínicas: 
        <span class="badge bg-info">{{ $totalHistorias }}</span>
    </p>
    <p class=" text-dark">Pacientes con Enfermedades Crónicas: 
        <span class="badge bg-warning">{{ $enfermedadesCronicasCount }}</span>
    </p>
    <p class=" text-dark">Porcentaje de Pacientes que Fuman: 
        <span class="badge 
            @if ($porcentajeTabaco > 20) bg-danger 
            @elseif ($porcentajeTabaco > 10) bg-warning 
            @else bg-success 
            @endif">
            {{ number_format($porcentajeTabaco, 2) }}%
        </span>
    </p>
    <p class=" text-dark">Porcentaje de Pacientes que Consumen Alcohol: 
        <span class="badge 
            @if ($porcentajeAlcohol > 20) bg-danger 
            @elseif ($porcentajeAlcohol > 10) bg-warning 
            @else bg-success 
            @endif">
            {{ number_format($porcentajeAlcohol, 2) }}%
        </span>
    </p>
    <p class=" text-dark">Porcentaje de Pacientes que Usan Drogas Ilegales: 
        <span class="badge 
            @if ($porcentajeDrogas > 20) bg-danger 
            @elseif ($porcentajeDrogas > 10) bg-warning 
            @else bg-success 
            @endif">
            {{ number_format($porcentajeDrogas, 2) }}%
        </span>
    </p>
</div>
