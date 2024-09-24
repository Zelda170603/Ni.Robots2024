@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">Editar Libro</h1>
        @if ($errors->any())
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Hubo algunos problemas con los datos ingresados.
            </div>
            <ul class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Cambia el método a PUT para la edición -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Portada -->
                @if ($book->portada)
                    <div class="mb-5">
                        <label for="current-portada"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carátula Actual</label>
                        <img src="{{ asset('storage/librosPortada/' . $book->portada) }}" alt="Carátula del libro"
                            class="w-32 h-48 object-cover rounded-lg">
                    </div>
                @endif
                <div class="mb-5">
                    <label for="paginas"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Portada</label>
                    <label for="portada"
                        class="upload-container flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 mb-2">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                    upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
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
                        <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Título" required />
                    </div>

                    <!-- Descripción -->
                    <div class="mb-5">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea id="descripcion" name="descripcion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Descripción" required>{{ old('descripcion', $book->descripcion) }}</textarea>
                    </div>
                </div>

                <!-- Autor ID -->
                <div class="mb-5">
                    <label for="autor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Autor</label>
                    <select name="autor_id" id="autor_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                        <option value="">Seleccione un autor</option>
                        @foreach ($autores as $id => $nombre)
                            <option value="{{ $id }}"
                                {{ old('autor_id', $book->autor_id) == $id ? 'selected' : '' }}>
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
                                {{ old('editorial_id', $book->editorial_id) == $id ? 'selected' : '' }}>
                                {{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Categoría -->
                <div class="mb-5">
                    <label for="categoria"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                    <select name="categoria" id="categoria"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                        <option value="">Seleccione una categoría</option>
                        <option value="Literatura inclusiva"
                            {{ old('categoria', $book->categoria) == 'Literatura inclusiva' ? 'selected' : '' }}>Literatura
                            inclusiva</option>
                        <option value="Educacion"
                            {{ old('categoria', $book->categoria) == 'Educacion' ? 'selected' : '' }}>Educacion</option>
                        <option value="Derechos y leyes"
                            {{ old('categoria', $book->categoria) == 'Derechos y leyes' ? 'selected' : '' }}>Derechos y
                            leyes</option>
                        <option value="Cuidado de la salud"
                            {{ old('categoria', $book->categoria) == 'Cuidado de la salud' ? 'selected' : '' }}>Cuidado de
                            la salud</option>
                    </select>
                </div>

                <!-- Grupo de usuarios -->
                <div class="mb-5">
                    <label for="grupo_usuarios" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grupo
                        de Usuarios</label>
                    <select name="grupo_usuarios" id="grupo_usuarios"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                        <option value="">Seleccione un grupo de usuarios</option>
                        <option value="Niños"
                            {{ old('grupo_usuarios', $book->grupo_usuarios) == 'Niños' ? 'selected' : '' }}>Niños</option>
                        <option value="Adolescentes"
                            {{ old('grupo_usuarios', $book->grupo_usuarios) == 'Adolescentes' ? 'selected' : '' }}>
                            Adolescentes</option>
                        <option value="Adultos"
                            {{ old('grupo_usuarios', $book->grupo_usuarios) == 'Adultos' ? 'selected' : '' }}>Adultos
                        </option>
                    </select>
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
                    <label for="isbn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                    <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book?->isbn) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ISBN" required />
                </div>

                <!-- Páginas -->
                <div class="mb-5">
                    <label for="paginas"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Páginas</label>
                    <input type="number" id="paginas" name="paginas" value="{{ old('paginas', $book?->paginas) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Número de páginas" required />
                </div>
                <!-- File URL -->
                <!-- Archivo del libro -->
                <div class="mb-5">
                    <label for="file_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir
                        Archivo del Libro</label>
                    <input id="file_url" name="file_url" type="file" accept=".pdf,.epub" value="{{$book->file_url}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Sube un archivo del libro" />
                    @if ($book->file_url)
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Archivo actual: <a href="{{ asset('storage/' . $book->file_url) }}" target="_blank"
                                class="text-blue-500 underline">{{ basename($book->file_url) }}</a>
                        </p>
                    @endif
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Actualizar</button>
        </form>
    </div>

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
@endsection
