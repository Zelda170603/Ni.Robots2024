@extends('layouts.adminLY')

@section('content')
    <div class="p-4 col-span-4">
        <!-- Header: búsqueda + acciones -->
        <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <!-- Buscador -->
                <div class="w-full md:w-1/2">
                    <form action="{{ route('autores.index') }}" method="GET" class="flex items-center">
                        <label for="q" class="sr-only">Buscar</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="search" id="q" name="q" value="{{ request('q') }}"
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Buscar por nombre o apellido..." />
                        </div>
                    </form>
                </div>

                <!-- Acciones: nuevo autor / acciones / filtro -->
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <a href="{{ route('autores.create') }}"
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Añadir autor
                    </a>

                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <!-- Actions dropdown (example) -->
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                            Acciones
                        </button>
                        <div id="actionsDropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar masivo</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Eliminar todo</a>
                            </div>
                        </div>

                        <!-- Filter dropdown -->
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filtrar
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>

                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Categoría</h6>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input id="nac1" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" />
                                    <label for="nac1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Español</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="nac2" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" />
                                    <label for="nac2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Inglés</label>
                                </li>
                                <!-- agrega más filtros según necesites -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla: estilo inspirado en tu ejemplo -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">No</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Foto</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Nombre</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Apellido</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Nacionalidad</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Biografía</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Fecha Nac.</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Fecha Fallec.</th>
                        <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Opciones</th>
                    </tr>
                </thead>
                <tbody class="dark:divide-gray-600">
                    @php
                        $i = isset($autores) && method_exists($autores, 'currentPage') ? ($autores->currentPage()-1) * $autores->perPage() : 0;
                    @endphp

                    @foreach ($autores as $autore)
                        <tr class="{{ $loop->odd ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 dark:text-white">{{ ++$i }}</td>

                            <!-- Foto (si la tienes, usa la ruta correspondiente) -->
                            <td class="p-4">
                                <div class="flex items-center">
                                    @if(!empty($autore->foto_url))
                                        <img src="{{ $autore->foto_url }}" alt="{{ $autore->nombre }}" class="w-16 md:w-24 rounded-md object-cover mr-4">
                                    @else
                                        <div class="w-16 md:w-24 h-16 md:h-24 rounded-md bg-gray-300 dark:bg-gray-600 flex items-center justify-center mr-4 text-gray-700 dark:text-gray-200">
                                            {{ strtoupper(substr($autore->nombre, 0, 1) . substr($autore->apellido, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $autore->nombre }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $autore->apellido }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $autore->nacionalidad ?? '-' }}</td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ Str::limit($autore->biografia ?? '-', 80, '...') }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $autore->fecha_nacimiento ?? '-' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $autore->fecha_fallecimiento ?? '-' }}</td>

                            <td class="flex justify-center items-center text-sm font-medium text-gray-900 dark:text-white space-x-2">
                                <form action="{{ route('autores.destroy', $autore->id) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este autor?')"
                                        class="text-red-600 hover:text-red-900" aria-label="Eliminar">
                                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M3 6h18m-3 0V4a1 1 0 0 0-1-1h-10a1 1 0 0 0-1 1v2M4 6v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6M9 10v6m3-6v6m3-6v6"/>
                                        </svg>
                                    </button>
                                </form>

                                <a href="{{ route('autores.show', $autore->id) }}" class="text-gray-600 hover:text-gray-900 mr-2" title="Ver">
                                    <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('autores.edit', $autore->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Editar">
                                    <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.64a.6.6 0 0 1-.78-.78l1.861-6.419a1.2 1.2 0 0 1 .64-.727L17.14 3.46a3.6 3.6 0 0 1 5.288 5.289L10.779 17.78Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 p-4">
                {{ $autores->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
