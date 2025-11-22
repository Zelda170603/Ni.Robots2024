<!-- ========== HEADER (Fusionado: funcional + responsive) ========== -->
<nav
    class="fixed top-0 border-b border-gray-200 dark:border-gray-700 z-50 w-full backdrop-blur-3xl bg-white/70 dark:bg-gray-800/10">
    <div class="max-w-[85rem] w-full mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center gap-2">
            <!-- IZQUIERDA: Drawer, Logo, Buscador desktop -->
            <div class="flex items-center gap-3 md:gap-4 flex-1 min-w-0">
                @auth
                    <!-- Botón Drawer -->
                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="p-2 text-gray-600 rounded-lg hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        aria-label="Toggle sidebar">
                        <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @endauth

                <!-- Logo / Marca -->
                <a class="flex items-center shrink-0 focus:outline-none focus:opacity-80" href="{{ route('home') }}"
    aria-label="Brand">
    {{-- logo para modo oscuro (dark ON) --}}
    <img src="{{ asset('images/logo.png') }}"
         alt="Ni.Robots"
         class="hidden dark:block h-8 w-auto sm:h-10">

    {{-- logo para modo claro (dark OFF) --}}
    <img src="{{ asset('images/logoDark.png') }}"
         alt="Ni.Robots"
         class="block dark:hidden h-8 w-auto sm:h-10">
