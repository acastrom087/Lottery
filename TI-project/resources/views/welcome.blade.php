<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="css/app.css" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0"
        style="background-image: url(img/sorteos.png);background-size: cover;
        background-repeat:no-repeat;">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white rounded py-1 px-1 text-2xl text-orange-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-white rounded py-1 px-1 text-2xl text-orange-700">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white rounded py-1 px-1 ml-4 text-2xl text-orange-700">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div>
            <div class="bg-gray-100 rounded px-1">
                <h1 class="text-center text-3xl text-orange-700 uppercase">Tiempos Costa Rica</h1>
            </div>
        </div>
    </div>
</body>

</html>
