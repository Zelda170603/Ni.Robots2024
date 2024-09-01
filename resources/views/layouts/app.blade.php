<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col bg-gradient custom-bg-gradient">
    <nav class="fixed top-0 md:justify-start md:flex-nowrap z-50 w-full backdrop-blur-3xl">
        <div class="max-w-[85rem] w-full mx-auto  md:gap-3 py-2 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-around items-center ">
                <div class="flex gap-4 col-span-2 items-center">

                    <a class="flex-none font-extrabold text-xl  max-w-32 text-black focus:outline-none focus:opacity-80 dark:text-white"
                        href="#" aria-label="Brand">Ni.Robots</a>

                </div>

                <div class=" flex flex-wrap font-bold items-center gap-x-1.5">
                    @if (Route::has('login'))
                        <a class="py-[7px] px-2.5 inline-flex items-center font-bold text-sm rounded-lg border border-gray-200 bg-transparent text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none  focus:outline-none   dark:text-neutral-300 dark:hover:bg-gray-700 "
                            href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="py-2 px-2.5 inline-flex items-center font-bold text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:bg-blue-600"
                            href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <main class="flex min-h-full flex-1">
        @yield('content')
    </main>
    @vite('resources/js/dark-mode.js')
</body>

</html>
