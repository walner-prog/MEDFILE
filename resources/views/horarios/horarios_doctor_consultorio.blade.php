
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Enlace al CSS de Bootstrap -->
 
    
  

    <!-- Enlace al CSS de DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <h3>
                Horario  de Atención del consultorio de : {{ $horario->nombre }}
            </h3>
            <table class="table table-bordered table-striped table-sm border-2 text-center ">
                <thead class="text-white text-center p-2">
                    <tr>
                        <th class="px-6 py-3 text-center text-base font-medium tracking-wider">Hora</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Lunes</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Martes</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Miércoles</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Jueves</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Viernes</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Sábado</th>
                        <th class="px-6 py-3 text-left text-base font-medium tracking-wider">Domingo</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $horas = [
                            '08:00:00 - 09:00:00',
                            '09:00:00 - 10:00:00',
                            '10:00:00 - 11:00:00',
                            '11:00:00 - 12:00:00',
                            '12:00:00 - 13:00:00',
                            '13:00:00 - 14:00:00',
                            '14:00:00 - 15:00:00',
                            '15:00:00 - 16:00:00',
                            '16:00:00 - 17:00:00',
                            '17:00:00 - 18:00:00',
                            '18:00:00 - 19:00:00',
                            '19:00:00 - 20:00:00'
                        ];
            
                        $dias_semanas = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
                    @endphp
            
                    @foreach ($horas as $hora)
                        @php
                            list ($hora_inicio, $hora_fin) = explode(' - ', $hora);
                        @endphp
                        <tr>
                            <td class=" text-dark">{{ $hora }}</td>
                            @foreach ($dias_semanas as $dia)
                                @php
                                    $nombre_doctor = '';
                                    foreach ($horarios as $horario) {
                                        if (strtolower($horario->dia_semana) == $dia && 
                                            $hora_inicio >= $horario->hora_inicio &&
                                            $hora_fin <= $horario->hora_fin) {
                                            $nombre_doctor = $horario->doctor->primer_nombre . " " . $horario->doctor->primer_apellido;
                                            break;
                                        }
                                    }
                                @endphp
                                <td class=" text-dark">{{ $nombre_doctor }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12D0peP+0mswAczjDhw5f1y7RI5zspTK5F/p+5QRTKNT9z8W" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
