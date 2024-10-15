<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Historial del Chat</title>
</head>
<body style="background: #007fff;">
<div class="container mt-5 col-8">
    <h1 class="text-white">Historial del Chat</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chat: {{ $chat->name }}</h5>
            
            @foreach($chat->messages as $message)
                <p><strong>Pregunta:</strong> {{ $message->question }}</p>
                <p><strong>Respuesta:</strong> {{ $message->response }}</p>
                <hr> <!-- Línea horizontal para separar preguntas y respuestas -->
            @endforeach
            
        </div>
    </div>

    <a href="{{ route('chat') }}" class="btn btn-secondary mt-3">Volver a la lista de chats</a> <!-- Botón para volver -->
</div>
</body>
</html>
