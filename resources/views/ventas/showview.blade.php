<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Venta</title>
    <!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de Bootstrap (opcional, si necesitas funcionalidades de JavaScript de Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Estilos CSS para la boleta */
        body {
            font-family: Arial, sans-serif;
          
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 900px;
           
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333333;
        }
        .empresa-info, .datos-venta {
            margin-bottom: 20px;
        }
        .empresa-info p, .datos-venta p {
            margin: 5px 0;
            color: #666666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #f7f7f7;
            color: #333333;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2em;
            color: #333333;
        }
        .badge {
            background-color: #007bfe;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }

        :root {
  --bg-color-light: #ffffff;
  --text-color-light: #000000;
  --bg-color-dark: #1e1e1e;
  --text-color-dark: #ffffff;
}

body.light-mode {
  background-color: var(--bg-color-light);
  color: var(--text-color-light);
}

body.dark-mode {
  background-color: var(--bg-color-dark);
  color: var(--text-color-dark);
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #305836;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color: #f39521;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

    </style>
</head>
<body>
    <div class="form-group">
        <p class=" text-orange">Cambiar a <span id="mode-text">modo oscuro</span></p>
        <label class="switch">
          <input type="checkbox" id="theme-toggle">
          <span class="slider"></span>
        </label>
    </div>
    <div class="container mt-5">
         
   
        <h3>Detalle de Venta del cliente {{  $venta->cliente->nombre  }}</h3>
        <div class="row">
            <div class="col-lg-6">
                <div class="empresa-info">
                    @foreach ($configuraciones as $configuracion)
                        <p><strong>Nombre de la Empresa:</strong> <span class="badge">{{ $configuracion->nombre_empresa }}</span></p> <br>
                        <p><strong>RUC:</strong> <span class="badge">{{ $configuracion->ruc }}</span></p><br>
                        <p><strong>Teléfono:</strong> <span class="badge">{{ $configuracion->telefono }}</span></p><br>
                        <p><strong>Dirección:</strong> <span class="badge">{{ $configuracion->direccion }}</span></p>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="datos-venta">
                    <p><strong>ID de la factura:</strong> <span class="badge">{{ $venta->id }}</span></p> <br>
                    <p><strong>Cliente:</strong> <span class="badge">{{ $venta->cliente->nombre }}</span></p> <br>
                    <p><strong>Empleado:</strong> <span class="badge">{{ $venta->usuario->name }}</span></p> <br>
                    <p><strong>Fecha:</strong> <span class="badge">{{ $venta->created_at->format('d/m/Y') }}</span></p>
                </div>
            </div>
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
                        <td><span>C$</span> <span class="badge badge-success">{{ $producto->precio }}</span> </td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $venta->descuento ?? '-' }}</td> <!-- Mostrar descuento si existe, de lo contrario '-' -->
                        <td>{{ $venta->impuesto ?? '-' }}</td> <!-- Mostrar impuestos si existe, de lo contrario '-' -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total:</strong> <span>C$</span> <span class="badge badge-primary">{{ $venta->total }}</span> </p>
        </div>
    </div>

    <script>
        

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
</body>
</html>
