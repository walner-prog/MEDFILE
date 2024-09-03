<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Baucher de Venta</title>
    <style>
        /* Estilos CSS para el baucher */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Tamaño de fuente más pequeño para baucher */
            width: 250px; /* Ancho máximo para el baucher */
            margin: 0 auto; /* Centrar en la página */
            
          
        }
        .empresa-info p {
            margin: 5px 0;
            font-size: 12px;
        }
        .datos-venta {
            margin: 5px 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 10px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="empresa-info">
        <!-- Datos de la empresa -->
        @foreach ($configuraciones as $configuracion)
            <p><strong>Nombre de la Empresa:</strong> {{ $configuracion->nombre_empresa }}</p>
            <p><strong>RUC:</strong> {{ $configuracion->ruc }}</p>
            <p><strong>Teléfono:</strong> {{ $configuracion->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $configuracion->direccion }}</p>
        @endforeach
    </div>

    <div class="datos-venta">
        <!-- Datos de la venta -->
        <p><strong>ID de la factura:</strong> {{ $venta->id }}</p>
        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        <p><strong>Empleado:</strong> {{ $venta->usuario->name }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
    </div>

    <h2>Baucher de Venta</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>P. unit</th>
            </tr>
        </thead>
        <tbody>
            <!-- Detalle de los productos vendidos -->
            @foreach($venta->productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->pivot->cantidad }}</td>
                    <td><span>C$</span> {{ $producto->precio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <!-- Total de la venta -->
        <p><strong>Total:</strong> <span>C$</span> {{ $venta->total }}</p>
    </div>
</body>
</html>