</a>


                <!-- Buscador Desktop -->
                <div id="search-div-desktop" class="hidden md:block ml-2 min-w-0" data-modal-target="default-modal"
                    data-modal-toggle="default-modal">
                    <label for="topbar-search" class="sr-only">Search</label>
                    <div class="relative w-48 lg:w-64">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                                </path>
                            </svg>
                        </div>
                        <div id="topbar-search"
                            class="truncate bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            realizar busqueda
                        </div>
                    </div>
                </div>
            </div>

            <!-- DERECHA -->
            @auth
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Buscador Mobile -->
                    <button id="search-div-mobile" type="button" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="md:hidden p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        aria-label="Search">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>

                    <!-- Notificaciones -->
                    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                        class="relative p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        type="button" aria-haspopup="true" aria-expanded="false">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 14 20">
                            <path
                                d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                        </svg>
                        @if (count(auth()->user()->unreadNotifications) > 0)
                            <span
                                class="absolute -top-1 -right-1 inline-flex w-4 h-4 items-center justify-center text-white text-[10px] bg-red-500 border border-white rounded-full dark:border-slate-900">
                                {{ count(auth()->user()->unreadNotifications) }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Notificaciones (funciona con data-dropdown-toggle) -->
                    <div id="dropdownNotification"
                        class="z-50 hidden w-[95vw] max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                        role="menu" aria-labelledby="dropdownNotificationButton">
                        <div
                            class="px-4 py-2 font-bold text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-700 dark:text-white">
                            Notifications
                        </div>
                        <div id="notifications-container"
                            class="h-96 flex flex-col divide-y font-bold divide-gray-100 dark:divide-gray-700 overflow-y-auto no-scrollbar">
                        </div>
                        <a href="#"
                            class="block py-2 text-sm font-bold text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-500 dark:text-white">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    viewBox="0 0 20 14" fill="currentColor">
                                    <path
                                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                                View all
                            </span>
                        </a>
                    </div>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" type="button"
                        class="p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white rounded-lg"
                        aria-label="Cambiar tema">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
                        </svg>
                    </button>

                    <!-- Menú Usuario -->
                    <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="{{ Storage::url('images/profile_pictures/' . Auth::user()->profile_picture) }}"
                            alt="user photo" />
                    </button>

                    <!-- Dropdown Usuario -->
                    <div id="dropdown"
                        class="hidden z-50 my-4 w-56 text-base list-none bg-white overflow-hidden divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                        role="menu" aria-labelledby="user-menu-button">
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-sm font-semibold text-gray-900 truncate dark:text-white">{{ Auth::user()->email }}</span>
                        </div>

                        <ul class="py-1 font-bold text-gray-700 dark:text-gray-300">
                            <li>
                                <a href="{{ route('user_perfil') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    ir al perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('edit_profile') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4" />
                                    </svg>
                                    Configuracion
                                </a>
                            </li>
                        </ul>

                        <ul class="py-1 font-bold text-gray-700 dark:text-gray-300">
                            <li>
                                <a href="#"
                                    class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    My likes
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                        </path>
                                    </svg>
                                    Collections
                                </a>
                            </li>
                            <li>
                                <a href="/compras"
                                    class="flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="flex items-center">
                                        <svg class="mr-2 w-5 h-5 text-blue-600 dark:text-blue-500" viewBox="0 0 24 24"
                                            fill="none">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                                        </svg>
                                        Ver mis compras
                                    </span>
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                        <ul class="py-1 font-bold text-gray-700 dark:text-gray-300">
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                    </svg>
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf</form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <!-- Invitado: theme + hamburguesa + links desktop -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Theme -->
                    <button id="theme-toggle" type="button"
                        class="p-2 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white rounded-lg"
                        aria-label="Cambiar tema">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
                        </svg>
                    </button>

                    <!-- Hamburguesa -->
                    <button type="button"
                        class="lg:hidden hs-collapse-toggle size-9 flex justify-center items-center rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        id="hs-header-base-collapse" aria-expanded="false" aria-controls="hs-header-base"
                        aria-label="Toggle navigation" data-hs-collapse="#hs-header-base">
                        <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                        <span class="sr-only">Toggle navigation</span>
                    </button>

                    <!-- Links desktop -->
                    <div class="hidden lg:flex items-center gap-2">
                        @if (Route::has('login'))
                            <a class="py-2 px-3 inline-flex items-center text-sm rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-gray-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-gray-700"
                                href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a class="py-2 px-3 inline-flex items-center text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                                href="{{ route('register') }}">
                                {{ __('Registrarse') }}
                            </a>
                        @endif
                    </div>
                </div>
            @endauth
        </div>

        <!-- Menú móvil INVITADO -->
        @guest
            <div id="hs-header-base" class="hs-collapse hidden lg:hidden overflow-hidden transition-all duration-300 mt-3"
                aria-labelledby="hs-header-base-collapse">
                <div class="py-2 border-t border-gray-200 dark:border-neutral-700">
                    <div class="flex flex-col space-y-2">
                        <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg dark:text-gray-200 dark:hover:bg-gray-700"
                            href="{{ route('home') }}">
                            <svg class="shrink-0 size-4 me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                <path
                                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            </svg>
                            Pagina principal
                        </a>

                        <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg dark:text-gray-200 dark:hover:bg-gray-700"
                            href="{{ route('books.index') }}">
                            <svg class="shrink-0 size-4 me-3" aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                            </svg>
                            Educacion
                        </a>

                        <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg dark:text-gray-200 dark:hover:bg-gray-700"
                            href="{{ route('atencion_medica') }}">
                            <svg class="shrink-0 size-4 me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 12h.01" />
                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                <rect width="20" height="14" x="2" y="6" rx="2" />
                            </svg>
                            Atencion medica
                        </a>

                        <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg dark:text-gray-200 dark:hover:bg-gray-700"
                            href="{{ route('productos.index') }}">
                            <svg class="shrink-0 size-4 me-3" aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                            </svg>
                            Productos
                        </a>

                        <!-- Auth móvil -->
                        <div class="pt-2 border-t border-gray-200 dark:border-neutral-700">
                            <div class="flex flex-col space-y-2">
                                @if (Route::has('login'))
                                    <a class="py-2 px-3 text-center text-sm rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-gray-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-gray-700"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="py-2 px-3 text-center text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                                        href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</nav>

<!-- Toggle hamburguesa invitado -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('hs-header-base-collapse');
        const menu = document.getElementById('hs-header-base');
        if (toggleButton && menu) {
            toggleButton.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                const icons = toggleButton.querySelectorAll('svg');
                icons.forEach(icon => icon.classList.toggle('hidden'));
                const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
                toggleButton.setAttribute('aria-expanded', (!isExpanded).toString());
            });
        }
    });
</script>

<!-- Sidebar -->
@auth
    @include('Index.aside')
@endauth
