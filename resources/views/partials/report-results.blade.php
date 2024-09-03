<!-- resources/views/partials/report-results.blade.php -->
<div>
    <h3>Resultados del Reporte</h3>
    <ul>
        <li>Total de ventas en cordobas: C$ {{ number_format($totalVentas, 2) }}</li>
        <li>Total de productos vendidos: {{ $totalProductos }}</li>
        <li>Promedio de ventas por cliente: C$ {{ number_format($promedioVentasCliente, 2) }}</li>
        <li>Producto más vendido: {{ $productoMasVendido->nombre }} ({{ $productoMasVendido->ventas->count() }} unidades)</li>
        <li>Cliente principal: {{ $clientePrincipal->nombre }} ({{ $clientePrincipal->ventas->count() }} compras)</li>
        <li>Total ventas del mes anterior: C$ {{ number_format($ventasMesAnterior, 2) }}</li>
        <li>Total ventas del mismo mes del año anterior: C$ {{ number_format($ventasMismoMesAnoAnterior, 2) }}</li>
        <li>Margen de Ganancia: C$ {{ number_format($margenGanancia, 2) }}</li>
    </ul>

    <h3>Detalle de Ventas</h3>
    <table class="table table-bordered">
        <thead class="bg-gradient-orange">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Empleado</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Total</th>
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
                        {{ $producto->nombre }}
                    @endforeach
                </td>
                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                <td>C$ {{ number_format($venta->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
