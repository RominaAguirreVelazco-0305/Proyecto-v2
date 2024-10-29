<nav x-data="{ open: false }" class="bg-white border-b border-gray-100" style="position: sticky; top: 0; z-index: 1000;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->



                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-mark class="block h-9 w-auto" />
                                </a>
                            </div>
                            

                    
                                                                <!-- Navigation Links -->
                                                                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
        {{ __('Home') }}
    </x-nav-link>
    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
        {{ __('Contáctanos') }}
    </x-nav-link>
    <x-nav-link href="{{ route('top.investments') }}" :active="request()->routeIs('top.investments')">
        {{ __('Proyectos con Más Inversiones') }}
    </x-nav-link>
    @auth
    <x-nav-link href="{{ route('investments.index') }}" :active="request()->routeIs('investments.index')">
        {{ __('Mis inversiones creadas') }}
    </x-nav-link>
    <x-nav-link href="{{ route('chat.form') }}" :active="request()->routeIs('chat.form')">
        {{ __('ChatBox') }}
    </x-nav-link>
    @endauth
    <!-- Botón para cambiar el tema -->
    <button onclick="toggleDarkMode()" class="px-3 py-2 rounded text-white bg-gray-800 hover:bg-gray-600">
        Cambiar Modo
    </button>
</div>



                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            @auth
                                <div class="ms-3 relative">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                        {{ Auth::user()->name }}
                                                    </button>
                                                </span>
                                            @endif  
                                        </x-slot>

                                        <x-slot name="content">
                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('notifications.index') }}">
                    {{ __('Notificaciones') }}
                </x-dropdown-link>
                <div class="border-t border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>

                                    </x-dropdown>
                                </div>
                            @else
                            <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>
                            <div>

                            </div>
                            <a href="{{ route('register') }}" class="btn-login" style="margin-right: 10px;">Registrarse</a>

                            <style>
            .btn-login {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: 500;
                color: #ffffff;
                background-color: #007bff;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s, box-shadow 0.3s;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                margin-right: 10px; /* Añade espacio entre los botones */
            }

            .btn-login:last-child {
                margin-right: 0; /* Elimina el margen del último botón */
            }

            .btn-login:hover, .btn-login:focus {
                background-color: #0056b3;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                color: #ffffff;
                text-decoration: none;
            }
            </style>



                            @endauth
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
            <!-- Enlace al Home -->
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <!-- Condición para mostrar enlaces solo a usuarios autenticados -->
            @auth
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-responsive-nav-link>

        <!-- Enlaces visibles solo para usuarios autenticados -->
        @auth
            <!-- Enlace a Mis Inversiones -->
            <x-responsive-nav-link href="{{ route('investments.index') }}" :active="request()->routeIs('investments.index')">
                {{ __('Mis inversiones creadas') }}
            </x-responsive-nav-link>

            <!-- Enlace a ChatBox -->
            <x-responsive-nav-link href="{{ route('chat.form') }}" :active="request()->routeIs('chat.form')">
                {{ __('ChatBox') }}
            </x-responsive-nav-link>
        @endauth

        <!-- Enlaces accesibles para todos los usuarios -->
        <!-- Enlace a Contáctanos -->
        <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
            {{ __('Contáctanos') }}
        </x-responsive-nav-link>

        <!-- Enlace a Proyectos con más inversiones -->
        <x-responsive-nav-link href="{{ route('top.investments') }}" :active="request()->routeIs('top.investments')">
            {{ __('Proyectos con más inversiones') }}
        </x-responsive-nav-link>
            @endauth
        </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @auth
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="mt-3 space-y-1">
                                <!-- Account Management -->
                                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        {{ __('API Tokens') }}
                                    </x-responsive-nav-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Iniciar sesión</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>