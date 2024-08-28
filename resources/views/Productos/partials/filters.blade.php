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
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form id="filterForm" action="{{ route('productos.index') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="tipo_producto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo
                    de
                    Producto</label>
                <select name="tipo_producto" id="tipo_producto"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">Todos</option>
                    <option value="protesis">Prótesis</option>
                    <option value="ortesis">Órtesis</option>
                    <option value="ortopedicos">Ortopédicos</option>
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
                    <label for="precio_min" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio
                        Mínimo</label>
                    <input type="number" name="precio_min" id="precio_min" value="{{ request('precio_min') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div class="sm:w-1/2 lg:w-auto">
                    <label for="precio_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio
                        Máximo</label>
                    <input type="number" name="precio_max" id="precio_max" value="{{ request('precio_max') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
            </div>
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Color</label>
                <input type="text" name="color" id="color" value="{{ request('color') }}"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
            </div>
            <div>
                <label for="nivel_afectacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel
                    de
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
