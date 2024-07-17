<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create centro de atencion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="text-slate-900 dark:text-white">
            <h1 class="text-2xl font-bold">Crear Nuevo Producto</h1>
        </div>
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
        <form action="{{ route('Centro_atencion.store') }}" class="pt-4" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="mb-5">
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="correo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="telefono"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="direccion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="ciudad"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                    <select id="ciudad" name="ciudad" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ old('ciudad') == $city ? 'selected' : '' }}>
                                {{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="departamento"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                    <input type="text" id="departamento" name="departamento" value="{{ old('departamento') }}"
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="google_map_direction"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Map
                        Direction</label>
                    <input type="text" id="google_map_direction" name="google_map_direction"
                        value="{{ old('google_map_direction') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="descripcion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-5">
                    <label for="tipo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                    <select id="tipo" name="tipo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Minsa" {{ old('tipo') == 'Minsa' ? 'selected' : '' }}>Minsa</option>
                        <option value="Psicologia" {{ old('tipo') == 'Psicologia' ? 'selected' : '' }}>Psicologia
                        </option>
                        <option value="Terapia" {{ old('tipo') == 'Terapia' ? 'selected' : '' }}>Terapia</option>
                        <option value="Otros" {{ old('tipo') == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label for="foto_principal"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Principal</label>
                    <input type="file" id="foto_principal" name="foto_principal" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="fotos_secundarias"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fotos Secundarias (Máx
                        3)</label>
                    <input type="file" id="fotos_secundarias" name="fotos_secundarias[]" multiple
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Guardar</button>
            </div>
        </form>

    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js');
</body>

</html>
