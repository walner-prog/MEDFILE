{{-- @extends('layouts.app') --}}

<section>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">


   
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
 
  @extends('adminlte::page')
    
  @section('title', 'Panel de venta')
  
  
  

@section('content')
<div class="container mt-5 toggle-container">
    <p class=" text-orange">Cambiar a <span id="mode-text">modo oscuro</span></p>
      <label class="switch">
        <input type="checkbox" id="theme-toggle">
        <span class="slider"></span>
      </label>
    <br>
    <div class="d-flex justify-content-between mb-4">
        <h1 class=" text-muted"> Reporte de Ventas</h1>
        <hr>
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDetalle">
            Detalles del Módulo
        </button>
    </div>
    
    <div class="row">
        <!-- Ventas del Día -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ventas del Día</h5>
                        </div>
                        <div class="col-auto">
                            
                            <div class="stat text-orange">
                                <i class="fas fa-chart-line align-middle fa-5x"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 text-success">{{ $totalVentasDia_venta }} </h1>
                    <div class="mb-0">
                        <span class="text-muted">Productos vendidos de hoy</span>
                        <li><i class="fas fa-calendar-day text-warning fa-2x"></i> Hoy:   <h1 class="badge badge-primary custon-badge">{{ $totalProductosVendidosDia }} </h1></li>
                        <p class="text-dark">Total de ventas hoy en córdobas: <br>   <span class="badge badge-primary custon-badge">C$ {{ $totalVentasDia }}</span>
                        <p class="text-dark">Ganancia de hoy en córdobas: <br>    <span class="badge badge-primary custon-badge">C$ {{ $gananciaDia }}</span></p>
                    </div>                                 
                </div>
            </div>
        </div>
        <!-- Ventas de la Semana -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ventas de la Semana</h5>
                        </div>
                        <div class="col-auto">
                            
                            <div class="stat text-orange">
                                <i class="fas fa-money-bill-wave align-middle fa-5x"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 text-success">{{ $totalVentasSemana }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Productos vendidos Esta Semana</span>
                        <li><i class="fas fa-calendar-week text-warning fa-2x"></i> Esta Semana: <h1 class="badge badge-primary custon-badge">{{ $totalProductosVendidosSemana }}</h1></li>  
                    </div>
                </div>
            </div>
        </div>
        <!-- Ventas del Mes -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ventas del Mes</h5>
                        </div>
                        <div class="col-auto">
                           
                            <div class="stat text-orange">
                                <i class="fas fa-chart-bar align-middle fa-5x"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 text-success">{{ $totalVentasMes }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Productos vendidos Este Mes</span>
                        <li><i class="fas fa-calendar-alt text-warning fa-2x"></i> Este Mes: <h1 class="badge badge-primary custon-badge">{{ $totalProductosVendidosMes_ }}</h1> </li>
                        <p class="text-dark">Total de ventas este mes en córdobas: <br> <span class="badge badge-primary custon-badge">C$ {{ $totalVentasMes_ }} </span> </p> 
                        <p class="text-dark">Ganancia de este mes en córdobas: <br><span class="badge badge-primary custon-badge">C$ {{ $gananciaMes }}</span></p> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Ventas del Año -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ventas del Año</h5>
                        </div>
                        <div class="col-auto">
                           
                            <div class="stat text-orange">
                                <i class="fas fa-file-alt align-middle fa-5x"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 text-success">{{ $totalVentasAnio }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Productos vendidos Este Año</span>
                        <li><i class="fas fa-calendar text-warning fa-2x"></i> Este Año: <h1 class="badge badge-primary custon-badge">{{ $totalProductosVendidosAnio }}</h1></li> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      <hr>
      <div class="row">
        <div class="col-lg-4">
            <h2 class="text-muted">Ventas por Cliente</h2>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Total Ventas en C$</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventasPorCliente as $venta)
                    <tr>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td><span class="text-indigo">C$</span> {{ $venta->total_ventas }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-info">
                        <td><strong>Total General:</strong></td>
                        <td><strong>C$ {{ $ventasPorCliente->sum('total_ventas') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        
        <div class="col-lg-8">
            <h2 class="text-muted">Ventas por Productos</h2>
          
            <table class="table table-bordered table-striped" id="ReporteTablex">
                <thead class="bg-dark">
                    <tr>
                        <th>ID Venta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventasPorProductos as $venta)
                        @foreach ($venta->productos as $producto)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->pivot->cantidad }}</td>
                                <td class="text-success">C$ {{ number_format($producto->precio, 2) }}</td>
                                <td class="text-primary">C$ {{ number_format($producto->pivot->cantidad * $producto->precio, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            
            
        </div>
        
     
      </div>
  
  
  <hr>
  <h2 class="text-muted text-center">Ventas por Fecha</h2>
   <div class="row mt-3">
 
    <div class="col-lg-12">
        <form action="{{ route('reportes.index') }}" method="GET">
            <div class="form-row align-items-center">
                <div class="col-md-4 mb-2">
                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $fechaInicio }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="fecha_fin">Fecha de Fin:</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $fechaFin }}">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-info">Filtrar</button>
                </div>
            </div>
        </form>

        
            

                <h2 class="text-muted text-center">Resumen de Ventas</h2>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Reporte de Ventas</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Total de ventas en cordobas</h6>
                                        <p class="h2"><i class="fas fa-dollar-sign text-primary"></i> C$ {{ number_format($totalVentas, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Total de productos vendidos</h6>
                                        <span>Este es el total de los diferentes productos del stock </span>
                                        <p class="h2"><i class="fas fa-cube text-success"></i> {{ $totalProductos }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Promedio de ventas por cliente</h6>
                                        <p class="h2"><i class="fas fa-user-friends text-info"></i> C$ {{ number_format($promedioVentasPorCliente, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Producto más vendido</h6>
                                        <p class="h2"><i class="fas fa-star text-warning"></i> 
                                            @if ($nombreProductoMasVendido != 'No disponible')
                                                {{ $nombreProductoMasVendido }} ({{ $cantidadVendidaProductoMasVendido }} unidades)
                                            @else
                                                No hay datos disponibles.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Cliente principal</h6>
                                        <p class="h2"><i class="fas fa-user text-primary"></i> 
                                            @if ($nombreClientePrincipal != 'No disponible')
                                                {{ $nombreClientePrincipal }} ({{ $cantidadComprasClientePrincipal }} compras)
                                            @else
                                                No hay datos disponibles.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Total ventas del mes anterior</h6>
                                        <p class="h2"><i class="fas fa-calendar-alt text-danger"></i> C$ {{ number_format($totalVentasMesAnterior, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Total ventas del mismo mes del año anterior</h6>
                                        <p class="h2"><i class="fas fa-calendar text-secondary"></i> C$ {{ number_format($totalVentasMismoMesAnoAnterior, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h6 class="text-uppercase">Margen de Ganancia</h6>
                                        <p class="h2"><i class="fas fa-chart-line text-success"></i> C$ {{ number_format($margenGanancia, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
    </div>
    <div class="col-lg-10">
        <table class="table table-bordered" id="ReporteTable">
            <thead class="bg-gradient-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Total Productos</th> <!-- Nueva columna -->
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas_filter as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->usuario->name }}</td>
                    <td>
                        @foreach ($venta->productos as $producto)
                            {{ $producto->nombre }} <br> 
                        @endforeach
                    </td>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                    <td>C$ {{ $venta->total }}</td>
                    <td>{{ count($venta->productos) }}</td> <!-- Mostrar el total de productos -->
                </tr>
                @endforeach
               
                
            </tbody>
        </table>
        <ul>
           
        </ul>
    </div>
    
   
    
   </div>

   <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalDetalleLabel">Detalles del Módulo de Reportes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body text-muted">
                <p>El módulo de reportes permite visualizar y analizar datos de ventas de manera detallada. A continuación, se presentan algunas características y funcionalidades clave:</p>
                <ul>
                    <li><strong>Filtros Disponibles:</strong> Puedes filtrar las ventas por fecha, cliente, empleado, productos vendidos, entre otros criterios.</li>
                    <li><strong>Información Mostrada:</strong> El módulo muestra información como el total de ventas, productos vendidos, promedios por cliente, ventas por producto, y más.</li>
                    <li><strong>Análisis de Datos:</strong> Proporciona análisis detallados como ventas por cliente, ventas por producto, comparativas con meses anteriores, y margen de ganancia.</li>
                </ul>
                <p>Para utilizar el módulo de reportes, selecciona los filtros deseados y haz clic en "Filtrar". Los resultados se actualizarán dinámicamente sin necesidad de recargar la página.</p>
                <p>Interpreta los datos mostrados para tomar decisiones informadas sobre estrategias de ventas, seguimiento de clientes destacados, y análisis de rendimiento del equipo de ventas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@stop

  
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  @stop
  
  @section('js')
  <script src="{{ mix('js/app.js') }}"></script>

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

    // data table para la priemer tabla 
    $(document).ready(function() {
        $('#ReporteTablex').DataTable({
           /* "select":"true",

            select: {
                items:'cell',
            },*/
            scrollX: true,
            scrollY: 400, // Ajusta la altura máxima que deseas
            fixedHeader: true,
            "language" : {
                "search" :   "Buscar ",
                "lengthMenu" : "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "info"      : "Mostrando página _PAGE_ de _PAGES_",
                "paginate"  :  {
                    "previous"  : "Anterior ",
                    "next"       : "Siguiente",
                    "first"       : "Primero",
                    "last"        : "Último",
                },
                "sProcessing":"Procesando...",
            },
            "lengthMenu": [[5, 15, 50, -1], [5, 15, 50, "Todos"]],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i>',
                titleAttr: 'Copiar',
                className: 'bg-secondary',
                exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    }
            },
            {
                extend: 'excel',
                text:      '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'bg-success',
                exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    }
            },
            {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'bg-danger',
                    exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    },
                    customize: function (doc) {
                        doc.content.splice(0, 1, {
                            text: [
                                { text: 'Tabla de Categorias \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                                { text: 'Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '\n', fontSize: 12, italics: true },
                                { text: 'Usuario: ' + '{{ Auth::user()->name }}' + '\n\n', fontSize: 12, italics: true }
                            ]
                        });
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Fecha: ', { text: new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['Página ', { text: page.toString() },  ' de ', { text: pages.toString() }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'bg-info',
                    exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    },
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<h3>Tabla de Categorias</h3>' +
                                '<p>Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '</p>' +
                                '<p>Usuario: ' + '{{ Auth::user()->name }}' + '</p>'
                            );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
            {
                extend: 'colvis',
                text: '<i class="fas fa-eye"> ',
                    titleAttr: 'Ocultar colunna',
                className: 'bg-dark'
            },
            

        ],
           /*
         
           columnDefs: [
                {
                    "targets": 1, // Última columna (Acciones)
                    "visible": false, // Visible en la tabla principal
                    "searchable": false, // No buscar en esta columna
                    "orderable": false, // No ordenar por esta columna
                },
                columnDefs: [
                {
                    "targets": 4, // Última columna (Acciones)
                    "className": 'd-flex justify-content-center', // Visible en la tabla principal
                   
                }
            ]*/
            
            
        });
        
    });

    $(document).ready(function() {
        $('#ReporteTable').DataTable({
           /* "select":"true",

            select: {
                items:'cell',
            },*/
            scrollX: true,
            scrollY: 400, // Ajusta la altura máxima que deseas
            fixedHeader: true,
            "language" : {
                "search" :   "Buscar ",
                "lengthMenu" : "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "info"      : "Mostrando página _PAGE_ de _PAGES_",
                "paginate"  :  {
                    "previous"  : "Anterior ",
                    "next"       : "Siguiente",
                    "first"       : "Primero",
                    "last"        : "Último",
                },
                "sProcessing":"Procesando...",
            },
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i>',
                titleAttr: 'Copiar',
                className: 'bg-secondary',
                exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    }
            },
            {
                extend: 'excel',
                text:      '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'bg-success',
                exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    }
            },
            {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'bg-danger',
                    exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    },
                    customize: function (doc) {
                        doc.content.splice(0, 1, {
                            text: [
                                { text: 'Tabla de Categorias \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                                { text: 'Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '\n', fontSize: 12, italics: true },
                                { text: 'Usuario: ' + '{{ Auth::user()->name }}' + '\n\n', fontSize: 12, italics: true }
                            ]
                        });
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Fecha: ', { text: new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['Página ', { text: page.toString() },  ' de ', { text: pages.toString() }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'bg-info',
                    exportOptions: {
                        columns: ':not(:last-child)' // Excluir última columna (Acciones)
                    },
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<h3>Tabla de Categorias</h3>' +
                                '<p>Fecha: ' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '</p>' +
                                '<p>Usuario: ' + '{{ Auth::user()->name }}' + '</p>'
                            );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
            {
                extend: 'colvis',
                text: '<i class="fas fa-eye"> ',
                    titleAttr: 'Ocultar colunna',
                className: 'bg-dark'
            },
            

        ],
           /*
         
           columnDefs: [
                {
                    "targets": 1, // Última columna (Acciones)
                    "visible": false, // Visible en la tabla principal
                    "searchable": false, // No buscar en esta columna
                    "orderable": false, // No ordenar por esta columna
                },
                columnDefs: [
                {
                    "targets": 4, // Última columna (Acciones)
                    "className": 'd-flex justify-content-center', // Visible en la tabla principal
                   
                }
            ]*/
            
            
        });
        
    });

    

    document.addEventListener('DOMContentLoaded', function () {
        function showAlert(message, icon, type) {
            Swal.fire({
                title: message,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }

        @if(session('info'))
            showAlert('{{ session('info') }}', 'success', 'success');
        @endif

        @if(session('update'))
            showAlert('{{ session('update') }}', 'info', 'info');
        @endif

        @if(session('delete'))
            showAlert('{{ session('delete') }}', 'error', 'error');
        @endif
    });

    const toggleSwitch = document.getElementById('theme-toggle');
    const modeText = document.getElementById('mode-text');

function switchTheme(e) {
  if (e.target.checked) {
    document.body.classList.add('dark-mode');
    document.body.classList.remove('light-mode');
    modeText.textContent = 'modo claro';
  } else {
    document.body.classList.add('light-mode');
    document.body.classList.remove('dark-mode');
    modeText.textContent = 'modo oscuro';
  }
}

toggleSwitch.addEventListener('change', switchTheme);

// Set the default theme based on user preference or system settings
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
  toggleSwitch.checked = true;
  document.body.classList.add('dark-mode');
  modeText.textContent = 'modo claro';
} else {
  document.body.classList.add('light-mode');
  modeText.textContent = 'modo oscuro';
}


  </script>
  @stop
</section>
