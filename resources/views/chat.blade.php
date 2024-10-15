@extends('layouts.app_portal')
@php
$hideFooter = true; // Definir esta variable para desactivar el footer
@endphp
<br> 

    @section('content' )
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
      
        <style>
              .d-none
               {
                    display: none;
                   
                }

        </style>
    </head>

    <div class="container-fluid">
        <div class="row p-1">
            <!-- Columna para el historial de chats -->
            <div class="col-lg-2 mt-5">
                <h3>Historial guardado de los Chats</h3>
                <!-- Componente Livewire para mostrar los nombres de los chats previos -->
                <br>
                <livewire:chat-names />
            </div>
    
            <!-- Columna para el chat -->
            <div class="col-lg-10 col-md-12 col-sm-12 mt-5">
                <h3 id="output" class="text-output"></h3>
                <div id="fadeText" class="fade text-right text-primary">
                    <h4>La inteligencia artificial a tu alcance.</h4>
                </div>
                <button type="button" id="new-chat-btn" class="btn btn-secondary">Nuevo Chat</button>
                <div id="loading-message" class="d-none">Cargando...</div>
    
                <!-- Historial del chat -->
                <div id="chat-history" class="mt-4 text-white chat-scroll col-md-10" style="max-height: 500px; overflow-y: auto;">
                    <!-- Aquí se irá agregando cada pregunta y respuesta -->
                </div>
            </div>
        </div>
    
        <!-- Formulario de chat fijo en la parte inferior -->
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <!-- Formulario fijo en la parte inferior, centrado horizontalmente -->
                <form id="chat-form" method="POST" action="{{ url('send') }}" class="fixed-bottom p-3 d-flex justify-content-center ml-5 align-items-center">
                    @csrf
                    <div class="mb-3 w-75 text-right justify-content-end">
                        <textarea class="form-control text-area-ia" id="input" name="input" placeholder="Escribe tu mensaje" required></textarea>
                    </div>
                    <button type="submit" id="send-button" class="btn btn-primary mx-2">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    
@livewireScripts

<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        let currentChatId = null; // Variable para almacenar el ID del chat actual

           // Deshabilitar el botón de envío al cargar la página
            $('#send-button').prop('disabled', true);

           // Evento para habilitar/deshabilitar el botón de enviar
           $('#input').on('input', function() {
           const inputVal = $(this).val().trim(); // Obtener el valor del textarea y eliminar espacios en blanco
            $('#send-button').prop('disabled', inputVal === ''); // Habilitar o deshabilitar el botón según si el textarea está vacío
            });
        // Evento para el botón de "Nuevo Chat"
        $('#new-chat-btn').on('click', function() {
            currentChatId = null; // Reiniciar el chat actual
            $('#chat-history').empty(); // Limpiar el historial
            
            // Usar SweetAlert para mostrar un mensaje personalizado
            Swal.fire({
                title: 'Nuevo Chat Iniciado',
                text: 'Has comenzado un nuevo chat. ¡Adelante!',
                icon: 'info',
                confirmButtonText: 'Aceptar',
                width: '600px',
                padding: '1.5rem',
                background: '#f7f9fc',
                backdrop: 'rgba(0, 0, 0, 0.6)',
                customClass: {
                    title: 'text-primary',
                    content: 'text-dark',
                    popup: 'swal-custom-popup'
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });

        // Evento para el envío del formulario
        $('#chat-form').on('submit', function(e) {
            e.preventDefault(); // Evita el envío por defecto del formulario

            const input = $('#input').val();
            // Mostrar mensaje de carga
            $('#loading-message').removeClass('d-none');

            $.ajax({
                type: 'POST',
                url: '{{ url('send') }}', // Ruta de tu API
                data: {
                    input: input,
                    chat_id: currentChatId, // Enviar el chat ID si está activo
                    _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function(data) {
                    // Si es un nuevo chat, actualizar el chat ID
                    if (!currentChatId && data.chat_id) {
                        currentChatId = data.chat_id;
                    }

                    // Agregar la pregunta y la respuesta al historial
                    $('#chat-history').append(`
                       <div>
                         <strong class="text-primary">Pregunta:</strong> <span class="question">${input}</span><br>
                         <strong class="text-primary">Respuesta:</strong> 
                         <span class="response">${data.response.replace(/\n/g, '<br>')}</span><br>
                         <hr>
                      </div>
                    `);
                      // Hacer scroll hacia abajo para mostrar el último mensaje
                    $('#chat-history').scrollTop($('#chat-history')[0].scrollHeight);
                    // Restablecer el campo de entrada
                    $('#input').val('');
                    $('#send-button').prop('disabled', true); // Deshabilitar el botón después de enviar
                },
                error: function(xhr) {
                    if (xhr.status === 401) { // Verifica si el error es de autenticación
                        // Mostrar SweetAlert para el error de autenticación
                        Swal.fire({
                            title: 'No autenticado',
                            text: 'Por favor, inicie sesión para usar el chat IA de MEDFILE.',
                            icon: 'warning',
                            confirmButtonText: 'Cerrar',
                            customClass: {
                                title: 'text-danger',  // Personaliza el color del título
                                content: 'text-dark'   // Personaliza el color del contenido
                            },
                            background: '#f7f9fc', // Fondo personalizado
                            backdrop: 'rgba(0, 0, 0, 0.6)', // Color de fondo
                            width: '400px',  // Ancho personalizado
                            padding: '1.5rem', // Padding interno
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown' // Animación al mostrar
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp' // Animación al ocultar
                            }
                        });
                    } else {
                        // Manejar otros errores
                        $('#chat-history').append(`
                           <div class="text-danger fs-6">
                                 <strong>Error:</strong> ${xhr.responseJSON.error}<br><hr>
                           </div>
                        `);
                    }
                },
                complete: function() {
                    // Ocultar el mensaje de carga
                    $('#loading-message').addClass('d-none');
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('input');

        textarea.addEventListener('input', function() {
            this.style.height = 'auto'; // Restablecer la altura
            this.style.height = (this.scrollHeight) + 'px'; // Ajustar a la altura del contenido
        });
    });
</script>


<script>
  function typeWriter(text, i = 0) {
      if (i < text.length) {
          document.getElementById("output").innerHTML += text.charAt(i);
          i++;
          setTimeout(() => typeWriter(text, i), 100); // Ajusta la velocidad aquí
      }
  }

  typeWriter("Chat con la IA de MEDFILE", 0);
</script>

<style>
    .fade {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .fade.visible {
        opacity: 1;
    }
  </style>
  
  <script>
    function showFadeText() {
        const fadeText = document.getElementById("fadeText");
        fadeText.classList.add("visible");
        setTimeout(() => {
            fadeText.classList.remove("visible");
        }, 3000); // Duración visible
    }
  
    showFadeText();
  </script>
    @endsection
