<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con GPT-3.5 Turbo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            border-radius: 10px;
            background-color: #ffffff;
        }
        .message-container {
            height: 300px;
            overflow-y: auto;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .message {
            padding: 5px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 5px;
        }
        .user-message {
            text-align: right;
            color: blue;
        }
        .ai-message {
            text-align: left;
            color: green;
        }
        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 10px;
        }
        button {
            background-color: #007bff; /* Azul brillante */
            color: white; /* Texto blanco */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            width: 100%; /* Hace que el botón se extienda por todo el ancho */
        }
        button:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el mouse */
        }
                /* Modo oscuro */
body.dark-mode {
    background-color: #121212; /* Fondo más oscuro para todo el cuerpo */
    color: #e0e0e0; /* Texto claro */
}

body.dark-mode .container {
    background-color: #333; /* Fondo oscuro para el contenedor */
    color: #fff; /* Texto claro */
}

body.dark-mode .message-container {
    background-color: #242424; /* Fondo más oscuro para contenedor de mensajes */
    border-color: #444; /* Borde más oscuro */
}

body.dark-mode .btn {
    background-color: #0056b3; /* Botón más oscuro */
}

body.dark-mode .btn:hover {
    background-color: #004080; /* Botón más oscuro al pasar el mouse */
}

body.dark-mode textarea {
    background-color: #333; 
    color: #ddd;
}

    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat con GPT-3.5 Turbo
        </h2>
    </x-slot>

    <div class="container">
        <div class="message-container" id="messageContainer"></div>
        <form id="chatForm">
    @csrf
    <div class="profile-info">
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="profile-img">
        <textarea id="message" name="message" placeholder="Escribe tu mensaje aquí..."></textarea>
    </div>
    <button type="submit">Enviar Mensaje</button>
</form>

    </div>  
</x-app-layout>
<script src="{{ asset('js/app.js') }}"></script>
<script>
document.getElementById('chatForm').onsubmit = function(event) {
    event.preventDefault();
    const messageText = document.getElementById('message').value;
    const messageContainer = document.getElementById('messageContainer');
    const userMessageHtml = '<div class="message user-message"><strong>Tú:</strong> ' + messageText + '</div>';

    messageContainer.innerHTML = userMessageHtml + messageContainer.innerHTML;
    fetch("{{ route('chat.send') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message: messageText })
    })
    .then(response => response.json())
    .then(data => {
        const aiMessageHtml = '<div class="message ai-message"><strong>GPT-3.5:</strong> ' + data.response + '</div>';
        messageContainer.innerHTML = aiMessageHtml + messageContainer.innerHTML;
        document.getElementById('message').value = ''; // Clear the message input box
    })
    .catch(error => console.error('Error:', error));
};
</script>
</body>
</html>
