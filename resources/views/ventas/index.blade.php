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
  
  
  <style>
   
  </style>

@section('content')
 <div class="container toggle-container">
   
    
    <p class=" text-orange">Cambiar a <span id="mode-text">modo oscuro</span></p>
      <label class="switch">
        <input type="checkbox" id="theme-toggle">
        <span class="slider"></span>
      </label>
     
    <!-- Aquí incluir el resto de la tabla y lógica de visualización de ventas -->
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Mostrar error específico pasado desde el controlador -->
    @if ($error = $errors->first('error'))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endif
  
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white cart-dia mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="stat text-indigo text-left">
                                <i class="fas fa-chart-bar align-middle fa-5x"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="card-titl text-cart">Ventas del Día</h3>
                            <h2 class="card-text ">{{ $contadorVentas }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card text-white cart-dia mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="stat text-indigo">
                                <i class="fas fa-chart-bar align-middle fa-5x"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="card-titl text-cart">Monto Total del Día</h3>
                            <h2 class="card-text">C$ {{ number_format($montoTotal, 2) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card text-white cart-dia mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="stat text-indigo">
                                <i class="fas fa-file-alt align-middle fa-5x"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h3 class="card-titl text-cart">productos vendidos en el Día</h3>
                            <p class="card-text"><h2 class="">{{ $totalProductosVendidos }}</h2></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <div class="col">
            <button class="btn btn-info   mb-3 w-25" data-toggle="modal" data-target="#createVentaModal"><h5>Crear Venta</h5></button>
        </div>
        <table id="ventasTable" class="table table-striped table-bordered shadow-lg" style="width:100%">
            <thead class="">
                <tr class="table- text-white">
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Producto</th>
                    <th width='10px'>Cantidad</th>
                    <th>P. unidad</th> 
                    <th>Marca </th>
                    <th>Total en C$</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventasDelDia as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }}</td> 
                    <td>{{ $venta->usuario->name }}</td>
                    <td>
                        @foreach ($venta->productos as $producto)
                            {{ $producto->nombre }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($venta->productos as $producto)
                            {{ $producto->pivot->cantidad }} <br>
                            
                        @endforeach
                    </td>
        
                    <td>
                        @foreach ($venta->productos as $producto)
                        <span class="text-indigo ">C$</span> <span class="badge badge-success custon-badge">{{ $producto->precio }}</span>  <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($venta->productos as $producto)
                            {{ $producto->marca }} <br>
                        @endforeach
                    </td>
                    <td ><span class="text-indigo">C$</span> <span class="badge badge-info custon-badge"> {{ $venta->total  }}</span></td> <br>
                    <td width="250px">
                        @can('ver-venta')
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewVentaModal{{ $venta->id }}">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                        @endcan
                    
                        @can('editar-venta')
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editVentaModal{{ $venta->id }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                        @endcan
                    
                        @can('eliminar-venta')
                            <form id="delete-for" action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete-venta">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        @endcan
                    </td>
                    
                </tr>

               <!-- Modal para Ver Venta con Documento -->
    <div class="modal fade" id="viewVentaModal{{ $venta->id }}" tabindex="-1" role="dialog" aria-labelledby="viewVentaModalLabel{{ $venta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewVentaModalLabel{{ $venta->id }}">Detalle de la Venta del cliente: <span class=" badge-success p-2 border border-4">{{ $venta->cliente->nombre }}</span>  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
               
                
                <!-- Ejemplo de un enlace para descargar la boleta -->
                <a href="{{ route('ventas.pdf', $venta->id) }}" class="btn btn-primary mr-4" target="_blank">Descargar Boleta</a>
             
                <a href="{{ route('ventas.printPdf', $venta) }}" class="btn btn-info mr-4 " target="_blank">Imprimir Boleta</a>

                <a href="{{ route('ventas.imprimirBaucher', ['venta' => $venta->id]) }}" class="btn btn-success" target="_blank">Imprimir Baucher</a>

                <a href="{{ route('ventas.showview', ['venta' => $venta->id]) }}" class="btn btn-secondary" target="_blank">ver detalles de la venta</a>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
  </div>



         <!-- Modal para Editar Venta -->
   <div class="modal fade" id="editVentaModal{{ $venta->id }}" tabindex="-1" role="dialog" aria-labelledby="editVentaModalLabel{{ $venta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h5 class="modal-title text-white" id="editVentaModalLabel{{ $venta->id }}">Editar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ventas.update', $venta->id) }}" method="POST" id="formEditVenta{{ $venta->id }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                        <select class="form-control" name="cliente_id" required>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ $cliente->id == $venta->cliente_id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usuario_id">Usuario <span class="text-danger">*</span></label>
                        <select class="form-control" name="usuario_id" required>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == $venta->usuario_id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <h5>Productos</h5>
                   
                    <div id="productos-edit{{ $venta->id }}">
                        <!-- Productos existentes -->
                        @foreach ($venta->productos as $producto)
                            <div class="form-group d-flex align-items-center producto-row">
                                <select class="form-control mr-2 producto-select" name="productos[{{ $loop->index }}][producto_id]" required>
                                    @foreach ($productos as $p)
                                        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}" {{ $p->id == $producto->id ? 'selected' : '' }}>{{ $p->nombre }} (Stock: {{ $p->stock }})</option>
                                    @endforeach
                                </select>
                                <span class="producto-precio text-muted"></span> 
                                <input type="number" class="form-control mr-2 cantidad-input" name="productos[{{ $loop->index }}][cantidad]" value="{{ $producto->pivot->cantidad }}" placeholder="Cantidad" required>
                                <button type="button" class="btn btn-danger btn-remove-producto">X</button>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_impuesto{{ $venta->id }}">Impuesto</label>
                                <input type="number" id="edit_impuesto{{ $venta->id }}" name="impuesto" value="{{ $venta->impuesto }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_descuento{{ $venta->id }}">Descuento/Promocion</label>
                                <input type="number" id="edit_descuento{{ $venta->id }}" name="descuento" value="{{ $venta->descuento }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total">Total <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total" id="edit_total{{ $venta->id }}" value="{{ $venta->total }}" step="0.01" readonly required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
   </div>

    </div>
             </div>


                @endforeach
            </tbody>
        </table>

        
        
    </div>
 
    <!-- Modal para Crear Venta -->
    <div class="modal fade" id="createVentaModal" tabindex="-1" role="dialog" aria-labelledby="createVentaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h5 class="modal-title text-white" id="createVentaModalLabel">Registrar una nueva Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ventas.store') }}" method="POST" id="formCrearVenta">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                     <div class="row pl-5 mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                                <select class="form-control" name="cliente_id" required>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="usuario_id">Usuario <span class="text-danger">*</span></label>
                                <select class="form-control" name="usuario_id" required>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group ">
                                <label for="search_producto">Buscar Producto</label>
                                <div class="input-group col-6">
                                    <input type="text" class="form-control" id="search_producto" placeholder="Buscar Producto">
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productos">Productos <span class="text-danger">*</span></label>
                                <div id="productos">
                                    <div class="form-group d-flex align-items-center producto-row">
                                        <select class="form-control mr-2 producto-select" name="productos[0][producto_id]" required>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }} (Stock: {{ $producto->stock }})</option>
                                            @endforeach
                                        </select>
                                        <span class="producto-precio text-success"></span>
                                        
                                        <input type="number" class="form-control mr-2 cantidad-input" name="productos[0][cantidad]" placeholder="Cantidad" required>
                                        <button type="button" class="btn btn-danger btn-remove-producto">X</button>
                                    </div>
                                </div>
                                <button type="button" id="add-producto" class="btn btn-primary mt-2">Agregar Producto</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="subtotal">Subtotal </label>
                                <input type="number" class="form-control" name="subtotal" id="subtotal" step="0.01" readonly>
                            </div>
                        </div>
                        
                     </div>
                   
                    
                     <div class="row pl-5">
                       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="impuesto">Impuesto (%)</label>
                                <input type="number" class="form-control" name="impuesto" id="impuesto" value="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="descuento">Descuento/Promoción (%)</label>
                                <input type="number" class="form-control" name="descuento" id="descuento" value="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total">Total <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="total" id="total" step="0.01" readonly required>
                            </div>
                        </div>
                       
                     </div>
                      <div class="pl-5">
                        <button type="submit" class="btn btn-info ">Registrar Venta</button>
                      </div>
                   
                </form>
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

    $(document).ready(function() {
        $('#ventasTable').DataTable({
           /* "select":"true",

            select: {
                items:'cell',
            },*/
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
                                { text: 'Informe de Ventas   \n', fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
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
                                '<h3>Tabla de Ventas</h3>' +
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


  /*
    $(document).ready(function() {
            // Capturar el clic en el botón de eliminar venta
            $('.btn-delete-venta').click(function(e) {
                e.preventDefault(); // Evitar el envío del formulario automáticamente

                // Mostrar un mensaje de confirmación
                if (confirm('¿Estás seguro de eliminar esta venta? Esta acción es irreversible.')) {
                    // Si el usuario confirma, enviar el formulario para eliminar la venta
                    $('#delete-form').submit();
                }
            });
        });
*/
    $(document).ready(function() {
    // Calcular el subtotal basado en el precio y cantidad al cambiar la cantidad o seleccionar un producto
    $('#productos').on('change keyup', '.producto-select, .cantidad-input', function() {
        recalcularSubtotal();
    });

    // Al agregar o quitar productos
    $('#add-producto').click(function() {
        const index = $('.form-group').length; // Obtener el índice del nuevo producto
        const newProducto = `
            <div class="form-group d-flex align-items-center producto-row">
                <select class="form-control mr-2 producto-select" name="productos[${index}][producto_id]" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }} (Stock: {{ $producto->stock }})</option>
                    @endforeach
                </select>
                <span class="producto-precio text-muted"></span>
                <input type="number" class="form-control mr-2 cantidad-input" name="productos[${index}][cantidad]" placeholder="Cantidad" required>
                <button type="button" class="btn btn-danger btn-remove-producto">X</button>
            </div>
        `;
        $('#productos').append(newProducto);

        // Agregar evento al botón de remover producto
        $('.btn-remove-producto').off().click(function() {
            $(this).closest('.form-group').remove();
            recalcularSubtotal();
        });
    });

    // Función para recalcular el subtotal
    function recalcularSubtotal() {
        let subtotal = 0;

        $('#productos .form-group').each(function() {
            const precio = parseFloat($(this).find('.producto-select option:selected').data('precio'));
            const cantidad = parseInt($(this).find('.cantidad-input').val());
            if (!isNaN(precio) && !isNaN(cantidad)) {
                const subtotalProducto = precio * cantidad;
                subtotal += subtotalProducto;
                // Mostrar el precio unitario del producto
                $(this).find('.producto-precio').text('$' + precio.toFixed(2));
                // Mostrar el subtotal del producto
                $(this).find('.producto-subtotal').text('$' + subtotalProducto.toFixed(2));
            }
        });

        $('#subtotal').val(subtotal.toFixed(2));
        recalcularTotal();
    }

    // Función para recalcular el total basado en el subtotal, impuesto y descuento
    function recalcularTotal() {
        let subtotal = parseFloat($('#subtotal').val()) || 0;
        let impuesto = parseFloat($('#impuesto').val()) || 0;
        let descuento = parseFloat($('#descuento').val()) || 0;

        let total = subtotal * (1 + impuesto / 100) * (1 - descuento / 100);

        $('#total').val(total.toFixed(2));
    }

    // Inicializar el cálculo subtotal y total al cargar la página
    recalcularSubtotal();

    // Inicializar el evento de remover producto para los productos existentes
    $(document).on('click', '.btn-remove-producto', function() {
        $(this).closest('.form-group').remove();
        recalcularSubtotal();
    });

    // Escuchar cambios en el impuesto y descuento para recalcular el total en tiempo real
    $('#impuesto, #descuento').on('input', function() {
        recalcularTotal();
    });

    // Al cambiar la selección de producto, actualizar el precio unitario mostrado
    $('#productos').on('change', '.producto-select', function() {
        const precio = parseFloat($(this).find('option:selected').data('precio'));
        $(this).closest('.form-group').find('.producto-precio').text('$' + (precio || 0).toFixed(2));
        recalcularSubtotal(); // Recalcular subtotal al cambiar el producto seleccionado
    });
});



$(document).ready(function() {
    // Función para inicializar el comportamiento del formulario de edición
    function initEditForm(ventaId) {
        // Agregar producto en edición
        $(`#add-producto-edit${ventaId}`).click(function() {
            const index = $(`#productos-edit${ventaId} .producto-row`).length; // Obtener el índice del nuevo producto
            const newProducto = `
                <div class="form-group d-flex align-items-center producto-row">
                    <select class="form-control mr-2 producto-select" name="productos[${index}][producto_id]" required>
                        @foreach ($productos as $p)
                            <option value="{{ $p->id }}" data-precio="{{ $p->precio }}" data-stock="{{ $p->stock }}">{{ $p->nombre }} (Stock: {{ $p->stock }})</option>
                        @endforeach
                    </select>
                    <span class="producto-precio text-muted"></span> <!-- Mostrar precio unitario -->
                    <input type="number" class="form-control mr-2 cantidad-input" name="productos[${index}][cantidad]" placeholder="Cantidad" required>
                    <button type="button" class="btn btn-danger btn-remove-producto">X</button>
                </div>
            `;
            $(`#productos-edit${ventaId}`).append(newProducto);
        });

        // Remover producto en edición
        $(`#productos-edit${ventaId}`).on('click', '.btn-remove-producto', function() {
            $(this).closest('.producto-row').remove();
            recalcularTotalEdit(ventaId); // Recalcular el total al remover un producto
        });

        // Calcular total al cambiar la cantidad o seleccionar un producto
        $(`#productos-edit${ventaId}`).on('change keyup', '.producto-select, .cantidad-input', function() {
            validarStock(ventaId); // Validar stock al cambiar la cantidad o seleccionar un producto
            recalcularTotalEdit(ventaId); // Recalcular total al cambiar la cantidad o seleccionar un producto
        });

        // Calcular total al cambiar el impuesto o descuento
        $(`#edit_impuesto${ventaId}, #edit_descuento${ventaId}`).on('change keyup', function() {
            recalcularTotalEdit(ventaId);
        });

        // Función para validar el stock en edición
        function validarStock(ventaId) {
            $(`#productos-edit${ventaId} .producto-row`).each(function() {
                const productoId = $(this).find('.producto-select').val();
                const cantidad = parseInt($(this).find('.cantidad-input').val());
                const stock = parseFloat($(`#productos-edit${ventaId} .producto-select option[value="${productoId}"]`).data('stock'));

                if (!isNaN(cantidad) && !isNaN(stock) && cantidad > stock) {
                    $(this).find('.cantidad-input').val(stock); // Establecer la cantidad máxima disponible
                }
            });
        }

        // Función para recalcular el total en edición
        function recalcularTotalEdit(ventaId) {
            let subtotal = 0;
            let impuesto = parseFloat($(`#edit_impuesto${ventaId}`).val()) || 0;
            let descuento = parseFloat($(`#edit_descuento${ventaId}`).val()) || 0;

            $(`#productos-edit${ventaId} .producto-row`).each(function() {
                const precio = parseFloat($(this).find('.producto-select option:selected').data('precio'));
                const cantidad = parseInt($(this).find('.cantidad-input').val());
                if (!isNaN(precio) && !isNaN(cantidad)) {
                    subtotal += precio * cantidad;
                    // Mostrar el precio unitario del producto
                    $(this).find('.producto-precio').text('$' + precio.toFixed(2));
                }
            });

            let total = subtotal * (1 + impuesto / 100) * (1 - descuento / 100);

            $(`#edit_total${ventaId}`).val(total.toFixed(2));
        }

        // Inicializar el cálculo total al cargar la página
        recalcularTotalEdit(ventaId);
    }

    // Inicializar los formularios de edición existentes
    @foreach ($ventasDelDia as $venta)
        initEditForm({{ $venta->id }});
    @endforeach
});


 // Activar tooltips de Bootstrap para cada tarjeta
 $(document).ready(function () {
        $('.card').each(function () {
            $(this).hover(function () {
                // Mostrar tooltip al pasar el ratón por encima
                $(this).tooltip({
                    title: $(this).find('.card-body').html(), // Utiliza el contenido HTML del cuerpo de la tarjeta como título del tooltip
                    html: true, // Permite HTML dentro del tooltip
                    placement: 'top', // Coloca el tooltip encima de la tarjeta
                    trigger: 'hover', // Mostrar tooltip al pasar el ratón
                    container: 'body' // Colocar el tooltip en el cuerpo del documento
                });
                $(this).tooltip('show'); // Mostrar tooltip
            }, function () {
                // Ocultar tooltip al quitar el ratón
                $(this).tooltip('dispose');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('search_producto').addEventListener('input', function (e) {
            let searchTerm = e.target.value;

            fetch(`/buscar-productos?query=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    let selectElements = document.querySelectorAll('.producto-select');
                    selectElements.forEach(select => {
                        select.innerHTML = ''; // Clear current options
                        data.forEach(producto => {
                            let option = document.createElement('option');
                            option.value = producto.id;
                            option.dataset.precio = producto.precio;
                            option.textContent = `${producto.nombre} (Stock: ${producto.stock})`;
                            select.appendChild(option);
                        });
                    });
                });
        });

        document.getElementById('add-producto').addEventListener('click', function () {
            // Your existing code for adding a new product row
        });

        document.querySelector('#formCrearVenta').addEventListener('submit', function (e) {
            // Your existing code for handling the form submission
        });
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
