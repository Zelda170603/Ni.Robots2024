<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administracion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Administracion.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">Libro</h1>
            <form action="/books" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Portada -->
                    <div class="mb-5">
                        <label for="paginas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Portada</label>
                        <label for="portada"
                            class="upload-container flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 mb-2">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="portada" name="portada" type="file" class="hidden"
                                onchange="handleFileUpload(this)" />
                        </label>
                    </div>
                    <!-- Title -->
                    <div>
                        <div class="mb-5">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                            <input id="title" name="title" type="text" value="{{ old('title', $book?->title) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Título" required />
                        </div>
                        <!-- Descripción -->
                        <div class="mb-5">
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <textarea id="descripcion" name="descripcion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Descripción" required>{{ old('descripcion', $book?->descripcion) }}</textarea>
                        </div>
                    </div>
                    <!-- Autor ID -->
                    <div class="mb-5">
                        <label for="autor_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Autor</label>
                        <select name="autor_id" id="autor_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="">Seleccione un autor</option>
                            @foreach ($autores as $id => $nombre)
                                <option value="{{ $id }}"
                                    {{ old('autor_id', $book ? $book->autor_id : '') == $id ? 'selected' : '' }}>
                                    {{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Editorial ID -->
                    <div class="mb-5">
                        <label for="editorial_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Editorial</label>
                        <select name="editorial_id" id="editorial_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="">Seleccione una editorial</option>
                            @foreach ($editoriales as $id => $nombre)
                                <option value="{{ $id }}"
                                    {{ old('editorial_id', $book ? $book->editorial_id : '') == $id ? 'selected' : '' }}>
                                    {{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- File URL -->
                    <div class="mb-5">
                        <label for="file_url"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Archivo</label>
                        <input id="file_url" name="file_url" type="file"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <!-- Fecha de Publicación -->
                    <div class="mb-5">
                        <label for="fecha_publicacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                            Publicación</label>
                        <input type="date" id="fecha_publicacion" name="fecha_publicacion"
                            value="{{ old('fecha_publicacion', $book?->fecha_publicacion) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>

                    <!-- ISBN -->
                    <div class="mb-5">
                        <label for="isbn"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book?->isbn) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ISBN" required />
                    </div>

                    <!-- Páginas -->
                    <div class="mb-5">
                        <label for="paginas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Páginas</label>
                        <input type="number" id="paginas" name="paginas"
                            value="{{ old('paginas', $book?->paginas) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Número de páginas" required />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Crear
                        Libro</button>
                </div>
            </form>

        </div>
    </main>
    <script>
        function handleFileUpload(input) {
            if (input.files && input.files.length > 0) {
                // Agregar la clase verde al contenedor del input
                const container = input.closest('.upload-container');
                // Modo claro
                container.classList.add('bg-green-100', 'border-green-500');
                container.classList.remove('bg-gray-50', 'border-gray-300');
                // Modo oscuro
                container.classList.add('dark:bg-green-900', 'dark:border-green-500');
                container.classList.remove('dark:bg-gray-700', 'dark:border-gray-600');
            }
        }
    </script>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js');
    {{-- @vite('resources/js/centros_Atencion/cargar_centros.js'); --}}
</body>

</html>
