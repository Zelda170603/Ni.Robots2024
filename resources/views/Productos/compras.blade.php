<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .star-icon {
            @apply text-gray-400 cursor-pointer;
            transition: color 0.3s;
        }

        .star-icon.highlight {
            @apply text-yellow-400;
        }

        .stars-container .star-icon:hover,
        .stars-container .star-icon:hover~.star-icon {
            @apply text-yellow-400;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="container mx-auto p-4 min-h-full mt-18">
        <div class="mx-auto max-w-7xl px-8">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Historial de compras</h1>
                <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                    Revisa el estado de las ordenes, gestiona devoluciones y descubre productos similares.
                </p>
            </div>
        </div>
        <div class="mt-16">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="mx-auto flex flex-col gap-4 sm:max-w-2xl sm:px-4 lg:max-w-4xl lg:px-0">
                    @if ($compras->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">No orders found.</p>
                    @else
                        @foreach ($compras as $compra)
                            <div
                                class="border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                                <div
                                    class="flex items-center border-b border-gray-200 dark:border-gray-600 p-4 sm:grid grid-cols-4 sm:gap-x-6 sm:p-6">
                                    <dl class="grid flex-1 grid-cols-3 gap-x-6 text-sm col-span-3">
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Order number</dt>
                                            <dd class="mt-2 text-gray-500">{{ $compra->compra_id }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Date placed</dt>
                                            <dd class="mt-2 text-gray-500"><time
                                                    datetime="{{ $compra->created_at }}">{{ $compra->created_at->format('M j, Y') }}</time>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-bold text-gray-900 dark:text-gray-400">Total amount</dt>
                                            <dd class="mt-2 font-bold text-gray-900 dark:text-gray-400">
                                                ${{ $compra->total }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach ($compra->compraProductos as $compraProducto)
                                        <li class="sm:p-6 p-4">
                                            <div class="flex sm:items-start">
                                                <div
                                                    class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-800 sm:w-44 sm:h-44 ">
                                                    <img src="{{ Storage::url('images/productos/' . $compraProducto->producto->foto_prod) }}"
                                                        alt="{{ $compraProducto->producto->nombre_prod }}"
                                                        class="w-full h-full object-cover object-center">
                                                </div>
                                                <div class="ml-4 w-full">
                                                    <div
                                                        class="flex justify-between text-md font-medium text-gray-700 dark:text-gray-400">
                                                        <span>{{ $compraProducto->producto->nombre_prod }} x
                                                            {{ $compraProducto->cantidad }}</span>
                                                        <p>${{ $compraProducto->producto->precio }}</p>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $compraProducto->producto->descripcion }}</p>
                                                </div>
                                            </div>
                                            <div class="mx-auto flex items-center justify-between space-x-2 mt-4">
                                                <div class="flex items-center justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-6 h-6 text-green-500">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        Delivered on <time
                                                            datetime="{{ $compra->created_at }}">{{ $compra->created_at->format('M j, Y') }}</time>
                                                    </p>
                                                </div>
                                                <div class="font-medium flex items-center justify-center  space-x-4">


                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="crud-modal"
                                                        data-modal-toggle="crud-modal"
                                                        data-product-id="{{ $compraProducto->producto->id }}" 
                                                        class="text-indigo-600 pr-4 hover:text-indigo-900 border-r border-gray-500 dark:text-indigo-400 dark:border-gray-600"
                                                        type="button">
                                                        Calificar
                                                    </button>




                                                    <a href="#"
                                                        class="text-indigo-600 pr-4 hover:text-indigo-900 border-r border-gray-500 dark:text-indigo-400 dark:border-gray-600 ">View
                                                        product</a>
                                                    <a href="#"
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Buy
                                                        again</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Calificar producto
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                        <input type="hidden" name="id_prod" id="id_prod">
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Qué opinas sobre
                                este producto?</label>
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
    <script>
        document.querySelectorAll('[data-modal-toggle="crud-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                document.getElementById("id_prod").value = productId;
            });
        });

        const stars = document.querySelectorAll('.stars');
        const input = document.getElementById("calificacion");
        let clicked = false;

        stars.forEach(function(star) {
            star.addEventListener('mouseover', function() {
                const selectedId = parseInt(star.id);
                stars.forEach(function(s) {
                    if (!clicked && parseInt(s.id) <= selectedId) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-300');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                if (!clicked) {
                    stars.forEach(function(s) {
                        s.classList.remove('text-yellow-300');
                        s.classList.add('text-gray-300');
                    });
                }
            });

            star.addEventListener('click', function() {
                clicked = true;
                const selectedId = parseInt(star.id);
                input.value = selectedId;

                stars.forEach(function(s) {
                    if (parseInt(s.id) <= selectedId) {
                        s.classList.add('text-yellow-300');
                        s.classList.remove('text-gray-300');
                    } else {
                        s.classList.remove('text-yellow-300');
                        s.classList.add('text-gray-300');
                    }
                });
            });
        });

        document.getElementById("envio").addEventListener("click", function(event) {
            event.preventDefault();

            const formData = {
                puntuacion: document.getElementById("calificacion").value,
                comentario: document.getElementById("description").value,
                id_prod: document.getElementById("id_prod").value,
            };
            console.log(formData);

            fetch('/productos/rate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Error en la solicitud');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Operación exitosa:', data.message);
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });
        });
    </script>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
</body>

</html>
