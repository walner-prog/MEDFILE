<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
     
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
     
      @livewireStyles
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <!-- Tailwind CSS CDN -->
      <script src="https://cdn.tailwindcss.com"></script>
      <head>
        <script>
          (function() {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
              document.documentElement.classList.add('dark-mode');
              document.documentElement.classList.remove('light-mode');
            } else if (currentTheme === 'light') {
              document.documentElement.classList.add('light-mode');
              document.documentElement.classList.remove('dark-mode');
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              document.documentElement.classList.add('dark-mode');
            } else {
              document.documentElement.classList.add('light-mode');
            }
          })();
        </script>
        <!-- Resto de tu <head> -->
      </head>
 <style>
    .fa-2x{
        color:rgb(109, 154, 154);
    }
    h3{
        color:cadetblue;
    }
 </style>

  </head>
    
<body>
    
@extends('adminlte::page')

@section('title', 'AdminSalud')




@section('content')
<div class="container mt-4 toggle-container">
    <br>
   

    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">PANEL </li>
                    <li class="breadcrumb-item active" aria-current="page"> MEDFILE</li>
                </ol>
            </nav>
        </div>
        
    </div>
       <div class="row">
        
          <div class="col-lg-4"></div>
          <div class="col-lg-4 text-right">
           
           
        </div>
  
    
        
            <div class="container-fluid container-lg">
                <div class="row">
                    <!-- Usuarios -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <!-- Ícono en la esquina superior izquierda -->
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-info ">
                                <i class="fas fa-users fa-2x "></i>
                              </div>
                            </div>
                            <!-- Cantidad en la esquina superior derecha -->
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $usersCount }}</h3>
                            </div>
                          </div>
                          <!-- Texto centrado debajo de la cantidad -->
                          <p class="text-muted text-center">Usuarios</p>
                          
                          <!-- Footer con enlace -->
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('usuarios.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Pacientes -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-success">
                                <i class="fas fa-procedures fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $pacientesCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Pacientes</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('pacientes.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Citas -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-warning">
                                <i class="fas fa-calendar-check fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $citasCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Citas</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('citas.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Doctores -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-danger">
                                <i class="fas fa-user-md fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $doctoresCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Doctores</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('doctores.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <!-- Historias Clínicas -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-primary">
                                <i class="fas fa-file-medical-alt fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $historiasClinicasCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Historias Clínicas</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('historias_clinicas.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Especialidades -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-info">
                                <i class="fas fa-stethoscope fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $especialidadesCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Especialidades</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('especialidades.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Control Medicamentos -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-warning">
                                <i class="fas fa-pills fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $controlMedicamentosCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Control Medicamentos</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('control_medicamentos.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Admisión y Egreso Hospitalario -->
                    <div class="col-lg-3 col-sm-6">
                      <div class="card border border-info">
                        <div class="content">
                          <div class="row">
                            <div class="col-xs-4 ml-3 mt-2 text-left">
                              <div class="icon-big icon-danger">
                                <i class="fas fa-hospital-alt fa-2x"></i>
                              </div>
                            </div>
                            <div class="col-xs-8 col-lg-8 text-right mr-4 mt-2">
                              <h3>{{ $admisionEgresoCount }}</h3>
                            </div>
                          </div>
                          <p class="text-muted text-center">Admisión y Egreso</p>
                          <div class="footer">
                            <hr />
                            <div class="stats text-center">
                              <a href="{{ route('registro_admision_hospitalario.index') }}"><i class="fas fa-eye"></i> Ver Detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
            </div>

            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-12">
                    
                            <div class="w-full lg:w-2/3 w-100 bg-white char-grafica text-dark shadow-lg rounded-lg p-6">
                                <h3 class="text font-bold text-left mb-4 ">Pacientes por Ciudad</h3>
                                <canvas id="pacientesChart" width="400" height="200"></canvas>
                              
                            </div>
                     
                    </div>
                </div>
                
            </div>
            
            
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="w-full lg:w-2/3 w-100 bg-white char-grafica text-dark shadow-lg rounded-lg p-6">
                            <h3 class="text font-bold text-left mb-4">Pacientes por Enfermedad Crónica</h3>
                            <canvas id="pacientesChart_enfermedades" width="400" height="200"></canvas>
                           

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="w-full lg:w-2/3 w-100 bg-white char-grafica text-dark shadow-lg rounded-lg p-6">
                            <h2 class="text font-bold text-center mb-4">Pacientes por Género
                            </h2>
                            <canvas id="pacientesGeneroChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-12">
                    
                            <div class="w-full lg:w-2/3 w-100 bg-white char-grafica text-dark shadow-lg rounded-lg p-6">
                                <h3 class="text font-bold text-left mb-4 ">Distribución de Pacientes por Edad</h3>
                                <canvas id="ageDistributionChart" width="400" height="200"></canvas>
                               
                            </div>
                     
                    </div>
                </div>
                
            </div>
          
           
        

</div>

         <br>
  
      
     
         
     
     


    @livewireScripts
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

  
  <!-- JS de DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

 <!-- CDN de Buttons para DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>


<script>
  var ctx = document.getElementById('pacientesChart').getContext('2d');
var pacientesCiudadChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($ciudades),
        datasets: [{
            label: '# de Pacientes',
            data: @json($totales),
            backgroundColor: [
                'rgba(54, 162, 235, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            barThickness: 50 // Ajusta el grosor de las barras
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 16 // Tamaño del texto en el eje Y
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 16 // Tamaño del texto en el eje X
                    }
                }
            }
        },
        plugins: {
            title: {
                 display: true,
                 text: 'Total de pacientes por ciudades',
                 },
            legend: {
                display: true,
                position: 'bottom', // Leyenda en la parte inferior
                labels: {
                    boxWidth: 20, // Ancho del cuadro de color
                    padding: 15, // Espaciado entre el cuadro y el texto
                    font: {
                        size: 16 // Tamaño del texto en la leyenda
                    },
                    generateLabels: function(chart) {
                        // Personalizar los colores de la leyenda con los colores del dataset
                        return chart.data.labels.map(function(label, i) {
                            return {
                                text: label, // Mostrar el nombre de cada ciudad
                                fillStyle: chart.data.datasets[0].backgroundColor[i], // Color del cuadro
                                strokeStyle: chart.data.datasets[0].borderColor[i], // Borde del cuadro
                                lineWidth: 1
                            };
                        });
                    }
                }
            }
        },
        maintainAspectRatio: true
    }
});


