<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        td{
            color: darkslategray;
        }
        .ocupado {
    color: red; /* O el color que prefieras para los ocupados */
}

.disponible {
    color: green; /* O el color que prefieras para los disponibles */
}

    </style>
@if (!empty($horariosDisponibles))
<table>
    <thead>
        <tr>
            <th>Día</th>
            <th>Horarios Disponibles</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($horariosDisponibles as $dia => $horas)
            <tr>
                <td>{{ \Carbon\Carbon::parse($dia)->locale('es')->translatedFormat('l') }}</td>
                <td>
                    @foreach ($horas as $hora)
                        <span class="{{ $hora['ocupado'] ? 'ocupado' : 'disponible' }}">
                            {{ $hora['hora'] }}
                        </span><br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@else
<p>No hay horarios disponibles.</p>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>