<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administracion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notificaciones.js', 'resources/js/dark-mode.js'])
    @vite(['resources/js/chart.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    @include('Administracion.nav-bar')
    
    @if (auth()->user()->role->role_type == 'admin')
        @include('components.aside-admin')
    @elseif(auth()->user()->role->role_type == 'doctor')
      @include('components.aside-doctor')
    @endif

    @include('components.aside-doctor')
    <div class="lg:pl-64 pt-20">
        <main class="grid gap-4 xl:grid-cols-4 px-4 2xl:grid-cols-3">
            @yield('content')
        </main>
        @include('components.footer-admin')

        <p class="my-10 text-sm text-center text-gray-500">
            &copy; 2019-2023 <a href="https://flowbite.com/" class="hover:underline" target="_blank">Flowbite.com</a>.
            All rights reserved.
        </p>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>

</html>
