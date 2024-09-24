@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <div class="sm:flex sm:items-center justify-between">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Editoriales') }}</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">A list of all the {{ __('Editoriales') }}.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('editoriales.create') }}"
                    class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400">
                    Add new
                </a>
            </div>
        </div>

        <div class="mt-6 flow-root">
            <div
                class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg dark:ring-white/10 dark:shadow-lg">
                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300 sm:pl-6">
                                No
                            </th>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                                Nombre
                            </th>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                                Dirección
                            </th>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                                Teléfono
                            </th>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                                Correo Electrónico
                            </th>
                            <th scope="col"
                                class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                                Sitio Web
                            </th>
                            <th scope="col"
                                class="relative py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-700 dark:text-gray-300 sm:pr-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($editoriales as $editoriale)
                            <tr class="even:bg-gray-50 hover:bg-gray-100 dark:even:bg-gray-800 dark:hover:bg-gray-700">
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-6">
                                    {{ ++$i }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $editoriale->nombre }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $editoriale->direccion }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $editoriale->telefono }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $editoriale->correo_electronico }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-blue-600 dark:text-blue-400">
                                    <a href="{{ $editoriale->sitio_web }}" target="_blank">{{ $editoriale->sitio_web }}</a>
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-right sm:pr-6">
                                    <form action="{{ route('editoriales.destroy', $editoriale->id) }}" method="POST">
                                      
                                        <a href="{{ route('editoriales.edit', $editoriale->id) }}"
                                            class="text-indigo-600 font-bold hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-2">{{ __('Edit') }}</a>
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('editoriales.destroy', $editoriale->id) }}"
                                            class="text-red-600 font-bold hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                            {{ __('Delete') }}
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 px-4">
            {!! $editoriales->withQueryString()->links() !!}
        </div>
    </div>
@endsection
