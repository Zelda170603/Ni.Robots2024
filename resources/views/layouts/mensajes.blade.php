<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mensajes')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    @include('Index.search-results')
    <main class="flex h-screen overflow-hidden pt-14 ">
        @yield('content')
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones')
    @vite('resources/js/Mensajes/contactos_search.js')
    @vite('resources/js/Mensajes/mensajes.js')

</body>
