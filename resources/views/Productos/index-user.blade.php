<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="container mx-auto p-4 min-h-full mt-18">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Productos</h1>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800">
                <div class=" p-4 flex justify-between items-center">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        type="button" id="openFiltersButton">
                        Filtros
                    </button>
                    <div class="flex max-w-lg relative">
                        <label for="voice-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z" />
                                </svg>
                            </div>
                            <input type="text" id="search-bar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search products..." required />
                            <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 16 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 7v3a5.006 5.006 0 0 1-5 5H6a5.006 5.006 0 0 1-5-5V7m7 9v3m-3 0h6M7 1h2a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V4a3 3 0 0 1 3-3Z" />
                                </svg>
                            </button>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>Search
                        </button>
                        <div id="search-result"
                            class="absolute top-12 ring-blue-500 border-blue-500 border text-gray-900 text-sm rounded-lg  block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        </div>
                    </div>
                </div>

                <div class="my-4">
                    {{ $productos->links() }}
                </div>
                @if ($productos->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($productos as $producto)
                            <div
                                class="bg-white text-gray-800 dark:bg-gray-700 dark:text-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold">{{ $producto->nombre_prod }}</h2>
                                <img src="{{ Storage::url('images/productos/' . $producto->foto_prod) }}"
                                    alt="Foto de {{ $producto->nombre_prod }}"
                                    class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
                                <p class="mt-2"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                <p><strong>Precio:</strong> {{ $producto->precio }}</p>
                                <p><strong>Color:</strong> {{ $producto->color }}</p>
                                <p><strong>Nivel de Amputación:</strong> {{ $producto->nivel_afectacion }}</p>
                                <p><strong>Grupo de Usuarios:</strong> {{ $producto->grupo_usuarios }}</p>
                                <p><strong>Existencias:</strong> {{ $producto->existencias }}</p>
                                <p><strong>Tipo de Producto:</strong> {{ $producto->tipoProducto->nombre_tipo }}</p>
                                <p><strong>Fabricante:</strong> {{ $producto->fabricante->nombre }}</p>
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Editar
                                    </a>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded add-to-cart"
                                        data-product-id="{{ $producto->id }}">
                                        Añadir al Carrito
                                    </button>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $productos->links() }}
                    </div>
                @else
                    <p>No hay productos disponibles.</p>
                @endif
            </div>
        </div>
    </main>
    @include('Productos.cart')

    <div id="filter-content"
        class="fixed top-14 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full backdrop-blur-sm bg-white/70  w-80 dark:bg-gray-800/30"
        tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            Filtros
        </h5>
        <button type="button" id="closeFiltersButton"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form id="filterForm" action="{{ route('productos.index') }}" method="GET" class="mb-4">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="id_tipo_producto"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de
                        Producto</label>
                    <select name="id_tipo_producto" id="id_tipo_producto"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="">Todos</option>
                        @foreach ($tipo_productos as $tipo_producto)
                            <option value="{{ $tipo_producto->id }}"
                                {{ request('id_tipo_producto') == $tipo_producto->id ? 'selected' : '' }}>
                                {{ $tipo_producto->nombre_tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="id_fabricante"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fabricante</label>
                    <select name="id_fabricante" id="id_fabricante"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="">Todos</option>
                        @foreach ($fabricantes as $fabricante)
                            <option value="{{ $fabricante->id }}"
                                {{ request('id_fabricante') == $fabricante->id ? 'selected' : '' }}>
                                {{ $fabricante->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-4 lg:space-x-8">
                    <div class="sm:w-1/2 lg:w-auto">
                        <label for="precio_min"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio Mínimo</label>
                        <input type="number" name="precio_min" id="precio_min" value="{{ request('precio_min') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    </div>
                    <div class="sm:w-1/2 lg:w-auto">
                        <label for="precio_max"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio Máximo</label>
                        <input type="number" name="precio_max" id="precio_max" value="{{ request('precio_max') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    </div>
                </div>
                <div>
                    <label for="color"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Color</label>
                    <input type="text" name="color" id="color" value="{{ request('color') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div>
                    <label for="nivel_afectacion"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel de
                        Amputación</label>
                    <input type="text" name="nivel_afectacion" id="nivel_afectacion"
                        value="{{ request('nivel_afectacion') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    @vite('resources/js/dark-mode.js')
    @vite('resources/js/productos.js')
    @vite('resources/js/carrito.js')
</body>

</html>
