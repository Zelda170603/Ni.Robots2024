<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    <!-- Nombre -->
    <div class="mb-5">
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $autore?->nombre) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Nombre" required>
        @error('nombre')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Apellido -->
    <div class="mb-5">
        <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
        <input id="apellido" name="apellido" type="text" value="{{ old('apellido', $autore?->apellido) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Apellido" required>
        @error('apellido')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Fecha Nacimiento -->
    <div class="mb-5">
        <label for="fecha_nacimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Nacimiento</label>
        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento', $autore?->fecha_nacimiento) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @error('fecha_nacimiento')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Fecha Fallecimiento -->
    <div class="mb-5">
        <label for="fecha_fallecimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fallecimiento</label>
        <input id="fecha_fallecimiento" name="fecha_fallecimiento" type="date" value="{{ old('fecha_fallecimiento', $autore?->fecha_fallecimiento) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @error('fecha_fallecimiento')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Nacionalidad -->
    <div class="mb-5">
        <label for="nacionalidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nacionalidad</label>
        <input id="nacionalidad" name="nacionalidad" type="text" value="{{ old('nacionalidad', $autore?->nacionalidad) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Nacionalidad">
        @error('nacionalidad')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Biografía -->
    <div class="mb-5 sm:col-span-2">
        <label for="biografia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biografía</label>
        <textarea id="biografia" name="biografia" rows="4"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Escribe una biografía...">{{ old('biografia', $autore?->biografia) }}</textarea>
        @error('biografia')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
