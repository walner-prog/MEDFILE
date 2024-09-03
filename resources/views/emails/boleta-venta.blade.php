<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta</title>
</head>
<body>
    <h2>Boleta de Venta</h2>
    <p>Adjuntamos la boleta de venta correspondiente a la compra realizada el {{ $venta->created_at->format('d/m/Y') }}.</p>
    <p>Puedes revisar los detalles de la compra en el archivo adjunto.</p>
</body>
</html>
