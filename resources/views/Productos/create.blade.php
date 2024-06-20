<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nuevo Producto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Administracion.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="rounded-lg overflow-hidden">
            <div class="text-slate-900 dark:text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nuevo Producto</h1>
            </div>
            <div class="p-4">
                @if (session('success'))
                    <div class="mb-4">
                        <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="mb-5">
                            <label for="foto_prod"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto del
                                producto</label>
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 dark:border-gray-500/50 px-6 py-10 bg-white dark:bg-gray-800">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-500" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600 dark:text-gray-300">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white dark:bg-gray-700 font-semibold text-indigo-600 dark:text-indigo-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500 dark:hover:text-indigo-300">
                                            <span>Upload a file</span>
                                            <input name="foto_prod" id="foto_prod" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600 dark:text-gray-400">PNG, JPG, GIF up to
                                        10MB</p>
                                </div>
                            </div>

                        </div>
                        <div>
                            <div class="mb-5">
                                <label for="nombre_prod"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                <input type="text" name="nombre_prod" id="nombre_prod" value="{{ old('nombre_prod') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label for="descripcion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                                <textarea name="descripcion" id="descripcion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <label for="precio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" name="precio" id="precio" value="{{ old('precio') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="nivel_afectacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel de
                                Afectación</label>
                            <input type="text" name="nivel_afectacion" id="nivel_afectacion"
                                value="{{ old('nivel_afectacion') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <div class="mb-5">
                            <label for="grupo_usuarios"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grupo de
                                Usuarios</label>
                            <input type="text" name="grupo_usuarios" id="grupo_usuarios"
                                value="{{ old('grupo_usuarios') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <div class="mb-5">
                            <label for="existencias"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existencias</label>
                            <input type="number" name="existencias" id="existencias" value="{{ old('existencias') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <div class="mb-5">
                            <label for="id_tipo_producto"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de
                                Producto</label>
                            <select name="id_tipo_producto" id="id_tipo_producto"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($tipo_productos as $tipo_producto)
                                    <option value="{{ $tipo_producto->id }}"
                                        {{ old('id_tipo_producto') == $tipo_producto->id ? 'selected' : '' }}>
                                        {{ $tipo_producto->nombre_tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="id_fabricante"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fabricante</label>
                            <select name="id_fabricante" id="id_fabricante"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($fabricantes as $fabricante)
                                    <option value="{{ $fabricante->id }}"
                                        {{ old('id_fabricante') == $fabricante->id ? 'selected' : '' }}>
                                        {{ $fabricante->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Crear
                            Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
</body>

</html>
