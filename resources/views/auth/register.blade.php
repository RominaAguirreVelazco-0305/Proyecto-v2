<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Microinversiones</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/img4.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
            filter: brightness(0.8);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            max-width: 350px; /* Conserva el ancho */
            padding: 15px; /* Ajustado para reducir la altura */
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
        }

        .avatar {
            background-color: #0077B5;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            margin-bottom: 10px; /* Espacio reducido */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar img {
            width: 80%;
            height: 80%;
            border-radius: 50%;
        }

        h1 {
            font-size: 20px;
            color: #1a202c;
            margin-bottom: 10px; /* Espacio reducido */
        }

        .input-group input {
            border-radius: 8px;
            padding: 8px; /* Altura de los inputs reducida */
            border: 1px solid #ccc;
            width: 100%;
            margin-top: 5px;
            font-size: 15px;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .input-group input:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.5);
        }

        .create-account {
            text-align: center;
            width: 100%;
        }

        .create-account a {
            color: #3182ce;
            text-decoration: none;
        }

        .create-account a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            margin-top: 10px;
            font-size: 15px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="avatar">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
        </div>

        <h1>Crear una Cuenta</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-3">
                <label for="name" class="block text-gray-700">Nombre</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="input-group mb-3">
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group mb-3">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="input-group mb-3">
                <label for="password_confirmation" class="block text-gray-700">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Registrar</button>
        </form>

        <p class="create-account">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a></p>
    </div>

</body>
</html>
