@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="md:mx-auto rounded shadow-xl w-full overflow-hidden">
        <div class="h-44 bg-gradient-to-r from-cyan-500 to-blue-500"></div>
        <div class="px-5 py-2 flex flex-col gap-3 pb-6">
            <!-- Imagen de perfil -->
            <div class="size-24 shadow-md rounded-full border-4 overflow-hidden -mt-14 border-white">
                <img src="{{ Storage::url('images/profile_pictures/' . $user->profile_picture) }}"
                    class="w-full h-full rounded-full object-center object-cover">
            </div>

            <!-- Nombre y email del usuario -->
            <div>
                <h3 class="text-xl text-gray-800 dark:text-gray-200 font-bold leading-6">{{ $user->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
            </div>

            <!-- Departamento, Municipio, y Domicilio -->
            <div>
                <h4 class="text-md font-medium text-gray-800 dark:text-gray-200">Información de Residencia</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Departamento: {{ $user->departamento }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Municipio: {{ $user->municipio }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Domicilio: {{ $user->domicilio }}</p>
            </div>

            <!-- Verificar si el usuario es paciente -->
            @if ($user->role && $user->role->role_type === 'paciente')
                <div>
                    <h4 class="text-md font-medium text-gray-800 dark:text-gray-200">Datos del Paciente</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Cédula: {{ $user->role->roleable->cedula }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Biografía: {{ $user->role->roleable->biografia }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Edad: {{ $user->role->roleable->edad }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Peso: {{ $user->role->roleable->peso }} kg</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Altura: {{ $user->role->roleable->altura }} cm</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Condición: {{ $user->role->roleable->condicion }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tipo de Afectación:
                        {{ $user->role->roleable->tipo_afectacion }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Nivel de Afectación:
                        {{ $user->role->roleable->nivel_afectacion }}</p>
                </div>
            @endif

            <!-- Botones de acción -->
            <div class="flex gap-2 mt-3">
                <button type="button"
                    class="inline-flex w-auto cursor-pointer select-none items-center justify-center space-x-1 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-gray-300 active:bg-white hover:bg-gray-100 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Enviar
                    Mensaje</button>
                <button type="button"
                    class="inline-flex w-auto cursor-pointer select-none items-center justify-center space-x-1 rounded border border-gray-200 bg-blue-700 px-3 py-2 text-sm font-medium text-white transition hover:border-blue-300 hover:bg-blue-600 active:bg-blue-700 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300">Añadir
                    a proyectos</button>
            </div>

            <!-- Sección "Acerca de" -->
            <h4 class="text-md font-medium leading-3 mt-3 text-gray-800 dark:text-gray-200">Acerca de</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->biografia ?? 'Biografía no disponible.' }}</p>

            <!-- Experiencia laboral (Placeholder) -->
            <h4 class="text-md font-medium leading-3 mt-3">Experiencias</h4>
            <div class="flex flex-col gap-3">
                <!-- Ejemplo de experiencia (sustituir con datos reales si los tienes) -->
                <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                        class="h-8 w-8 text-slate-500" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path
                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z">
                        </path>
                    </svg>
                    <div class="leading-3">
                        <p class="text-sm font-bold text-slate-700">Ui Designer</p>
                        <span class="text-xs text-slate-600">5 años</span>
                    </div>
                    <p class="text-sm text-slate-500 self-start ml-auto">Como Ui Designer en Front Page</p>
                </div>
                <!-- Agrega más experiencias aquí -->
            </div>
        </div>
    </div>

@endsection
