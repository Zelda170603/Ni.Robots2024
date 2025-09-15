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
    @include('index.nav-bar')
    <main class="mt-14 overflow-hidden">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
               
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button" href="{{ route('autores.index') }}"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
            </div>
        </div>

        <div class="flow-root">
            <div class="mt-8 overflow-x-auto">
                <div class="max-w-xl py-2 align-middle">
                    <form method="POST" action="{{ route('autores.store') }}" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">

                            <div>
                                <x-input-label for="nombre" :value="__('Nombre')" />
                                <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full"
                                    :value="old('nombre', $autore?->nombre)" autocomplete="nombre" placeholder="Nombre" />
                                <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                            </div>
                            <div>
                                <x-input-label for="apellido" :value="__('Apellido')" />
                                <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                                    :value="old('apellido', $autore?->apellido)" autocomplete="apellido" placeholder="Apellido" />
                                <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
                            </div>
                            <div>
                                <x-input-label for="fecha_nacimiento" :value="__('Fecha Nacimiento')" />
                                <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="text"
                                    class="mt-1 block w-full" :value="old('fecha_nacimiento', $autore?->fecha_nacimiento)" autocomplete="fecha_nacimiento"
                                    placeholder="Fecha Nacimiento" />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')" />
                            </div>
                            <div>
                                <x-input-label for="fecha_fallecimiento" :value="__('Fecha Fallecimiento')" />
                                <x-text-input id="fecha_fallecimiento" name="fecha_fallecimiento" type="text"
                                    class="mt-1 block w-full" :value="old('fecha_fallecimiento', $autore?->fecha_fallecimiento)" autocomplete="fecha_fallecimiento"
                                    placeholder="Fecha Fallecimiento" />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_fallecimiento')" />
                            </div>
                            <div>
                                <x-input-label for="nacionalidad" :value="__('Nacionalidad')" />
                                <x-text-input id="nacionalidad" name="nacionalidad" type="text"
                                    class="mt-1 block w-full" :value="old('nacionalidad', $autore?->nacionalidad)" autocomplete="nacionalidad"
                                    placeholder="Nacionalidad" />
                                <x-input-error class="mt-2" :messages="$errors->get('nacionalidad')" />
                            </div>
                            <div>
                                <x-input-label for="biografia" :value="__('Biografia')" />
                                <x-text-input id="biografia" name="biografia" type="text" class="mt-1 block w-full"
                                    :value="old('biografia', $autore?->biografia)" autocomplete="biografia" placeholder="Biografia" />
                                <x-input-error class="mt-2" :messages="$errors->get('biografia')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>Submit</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js');
    {{-- @vite('resources/js/centros_Atencion/cargar_centros.js'); --}}
</body>

</html>
