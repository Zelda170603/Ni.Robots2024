<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ni.Robots')</title>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    @include('Index.chatbot')
    @include('Index.search-results')
    <main class="container mx-auto p-4 min-h-full mt-18">
        @yield('content')
    </main>
    @vite('resources/js/dark-mode.js')
    
</body>