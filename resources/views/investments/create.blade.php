<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar/Editar Inversión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ isset($investment) ? 'Editar Inversión' : 'Agregar Nueva Inversión' }}</h2>
        <form action="{{ isset($investment) ? route('investments.update', $investment->id) : route('investments.store') }}" method="POST">
            @csrf
            @if(isset($investment))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Título de la Inversión</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $investment->title ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $investment->description ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Monto Requerido</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $investment->amount ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-control" id="status" name="status">
                    <option value="abierto" {{ (isset($investment) && $investment->status == 'abierto') ? 'selected' : '' }}>Abierto</option>
                    <option value="financiado" {{ (isset($investment) && $investment->status == 'financiado') ? 'selected' : '' }}>Financiado</option>
                    <option value="cerrado" {{ (isset($investment) && $investment->status == 'cerrado') ? 'selected' : '' }}>Cerrado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
