<div class="container">
    <h4 class="mb-4">Pacientes Filtrados</h4>

    @if($pacientes->isEmpty())
        <div class="alert alert-info" role="alert">
            No se encontraron pacientes con los criterios especificados.
        </div>
    @else
        <div class="table-responsive">
            <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2 table-bordered p-4">
                <thead class="from-green-500 to-green-600 text-white ">
                    <tr>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Nombre</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Edad</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Sexo</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Dirección</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Ciudad</th>
                        <th class="px-6 py-3 p-2 text-left text-base font-medium tracking-wider border-b border-gray-200">Enfermedad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td class=" p-2">{{ $paciente->no_expediente }}</td>
                            <td class=" p-2">{{ $paciente->primer_nombre }} {{ $paciente->primer_apellido }}</td>
                            <td class=" p-2">{{ $paciente->edad }}</td>
                            <td class=" p-2">{{ $paciente->sexo }}</td>
                            <td class=" p-2">{{ $paciente->direccion_residencia }}</td>
                            <td class=" p-2">{{ $paciente->municipio }}</td>
                            <td class=" p-2">
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