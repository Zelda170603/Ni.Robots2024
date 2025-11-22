@extends('layouts.app')

@section('title', 'Productos | pago')

@section('content')
    <div class="mx-auto max-w-5xl col-span-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Metodos de Pago</h2>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
            <div class="w-full lg:max-w-lg ">
                <!-- Contenedor para los botones de PayPal y Tarjeta de Crédito -->
                <div id="payment-buttons-container" class="mb-8">
                    <!-- Botón de PayPal -->
                    <div id="paypal-button-container"></div>
                    <!-- Botón de Tarjeta de Crédito
                        <button id="credit-card-button" type="button" class="text-gray-900 bg-white w-full hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded text-md px-4 py-3 text-center flex items-center justify-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z"/>
                            </svg>
                            Pago con tarjeta de credito o debito
                        </button>-->
                </div>

                <!-- Formulario para tarjeta de crédito -->
                <form id="credit-card-form" action="#"
                    class="hidden w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="full_name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                            <input type="text" id="first_name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Tus 2 nombres" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="last_name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                            <input type="text" id="last_name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Tus 2 Apellidos" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="city"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                            <input type="text" id="city"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Ciudad" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="state"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                            <input type="text" id="state"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Departamento" required />
                        </div>
                        <div class="col-span-2">
                            <label for="address"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                            <input type="text" id="address"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Bonnie Green" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Full
                                name (as
                                displayed on card)*</label>
                            <input type="text" id="card_name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Nombre que aparece en tu tarjeta" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_number"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Card
                                number*</label>
                            <input type="text" id="card_number"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="xxxx-xxxx-xxxx-xxxx" pattern="^4[0-9]{12}(?:[0-9]{3})?$" required />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_expiration"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Card
                                expiration*</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2h1Zm-1 4V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v1h1a1 1 0 0 0 1-1Zm14-1h1V7a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1h1a1 1 0 0 0 1-1Z" />
                                    </svg>
                                </div>
                                <input type="text" id="card_expiration"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/?([0-9]{2})$" required />
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_cvc"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">CVC/CVV*</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1Zm0 1H4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1Zm14 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1Z" />
                                    </svg>
                                </div>
                                <input type="text" id="card_cvc"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="123" pattern="^[0-9]{3,4}$" required />
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Script de PayPal -->
                <script
                    src="https://www.paypal.com/sdk/js?client-id=AUqL3cvaCIGDXcwEmA1goqRftEzPvkImUriLAJaHAO7leEhoMt4WqsvpXrF6NMSnPNc6eNiK7OP_Wxy4&components=buttons,funding-eligibility">
                </script>
            </div>
            <div class="mt-6 grow flex flex-col gap-2 sm:mt-8 lg:mt-0">
                <div
                    class="no-scrollbar space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <ul role="list" id="product-list" class="-my-6 divide-y divide-gray-200">
                            @foreach ($carritos as $carrito)
                                @php
                                    $producto = $carrito->producto;
                                    $productoId = $producto->id;
                                @endphp
                                <li class="flex items-center py-6" id="cart-item-{{ $productoId }}">
                                    <div
                                        class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-400 dark:border-gray-200">
                                        <img src="{{ asset('storage/images/productos/' . $producto->foto_prod) }}"
                                            alt="{{ $producto->nombre_prod }}"
                                            class="h-full w-full object-cover object-center">
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <h3><a href="#">{{ $producto->nombre_prod }}</a></h3>
                                                <p class="ml-4" id="price-{{ $productoId }}"
                                                    data-price="{{ $producto->precio }}">
                                                    ${{ number_format($producto->precio * $carrito->cantidad, 2) }}
                                                </p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-200">
                                                {{ $producto->color }}</p>
                                        </div>
                                        <div class="flex items-end justify-between text-sm">
                                            <label for="counter-input-{{ $productoId }}" class="sr-only">Choose
                                                quantity:</label>
                                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                                <div class="flex items-center">
                                                    <button type="button"
                                                        onclick="decrementQuantity({{ $productoId }})"
                                                        id="decrement-button-{{ $productoId }}"
                                                        data-input-counter-decrement="counter-input-{{ $productoId }}"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                        <svg class="h-2 w-2 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                        </svg>
                                                    </button>
                                                    <input type="text" id="counter-input-{{ $productoId }}"
                                                        data-input-counter
                                                        class="w-8 shrink-0 border-0 bg-transparent text-center text-sm font-light text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                        placeholder="" value="{{ $carrito->cantidad }}" required
                                                        data-stock="{{ $producto->existencias }}" />
                                                    <button type="button"
                                                        onclick="incrementQuantity({{ $productoId }})"
                                                        id="increment-button-{{ $productoId }}"
                                                        data-input-counter-increment="counter-input-{{ $productoId }}"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                        <svg class="h-2 w-2 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M9 1v16M1 9h16" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <button type="button" onclick="deleteProductFromCart({{ $productoId }})"
                                                class="self-center font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-600"
                                                data-product-id="{{ $productoId }}">
                                                <svg class="w-6 h-6 pb-2 text-gray-800 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div
                    class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-gray-500 dark:text-gray-400">Original price</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white" id="cart-originalprice">
                                ${{ number_format($subtotal, 2) }}</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white" id="cart-tax">
                                ${{ number_format($tax, 2) }}</dd>
                        </dl>
                    </div>

                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-md font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-md font-bold text-gray-900 dark:text-white" id="cart-total">
                            ${{ number_format($total, 2) }}</dd>
                    </dl>
                </div>
                <input id="total-cart" type="hidden" value="{{ number_format($total, 2) }}" disabled>
                <div class="mt-6 flex items-center justify-center gap-8">
                    <img class="h-8 w-auto dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal.svg" alt="" />
                    <img class="hidden h-8 w-auto dark:flex"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal-dark.svg"
                        alt="" />
                    <img class="h-8 w-auto dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="" />
                    <img class="hidden h-8 w-auto dark:flex"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg"
                        alt="" />
                    <img class="h-8 w-auto dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard.svg"
                        alt="" />
                    <img class="hidden h-8 w-auto dark:flex"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard-dark.svg"
                        alt="" />
                </div>
            </div>
        </div>

        <p class="mt-6 text-center text-gray-500 dark:text-gray-400 sm:mt-8 lg:text-left">
            Payment processed by <a href="/" title=""
                class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Paypal</a>
            for <a href="#" title=""
                class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Ni.Robots
                LLC</a>
            - Republica de Nicaragua
        </p>
    </div>
    @vite('resources/js/productos/send_compra.js')
@endsection
