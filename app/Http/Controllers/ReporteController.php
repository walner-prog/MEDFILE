<?php

// app/Http/Controllers/ReporteController.php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\User;
use App\Models\Venta;
use App\Models\Producto;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\EnviarBoletaVenta;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\DB;
use Exception;
class ReporteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    
      {
        // Obtener las fechas actuales
        $now = Carbon::now()->setTimezone('America/Managua');
    
        $fechaInicioDia = Carbon::now('America/Managua')->startOfDay();
        $fechaFinDia = Carbon::now('America/Managua')->endOfDay();
        $fechaInicioSemana = Carbon::now('America/Managua')->startOfWeek();
        $fechaFinSemana = Carbon::now('America/Managua')->endOfWeek();
        $fechaInicioMes = Carbon::now('America/Managua')->startOfMonth();
        $fechaFinMes = Carbon::now('America/Managua')->endOfMonth();
        $fechaInicioAnio = Carbon::now('America/Managua')->startOfYear();
        $fechaFinAnio = Carbon::now('America/Managua')->endOfYear();
    
        
    
        // Obtener el total de ventas por cada período
        $totalVentasDia_venta = Venta::whereBetween('created_at', [$fechaInicioDia, $fechaFinDia])->count();
        $totalVentasSemana = Venta::whereBetween('created_at', [$fechaInicioSemana, $fechaFinSemana])->count();
        $totalVentasMes = Venta::whereBetween('created_at', [$fechaInicioMes, $fechaFinMes])->count();
        $totalVentasAnio = Venta::whereBetween('created_at', [$fechaInicioAnio, $fechaFinAnio])->count();
    
         
         // Agrupar ventas por producto
         $ventasPorProducto = Venta::select('producto_id', DB::raw('SUM(total) as total_ventas'))
         ->groupBy('producto_id')
         ->get();
         $ventasPorProductos = Venta::with('productos')
        ->get();
        // Agrupar ventas por clienet
         $ventasPorCliente = Venta::select('cliente_id', DB::raw('SUM(total) as total_ventas'))
                            ->groupBy('cliente_id')
                            ->get();             
           $ventasPorCliente = Venta::with('cliente')
           ->get();
        //  fin
    
  
        $fechaInicio = $request->input('fecha_inicio', $now->copy()->toDateTimeString());
        $fechaFin = $request->input('fecha_fin', $now->copy()->toDateTimeString());
        
        $ventas_filter = Venta::with('cliente', 'usuario', 'productos')
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->get();
        
        // Calcular el total de productos vendidos, la suma total de ventas, promedio de ventas por cliente, producto más vendido y cliente principal
        $totalProductos = 0;
        $totalVentas = 0;
        $totalCostos = 0;

          // Aplicar filtros
          $fechaInicio = $request->input('fecha_inicio', $now->copy()->toDateTimeString());
        $fechaFin = $request->input('fecha_fin', $now->copy()->toDateTimeString());
          $categoriaProducto = $request->input('categoria_producto');
          $nombreProducto = $request->input('nombre_producto');
          $marcaProducto = $request->input('marca_producto');

          // aqui van los filtros para la tabla ve productos 

       
          $hoy = Carbon::today();

          // Obtener ventas del día con relaciones cargadas
          $ventasDelDia_hoy = Venta::whereDate('created_at', $hoy)->with('productos')->get();
      
          // Inicializar variables
          $totalProductosVendidosDia = 0;
          $totalVentasDia_cs = 0;
          $totalCostosDia_cs = 0;
          $totalVentasDia = 0;
      
          foreach ($ventasDelDia_hoy as $venta) {
              // Sumar el total de la venta
              $totalVentasDia += $venta->total;
      
              foreach ($venta->productos as $producto) {
                  // Sumar la cantidad de productos vendidos
                  $totalProductosVendidosDia += $producto->pivot->cantidad;
                  
                  // Calcular el costo total de los productos vendidos
                  $totalCostosDia_cs += $producto->pivot->cantidad * $producto->costo;
              }
          }
      
          // Calcular la ganancia
          $gananciaDia = $totalVentasDia - $totalCostosDia_cs;
      
          
          $fechaInicioSemana = Carbon::now()->startOfWeek();
      $fechaFinSemana = Carbon::now()->endOfWeek();

// Obtener ventas de la semana con relaciones cargadas
$ventasSemana = Venta::whereBetween('created_at', [$fechaInicioSemana, $fechaFinSemana])->with('productos')->get();

     // Calcular el total de productos vendidos en la semana
$totalProductosVendidosSemana = 0;
foreach ($ventasSemana as $venta) {
    foreach ($venta->productos as $producto) {
        $totalProductosVendidosSemana += $producto->pivot->cantidad;
    }
}

// Depuración: Imprimir total de productos vendidos en la semana
logger("Total de productos vendidos esta semana: " . $totalProductosVendidosSemana);
$fechaInicioMes = Carbon::now()->startOfMonth();
$fechaFinMes = Carbon::now()->endOfMonth();

// Obtener ventas del mes con relaciones cargadas
$ventasMes = Venta::whereBetween('created_at', [$fechaInicioMes, $fechaFinMes])->with('productos')->get();

// Inicializar variables
$totalProductosVendidosMes_ = 0;
$totalVentasMes_ = 0;
$totalCostosMes = 0;

foreach ($ventasMes as $venta) {
    // Sumar el total de la venta
    $totalVentasMes_ += $venta->total;

    foreach ($venta->productos as $producto) {
        // Sumar la cantidad de productos vendidos
        $totalProductosVendidosMes_ += $producto->pivot->cantidad;
        
        // Calcular el costo total de los productos vendidos
        $totalCostosMes += $producto->pivot->cantidad * $producto->costo;
    }
}

// Calcular la ganancia
$gananciaMes = $totalVentasMes_ - $totalCostosMes;



$fechaInicioAnio = Carbon::now()->startOfYear();
$fechaFinAnio = Carbon::now()->endOfYear();

// Obtener ventas del año con relaciones cargadas
$ventasAnio = Venta::whereBetween('created_at', [$fechaInicioAnio, $fechaFinAnio])->with('productos')->get();

// Calcular el total de productos vendidos en el año
$totalProductosVendidosAnio = 0;
foreach ($ventasAnio as $venta) {
    foreach ($venta->productos as $producto) {
        $totalProductosVendidosAnio += $producto->pivot->cantidad;
    }
}


          // aca terminan los filtros 

        $totalClientes = $ventas_filter->groupBy('cliente_id')->count();
        $productosVendidos = [];
        $clientesCompras = [];
        
        foreach ($ventas_filter as $venta) {
            // Sumar el total de productos vendidos en todas las ventas filtradas
            $totalProductos += count($venta->productos);
            
            // Sumar el total de ventas en todas las ventas filtradas
            $totalVentas += $venta->total;
        
            // Calcular el costo total de los productos vendidos en todas las ventas filtradas
            foreach ($venta->productos as $producto) {
                if (isset($producto->pivot->cantidad) && isset($producto->costo)) {
                    $totalCostos += $producto->pivot->cantidad * $producto->costo;
                }
            }
        
            // Contabilizar la cantidad de veces que se ha vendido cada producto
            foreach ($venta->productos as $producto) {
                if (isset($producto->id)) {
                    if (!isset($productosVendidos[$producto->id])) {
                        $productosVendidos[$producto->id] = 0;
                    }
                    $productosVendidos[$producto->id]++;
                }
            }
        
            // Contabilizar la cantidad de compras realizadas por cada cliente
            if (isset($venta->cliente_id)) {
                if (!isset($clientesCompras[$venta->cliente_id])) {
                    $clientesCompras[$venta->cliente_id] = 0;
                }
                $clientesCompras[$venta->cliente_id]++;
            }
        }
        
        
        $margenGanancia = $totalVentas - $totalCostos;
        // Calcular el promedio de ventas por cliente
        $promedioVentasPorCliente = $totalClientes > 0 ? $totalVentas / $totalClientes : 0;
        
       // Encontrar el producto más vendido si hay elementos en $productosVendidos
if (!empty($productosVendidos)) {
    arsort($productosVendidos);
    $productoMasVendidoId = key($productosVendidos);
    $cantidadVendidaProductoMasVendido = $productosVendidos[$productoMasVendidoId] ?? 0;
    $nombreProductoMasVendido = Producto::find($productoMasVendidoId)->nombre ?? 'No disponible';
} else {
    // Manejar el caso donde $productosVendidos está vacío
    $cantidadVendidaProductoMasVendido = 0;
    $nombreProductoMasVendido = 'No disponible';
}

       // Encontrar el cliente con más compras si hay elementos en $clientesCompras
if (!empty($clientesCompras)) {
    arsort($clientesCompras);
    $clientePrincipalId = key($clientesCompras);
    $cantidadComprasClientePrincipal = $clientesCompras[$clientePrincipalId] ?? 0;
    $nombreClientePrincipal = Cliente::find($clientePrincipalId)->nombre ?? 'No disponible';
} else {
    // Manejar el caso donde $clientesCompras está vacío
    $cantidadComprasClientePrincipal = 0;
    $nombreClientePrincipal = 'No disponible';
}


         // Comparativa con el mes anterior
    $fechaInicioMesAnterior = Carbon::parse($fechaInicio)->subMonth()->startOfMonth()->toDateString();
    $fechaFinMesAnterior = Carbon::parse($fechaInicio)->subMonth()->endOfMonth()->toDateString();
    $totalVentasMesAnterior = Venta::whereBetween('created_at', [$fechaInicioMesAnterior, $fechaFinMesAnterior])
        ->sum('total');

    // Comparativa con el mismo mes del año anterior
    $fechaInicioMismoMesAnoAnterior = Carbon::parse($fechaInicio)->subYear()->startOfMonth()->toDateString();
    $fechaFinMismoMesAnoAnterior = Carbon::parse($fechaInicio)->subYear()->endOfMonth()->toDateString();
    $totalVentasMismoMesAnoAnterior = Venta::whereBetween('created_at', [$fechaInicioMismoMesAnoAnterior, $fechaFinMismoMesAnoAnterior])
        ->sum('total');
    
     //   $clientes = Cliente::all();
      //  $usuarios = User::all();
       // $productos = Producto::all();
        $ventas = Venta::with('productos', 'cliente', 'usuario',)->get();
    
        return view('reportes.index', compact('ventas', 'ventas_filter', 'fechaInicio', 'fechaFin',
         'totalVentasDia_venta', 
        'totalVentasSemana', 
        'totalVentasMes',
         'totalVentasAnio',
        'ventasPorCliente',
        'ventasPorProducto',
        'totalProductos',
        'totalVentas',
        'promedioVentasPorCliente', 
        'nombreProductoMasVendido', 
    'cantidadVendidaProductoMasVendido', 
    'nombreClientePrincipal', 
    'cantidadComprasClientePrincipal', 
    'totalVentasMesAnterior',
    'totalVentasMismoMesAnoAnterior',
    'margenGanancia','ventasPorProductos',
    'totalProductosVendidosDia',
    'totalProductosVendidosSemana',
    'totalProductosVendidosMes_',
    'totalProductosVendidosAnio','totalVentasDia',
    'gananciaDia','totalProductosVendidosMes_','totalVentasMes_','gananciaMes'));
    }
    

    public function filtrar(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $ventas_filter = Venta::with('cliente', 'usuario', 'productos')
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->get();

        $totalProductos = $ventas_filter->sum(function($venta) {
            return $venta->productos->count();
        });

        $totalVentas = $ventas_filter->sum('total');

        // Calcula el promedio de ventas por cliente
        $promedioVentasCliente = $totalVentas / $ventas_filter->unique('cliente_id')->count();

        // Número de ventas
        $numeroVentas = $ventas_filter->count();

        // Producto más vendido
        $productoMasVendido = $ventas_filter->pluck('productos')->flatten()
            ->groupBy('id')
            ->sortByDesc(function ($productos) {
                return count($productos);
            })->first()->first();

        // Cliente principal
        $clientePrincipal = $ventas_filter->groupBy('cliente_id')
            ->sortByDesc(function ($ventas) {
                return $ventas->count();
            })->first()->first()->cliente;

        // Ventas del mes anterior
        $mesAnteriorInicio = Carbon::parse($fechaInicio)->subMonth()->startOfMonth();
        $mesAnteriorFin = Carbon::parse($fechaFin)->subMonth()->endOfMonth();
        $ventasMesAnterior = Venta::whereBetween('created_at', [$mesAnteriorInicio, $mesAnteriorFin])->sum('total');

        // Ventas del mismo mes del año anterior
        $mismoMesAnoAnteriorInicio = Carbon::parse($fechaInicio)->subYear()->startOfMonth();
        $mismoMesAnoAnteriorFin = Carbon::parse($fechaFin)->subYear()->endOfMonth();
        $ventasMismoMesAnoAnterior = Venta::whereBetween('created_at', [$mismoMesAnoAnteriorInicio, $mismoMesAnoAnteriorFin])->sum('total');

        // Margen de ganancia
        $totalCostos = $ventas_filter->sum(function ($venta) {
            return $venta->productos->sum('costo');
        });
        $margenGanancia = $totalVentas - $totalCostos;

        return response()->json([
            'html' => view('partials.report-results', compact(
                'ventas_filter',
                'totalProductos',
                'totalVentas',
                'promedioVentasCliente',
                'numeroVentas',
                'productoMasVendido',
                'clientePrincipal',
                'ventasMesAnterior',
                'ventasMismoMesAnoAnterior',
                'margenGanancia'
            ))->render()
        ]);
    }
    public function create()
    {
        // Lógica para mostrar el formulario de creación de reporte
        return view('reportes.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar un nuevo reporte (si es necesario)
        // Puede que aquí no se almacene realmente un reporte, sino que se generen datos para mostrar en el reporte
    }

    public function show($id)
    {
        // Lógica para mostrar un reporte específico
        // Puede ser un reporte por período, por producto, por cliente, etc.
        return view('reportes.show', compact('reporte'));
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición de un reporte
        return view('reportes.edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un reporte (si es necesario)
    }

    public function destroy($id)
    {
        // Lógica para eliminar un reporte
    }

    public function ventasPorPeriodo(Request $request)
    {
        // Obtener fechas desde la solicitud o usar valores predeterminados
        $fechaInicio = $request->input('fecha_inicio', Carbon::now()->startOfMonth()->toDateString());
        $fechaFin = $request->input('fecha_fin', Carbon::now()->endOfMonth()->toDateString());

        // Obtener ventas por período
        $ventasPeriodo = Venta::with('productos', 'cliente')
                        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                        ->get();

        // Puedes devolver los datos como JSON o pasarlos a una vista
        return response()->json([
            'ventas' => $ventasPeriodo,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ]);
    }


    public function ventasPorProducto(Request $request)
    {
        // Lógica para obtener y mostrar ventas por producto
        return view('reportes.ventas_producto', compact('ventas'));
    }

    public function ventasPorCliente(Request $request)
    {
        // Lógica para obtener y mostrar ventas por cliente
        return view('reportes.ventas_cliente', compact('ventas'));
    }
}
