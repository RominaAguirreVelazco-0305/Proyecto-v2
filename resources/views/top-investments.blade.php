<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos con Más Inversiones') }}
        </h2>
    </x-slot>

    <style>
        .swiper-container {
            width: 100%;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .swiper-slide {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 280px;
            height: 400px; /* Ajustada para asegurar uniformidad */
        }

        .swiper-slide img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .swiper-slide h3 {
            margin-top: 10px;
            text-align: center;
            font-size: 18px;
            padding: 0 10px;
        }

        .swiper-slide p {
            text-align: center;
            font-size: 16px;
            color: #666;
            margin: 5px 20px 15px;
            height: 60px; /* Altura fija para uniformidad del texto */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .btn-primary {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.2s;
            display: block;
            width: auto;
            margin: 10px auto 0;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .swiper-button-prev, .swiper-button-next {
            color: #007BFF;
            height: 50px;
            width: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid lightgray;
        }

        .swiper-pagination-bullet {
            background-color: #007BFF;
        }

        /* Modo oscuro */
        body.dark-mode .swiper-slide {
            background: #424242;
        }

        body.dark-mode .swiper-button-prev, 
        body.dark-mode .swiper-button-next {
            background: #333;
            color: #fff;
        }

        body.dark-mode .swiper-pagination-bullet {
            background-color: #ccc;
        }

        body.dark-mode .btn-primary {
            background-color: #2563eb;
        }

        body.dark-mode .btn-primary:hover {
            background-color: #1e40af;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($investments as $investment)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $investment->image) }}" alt="Imagen de {{ $investment->title }}">
                    <h3>{{ $investment->title }}</h3>
                    <p>{{ $investment->description }}</p>
                    <a href="{{ route('investments.show', $investment->id) }}" class="btn btn-primary">Ver Detalles</a>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                }
            });
        });
    </script>
</x-app-layout>
