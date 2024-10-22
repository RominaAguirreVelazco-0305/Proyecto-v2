<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inversión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Inversión</h2>
        <form action="{{ route('investments.update', $investment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Título de la Inversión</label>
                <input type="text" id="title" name="title" value="{{ $investment->title }}" required>
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4" required>{{ $investment->description }}</textarea>
            </div>

            <div>
                <label for="amount">Monto Requerido</label>
                <input type="number" id="amount" name="amount" value="{{ $investment->amount }}" required>
            </div>

            <div>
                <label for="status">Estado</label>
                <select id="status" name="status">
                    <option value="abierto" {{ $investment->status == 'abierto' ? 'selected' : '' }}>Abierto</option>
                    <option value="financiado" {{ $investment->status == 'financiado' ? 'selected' : '' }}>Financiado</option>
                    <option value="cerrado" {{ $investment->status == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
                </select>
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
