<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Inversión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
            border-radius: 8px;
            background-color: #ffffff; /* Fondo blanco para el modo claro */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            width: 50%; /* Ajusta el ancho de la imagen */
        }
        h1, p {
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s; /* Suaviza la transición de colores */
        }
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-regresar {
            background-color: #6c757d; /* Color de fondo para botón regresar en modo claro */
            color: white;
            margin-top: 20px; /* Espacio antes del botón Regresar */
        }
        .btn-regresar:hover {
            background-color: #5a6268;
        }

        /* Estilos para el modo oscuro */
        body.dark-mode {
            background-color: #333; /* Fondo oscuro para el modo oscuro */
            color: #fff; /* Texto claro para el modo oscuro */
        }

        body.dark-mode .container {
            background-color: #424242; /* Fondo oscuro para el contenedor en modo oscuro */
        }

        body.dark-mode .btn-primary {
            background-color: #0056b3;
        }
        body.dark-mode .btn-primary:hover {
            background-color: #004495;
        }

        body.dark-mode .btn-regresar {
            background-color: #5a6268; /* Color de fondo para botón regresar en modo oscuro */
        }
        body.dark-mode .btn-regresar:hover {
            background-color: #4b5258;
        }
    </style>
</head>
<body class="{{ (session('darkMode') === true) ? 'dark-mode' : '' }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la Inversión
        </h2>
    </x-slot>

    <div class="container">
        <div>
            <h1>{{ $investment->title }}</h1>
            <img src="{{ asset('storage/' . $investment->image) }}" alt="Imagen representativa de la inversión: {{ $investment->title }}">
            <p><strong>Descripcion: </strong>{{ $investment->description }}</p>
            <p><strong>Objetivo de Recaudación: </strong>${{ number_format($investment->goal_amount, 2) }}</p>
            <p><strong>Total Recaudado: </strong>${{ number_format($investment->raised_amount, 2) }}</p>
            <p><strong>Inversores: </strong>{{ $investment->investor_count }}</p>
            <a href="{{ route('investments.form', $investment->id) }}" class="btn btn-primary">Invertir Ahora</a>
            <a href="{{ url()->previous() }}" class="btn btn-regresar">Regresar</a>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
