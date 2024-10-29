<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Microinversiones</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
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
            max-width: 380px; /* Ancho aumentado */
            padding: 25px; /* Altura ajustada */
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
        }

        .avatar {
            background-color: #0077B5;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
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
            font-size: 24px;
            color: #1a202c;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            color: #4A5568;
            margin-bottom: 5px;
        }

        .input-group input {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
            font-size: 15px;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .input-group input:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.5);
        }

        .forgot-password {
            text-align: right;
            width: 100%;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: #3182ce;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .create-account {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .create-account a {
            color: #3182ce;
            text-decoration: none;
        }

        .create-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="avatar">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
        </div>

        <h1>Iniciar Sesión en Microinversiones</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required>
            </div>


            <button type="submit">Ingresar</button>
        </form>

        <p class="create-account">¿No tienes una cuenta? <a href="{{ route('register') }}">Crea tu cuenta</a></p>
    </div>

</body>
</html>
