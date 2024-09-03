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


  </head>
    
<body>
    
</body>
</html>

@extends('adminlte::page')

@section('title', 'AdminSalud')




@section('content')
<div class="container">
    
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol id="breadcrumb" class="breadcrumb mb-0  text-light">
                    <li class="breadcrumb-item">Hogar</li>
                    <li class="breadcrumb-item active" aria-current="page"> </li>
                </ol>
            </nav>
        </div>
        
     
      <div class="row">
        
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-right">
           
           
        </div>
    </div>
        <div class="card">
            <div class="card-body bt-secunadrio">
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <i class="fa-sharp fa-solid fa-notes-medical fa-2x mb-1"></i>
                        <div>Notas Médicas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-flask fa-2x mb-1"></i>
                        <div>Laboratorio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-user-nurse fa-2x mb-1"></i>
                        <div>Enfermera</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-vials fa-2x mb-1"></i>
                        <div>Viales</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-users-medical fa-2x mb-1"></i>
                        <div>Equipo Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-x-ray fa-2x mb-1"></i>
                        <div>Rayos X</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-wheelchair-move fa-2x mb-1"></i>
                        <div>Wheelchair</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-weight-scale fa-2x mb-1"></i>
                        <div>Balanza</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-wave-pulse fa-2x mb-1"></i>
                        <div>Frecuencia</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-vial-circle-check fa-2x mb-1"></i>
                        <div>Pruebas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-thermometer fa-2x mb-1"></i>
                        <div>Termómetro</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-syringe fa-2x mb-1"></i>
                        <div>Jeringa</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-suitcase-medical fa-2x mb-1"></i>
                        <div>Kit Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-stretcher fa-2x mb-1"></i>
                        <div>Camilla</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-staff-snake fa-2x mb-1"></i>
                        <div>Esculapio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-prescription-bottle-medical fa-2x mb-1"></i>
                        <div>Recetas</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-pills fa-2x mb-1"></i>
                        <div>Medicamentos</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-microscope fa-2x mb-1"></i>
                        <div>Microscopio</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-house-medical-circle-check fa-2x mb-1"></i>
                        <div>Centro Médico</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-hospital-user fa-2x mb-1"></i>
                        <div>Paciente</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-heart-pulse fa-2x mb-1"></i>
                        <div>Cardiología</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-folder-medical fa-2x mb-1"></i>
                        <div>Historia Clínica</div>
                    </div>
                    <div class="col-auto text-center">
                        <i class="fa-solid fa-comment-medical fa-2x mb-1"></i>
                        <div>Consulta</div>
                    </div>
                </div>
            </div>
              <br>
            
            
       </div>
</div>

         <br>
  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            doc.html(document.body, {
                callback: function (doc) {
                    doc.save('hoja_de_identificacion_paciente.pdf');
                },
                x: 10,
                y: 10
            });
        }
    </script>



       

    </div>


    @livewireScripts
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
   
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
   

</script>
@stop
</section>