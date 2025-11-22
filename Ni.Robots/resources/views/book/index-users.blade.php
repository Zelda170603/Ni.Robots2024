@extends('layouts.app')

@section('title', 'Libros')

@section('content')
<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Heading & Filters -->
    <div class="mb-4 items-center justify-between space-y-4 md:flex sm:space-y-0 gap-y-4 md:mb-8">
        <h2 class="mt-3 text-xl sm:mb-4 font-semibold text-gray-900 dark:text-white sm:text-2xl">Lista de Libros</h2>
        <div class="flex flex-col sm:flex-row items-center relative gap-2">
            <div class="flex flex-row w-full gap-2">
                <!-- Botones de filtros y sort -->
            </div>
            <div class="flex flex-row w-full">
                <input type="text" id="search-bar"
                       class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                       placeholder="Buscar libros..." />
            </div>
        </div>
    </div>

    <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        @if ($books->count())
            @foreach ($books as $book)
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-72 w-full overflow-hidden">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img class="mx-auto object-cover h-full dark:block"
                                 src="{{  $book->portada }}"
                                 alt="{{ $book->title }}" />
                        </a>
                    </div>
                    <div class="p-4">
                        <div class="mb-2 flex items-center justify-between gap-4">
                            <div class="flex items-center">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="h-4 w-4 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <a href="{{ route('books.show', $book->id) }}"
                           class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
                            {{ $book->title }}
                        </a>

                        <ul class="mt-2 flex flex-col gap-4">
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $book->autor->nombre }}</p>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $book->editorial->nombre }}</p>
                            </li>
                        </ul>

                        <!-- Botón para visor de PDF -->
                        @if($book->pdf)
                            <a href="{{ route('books.visor', $book->id) }}"
                               class="mt-3 inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Ver libro
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay libros disponibles.</p>
        @endif
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>

@include('book.partials.filters')
@vite('resources/js/books/libros.js')
@endsection
