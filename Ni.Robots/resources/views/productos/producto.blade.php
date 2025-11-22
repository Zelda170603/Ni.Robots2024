@extends('layouts.app')

@section('title', 'Producto')

@section('content')
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class=" justify-center max-w-md lg:max-w-lg mx-auto">
                <!-- Main Image -->
                <div class="border-2 border-gray-600 rounded-md p-2">
                    <img id="mainImage" class="w-full h-72 dark:block"
                        src="{{ Storage::url('images/productos/' . $producto->foto_prod) }}"
                        alt="{{ $producto->nombre_prod }}" />
                </div>
                <!-- Thumbnails -->
                <div id="thumbnails" class="flex justify-between gap-2 my-4">
                    <div class="thumbnail w-1/5 border-2 border-gray-600 rounded-md p-2">
                        <img id="mainImage" class="w-full dark:block"
                            src="{{ Storage::url('images/productos/' . $producto->foto_prod) }}"
                            alt="{{ $producto->nombre_prod }}"onclick="changeMainImage(this)" />
                    </div>
                    @foreach ($producto->fotos as $foto)
                        <div class="thumbnail w-1/5 border-2 border-gray-600 rounded-md p-2">
                            <img class="object-cover" src="{{ Storage::url('images/productos/' . $foto->nombre) }}"
                                alt="{{ $producto->nombre_prod }}" onclick="changeMainImage(this)" />
                        </div>
                    @endforeach
                </div>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl mb-4 dark:text-white">
                    Detalles del producto
                </h1>
                <!-- List -->
                <div class="space-y-3 w-full">
                    <dl class="flex flex-col sm:flex-row gap-1">
                        <dt class="min-w-40">
                            <span class="block text-sm text-gray-500 dark:text-neutral-500">grupo de Usuarios:</span>
                        </dt>
                        <dd>
                            <ul>

                                <li class="me-1  inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                    {{ $producto->grupo_usuarios }}
                                </li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-1">
                        <dt class="min-w-40">
                            <span class="block text-sm text-gray-500 dark:text-neutral-500">Nivel de afectacion:</span>
                        </dt>
                        <dd>
                            <ul>

                                <li class="me-1   inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                    {{ $producto->nivel_afectacion }}
                                </li>
                            </ul>
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-1">
                        <dt class="min-w-40">
                            <span class="block text-sm text-gray-500 dark:text-neutral-500">Tipo afectacion:</span>
                        </dt>
                        <dd>
                            <ul>

                                <li class="me-1  inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                    {{ $producto->tipo_afectacion }}
                                </li>
                            </ul>
                        </dd>
                    </dl>



                    <dl class="flex flex-col sm:flex-row gap-1">
                        <dt class="min-w-40">
                            <span class="block text-sm text-gray-500 dark:text-neutral-500">Tipo de producto:</span>
                        </dt>
                        <dd>
                            <ul>
                                <li class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $producto->tipo_producto }}
                                </li>
                            </ul>
                        </dd>
                    </dl>
                </div>
                <!-- End List -->
            </div>
            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    {{ $producto->nombre_prod }}
                </h1>
                <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        ${{ $producto->precio }}
                    </p>
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
                            {{ $producto->calificaciones()->count() }} Reviews
                        </a>
                    </div>
                </div>
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

                    <a href="#" title=""
                        class="text-white mt-4 sm:mt-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center justify-center"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>

                        Add to cart
                    </a>
                </div>
                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                <p class="mb-6 text-gray-500 dark:text-gray-400">
                    {{ $producto->descripcion }}
                </p>
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
                                <img class="w-10 h-10 me-4 rounded-full"
                                    src="{{ Storage::url('images/profile_pictures/' . $comentario->user->profile_picture) }}"
                                    alt="">
                                <div class="font-medium dark:text-white">
                                    <p>{{ $comentario->user->name ?? 'Unknown User' }}
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


                            </div>
                            <div class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                                <p>Calificado en {{ $comentario->user->departamento }},
                                    {{ $comentario->user->municipio }} a las
                                    @if ($comentario->id_prod)
                                        <time datetime="{{ $comentario->created_at }}"
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
        <div class="py-4">
            <h1 class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-6">
                Productos que te puedan interesar
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
                {!! $productCardView !!}
            </swiper-container>
        </div>


        <div class="py-4">
            <h1 class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-6">
                Productos del mismo nivel de afectacion
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
                {!! $productCardSameLevel !!}
            </swiper-container>
        </div>

    </div>
    @include('Productos.partials.cart')
    <script>
        // Función para cambiar la imagen principal y el color del borde
        function changeMainImage(element) {
            // Cambiar la imagen principal
            var mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;

            // Quitar la clase 'border-blue-700' y restaurar el borde gris en todos los thumbnails
            var thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(function(thumbnail) {
                thumbnail.classList.remove('border-blue-700');
                thumbnail.classList.add(
                    'border-gray-600'); // Restaurar el borde gris en las miniaturas no seleccionadas
            });
            // Quitar el borde gris y agregar la clase 'border-blue-700' al thumbnail seleccionado
            element.parentElement.classList.remove('border-gray-600');
            element.parentElement.classList.add('border-blue-700');
        }

        // Establecer la primera imagen como activa por defecto
        var firstThumbnail = document.querySelector('.thumbnail');
        firstThumbnail.classList.remove('border-gray-600');
        firstThumbnail.classList.add('border-blue-700');
    </script>
    @vite('resources/js/productos/carrito.js')
@endsection
