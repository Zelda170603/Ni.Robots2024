<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Compras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">

    @include('Index.nav-bar')mx-auto p-4 min-h-full mt-18
    <main class="mt-18 md:gap-6 lg:items-start xl:gap-8">

        <div class="mx-auto max-w-7xl px-8 mb-4">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Historial de compras</h1>
                <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                    Revisa el estado de las ordenes, gestiona devoluciones y descubre productos similares.
                </p>
            </div>
        </div>
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            @foreach ($comprasPendientes as $compraProductos)
                @foreach ($compraProductos as $orden)
                    <div class="mb-4 p-4 first-of-type:border border-b last:border-none rounded-lg bg-white shadow-md dark:bg-gray-800">
                        <h2 class="text-lg font-semibold mb-2">Orden #{{ $orden->compra->id }}</h2>
                        <p>Fecha de la compra: {{ $orden->compra->created_at->format('d/m/Y') }}</p>

                        <!-- Botón para mostrar el popover -->
                        <button data-popover-target="popover-user-profile-{{ $orden->compra->id }}" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            User Profile
                        </button>

                        <!-- Popover -->
                        <div id="popover-user-profile-{{ $orden->compra->id }}" data-popover role="tooltip"
                            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                            <div class="p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <a href="#">
                                        
                                        <img class="w-10 h-10 rounded-full"
                                            src="{{ Storage::url('images/profile_pictures/' .$orden->compra->User->profile_picture)}}" alt="{{$orden->compra->User->name}}">
                                    </a>
                                    <div>
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Contactar
                                        </button>
                                    </div>
                                </div>
                                <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                    <a href="#">{{$orden->compra->User->name}}</a>
                                </p>
                                <p class="mb-3 text-sm font-normal">
                                    <a href="#" class="hover:underline">{{$orden->compra->User->email}}</a>
                                </p>
                                <p class="mb-4 text-sm">{{$orden->compra->User->departamento}},{{$orden->compra->User->municipio}} 
                                    <a href="#"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">{{$orden->compra->User->domicilio}}</a>.</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>

                        <ul class="mb-4">
                            @foreach ($compraProductos as $compraProducto)
                                <div
                                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                    <div
                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <a href="#" class="shrink-0 md:order-1">
                                            <img class="h-20 w-20 dark:hidden"
                                                src="{{ asset('storage/images/product_pictures/' . $compraProducto->producto->foto_prod) }}"
                                                alt="{{ $compraProducto->producto->nombre_prod }} image" />
                                            <img class="hidden h-20 w-20 dark:block"
                                                src="{{ asset('storage/images/product_pictures/' . $compraProducto->producto->foto_prod) }}"
                                                alt="{{ $compraProducto->producto->nombre_prod }} image" />
                                        </a>

                                        <label for="counter-input" class="sr-only">Cantidad Adquirida:</label>
                                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                                            <div class="flex items-center">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">
                                                    ${{ $compraProducto->producto->precio }}</p>
                                            </div>
                                            <div class="text-end md:order-4 md:w-32">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">Cantidad:
                                                    {{ $compraProducto->cantidad }}</p>
                                            </div>
                                        </div>

                                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                            <a href="#"
                                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $compraProducto->producto->nombre_prod }}</a>

                                            <div class="flex items-center gap-4">
                                                <button type="button"
                                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                    </svg>
                                                    Add to Favorites
                                                </button>

                                                <button type="button"
                                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @endforeach
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
    <script>
        < script >
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('[data-popover-target]').forEach(button => {
                    button.addEventListener('click', function() {
                        const popoverId = this.getAttribute('data-popover-target');
                        const popover = document.getElementById(popoverId);

                        if (popover) {
                            popover.classList.toggle('invisible');
                            popover.classList.toggle('opacity-100');
                            popover.classList.toggle('opacity-0');
                        }
                    });
                });

                document.addEventListener('click', function(event) {
                    if (!event.target.matches('[data-popover-target]') && !event.target.closest(
                            '[data-popover]')) {
                        document.querySelectorAll('[data-popover]').forEach(popover => {
                            popover.classList.add('invisible');
                            popover.classList.remove('opacity-100');
                            popover.classList.add('opacity-0');
                        });
                    }
                });
            });
    </script>
    </script>
</body>

</html>
