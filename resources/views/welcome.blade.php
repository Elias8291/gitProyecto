@extends('layouts.auth_app')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 animate">
        <h1 class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600 mb-6">Restablecer Contraseña</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/password/reset') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="email">
                    Correo Electrónico
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">
                    Nueva Contraseña
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="password_confirmation">
                    Confirmar Contraseña
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-gradient-to-br transition-all duration-300" type="submit">
                    Restablecer Contraseña
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-purple-600 hover:text-purple-800" href="{{ route('login') }}">
                    Iniciar Sesión
                </a>
            </div>
        </form>
    </div>
</div>
@endsection