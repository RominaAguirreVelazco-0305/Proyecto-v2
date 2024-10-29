    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invertir en Proyecto</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff; /* Fondo blanco para modo claro */
        color: #333; /* Texto negro para modo claro */
    }
    .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 8px;
        background-color: inherit; /* Utiliza el color de fondo del body */
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
        border: 2px solid #ccc; /* Borde más grueso y visible */
        border-radius: 4px;
        background-color: #fff; /* Fondo claro para los inputs */
        color: #000; /* Texto oscuro para los inputs */
    }
    button, .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        width: 100%; /* Asegura que el botón se expanda completamente */
        margin-top: 10px; /* Espacio antes de cada botón */
    }
    .btn-secondary {
        background-color: #007bff; /* Azul */
        color: white;
    }
    .btn-secondary:hover {
        background-color: #0056b3; /* Azul oscuro */
    }
    .btn-primary {
        background-color: #dc3545; /* Rojo */
        color: white;
    }
    .btn-primary:hover {
        background-color: #c82333; /* Rojo oscuro */
    }

    /* Estilos para el modo oscuro */
    body.dark-mode {
        background-color: #333; /* Fondo oscuro para el modo oscuro */
        color: #fff; /* Texto claro para el modo oscuro */
    }
    body.dark-mode .container {
        background-color: #424242; /* Fondo oscuro para el contenedor en modo oscuro */
    }
    body.dark-mode input[type="text"], body.dark-mode input[type="number"], body.dark-mode input[type="date"], body.dark-mode select, body.dark-mode textarea {
        background-color: #555; /* Fondo gris oscuro para inputs en modo oscuro */
        color: #ddd; /* Texto gris claro para inputs en modo oscuro */
        border: 2px solid #777; /* Borde más visible en modo oscuro */
    }
    body.dark-mode button, body.dark-mode .btn {
        background-color: #0062cc; /* Azul para el modo oscuro */
    }
    body.dark-mode button:hover, body.dark-mode .btn:hover {
        background-color: #004495; /* Azul más oscuro al pasar el mouse */
    }
</style>


    </head>
    <body class="{{ (session('darkMode') === true) ? 'dark-mode' : '' }}">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invertir en Proyecto
            </h2>
        </x-slot>

        <div class="container">
            <form action="{{ route('processInvestment', $investment->id) }}" method="post">
                @csrf
                <label for="amount">Cantidad a invertir:</label>
                <input type="number" id="amount" name="amount" placeholder="Ingrese la cantidad a invertir" required>

                <label for="card_number">Número de Tarjeta:</label>
                <input type="text" id="card_number" name="card_number" placeholder="Número de tarjeta" required pattern="^[45]\d{12,18}$">

                <label for="card_expiry">Fecha de Vencimiento:</label>
                <input type="date" id="card_expiry" name="card_expiry" required min="{{ date('Y-m-d') }}">

                <label for="card_cvc">CVC:</label>
                <input type="number" id="card_cvc" name="card_cvc" placeholder="CVC" required pattern="\d{3,4}">

                <button type="submit" class="btn btn-primary">Confirmar Inversión</button>
                <button type="button" onclick="window.location.href='{{ route('investments.show', $investment->id) }}'" class="btn btn-secondary">Regresar</button>
            </form>
        </div>  
    </x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
    </html>
