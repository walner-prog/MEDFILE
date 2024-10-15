<div class="chat-list-container"> <!-- Contenedor con scroll -->
    @php
    use Illuminate\Support\Str; // Asegúrate de importar Str
    @endphp
    
    <ul class="list-group">
        @foreach($chats as $chat)
            <li class="list-group-item">
                <a href="{{ route('chat.view', ['chat_id' => $chat->id]) }}">
                    {{ Str::limit($chat->name, 50) }} <!-- Limita el nombre a 100 caracteres -->
                </a>
            </li>
        @endforeach
    </ul>
    

    <!-- Agregar enlaces de paginación -->
    <div class="mt-3">
        {{ $chats->links() }} <!-- Enlaces de paginación -->
    </div>
</div>


<style>
    .chat-list-container {
    max-height: 400px; /* Ajusta la altura máxima según sea necesario */
    overflow-y: auto; /* Habilita el scroll vertical */
   /* border: 1px solid #ccc; /* Agrega un borde si lo deseas */
    padding: 10px; /* Espaciado interno */
    background-color: #f8f9fa; /* Color de fondo */
}

li a{
    text-decoration: none;
    list-style: none;
}

a:hover{
    color: rgb(55, 145, 61);
}

</style>
