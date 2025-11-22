@extends('layouts.mensajes')

@section('title', 'Mensajes')

{{-- Metas y boot de variables para JS (CSRF, usuario actual y Agora) --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="current-user-id" content="{{ auth()->id() }}">
<script>
  // fallback si no usas Vite envs todavía
  window.AGORA_APP_ID = @json(env('AGORA_APP_ID'));
  window.currentUserId = {{ auth()->id() }};
</script>

@section('content')
    <!-- Exponer el nombre del receptor para el UI de la videollamada -->
    <div data-receiver-name="{{ $user->name }}" class="hidden"></div>

    <!-- user list section -->
    <section class="bg-inherit px-4 pt-4 lg:w-80 lg:border-r border-r-slate-200 dark:border-r-slate-500 lg:flex hidden flex-col h-screen">
        <div class="flex items-center justify-between">
            <div class="text-slate-600 dark:text-white max-w-sm pb-6">
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
            @include('mensajes.partials.modal_search')
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
            <!-- Los contactos se cargarán aquí -->
        </div>
    </section>

    <!--main chat area-->
    <section class="bg-inherit flex-1 flex flex-col">
        <!--Chat header-->
        <div class="flex items-center px-4 py-2 border-b bg-gray-200 dark:bg-gray-700 border-b-slate-200 dark:border-b-gray-700 gap-2">
            <a class="lg:hidden block" href="/mensajes">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <div class="flex-shrink-0">
                @php
                    $avatar = ($user->profile_picture && $user->profile_picture !== 'null.jpg')
                        ? Storage::url('images/profile_pictures/' . $user->profile_picture)
                        : asset('images/default-avatar.jpg');
                @endphp
                <img class="w-12 h-12 object-cover rounded-full" src="{{ $avatar }}" alt="Profile picture">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-md font-medium text-gray-900 truncate dark:text-white">
                    {{ $user->name }}
                </p>
                <p class="text-base text-gray-500 truncate dark:text-gray-400">
                    {{ $lastSeenFormatted }}
                </p>
            </div>

            <!-- 🔥 BOTONES DE VIDEOCALL INTEGRADOS -->
            <div class="flex items-center gap-2">
                <!-- Botón para videollamada presencial -->
                <button id="startPresentialCall" class="p-2 text-green-600 bg-green-100 rounded-full hover:bg-green-200 dark:bg-green-900 dark:hover:bg-green-800" title="Videollamada Presencial">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>

                <!-- Botón para telehealth -->
                <button id="startTelehealthCall" class="p-2 text-blue-600 bg-blue-100 rounded-full hover:bg-blue-200 dark:bg-blue-900 dark:hover:bg-blue-800" title="Telehealth">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!--messages section-->
        <div id="chatWindow" class="flex flex-col gap-4 p-4 h-screen overflow-y-auto no-scrollbar">
            <!-- Aquí se cargan los mensajes -->
        </div>

        <div class="lg:px-4 lg:pb-2">
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                <button type="button"
                    class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 18">
                        <path fill="currentColor"
                            d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                    </svg>
                    <span class="sr-only">Upload image</span>
                </button>
                <button type="button"
                    class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                    </svg>
                    <span class="sr-only">Add emoji</span>
                </button>

                {{-- ID del receptor para mensaje.js y videollamadas --}}
                <input id="UserReceive" type="hidden" value="{{ $user->id }}">

                <input id="chat" type="text" rows="1"
                    class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your message...">
                <button id="sendButton" type="button"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600"
                    disabled>
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </div>
    </section>

    <!-- 🔥 MODAL DE VIDEOCALL INTEGRADO -->
    <div id="videoCallModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-height-screen p-4 min-h-screen">
            <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-4xl">
                <!-- Header del modal -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="videoCallTitle">Videollamada</h3>
                    <button id="closeVideoCall" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Contenido de la videollamada -->
                <div class="p-4">
                    <!-- Información del tipo de llamada -->
                    <div id="callTypeInfo" class="mb-4 p-3 rounded-lg bg-blue-50 dark:bg-blue-900">
                        <p class="text-blue-800 dark:text-blue-200 text-sm" id="callTypeText"></p>
                    </div>

                    <!-- Botones para llamada entrante (el contenedor YA NO está oculto) -->
                    <div id="incomingCallButtons" class="flex justify-center space-x-4 mb-4">
                        <button id="acceptCall" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2 hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Aceptar</span>
                        </button>
                        <button id="declineCall" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center space-x-2 hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Rechazar</span>
                        </button>
                    </div>

                    <!-- Videos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Video local -->
                        <div class="relative">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tu cámara</h4>
                            <div class="w-full h-48 md:h-64 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <!-- Agora renderiza dentro del contenedor -->
                                <div id="localVideo" class="w-full h-full"></div>
                                <!-- Placeholder cuando no hay video -->
                                <div id="localVideoPlaceholder" class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm mt-2">Cámara local</p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                Tú
                            </div>
                        </div>

                        <!-- Video remoto -->
                        <div class="relative">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $user->name }}</h4>
                            <div class="w-full h-48 md:h-64 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <div id="remoteVideo" class="w-full h-full"></div>
                                <!-- Placeholder cuando no hay video remoto -->
                                <div id="remoteVideoPlaceholder" class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm mt-2">Esperando usuario...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                {{ $user->name }}
                            </div>
                        </div>
                    </div>

                    <!-- Controles de la llamada -->
                    <div id="callControls" class="flex justify-center space-x-4">
                        <button id="toggleAudio" class="p-3 bg-gray-200 dark:bg-gray-700 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600">
                            <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        </button>

                        <button id="toggleVideo" class="p-3 bg-gray-200 dark:bg-gray-700 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600">
                            <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </button>

                        <button id="endCall" class="p-3 bg-red-600 rounded-full hover:bg-red-700">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Estado de la conexión -->
                    <div id="connectionStatus" class="mt-4 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400" id="statusText">Conectando...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script de Agora SDK --}}
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>

    {{-- Tu JS (donde está la state machine y el flujo controlado) --}}
    @vite('resources/js/Mensajes/mensaje.js')
@endsection
