@foreach ($pacientes as $paciente)
    <p>{{ $paciente->primer_nombre }} {{ $paciente->primer_apellido }} - Edad: {{ now()->diffInYears($paciente->fecha_nacimiento) }}</p>
@endforeach

{{ $pacientes->links() }}
