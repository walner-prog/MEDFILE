<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total de Consultas por Enfermedad</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .card {
            margin-bottom: 20px;
        }
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="mb-4">Total de Consultas por Enfermedad</h4>

        @if($enfermedades->isEmpty())
            <div class="alert alert-info" role="alert">
                No se encontraron enfermedades registradas en las historias clínicas.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Resumen de Consultas por Enfermedad</h5>
                </div>
                <div class="card-body">
                    <table class="min-w-full w-100 border border-gray-300 shadow-md rounded-lg p-2">
                        <thead class="from-green-500 to-green-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Enfermedad</th>
                                <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Total de Consultas</th>
                                <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Porcentaje de Pacientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enfermedades as $enfermedad => $count)
                                <tr>
                                    <td>{{ $enfermedad }}</td>
                                    <td>{{ $count }}</td>
                                    <td>{{ number_format(($count / $totalPacientes) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Pacientes Registrados</h5>
                    <p class="card-text text-dark">{{ $totalPacientes }}</p>
                </div>
            </div>

            <!-- Gráficos -->
           
        @endif
    </div>

    <!-- Incluye Bootstrap JS y Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
