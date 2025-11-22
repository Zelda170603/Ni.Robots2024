<!-- Botón para abrir el carrito -->
<button id="openCartButton"
    class="fixed bottom-4 right-4 text-white p-2 rounded-full shadow-lg backdrop-blur-3xl bg-green-800 dark:bg-green-600">
    <svg class="w-8 h-8 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
    </svg>

</button>
<div id="overlay" class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity opacity-0 pointer-events-none">
</div>
<!-- Contenedor del carrito -->
<div id="cart-content"
    class="fixed top-0 pt-14 right-0 z-40 h-screen p-4 overflow-y-auto no-scrollbar transition-transform translate-x-full w-80 backdrop-blur-3xl  bg-white/70  dark:bg-gray-800/10"
    tabindex="-1">
    <div class="flex items-center justify-between p-2">
        <h5 id="drawer-right-label"
            class="inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            Carrito de Compras
        </h5>
        <button type="button" id="closeCartButton" aria-controls="drawer-right-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>


    <div class="mt-8 no-scrollbar">
        <div class="flow-root">
            <ul role="list" id="product-list" class="-my-6 divide-y divide-gray-200">

            </ul>
        </div>
    </div>
    <div class="mt-4 space-y-6">
        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</h4>
        <div class="space-y-4">
            <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500 dark:text-gray-400">Original price</dt>
                    <dd id="cart-originalprice" class=" text-sm font-medium text-gray-900 dark:text-white"></dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd id="cart-tax" class="text-sm font-medium text-gray-900 dark:text-white"></dd>
                </dl>
            </div>
            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-md font-bold text-gray-900 dark:text-white">Total</dt>
                <dd id="cart-total" class="text-md font-bold text-gray-900 dark:text-white"></dd>
            </dl>
        </div>
        <div class="fixed bottom-0 flex flex-col gap-4 pb-4">
            <div class="flex items-start sm:items-center">
                <input id="terms-checkbox-2" type="checkbox" value=""
                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                <label for="terms-checkbox-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> I agree
                    with the <a href="" title=""
                        class="text-blue-700 underline hover:no-underline dark:text-blue-500">Terms and
                        Conditions</a>
                    of use of the Ni.Robots marketplace </label>
            </div>
            <div class="flex items-center">
                <a href="/producto/pago" type="submit"
                    class="mt-4 flex w-full items-center justify-center rounded-lg bg-blue-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-blue-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:mt-0">Ir a pagar</a>
            </div>
        </div>

    </div>
</div>
