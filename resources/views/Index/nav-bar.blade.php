<!-- ========== HEADER ========== -->
<nav
    class="fixed top-0 md:justify-start md:flex-nowrap z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-[85rem] w-full mx-auto  md:gap-3 py-2 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 justify-between items-center ">
            <a class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80 dark:text-white"
                href="#" aria-label="Brand">Ni.Robots</a>

            @auth
                <div class="flex items-center justify-end">
                    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                        class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 focus:outline-none dark:hover:text-white dark:text-gray-400"
                        type="button">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 14 20">
                            <path
                                d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                        </svg>
                        @if (count(auth()->user()->unreadNotifications) > 0)
                            <div
                                class="absolute flex w-4 h-4 justify-center items-center text-white text-xs-extra bg-red-500 border border-white rounded-full text-white` -top-1 start-3.5 dark:border-slate-900">
                                <span class="font-semibold">{{ count(auth()->user()->unreadNotifications) }}</span>
                            </div>
                        @endif
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNotification"
                        class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                        aria-labelledby="dropdownNotificationButton">
                        <div
                            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                            Notifications
                        </div>
                        <div id="notifications-container"
                            class=" h-96 flex flex-col divide-y divide-gray-100 dark:divide-gray-700 overflow-y-auto no-scrollbar">

                        </div>
                        <a href="#"
                            class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                            <div class="inline-flex items-center ">
                                <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                    <path
                                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>
                    <div>
                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 ml-4 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                            <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full ml-4 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="{{ Storage::url('images/profile_pictures/' . Auth::user()->profile_picture) }}"
                                alt="user photo">
                        </button>
                        <!-- User Dropdown -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                        out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <!-- Collapse Button -->
                <div class="md:hidden relative flex justify-end">
                    <button type="button"
                        class="hs-collapse-toggle  size-9 flex justify-center items-center font-medium text-[12px] rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        id="hs-header-base-collapse" aria-expanded="false" aria-controls="hs-header-base"
                        aria-label="Toggle navigation" data-hs-collapse="#hs-header-base">
                        <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                </div>

                <!-- End Collapse Button -->
                <!-- Collapse -->
                <div id="hs-header-base"
                    class="hs-collapse hidden md:col-span-1 col-span-2 overflow-hidden transition-all duration-300 basis-full grow md:block "
                    aria-labelledby="hs-header-base-collapse">
                    <div
                        class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                        <div class="py-2 md:py-0  flex flex-col md:flex-row md:items-center gap-0.5 md:gap-1">
                            <div class="grow">
                                <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">
                                    <a class="p-2 flex items-center text-sm bg-gray-100 text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                        href="#" aria-current="page">
                                        <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                            <path
                                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        </svg>
                                        Landing
                                    </a>

                                    <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                        href="#">
                                        <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                        Account
                                    </a>

                                    <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                        href="#">
                                        <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                        Work
                                    </a>

                                    <a class="p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                        href="#">
                                        <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                                            <path d="M18 14h-8" />
                                            <path d="M15 18h-5" />
                                            <path d="M10 6h8v4h-8V6Z" />
                                        </svg>
                                        Blog
                                    </a>
                                </div>
                            </div>

                            <div class="my-2 md:my-0 md:mx-2">
                                <div class="w-full h-px md:w-px md:h-4 bg-gray-100 md:bg-gray-300 dark:bg-neutral-700">
                                </div>
                            </div>

                            <!-- Button Group -->
                            <div class=" flex flex-wrap items-center gap-x-1.5">
                                @if (Route::has('login'))
                                    <a class="py-[7px] px-2.5 inline-flex items-center font-medium text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                        href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="py-2 px-2.5 inline-flex items-center font-medium text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:bg-blue-600"
                                        href="{{ route('register') }}">
                                        {{ __('Registrarse') }}
                                    </a>
                                @endif
                            </div>
                            <!-- End Button Group -->
                        </div>
                    </div>
                </div>

                <!-- End Collapse -->
            @endauth
        </div>
    </div>
</nav>
<!-- ========== END HEADER ========== -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById('hs-header-base-collapse');
        const collapseMenu = document.getElementById('hs-header-base');

        toggleButton.addEventListener('click', function() {
            // Toggle the 'hidden' class to show or hide the menu
            collapseMenu.classList.toggle('hidden');
            collapseMenu.classList.toggle('block');
        });
    });
</script>


@auth
    @include('index.aside')
@endauth
