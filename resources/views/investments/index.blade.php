    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Inversiones</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 8px;
        background-color: #ffffff; /* Modo claro */
    }

    .btn {
        margin-bottom: 10px;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        color: #fff;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-warning {
        background-color: #ffc107;
        color: #000;
    }
    .btn-warning:hover {
        background-color: #e0a800;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
    
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        text-align: left;
        padding: 8px;
        border-top: 1px solid #ddd; /* Borde superior en lugar de inferior */
        vertical-align: middle;
    }

    tbody tr {
        border-bottom: 1px solid #ddd; /* Borde solo en la parte inferior de cada fila */
    }

    img.thumbnail {
        width: 50px;
        height: auto;
    }

    .actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }

    /* Estilos específicos para modo oscuro */
    body.dark-mode .container,
    body.dark-mode .bg-white {
        background-color: #333; /* Fondo oscuro */
        color: #fff; /* Texto claro */
    }

    body.dark-mode .btn {
        background-color: #5a5a5a; /* Botones más oscuros en modo oscuro */
    }

    body.dark-mode .btn:hover {
        background-color: #404040; /* Hover de botones en modo oscuro */
    }

    body.dark-mode table {
        color: #fff; /* Texto claro en tablas */
    }

    body.dark-mode th, 
    body.dark-mode td {
        border-top: 1px solid #666; /* Ajustar el color de los bordes en modo oscuro */
    }

    body.dark-mode .btn-primary,
    body.dark-mode .btn-warning,
    body.dark-mode .btn-danger {
        opacity: 0.8; /* Ligeramente transparente para mejorar la visibilidad */
    }
    body.dark-mode .btn-primary:hover,
    body.dark-mode .btn-warning:hover,
    body.dark-mode .btn-danger:hover {
        opacity: 1; /* Opacidad normal al hacer hover */
    }
</style>

    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Listado de Inversiones') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="container">
                        <div class="header-actions">
                            <h2>Inversiones Disponibles</h2>
                            <a href="{{ route('investments.create') }}" class="btn btn-primary">Agregar Nueva Inversión</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Monto Requerido</th>
                                    <th>Cantidad Objetivo</th>
                                    <th>Inversores</th>
                                    <th>Recaudado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investments as $investment)
                                <tr>
                                        <td><img src="{{ asset('storage/' . $investment->image) }}" alt="Imagen de {{ $investment->title }}" class="thumbnail">
    
                                        </td>
                                    <td>{{ $investment->title }}</td>   
                                    <td>{{ $investment->description }}</td>
                                    <td>${{ number_format($investment->amount, 2) }}</td>
                                    <td>${{ number_format($investment->goal_amount, 2) }}</td>
                                    <td>{{ $investment->investor_count }}</td>
                                    <td>${{ number_format($investment->raised_amount, 2) }}</td>
                                    <td>{{ $investment->status }}</td>
                                    <td class="actions">
                                        <a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta inversión?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
    </html>
