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
        <h1 class="mb-4">Total de Consultas por Enfermedad</h1>

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
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Enfermedad</th>
                                <th>Total de Consultas</th>
                                <th>Porcentaje de Pacientes</th>
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
                    <p class="card-text">{{ $totalPacientes }}</p>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Distribución de Consultas por Enfermedad</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="enfermedadesChart"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Incluye Bootstrap JS y Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Script para Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('enfermedadesChart').getContext('2d');
            var enfermedadesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($enfermedades->keys()), // Etiquetas de enfermedades
                    datasets: [{
                        label: 'Total de Consultas',
                        data: @json($enfermedades->values()), // Datos de consultas
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
