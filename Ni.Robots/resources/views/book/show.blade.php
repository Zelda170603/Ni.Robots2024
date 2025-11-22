@extends('layouts.app')

@section('title', 'Libros')

@section('content')
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class="justify-center max-w-md lg:max-w-lg mx-auto">
                <!-- Main Image -->
                <div class="border-2 border-gray-600 rounded-md p-2">
                    <img id="mainImage" class="w-full h-auto dark:block"
                        src="{{ $book->portada ? asset($book->portada) : 'https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg' }}"
                        alt="{{ $book->title }}" />
                </div>

                <!-- Botón para abrir el modal del PDF -->
                <div class="mt-6 text-center">
                    <button id="open-pdf-modal" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        📖 Leer Libro PDF
                    </button>
                </div>
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    {{ $book->title }}
                </h1>
                <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                    <div class="flex items-center gap-2 mt-2 sm:mt-0">
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $promedioCalificaciones)
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                            ({{ number_format($promedioCalificaciones, 1) }})
                        </p>
                        <a href="#" class="text-sm font-medium leading-none text-gray-900 dark:text-white">
                            {{ $book->calificaciones()->count() }} Reviews
                        </a>
                    </div>
                </div>
                <p class="my-6 text-gray-500 dark:text-gray-400">
                    {{ $book->descripcion }}
                </p>
                <ul class="mt-2 grid gap-4 grid-cols-2">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $book->autor->nombre }}
                        </p>
                    </li>

                    <li class="flex flex-col gap-2">
                        <p class="text-gray-500 dark:text-gray-400">
                            Público:
                        </p>
                        <span
                            class="me-2 rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            {{ $book->grupo_usuarios }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $book->editorial->nombre }}
                        </p>
                    </li>
                    <li class="flex flex-col gap-2">
                        <p class="text-gray-500 dark:text-gray-400">
                            Categoría:
                        </p>
                        <span
                            class="me-2 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                            {{ $book->categoria }}</span>
                    </li>
                </ul>
                <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                    <a href="#" title=""
                        class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg>
                        Add to favorites
                    </a>

                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                        data-book-id="{{ $book->id }}"
                        class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center justify-center"
                        role="button">
                        <svg class="size-5 text-gray-800 dark:text-white -ms-2 me-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z" />
                        </svg>
                        Calificar
                    </button>
                </div>
                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                <!--Rating-->
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">1,745 global ratings</p>
                    @foreach ([5 => '5 star', 4 => '4 star', 3 => '3 star', 2 => '2 star', 1 => '1 star'] as $stars => $label)
                        @php
                            $percentage = $ratingsPercentages[$stars] ?? 0;
                        @endphp
                        <div class="flex items-center mt-4">
                            <a href="#"
                                class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $label }}</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span
                                class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ number_format($percentage, 2) }}%</span>
                        </div>
                    @endforeach
                    <!-- Mostrar comentarios y calificaciones -->
                    @foreach ($comentarios as $comentario)
                        <article class="mt-8">
                            <div class="flex items-center mb-4">
                                <img class="w-10 h-10 me-4 rounded-full" src="{{ Storage::url('images/profile_pictures/' . $comentario->user->profile_picture) }}"
                                    alt="">
                                <div class="font-medium dark:text-white">
                                    <p>{{ $comentario->user->name ?? 'Unknown User' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $comentario->puntuacion ? 'text-yellow-300' : 'text-gray-300' }}"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                                <h3 class="ms-2 text-sm font-semibold text-gray-900 dark:text-white">Thinking to
                                    buy another one!</h3>
                            </div>
                            <div class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                                <p>Calificado en {{ $comentario->user->departamento }},
                                    {{ $comentario->user->municipio }} a las
                                    @if ($comentario->created_at)
                                        <time datetime="{{ $comentario->created_at->format('Y-m-d H:i') }}"
                                            class="block text-sm text-gray-500 dark:text-gray-400">
                                            {{ $comentario->created_at->diffForHumans() }}
                                        </time>
                                    @else
                                        <time datetime="" class="block text-sm text-gray-500 dark:text-gray-400">
                                            Date not available
                                        </time>
                                    @endif
                                </p>
                            </div>
                            <p class="mb-3 text-gray-500 dark:text-gray-400 "> {{ $comentario->comentario }}</p>
                            <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                        </article>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal para el PDF Viewer -->
        <!-- Modal para el PDF Viewer -->
       <div id="pdf-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-6xl h-[90vh] flex flex-col" 
         data-pdf-url="{{ $book->file_url }}">
        <!-- Header del Modal -->
        <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $book->title }}</h3>
            <button id="close-pdf-modal" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Contenido del PDF -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Panel de controles lateral -->
            <div class="w-16 bg-gray-100 dark:bg-gray-700 flex flex-col items-center py-4 space-y-4">
                <button id="prev-page" class="p-2 bg-white dark:bg-gray-600 rounded-full shadow hover:bg-gray-200 dark:hover:bg-gray-500 transition duration-300 tooltip" title="Página anterior">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                
                <div class="text-center text-sm font-medium text-gray-600 dark:text-gray-300">
                    <span id="current">1</span>
                    <span class="block text-xs">de</span>
                    <span id="page-count"></span>
                </div>
                
                <button id="next-page" class="p-2 bg-white dark:bg-gray-600 rounded-full shadow hover:bg-gray-200 dark:hover:bg-gray-500 transition duration-300 tooltip" title="Página siguiente">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                
                <div class="flex flex-col space-y-2 mt-4">
                    <button id="zoom-in" class="p-2 bg-white dark:bg-gray-600 rounded-full shadow hover:bg-gray-200 dark:hover:bg-gray-500 transition duration-300 tooltip" title="Acercar">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                    <button id="zoom-out" class="p-2 bg-white dark:bg-gray-600 rounded-full shadow hover:bg-gray-200 dark:hover:bg-gray-500 transition duration-300 tooltip" title="Alejar">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Área del PDF - VERSIÓN MEJORADA -->
            <div class="flex-1 bg-gray-200 dark:bg-gray-600 overflow-auto p-4">
                <div class="flex items-start justify-center min-h-full">
                    <canvas id="pdf-renderer" class="shadow-lg mx-auto"></canvas>
                </div>
            </div>
        </div>

        <!-- Footer con información -->
        <div class="p-3 bg-gray-100 dark:bg-gray-700 text-center text-sm text-gray-600 dark:text-gray-300">
            Usa los controles para navegar • Zoom: +/- • Flechas del teclado • ESC para cerrar
        </div>
    </div>
