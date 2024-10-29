<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inversión</title>
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
        textarea {
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
            margin-right: 10px; /* Asegura espacio entre botones */
        }
        button:hover {
            background-color: #0056b3;
        }
        img {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Inversión</h2>
        <form action="{{ route('investments.update', $investment->id) }}" method="POST" enctype="multipart/form-data">
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
                <label for="goal_amount">Cantidad Objetivo ($)</label>
                <input type="number" id="goal_amount" name="goal_amount" step="0.01" value="{{ $investment->goal_amount }}" required>
            </div>

            <div>
                <label for="amount">Monto Requerido ($)</label>
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

            <div>
                <label for="image">Imagen (dejar en blanco para mantener la actual)</label>
                <input type="file" id="image" name="image">
                @if($investment->image)
                    <div>
                        <img src="{{ asset('storage/' . $investment->image) }}" alt="Imagen actual">
                    </div>
                @endif
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
