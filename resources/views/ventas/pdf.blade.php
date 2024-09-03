<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta</title>
    <style>
        /* Estilos CSS para la boleta */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .empresa-info {
            margin-bottom: 20px;
        }
        .empresa-info p {
            margin: 5px 0;
        }

        .datos-venta{
            margin: 5px 0;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="empresa-info">
        @foreach ($configuraciones as $configuracion)
            <p><strong>Nombre de la Empresa:</strong> {{ $configuracion->nombre_empresa }}</p>
            <p><strong>RUC:</strong> {{ $configuracion->ruc }}</p>
            <p><strong>Teléfono:</strong> {{ $configuracion->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $configuracion->direccion }}</p>
        @endforeach
    </div>

    <div class="datos-venta">
        <p><strong>ID de la factura:</strong> {{ $venta->id }}</p>
        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        <p><strong>Empleado:</strong> {{ $venta->usuario->name }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
    </div>

    <h2>Boleta de Venta</h2>
    <table>
        <thead>
            <tr>
               
                <th>Producto</th>
                <th>Cantidad</th>
                <th>P. unidad</th>
                <th>Marca</th>
                <th>Des (%)</th>
                <th>Imp (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->productos as $producto)
                <tr>
                  
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->pivot->cantidad }}</td>
                    <td><span>C$</span> {{ $producto->precio }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $venta->descuento ?? '-' }}</td> <!-- Mostrar descuento si existe, de lo contrario '-' -->
                    <td>{{ $venta->impuesto ?? '-' }}</td> <!-- Mostrar impuestos si existe, de lo contrario '-' -->
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        <p><strong>Total:</strong> <span>C$</span> {{ $venta->total }}</p>
    </div>
</body>
</html>
