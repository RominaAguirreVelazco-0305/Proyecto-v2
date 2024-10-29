<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invertir en Proyecto</title>
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
        input[type="text"], input[type="number"], input[type="date"], select, textarea {
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invertir en Proyecto
        </h2>
    </x-slot>

    <div class="container">
        <a href="{{ route('investments.show', $investment->id) }}" class="btn btn-secondary">Regresar</a>
        <form action="{{ route('investments.processInvestment', $investment->id) }}" method="POST">
            @csrf
            <label for="amount">Cantidad a invertir:</label>
            <input type="number" id="amount" name="amount" placeholder="Ingrese la cantidad a invertir" required>

            <label for="card_number">Número de Tarjeta:</label>
            <input type="text" id="card_number" name="card_number" placeholder="Número de tarjeta" required>

            <label for="card_expiry">Fecha de Vencimiento:</label>
            <input type="date" id="card_expiry" name="card_expiry" required>

            <label for="card_cvc">CVC:</label>
            <input type="number" id="card_cvc" name="card_cvc" placeholder="CVC" required>

            <button type="submit">Confirmar Inversión</button>
        </form>
    </div>  
</x-app-layout>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
