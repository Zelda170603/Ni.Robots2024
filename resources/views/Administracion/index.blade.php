<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administracion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('index.nav-bar')
    <main class="mt-14 overflow-hidden">
        <div class="gap-8 py-8 px-4 mx-auto max-w-6xl relative lg:py-4 xl:grid xl:grid-cols-12">

            <div class="col-span-8">
                <h1
                    class="mb-4 font-extrabold tracking-tight text-3xl md:text-6xl  bg-gradient-to-tr from-sky-800 via-teal-800 to-teal-800 bg-clip-text text-transparent">
                    Discover new product and best possibilities</h1>
                <p class="mb-6 font-medium dark:text-gray-400 xl:mb-8 md:text-lg lg:text-lg text-gray-700">
                    Here at Flowbite we focus on markets where technology, innovation, and capital can unlock
                    long-term value and drive economic growth.</p>
                <div class="sm:gap-16 gap-10 flex items-center sm:flex-row flex-col">
                    <div class="mb-8 text-gray-500 sm:mb-0 dark:text-gray-400">
                        <svg class="mb-3 size-7" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <h2 class="mb-3 text-lg font-semibold dark:text-gray-100 text-gray-900">
                            28 November 2021</h2>
                        <p class="mb-4 font-normal">Join us at FlowBite 2021 to understand
                            what’s next as the global tech and startup ecosystem, rethinks the future of everything.
                        </p>
                        <a href="#"
                            class="text-white relative bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Conference
                        </a>
                    </div>
                    <div class="mb-8 text-gray-500 sm:mb-0 dark:text-gray-400">
                        <svg class="mb-3 size-7" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <h2 class="mb-3 text-lg font-semibold dark:text-gray-100 text-gray-900">
                            25+ top notch speakers</h2>
                        <p class="mb-4 font-normal">Here you will find keynote speakers,
                            who all are able to talk about Recruiting. Click on the individual keynote speakers and
                            read more about them and their keynotes.</p>
                        <a href="#"
                            class="text-white relative bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Conference
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden  w-1/3 h-full xl:block">
                <div class="flex items-center space-x-6 lg:space-x-8">
                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                        <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg"
                                alt="" class="h-full w-full object-cover object-center">
                        </div>
                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg"
                                alt="" class="h-full w-full object-cover object-center">
                        </div>
                    </div>
                    <div class="grid flex-shrink-0 grid-cols-1  gap-y-6 lg:gap-y-8">
                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg"
                                alt="" class="h-full w-full object-cover object-center">
                        </div>
                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg"
                                alt="" class="h-full w-full object-cover object-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
                <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
        
        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js');
    {{-- @vite('resources/js/centros_Atencion/cargar_centros.js'); --}}
</body>

</html>
