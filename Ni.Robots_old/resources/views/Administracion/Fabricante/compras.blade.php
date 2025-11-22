@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <div class="mx-auto max-w-7xl lg:px-8 mb-4">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Historial de compras</h1>
                <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                    Revisa el estado de las ordenes, gestiona devoluciones.
                </p>
            </div>
        </div>
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            @if ($compras->isEmpty())
                <!-- Si no hay compras pendientes, muestra este mensaje -->
                <div class="mx-auto w-full text-center text-gray-500 dark:text-gray-400">
                    <p class="text-lg">No hay compras realizadas.</p>
                </div>
            @else
                @foreach ($compras as $compraProductos)
                    @foreach ($compraProductos as $orden)
                        <div
                            class="mb-4 p-4 border border-gray-400 dark:border-gray-700 rounded-lg gap-4 bg-white dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-4 text-gray-700 dark:text-gray-200">
                                    <h2 class="text-lg font-semibold mb-2">Orden #{{ $orden->compra->id }}</h2>
                                    <p>Fecha de la compra: {{ $orden->compra->created_at->format('d/m/Y') }}</p>
                                </div>
                                <button data-popover-target="popover-user-profile-{{ $orden->compra->id }}" type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    User Profile
                                </button>
                                <!-- Popover -->
                                <div id="popover-user-profile-{{ $orden->compra->id }}" data-popover role="tooltip"
                                    class="absolute z-10 invisible inline-block max-w-sm text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                    <div
                                        class="relative h-32 rounded-t-xl bg-[url('https://preline.co/assets/svg/examples/abstract-bg-1.svg')] bg-no-repeat bg-cover bg-center">
                                        <div class="absolute top-0 end-0 p-4">
                                        </div>
                                    </div>

                                    <div class="pt-0 p-2 sm:pt-0 sm:p-7">
                                        <div>
                                            <label class="sr-only">
                                                Product photo
                                            </label>

                                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-x-5">
                                                <img class="-mt-8 relative z-10 inline-block size-16 mx-auto sm:mx-0 rounded-full ring-4 ring-white dark:ring-gray-800"
                                                    src="{{ Storage::url('images/profile_pictures/' . $orden->compra->User->profile_picture) }}"
                                                    alt="{{ $orden->compra->User->name }}">


                                            </div>
                                        </div>
                                        <div class="flex flex-col text-sm gap-4 py-4">
                                            <div class="flex items-center justify-between">
                                                <span class="font-normal  leading-none text-gray-900 dark:text-gray-300">
                                                    Nombre:</span>
                                                <p class="font-normal  leading-none text-gray-900 dark:text-white">
                                                    <a href="#">{{ $orden->compra->User->name }}</a>
                                                </p>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class=" font-normal  leading-none text-gray-900 dark:text-gray-300">
                                                    Correo:</span>
                                                <p class="text-sm font-normal  leading-none text-gray-900 dark:text-white">
                                                    <a href="#">{{ $orden->compra->User->email }}</a>
                                                </p>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="font-normal  leading-none text-gray-900 dark:text-gray-300">
                                                    Ciudad:</span>
                                                <p class="text-sm font-normal leading-none text-gray-900 dark:text-white">
                                                    <a href="#"> {{ $orden->compra->User->departamento }},
                                                        {{ $orden->compra->User->municipio }}</a>
                                                </p>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class=" font-normal leading-none text-gray-900 dark:text-gray-300">
                                                    Domicilio:</span>
                                                <p class="text-sm font-normal leading-none text-gray-900 dark:text-white">
                                                    <a href="#">{{ $orden->compra->User->domicilio }}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="border-t pt-2 border-gray-400 dark:border-gray-700 flex justify-around items-center">
                                            <button type="button"
                                                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:outline-none focus:border-blue-600 focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-blue-500 dark:hover:border-blue-600 dark:focus:text-blue-500 dark:focus:border-blue-600">
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                                    <path d="M8 12h.01"></path>
                                                    <path d="M12 12h.01"></path>
                                                    <path d="M16 12h.01"></path>
                                                </svg> contactar
                                            </button>
                                            <button type="button"
                                                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                View profile
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7 7h10v10"></path>
                                                    <path d="M7 17 17 7"></path>
                                                </svg>
                                            </button>
                                        </div>

                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                            <ul class="mb-4">
                                @foreach ($compraProductos as $compraProducto)
                                    <li
                                        class="rounded-lg border border-gray-400 bg-white mt-4 p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                        <div
                                            class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                            <a href="#" class="shrink-0 md:order-1">
                                                <img class="h-20 w-20 dark:hidden"
                                                    src="{{ asset('storage/images/product_pictures/' . $compraProducto->producto->foto_prod) }}"
                                                    alt="{{ $compraProducto->producto->nombre_prod }} image" />
                                                <img class="hidden h-20 w-20 dark:block"
                                                    src="{{ asset('storage/images/product_pictures/' . $compraProducto->producto->foto_prod) }}"
                                                    alt="{{ $compraProducto->producto->nombre_prod }} image" />
                                            </a>

                                            <label for="counter-input" class="sr-only">Cantidad Adquirida:</label>
                                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                                <div class="flex items-center">
                                                    <p class="text-base font-bold text-gray-900 dark:text-white">
                                                        ${{ $compraProducto->producto->precio }}</p>
                                                </div>
                                                <div class="text-end md:order-4 md:w-32">
                                                    <p class="text-base font-bold text-gray-900 dark:text-white">Cantidad:
                                                        {{ $compraProducto->cantidad }}</p>
                                                </div>
                                            </div>

                                            <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                                <a href="#"
                                                    class="text-base font-medium text-gray-900  dark:text-white">{{ $compraProducto->producto->nombre_prod }}</a>

                                                <div class="flex flex-col justify-start gap-4">
                                                    <p class="text-base font-normal text-gray-900 dark:text-gray-200">
                                                        Hay un contenido de ti que no lo puedo borrar
                                                        No lo puedo borrar, baby
                                                        Anoche no me pude aguantar, lo tuve que mirar
                                                        Me empecé a tocar recordando

                                                        Puede que te borre' el tattoo del nombre mío
                                                        Pero han sido muchas sábana' mojá' que son testigo'
                                                        Ahora nuestro amor es de un autor desconocido
                                                        Como si nunca hubiera existido

                                                        {{ $compraProducto->producto->nombre_prod }} </p>
                                                    <div class="flex gap-4">
                                                        <span
                                                            class="me-2 rounded bg-blue-100 px-2 py-0.5 text-xs font-normal text-green-800 dark:bg-green-900 dark:text-green-300">
                                                            {{ $compraProducto->producto->tipo_producto }} </span>
                                                        <span
                                                            class="me-2 max-w-full rounded bg-blue-100 px-2 py-0.5 text-xs font-normal text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                            {{ $compraProducto->producto->nivel_afectacion }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                @endforeach
                                <div class="flex gap-2 items-start mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" class="w-6 h-6 text-green-500">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{$orden->status}} <time
                                            datetime="{{ $orden->created_at }}">{{ $orden->created_at->format('M j, Y') }}</time>
                                    </p>
                                </div>
                            </ul>
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    @vite('resources/js/fabricantes/poppover.js')
@endsection
