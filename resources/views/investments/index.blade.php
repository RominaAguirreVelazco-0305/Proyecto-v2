<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Inversiones</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Inversiones Disponibles</h2>
        <a href="{{ route('investments.create') }}" class="btn btn-primary mb-3">Agregar Nueva Inversión</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($investments as $investment)
                <tr>
                    <td>{{ $investment->title }}</td>
                    <td>{{ $investment->description }}</td>
                    <td>{{ $investment->amount }}</td>
                    <td>{{ $investment->status }}</td>
                    <td>
                        <a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" style="display: inline-block;">
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
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
