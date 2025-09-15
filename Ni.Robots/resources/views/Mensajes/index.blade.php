@extends('layouts.mensajes')

@section('title', 'Mensajes')

@section('content')
    <section
        class="bg-inherit px-4 pt-4 w-full lg:w-80 lg:border-r border-r-slate-200 dark:border-r-slate-500 flex flex-col h-screen">
        <div class="flex items-center justify-between">
            <div class="text-slate-600 dark:text-white max-w-sm  pb-6">
                <h1 class="text-3xl font-bold">Mensajes</h1>
            </div>
            <button data-modal-target="mensajes-modal" data-modal-toggle="mensajes-modal" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="size-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                </svg>

            </button>
            @include('Mensajes.partials.modal_search')
        </div>
        <div class="flex items-center w-full pb-6">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-6 text-slate-700 dark:text-gray-50" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
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
        </div>
    </section>
    <!--main chat area-->
    <section class="bg-inherit hidden  lg:flex flex-1 items-center justify-center">
        <div class="text-slate-600 dark:text-white max-w-sm  pb-6">
            <h1 class="text-3xl font-bold">Selecciona un usuario de la lista para conversar</h1>
        </div>
    </section>
@endsection