</div>


        <!-- Sección de libros recomendados -->
        <div class="py-4 justify-center">
            <h1 class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-6">
                Libros que te puedan interesar
            </h1>
            <swiper-container class="mySwiper" pagination-clickable="true"
                breakpoints='{
                "640": {
                    "slidesPerView": 1,
                    "spaceBetween": 10
                },
                "768": {
                    "slidesPerView": 2,
                    "spaceBetween": 20
                },
                "1024": {
                    "slidesPerView": 3,
                    "spaceBetween": 30
                }
            }'>
                {!! $bookCardView !!}
            </swiper-container>

            <div class="py-4">
                <h1 class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-6">
                    Libros de la categoria {{ $book->categoria }}
                </h1>
                <swiper-container class="mySwiper" pagination-clickable="true"
                    breakpoints='{
                    "640": {
                        "slidesPerView": 1,
                        "spaceBetween": 10
                    },
                    "768": {
                        "slidesPerView": 2,
                        "spaceBetween": 20
                    },
                    "1024": {
                        "slidesPerView": 3,
                        "spaceBetween": 30
                    }
                }'>
                    {!! $bookCardmismacategoria !!}
                </swiper-container>
            </div>

            <div class="py-4">
                <h1 class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-6">
                    Mas libros para {{ $book->grupo_usuarios }}
                </h1>
                <swiper-container class="mySwiper" pagination-clickable="true"
                    breakpoints='{
                    "640": {
                        "slidesPerView": 1,
                        "spaceBetween": 10
                    },
                    "768": {
                        "slidesPerView": 2,
                        "spaceBetween": 20
                    },
                    "1024": {
                        "slidesPerView": 3,
                        "spaceBetween": 30
                    }
                }'>
                    {!! $bookCardmismoPublico !!}
                </swiper-container>
            </div>
        </div>

        <!-- Modal para calificar -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Calificar Libro
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                        <div class="flex flex-col gap-4 mb-4 justify-center">
                            <div class="flex items-center justify-center stars-container">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg id="{{ $i }}" class="w-8 h-8 ms-3 stars text-gray-300 star"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                            </div>
                            <input type="hidden" name="calificacion" id="calificacion">
                            <input type="hidden" name="id_book" id="id_book">
                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Qué
                                    opinas
                                    sobre
                                    este libro?</label>
                                <textarea id="description" name="comentario" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Escribe un comentario"></textarea>
                            </div>
                        </div>
                        <button id="envio" type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Enviar Reseña
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.worker.min.js"></script>
        @vite('resources/js/books/modal-pdf.js')
    @endsection