<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mensajes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto max-w-screen-2xl">
    @include('Index.nav-bar')
    <main class="flex  h-screen overflow-hidden pt-14 ">
        <!-- user list section -->
        <section class="bg-inherit px-4 pt-4  lg:w-80 lg:border-r border-r-slate-200 dark:border-r-slate-500 lg:flex hidden flex-col h-screen">
            <div class="text-slate-600 dark:text-white max-w-sm  pb-6">
                <h1 class="text-3xl font-bold">Mensajes</h1>
            </div>
            <div class="flex items-center w-full pb-6">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-6 h-6 text-slate-700 dark:text-gray-50" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search-bar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar a un usuario..." required />
                </div>
            </div>
            <!-- lista de chats -->
            <div id="contact-list" class="flex-1 overflow-y-auto no-scrollbar">
                <div class="flex items-center space-x-4 pb-4 last-of-type:pb-0 hover:bg-slate-600">
                    <div class="flex-shrink-0">
                        <img class="w-12 h-12 object-cover rounded-full"
                            src="{{ Storage::url('images/fabricantes/1718226350.jpg') }}" alt="Neil image">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between">
                            <p class="text-base font-medium text-gray-800 truncate dark:text-white">
                                Michael Jordan
                            </p>
                            <span class="text-base font-medium text-gray-600 dark:text-slate-500">
                                4:30
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            Son las 3 y media de la mañana y sigo pensandote ahora
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--main chat area-->
        <section class="bg-inherit flex-1 flex flex-col">
            <!--Chat header-->
            <div class="flex items-center px-4 py-2 border-b bg-gray-200 dark:bg-gray-700 border-b-slate-200 dark:border-b-gray-700 gap-2">
                <a class="lg:hidden block" href="/mensajes">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M5 12l4-4m-4 4 4 4" />
                    </svg>
                </a>
                <div class="flex-shrink-0">
                    <img class="w-12 h-12 object-cover rounded-full"
                    
                        src="{{ Storage::url('images/profile_pictures/' . $user->profile_picture) }}" alt="Neil image">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-mdphp font-medium text-gray-900 truncate dark:text-white">
                        {{ $user->name }}
                    </p>
                    <p class="text-base text-gray-500 truncate dark:text-gray-400">
                        {{ $lastSeenFormatted }}
                    </p>
                </div>
            </div>
            <!--messages section-->
            <div id="chatWindow" class="flex flex-col gap-4 p-4 h-screen overflow-y-auto no-scrollbar">
                <!---Aqui se cargan los mensajes--->
            </div>
            <div class="lg:px-4 lg:pb-2">
                <label for="chat" class="sr-only">Your message</label>
                <div class="flex items-center px-3 py-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                    <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                        </svg>
                        <span class="sr-only">Upload image</span>
                    </button>
                    <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                        </svg>
                        <span class="sr-only">Add emoji</span>
                    </button>
                    <input id="UserReceive" type="text" value="{{$user->id}}"hidden disabled>
                    <input id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></input>
                    <button id="sendButton" type="button" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600" disabled>
                        <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
            </div>
            
        </section>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/Mensajes/contactos_search.js')
    @vite('resources/js/Mensajes/mensajes.js')
</body>

</html>
