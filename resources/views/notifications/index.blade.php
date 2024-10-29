<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            background-color: #ffffff; /* Para modo claro */
        }
        .notification {
            border: 2px solid #eee; /* Borde alrededor de cada notificación */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra para dar profundidad */
            padding: 15px;
            margin-bottom: 20px; /* Mayor espacio entre notificaciones */
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffffff; /* Asegurarse de que el fondo es blanco o de un color que contraste con el borde */
        }
        .notification img {
            border-radius: 50%;
            margin-right: 15px;
            width: 30px; /* Ajustado a 30px */
            height: 30px; /* Ajustado a 30px para mantener la proporción */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            object-fit: cover; /* Esto asegura que la imagen se recorte para llenar el espacio */
        }
        .notification-content {
            flex-grow: 1;
            margin-right: 20px;
        }
        .notification-count {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 0.3em 0.7em;
            font-size: 1em;
            vertical-align: top;
            margin-left: 10px;
        }
        .btn {
            margin-top: 5px;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        /* Estilos para el modo oscuro */
        body.dark-mode .container,
        body.dark-mode .notification,
        body.dark-mode .notification.unread {
            background-color: #333; /* Fondo oscuro */
            color: #ccc; /* Texto más claro */
        }
        body.dark-mode .notification {
            border-color: #555; /* Borde más oscuro en modo oscuro */
            box-shadow: 0 4px 8px rgba(0,0,0,0.3); /* Sombra más oscura para modo oscuro */
        }
    </style>
    <!-- Añadiendo jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteNotification(notificationId) {
            $.ajax({
                url: '/notifications/' + notificationId, // Asegúrate de que esta URL es correcta
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(result) {
                    // Si la eliminación fue exitosa, elimina el elemento de la lista
                    $('li.notification-item-' + notificationId).remove();
                },
                error: function() {
                    alert('Error al eliminar la notificación');
                }
            });
        }
    </script>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }} <span class="notification-count">{{ $unreadCount }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="container">
                    <h2>Tus Notificaciones</h2>

                    <form action="{{ route('notifications.deleteAll') }}" method="POST" style="margin-bottom: 20px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Eliminar Todas las Notificaciones</button>
                    </form>

                    @if($notifications->isEmpty())
                        <p>No tienes notificaciones.</p>
                    @else
                        <ul>
                            @foreach ($notifications as $notification)
                                @php
                                    $investment = \App\Models\Investment::find($notification->data['investment_id']);
                                @endphp
                                <li class="notification-item-{{ $notification->id }} {{ $notification->read_at ? 'read' : 'unread' }}">
                                    <div class="notification">
                                        <div class="notification-content">
                                            <p>{{ $notification->data['message'] }}</p>
                                            <p>Inversor: {{ $notification->data['investor_name'] }}</p>
                                            <p>Cantidad Invertida: ${{ number_format($notification->data['amount'], 2) }}</p>
                                        </div>
                                        @if($investment && Storage::disk('public')->exists($investment->image))
                                            <img src="{{ Storage::url($investment->image) }}" alt="Imagen de la inversión" style="width: 90px; height: 60px; border-radius: 50%;">
                                        @else
                                            <p>Imagen no disponible</p>
                                        @endif
                                        <button onclick="deleteNotification('{{ $notification->id }}')" class="btn">Eliminar</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
