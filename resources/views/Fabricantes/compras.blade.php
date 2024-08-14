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
                <div class="mb-4 p-4 border rounded-lg bg-white shadow-md dark:bg-gray-800">
                    <h2 class="text-lg font-semibold mb-2">Orden #{{ $orden->compra->id }}</h2>
                    <p>Fecha de la compra: {{ $orden->compra->created_at->format('d/m/Y') }}</p>
                    <ul class="mb-4">
                        @foreach ($compraProductos as $compraProducto)
                            <li>
                                {{ $compraProducto->producto->nombre_prod }} - Cantidad: {{ $compraProducto->cantidad }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endforeach
        </div>
    </main>
    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            <div class="space-y-6">
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="#" class="shrink-0 md:order-1">
                            <img class="h-20 w-20 dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg"
                                alt="imac image" />
                            <img class="hidden h-20 w-20 dark:block"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-dark.svg"
                                alt="imac image" />
                        </a>

                        <label for="counter-input" class="sr-only">Cantidad Adquirida:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                            <div class="flex items-center">
                                <p class="text-base font-bold text-gray-900 dark:text-white">$699</p>
                            </div>
                            <div class="text-end md:order-4 md:w-32">
                                <p class="text-base font-bold text-gray-900 dark:text-white">$699</p>
                            </div>
                        </div>

                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                            <a href="#"
                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">Tablet
                                APPLE iPad Pro 12.9" 6th Gen, 128GB, Wi-Fi, Gold</a>

                            <div class="flex items-center gap-4">
                                <button type="button"
                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                    </svg>
                                    Add to Favorites
                                </button>

                                <button type="button"
                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="#" class="shrink-0 md:order-1">
                            <img class="h-20 w-20 dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg"
                                alt="imac image" />
                            <img class="hidden h-20 w-20 dark:block"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-dark.svg"
                                alt="imac image" />
                        </a>

                        <label for="counter-input" class="sr-only">Cantidad Adquirida:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                            <div class="flex items-center">
                                <p class="text-base font-bold text-gray-900 dark:text-white">$699</p>
                            </div>
                            <div class="text-end md:order-4 md:w-32">
                                <p class="text-base font-bold text-gray-900 dark:text-white">$699</p>
                            </div>
                        </div>

                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                            <a href="#"
                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">Tablet
                                APPLE iPad Pro 12.9" 6th Gen, 128GB, Wi-Fi, Gold</a>

                            <div class="flex items-center gap-4">
                                <button type="button"
                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                    </svg>
                                    Add to Favorites
                                </button>

                                <button type="button"
                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
</body>

</html>
