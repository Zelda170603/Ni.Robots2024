<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="container mx-auto p-4 min-h-full mt-18">
        <div class="mx-auto max-w-7xl px-8">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Order history</h1>
                <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                    Check the status of recent orders, manage returns, and discover similar products.
                </p>
            </div>
        </div>
        <div class="mt-16">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="mx-auto flex flex-col gap-4 sm:max-w-2xl sm:px-4 lg:max-w-4xl lg:px-0">
                    @if($compras->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">No orders found.</p>
                    @else
                        @foreach($compras as $compra)
                            <div class="border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                                <div class="flex items-center border-b border-gray-200 dark:border-gray-600 p-4 sm:grid grid-cols-4 sm:gap-x-6 sm:p-6">
                                    <dl class="grid flex-1 grid-cols-3 gap-x-6 text-sm col-span-3">
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Order number</dt>
                                            <dd class="mt-2 text-gray-500">{{ $compra->compra_id }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Date placed</dt>
                                            <dd class="mt-2 text-gray-500"><time datetime="{{ $compra->created_at }}">{{ $compra->created_at->format('M j, Y') }}</time></dd>
                                        </div>
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Total amount</dt>
                                            <dd class="mt-2 font-bold text-gray-900 dark:text-gray-400">${{ $compra->total }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach($compra->compraProductos as $compraProducto)
                                        <li class="sm:p-6 p-4">
                                            <div class="flex sm:items-start">
                                                <div class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-800 sm:w-44 sm:h-44 ">
                                                    <img src="{{ Storage::url('images/productos/' . $compraProducto->producto->foto_prod)}}" alt="{{ $compraProducto->producto->nombre_prod }}" class="w-full h-full object-cover object-center">
                                                </div>
                                                <div class="ml-4 w-full">
                                                    <div class="flex justify-between text-md font-medium text-gray-700 dark:text-gray-400">
                                                        <span>{{ $compraProducto->producto->nombre_prod }} x {{ $compraProducto->cantidad }}</span>
                                                        <p>${{ $compraProducto->producto->precio }}</p>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $compraProducto->producto->descripcion }}</p>
                                                </div>
                                            </div>
                                            <div class="mx-auto flex items-center justify-between space-x-2 mt-4">
                                                <div class="flex items-center justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-green-500">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        Delivered on <time datetime="{{ $compra->created_at }}">{{ $compra->created_at->format('M j, Y') }}</time>
                                                    </p>
                                                </div>
                                                <div class="font-medium flex items-center justify-center  space-x-4">
                                                    <a href="#" class="text-indigo-600 pr-4 hover:text-indigo-900 border-r border-gray-500 dark:text-indigo-400 dark:border-gray-600 ">View product</a>
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Buy again</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
</body>

</html>
