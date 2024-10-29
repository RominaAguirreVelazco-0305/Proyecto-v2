<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Inversión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-color: #ffffff;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>{{ isset($investment) ? 'Editar Inversión' : 'Agregar Nueva Inversión' }}</h2>
        <form action="{{ isset($investment) ? route('investments.update', $investment->id) : route('investments.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="goal_amount" class="form-label">Cantidad Objetivo</label>
                <input type="number" class="form-control" id="goal_amount" name="goal_amount" step="0.01" value="{{ $investment->goal_amount ?? '' }}" required>
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
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
