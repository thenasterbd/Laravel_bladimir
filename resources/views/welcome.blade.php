<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - {{ config('app.name', 'Laravel') }}</title>
    <!-- Estilos de Tailwind CSS -->
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-cyan-500 to-blue-600 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-4xl mx-auto bg-white/90 backdrop-blur-sm shadow-xl rounded-lg overflow-hidden flex">
        <!-- Columna de la imagen -->
        <div class="w-1/2 flex items-center justify-center p-4">
            <img src="{{ asset('img/tourist.jpg') }}" alt="Imagen Descriptiva" class="max-h-full rounded-lg shadow-md">
        </div>
        <!-- Columna de los botones -->
<div class="w-1/2 p-6 sm:p-12 flex flex-col items-center justify-center">
    <h1 class="text-3xl font-bold mb-4 text-center text-gray-700">Bienvenido a {{ config('Pixel Pioneer', 'Pixel Pioneer') }}</h1>
    <p class="text-gray-600 mb-8 text-center">Comienza tu nueva aventura con Nosotros.</p>
    <div class="flex flex-col sm:flex-row sm:justify-center gap-4">
        <a href="{{ route('login') }}" class="block text-center w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300 ease-in-out">
            Iniciar sesión
        </a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block text-center w-full sm:w-auto bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition duration-300 ease-in-out">
                Registrarse
            </a>
        @endif
    </div>
</div>
    </div>
</body>
</html>
