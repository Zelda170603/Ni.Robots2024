<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mensajes')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notificaciones.js'])>
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    @include('Index.search-results')
    <main class="flex h-screen overflow-hidden pt-14 ">

        @if (session('status'))
  <div class="mb-4 rounded-lg border border-yellow-300 bg-yellow-50 px-4 py-3 text-sm text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-100 dark:border-yellow-700">
    {{ session('status') }}
  </div>
@endif
        @yield('content')
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
    @vite('resources/js/Mensajes/contactos_search.js')
    @vite('resources/js/Mensajes/mensajes.js')

</body>
