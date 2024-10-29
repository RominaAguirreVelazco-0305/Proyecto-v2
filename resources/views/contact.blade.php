<!DOCTYPE html>
<html lang="es">
<x-app-layout>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos generales */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ajustado para manejar mejor la altura total */
            color: #444;
            transition: background-color 0.3s, color 0.3s;
        }
        .content-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }
        .container {
            max-width: 500px; /* Mantenido como antes */
            max-height: 85vh; /* Nuevo límite de altura máxima */
            text-align: center;
            background-color: #fff;
            padding: 10px; /* Reducido el padding */
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: auto; /* Añadido desplazamiento si es necesario */
        }
        /* Foto de perfil */
        .profile-img {
            width: 140px;
            height: 170px;
            border-radius: 15% / 30%;
            margin-bottom: 20px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            transition: transform 0.3s;
        }
        .profile-img:hover {
            transform: scale(1.1);
        }
        /* Estilo para el nombre */
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            position: relative;
        }
        h1::after {
            content: "";
            width: 80px;
            height: 4px;
            background-color: #007bff;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
            border-radius: 2px;
        }
        /* Estilo de introducción */
        .intro-text {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
            margin: 20px 0;
            padding: 0 15px;
            animation: fadeIn 1s ease-out;
        }
        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .social-links, .contact-info {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 15px 0;
        }
        .social-links a, .contact-info a {
            font-size: 26px;
            color: #555;
            transition: transform 0.3s, color 0.3s;
            text-decoration: none;
        }
        .social-links a:hover, .contact-info a:hover {
            transform: rotate(15deg) scale(1.3);
            color: #007bff;
        }
        .fa-facebook-f { color: #3b5998; }
        .fa-instagram { color: #e1306c; }
        .fa-twitter { color: #1da1f2; }
        .fa-github { color: #333; }
        .fa-envelope { color: #d44638; }
        .fa-whatsapp { color: #25d366; }
        /* Botones personalizados */
        .btn {
            padding: 8px 18px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
            font-weight: bold;
            display: inline-block;
            margin: 10px;
        }
        .btn-blue {
            background-color: #007bff;
        }
        .btn-blue:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-dark {
            background-color: #333;
        }
        .btn-dark:hover {
            background-color: #111;
            transform: scale(1.05);
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            width: 100%;
            font-size: 13px;
        }

        /* Modo oscuro */
        body.dark-mode {
            background-color: #121212;
            color: #ddd;
        }
        .dark-mode .container {
            background-color: #1e1e1e;
            color: #ddd;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }
        .dark-mode .footer {
            background-color: #111;
            color: #ccc;
        }
        .dark-mode .social-links a, .dark-mode .contact-info a {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <img src="{{ asset('images/perfil.jpeg') }}" alt="Romina Jacqueline Aguirre Velazco" class="profile-img" onerror="this.src='{{ asset('images/default.jpg') }}'">
            <h1>Romina Jacqueline Aguirre Velazco</h1>
            <p class="intro-text">Aquí puedes encontrar mis redes sociales y medios de contacto. No dudes en comunicarte conmigo para cualquier consulta o colaboración.</p>
            <div class="social-links">
                <a href="https://www.facebook.com/profile.php?id=100077305261315&mibextid=ZbWKwL" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/rominaagvela05/profilecard/?igsh=bGE4dGZ5NGp6emcy" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/tuusuario" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://github.com/RominaAguirreVelazco-0305" target="_blank"><i class="fab fa-github"></i></a>
            </div>
            <div class="contact-info">
                <a href="mailto:romina.aguirre8841@alumnos.udg.mx"><i class="fa fa-envelope"></i></a>
                <a href="https://wa.me/523326624942"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Romina Jacqueline Aguirre Velazco - Todos los Derechos Reservados</p>
    </footer>

    <script>
        // Función para regresar a la página anterior
        function goBack() {
            window.history.back();
        }

        // Función para alternar el modo oscuro
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
    </x-app-layout>

</body>
</html>
