<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inversiones Disponibles') }}
        </h2>
    </x-slot>

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
            height: 420px; /* Altura fija para todas las tarjetas */
            margin-bottom: 20px;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }
        .card-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px; /* Ajusta el espacio bajo el título */
            padding-bottom: 10px; /* Añade más espacio y define un separador */
            border-bottom: 1px solid #e0e0e0; /* Línea de separación */
        }
        .card-text {
            font-size: 16px;
            color: #666;
            margin-top: 10px; /* Añade espacio entre el título y el texto */
            flex-grow: 1; /* Permite que el texto expanda */
            overflow: hidden;
        }
        .btn {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }

        /* Estilos para el modo oscuro */
        body.dark-mode .card {
            background-color: #333;
            color: #fff;
        }
        body.dark-mode .card-title,
        body.dark-mode .card-text,
        body.dark-mode .btn {
            color: #fff;
        }
        body.dark-mode .btn {
            background-color: #0062cc;
        }
        body.dark-mode .btn:hover {
            background-color: #004495;
        }
    </style>

    <div class="card-container">
        @foreach ($investments as $investment)
            <div class="card">
                <img src="{{ asset('storage/' . $investment->image) }}" alt="Imagen representativa de la inversión: {{ $investment->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $investment->title }}</h2>
                    <div class="card-text">{{ $investment->description }}</div>
                    @if(auth()->check() && auth()->id() == $investment->user_id)
                        <a href="{{ route('investments.index') }}" class="btn">Ver Mis Inversiones</a>
                    @elseif(auth()->check())
                        <a href="{{ route('investments.show', $investment->id) }}" class="btn">Ver Detalles</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Iniciar sesión para ver detalles</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
