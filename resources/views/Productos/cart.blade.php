<!-- Botón para abrir el carrito -->
<button id="openCartButton"
    class="fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-green-700">
    Abrir Carrito
</button>
<div id="overlay" class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity opacity-0 pointer-events-none"></div>
<!-- Contenedor del carrito -->
<div id="cart-content"
    class="fixed top-14 right-0 z-40 h-screen p-4 overflow-y-auto  transition-transform translate-x-full backdrop-blur-3xl bg-white/70 w-80 dark:bg-gray-800/10"
    tabindex="-1" >
    <h5 id="drawer-right-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        Carrito de Compras
    </h5>
    <button type="button" id="closeCartButton" aria-controls="drawer-right-example"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="mt-8 scroll-m-0">
        <div class="flow-root">
            <ul role="list" id="product-list" class="-my-6 divide-y divide-gray-200">
                
            </ul>
        </div>
    </div>
    <div class="mt-6 border-t border-gray-200 px-4 py-6 sm:px-6">
        <div class="flex justify-between text-base font-medium text-gray-900 dark:text-gray-100">
            <p>Subtotal</p>
            <p>$262.00</p>
        </div>
        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-200">Shipping and taxes calculated at checkout.</p>
        <div class="mt-6">
            <a href="#"
                class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white  shadow-sm hover:bg-indigo-700">Checkout</a>
        </div>
        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
            <p>
                <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500" @click="open = false">
                    Continue Shopping
                    <span aria-hidden="true"> </span>
                </button>
            </p>
        </div>
    </div>
</div>
