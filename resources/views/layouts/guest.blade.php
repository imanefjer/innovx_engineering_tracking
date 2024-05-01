<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Innovx App') }}</title>
        <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <svg  class ="topright" height="140" width="140" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="120" cy="80" rx="100" ry="50" style="fill:black" />
        </svg>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
       
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <div class="bottomleft">
            <svg height="100" width="500" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="240" cy="50" rx="220" ry="30" fill="black" />
                <ellipse cx="220" cy="50" rx="190" ry="20" fill="#f3f4f6" />
            </svg>
        </div>
        <div class="bottomrightrot">
            <svg height="100" width="400" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="220" cy="50" rx="220" ry="30" fill="#D9D9D9" />
                <ellipse cx="220" cy="50" rx="190" ry="20" fill="#f3f4f6" />
            </svg>
        </div>
        <div class ="topleft" >
            <svg  height="200" width="300" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="90" cy="60" rx="120" ry="30" fill="#D9D9D9" />
            </svg>
        </div>
    </body>
</html>
