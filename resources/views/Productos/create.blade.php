@extends('layouts.adminLY')

@section('content')
        <div class="rounded-lg overflow-hidden col-span-4">
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
                        <!-- Foto principal -->
                        <div class="shrink-0 items-center justify-center w-full">
                            <label for="foto_prod"
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
                                <input id="foto_prod" name="foto_prod[]" type="file" class="hidden"
                                    onchange="handleFileUpload(this)" />
                            </label>
                            <div id="thumbnails" class="flex justify-between gap-2 mb-4">
                                <label for="foto_prod_2"
                                    class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                                    </div>
                                    <input id="foto_prod_2" name="foto_prod[]" type="file" class="hidden"
                                        onchange="handleFileUpload(this)" />
                                </label>
                                <label for="foto_prod_3"
                                    class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                                    </div>
                                    <input id="foto_prod_3" name="foto_prod[]" type="file" class="hidden"
                                        onchange="handleFileUpload(this)" />
                                </label>
                                <label for="foto_prod_4"
                                    class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                                    </div>
                                    <input id="foto_prod_4" name="foto_prod[]" type="file" class="hidden"
                                        onchange="handleFileUpload(this)" />
                                </label>
                            </div>
                        </div>
                        <div>
                            <div class="mb-5">
                                <label for="nombre_prod"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                <input type="text" name="nombre_prod" id="nombre_prod"
                                    value="{{ old('nombre_prod') }}"
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
                            <label for="Color"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color
                                </label>
                            <input type="text" name="color" id="color"
                                value="{{ old('color') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="tipo_afectacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                            <select id="tipo_afectacion" name="tipo_afectacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Seleccione una categoría</option>
                                <!-- Las categorías se cargarán aquí mediante JavaScript -->
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="nivel_afectacion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel de
                                Afectación</label>
                                <select id="nivel_afectacion" name="nivel_afectacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Seleccione un nivel de afectación</option>
                            </select>
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
                            <input type="number" name="existencias" id="existencias"
                                value="{{ old('existencias') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="tipo_producto"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de
                                Producto</label>
                            <select name="tipo_producto" id="tipo_producto"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="protesis">Prótesis</option>
                                <option value="ortesis">Órtesis</option>
                                <option value="ortopedicos">Ortopédicos</option>
                            </select>
                        </div>
                        @if(auth()->user()->role->role_type === "administrador")
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
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Crear
                            Producto</button>
                    </div>
                </form>
            </div>
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
    @vite('resources/js/resources/Cargas_Tipos_niveles_Afectacion.js');
@endsection
