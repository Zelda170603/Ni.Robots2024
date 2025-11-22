<div id="overlay" class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity opacity-0 pointer-events-none">
</div>
<div id="filter-content"
    class="fixed top-14 pb-10 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full backdrop-blur-sm bg-white/70  w-80 dark:bg-gray-800/30"
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
    <form id="filterForm" action="{{ route('books.index') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="autor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Autor</label>
                <select name="autor_id" id="autor_id"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">Todos</option>
                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}" {{ request('autor_id') == $autor->id ? 'selected' : '' }}>
                            {{ $autor->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="editorial_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Editorial</label>
                <select name="editorial_id" id="editorial_id"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">Todos</option>
                    @foreach ($editoriales as $editorial)
                        <option value="{{ $editorial->id }}"
                            {{ request('editorial_id') == $editorial->id ? 'selected' : '' }}>
                            {{ $editorial->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="categoria"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                <select name="categoria" id="categoria"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">Todas</option>
                    <option value="Literatura inclusiva"
                        {{ request('categoria') == 'Literatura inclusiva' ? 'selected' : '' }}>Literatura inclusiva
                    </option>
                    <option value="Educacion" {{ request('categoria') == 'Educacion' ? 'selected' : '' }}>Educación
                    </option>
                    <option value="Derechos y leyes"
                        {{ request('categoria') == 'Derechos y leyes' ? 'selected' : '' }}>Derechos y leyes</option>
                    <option value="Cuidado de la salud"
                        {{ request('categoria') == 'Cuidado de la salud' ? 'selected' : '' }}>Cuidado de la salud
                    </option>
                </select>
            </div>
            <div>
                <label for="grupo_usuarios" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grupo de
                    Usuarios</label>
                <select name="grupo_usuarios" id="grupo_usuarios"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    <option value="">Todos</option>
                    <option value="Niños" {{ request('grupo_usuarios') == 'Niños' ? 'selected' : '' }}>Niños</option>
                    <option value="Adolescentes" {{ request('grupo_usuarios') == 'Adolescentes' ? 'selected' : '' }}>
                        Adolescentes</option>
                    <option value="Adultos" {{ request('grupo_usuarios') == 'Adultos' ? 'selected' : '' }}>Adultos
                    </option>
                </select>
            </div>
            <div class="flex flex-col sm:flex-row sm:space-x-4 lg:space-x-8">
                <div class="sm:w-1/2 lg:w-auto">
                    <label for="fecha_publicacion_min"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Mínima</label>
                    <input type="date" name="fecha_publicacion_min" id="fecha_publicacion_min"
                        value="{{ request('fecha_publicacion_min') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div class="sm:w-1/2 lg:w-auto">
                    <label for="fecha_publicacion_max"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Máxima</label>
                    <input type="date" name="fecha_publicacion_max" id="fecha_publicacion_max"
                        value="{{ request('fecha_publicacion_max') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:space-x-4 lg:space-x-8">
                <div class="sm:w-1/2 lg:w-auto">
                    <label for="paginas_min" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Páginas
                        Mínimas</label>
                    <input type="number" name="paginas_min" id="paginas_min" value="{{ request('paginas_min') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <div class="sm:w-1/2 lg:w-auto">
                    <label for="paginas_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Páginas
                        Máximas</label>
                    <input type="number" name="paginas_max" id="paginas_max" value="{{ request('paginas_max') }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600">Buscar</button>
            </div>
        </div>
    </form>

</div>
