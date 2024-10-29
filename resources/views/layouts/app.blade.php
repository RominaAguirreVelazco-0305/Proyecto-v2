<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Microinversiones</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="icon" href="{{ asset('icons/logo.jpg') }}" type="image/jpg"/>

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <!-- Estilos para el modo oscuro -->
        <style>
    /* Estilos base, modo claro */
    body {
        background-color: #fff; /* Fondo blanco para el modo claro */
        color: #333; /* Texto oscuro para el modo claro */
    }

    /* Estilos para el modo oscuro */
    body.dark-mode {
        background-color: #333; /* Fondo oscuro para el modo oscuro */
        color: #fff; /* Texto claro para el modo oscuro */
    }

    body.dark-mode .bg-gray-100 {
        background-color: #424242; /* Cambia el fondo de los contenedores específicos también */
    }

    /* Asegúrate de que todos los textos y componentes se ajusten al modo oscuro */
    body.dark-mode nav,
    body.dark-mode .bg-white,
    body.dark-mode .card,
    body.dark-mode header {
        background-color: #424242;
    }

    body.dark-mode .text-gray-800,
    body.dark-mode .text-black,
    body.dark-mode a,
    body.dark-mode .link {
        color: #e0e0e0;
    }

    body.dark-mode .btn-blue {
        background-color: #2563eb; /* Botón en azul */
        color: #fff;
    }

    body.dark-mode .btn-blue:hover {
        background-color: #1e40af; /* Botón en azul más oscuro al hacer hover */
    }

    body.dark-mode .card {
        border: 1px solid #666; /* Borde para tarjetas */
    }

    body.dark-mode .shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave para los componentes */
    }

    body.dark-mode .navbar,
    body.dark-mode .footer {
        background-color: #2d2d2d; /* Fondo para navbar y footer */
        color: #fff; /* Texto para navbar y footer */
    }
</style>
        </style>
    </head>
    <body class="font-sans antialiased {{ (session('darkMode') === true) ? 'dark-mode' : '' }}">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Session Status -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }} <!-- Mensaje de información -->
                </div>
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        @stack('modals')

        @livewireScripts
        <script>
            function toggleDarkMode() {
                let darkMode = localStorage.getItem('darkMode') === 'true';
                darkMode = !darkMode;
                localStorage.setItem('darkMode', darkMode);
                document.body.classList.toggle('dark-mode');
            }

            document.addEventListener("DOMContentLoaded", function() {
                const darkMode = localStorage.getItem('darkMode') === 'true';
                if (darkMode) {
                    document.body.classList.add('dark-mode');
                }
                
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    setTimeout(function() {
                        alert.style.opacity = '0';
                        setTimeout(function() { alert.remove(); }, 600);
                    }, 5000);
                });
            });
        </script>
    </body>
</html>
