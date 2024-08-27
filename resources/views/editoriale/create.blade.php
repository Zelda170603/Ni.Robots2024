<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nueva editorial</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Administracion.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="rounded-lg overflow-hidden">
            <div class="text-slate-900 dark:text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nueva editorial</h1>
            </div>
            <div class="p-4">
                <form action="{{ route('editoriales.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Nombre -->
                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                            <input type="text" name="direccion" id="direccion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                            <input type="text" name="telefono" id="telefono"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-4">
                            <label for="correo_electronico" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                                Electrónico</label>
                            <input type="email" name="correo_electronico" id="correo_electronico"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <!-- Sitio Web -->
                        <div class="mb-4">
                            <label for="sitio_web" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sitio Web</label>
                            <input type="url" name="sitio_web" id="sitio_web"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crear Editorial
                        </button>
                    </div>
                </form>


            </div>
        </div>

    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js');
    {{-- @vite('resources/js/centros_Atencion/cargar_centros.js'); --}}
</body>

</html>
