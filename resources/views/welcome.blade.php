<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Sistema de Alumnos</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            font-family: 'Nunito', sans-serif;
            height: 100%;
            margin: 0;
        }
        .hover:transform {
            transition: transform .2s ease-in-out;
        }
        .card {
            transition: box-shadow .3s;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,.3);
        }
    </style>
</head>
<body class="bg-gray-100 full-height">
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <i class="fas fa-graduation-cap h-8 w-8"></i>
                    <span class="font-semibold text-xl">Sistema de Alumnos</span>
                </a>
                <div>
                    @auth
                        <a href="{{ url('/home') }}" class="px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-700 transition ease-in-out duration-150">Inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-700 transition ease-in-out duration-150">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-700 transition ease-in-out duration-150">Registrarse</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <header class="bg-indigo-500 text-white w-full h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold sm:text-5xl">
                Únete al Sistema de Alumnos
            </h1>
            <p class="mt-4 text-lg sm:text-xl">
                Crea tu cuenta para comenzar a gestionar la información de tus alumnos.
            </p>
            <div class="mt-8">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition ease-in-out duration-150">
                    Registrarse
                </a>
                <a href="{{ route('login') }}" class="ml-4 px-8 py-3 bg-transparent border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-indigo-600 transition ease-in-out duration-150">
                    Ya tengo cuenta
                </a>
            </div>
        </div>
    </header>
    
</body>
</html>
