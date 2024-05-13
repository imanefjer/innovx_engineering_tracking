<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Innovx app</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('extra-css') 

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 pb-4">
            
       
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="m-2">
                @yield('content')
                @if (isset($slot))
                    {{ $slot }}
                @endif
             </main>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        @yield('extra-js')
        <script>
        setInterval(() => {
            fetch('/path-to-get-notification-count')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('notificationCount').textContent = data.unreadCount;
                });
        }, 10000); // Update every 10 seconds
        </script>

    </body>
    
</html>