</script>
<script>
    var ctx = document.getElementById('pacientesChart_enfermedades').getContext('2d');

    var colores = [
    'rgba(54, 162, 235, 0.6)', // Color para Hipertensión arterial
    'rgba(75, 192, 192, 0.6)', // Color para Enfermedad renal crónica
    'rgba(255, 206, 86, 0.6)',  // Color para Enfermedad cardíaca
    // Agrega más colores si es necesario
      ];
    var pacientesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($enfermedades),
            datasets: [{
                label: '# de Pacientes',
                data: @json($totales_enfermedades),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 5,
                barThickness: 200 // Ajusta el grosor de las barras
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 16 // Tamaño del texto en el eje Y
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 16 // Tamaño del texto en el eje X
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Total de Pacientes por Enfermedad Crónica',
                },
                legend: {
                    display: true,
                    position: 'bottom', // Leyenda en la parte inferior
                    position: 'top',

                    labels: {
                        boxWidth: 20, // Ancho del cuadro de color
                        padding: 15, // Espaciado entre el cuadro y el texto
                      
                        font: {
                            size: 16, // Tamaño del texto en la leyenda
                            color: 'rgba(0, 0, 0, 1)' 
                        },
                        generateLabels: function(chart) {
                            // Personalizar los colores de la leyenda con los colores del dataset
                            return chart.data.labels.map(function(label, i) {
                                return {
                                    text: label, // Mostrar el nombre de cada enfermedad
                                    fillStyle: chart.data.datasets[0].backgroundColor[i], // Color del cuadro
                                    strokeStyle: chart.data.datasets[0].borderColor[i], // Borde del cuadro
                                    lineWidth: 1
                                };
                            });
                        }
                    }
                }
            },
            maintainAspectRatio: true
        }
    });
    </script>

<script>
    var ctx = document.getElementById('pacientesGeneroChart').getContext('2d');
    var pacientesGeneroChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Masculino', 'Femenino', 'Otro'],
            datasets: [{
                data: @json($pacientesPorGenero->pluck('total')),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Pacientes por Género'
                },
                legend: {
                    display: true,
                    position: 'bottom',
                }
            }
        }
    });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos desde el backend
        const ageDistribution = @json(array_values($rangos));
        const labels = @json(array_keys($rangos));

        // Crear el gráfico de barras
        const ctx = document.getElementById('ageDistributionChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Rango de edades
                datasets: [{
                    label: 'Número de Pacientes',
                    data: ageDistribution, // Número de pacientes por rango
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderWidth: 5,
                    barThickness: 200 // Ajusta el grosor de las barras
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@stop

</body>
</html>
