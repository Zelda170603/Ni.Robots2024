@extends('layouts.app')

@section('title', 'profesionales de la salud ')

@section('content')
    <!-- Card Section -->
    <div class="max-w-5xl sm:px-6 lg:px-8 mx-auto">
        <!-- Card -->
        <div class="rounded-xl shadow ">
            <div
                class="relative h-40 rounded-t-xl bg-[url('https://preline.co/assets/svg/examples/abstract-bg-1.svg')] bg-no-repeat bg-cover bg-center">
            </div>

            <div class="pt-0 p-4 sm:pt-0 sm:p-7">
                <!-- Grid -->
                <div class="space-y-4 sm:space-y-6">

                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 sm:gap-x-5">
                        <img class="-mt-8 relative z-10 inline-block size-24 mx-auto sm:mx-0 rounded-full ring-4 ring-white dark:ring-gray-800"
                            src="{{ Storage::url('images/profile_pictures/' . $medico->profile_picture) }}" alt="Avatar">

                        <div class="grid grid-cols-2 items-center mt-auto px-7 mb-2  center gap-2">
                            <a href="{{ route('create_with_medico', ['medico' => $medico->doctor->id]) }}" type="button"
                                class=" flex items-center justify-center gap-1 text-white text-center bg-blue-700 hover:bg-blue-800 col-span-1 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                                  </svg>
                                  Solicitar cita
                            </a>

                            <a href="{{ url('mensajes/'.$medico->name.'/' . $medico->id) }}"
                                class="cols-span-1 flex items-center justify-center gap-1  p-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 text-gray-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z"/>
                                  </svg>
                                  contactar</a>
                        </div>
                    </div>
                    <!-- List -->
                    <div class="space-y-3">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-blue-800 dark:text-gray-300">{{ $medico->name }}</h2>
                            <!--especialidad-->
                            <p class="text-gray-400 text-md dark:text-gray-400">
                                {{ $medico->doctor->especialidad ?? 'No specialty available' }}</p>
                        </div>

                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-40">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Correo Electronico:</span>
                            </dt>
                            <dd>
                                <ul>
                                    <li
                                        class="me-1 gap-2 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $medico->email }}
                                    </li>
                                </ul>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-40">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Codigo del minsa:</span>
                            </dt>
                            <dd>
                                <ul>
                                    <li
                                        class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                        {{ $medico->doctor->cod_minsa }}
                                    </li>
                                </ul>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-40">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Departamento,
                                    municipio:</span>
                            </dt>
                            <dd>
                                <ul>

                                    <li
                                        class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                        {{ $medico->departamento }} , {{ $medico->municipio }}
                                    </li>
                                </ul>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-40">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Direccion del
                                    consultorio:</span>
                            </dt>
                            <dd>
                                <ul>

                                    <li
                                        class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $medico->doctor->direccion_consultorio }}
                                    </li>
                                </ul>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-40">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">Titulacion:</span>
                            </dt>
                            <dd>
                                <ul>

                                    <li
                                        class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $medico->doctor->titulacion }}
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <!-- End List -->
                    <div class="space-y-3">
                        <h2 class="text-2xl font-bold md:text-3xl dark:text-white">Conoce mas sobre mi trabajo
                        </h2>
                        <p class="text-lg text-gray-800 dark:text-neutral-200">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Earum accusantium molestias nulla, maiores possimus explicabo voluptatem
                            laborum quia repellendus tenetur, facere at error animi nisi molestiae. Dolore exercitationem
                            laboriosam dolor!</p>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-3">
                        <div class="grid grid-cols-2 lg:grid-cols-1 gap-3">
                            <figure class="relative w-full h-60">
                                <img class="size-full absolute top-0 start-0 object-cover rounded-xl"
                                    src="https://images.unsplash.com/photo-1670272505340-d906d8d77d03?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                                    alt="Blog Image">
                            </figure>
                            <figure class="relative w-full h-60">
                                <img class="size-full absolute top-0 start-0 object-cover rounded-xl"
                                    src="https://images.unsplash.com/photo-1671726203638-83742a2721a1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                                    alt="Blog Image">
                            </figure>
                        </div>
                        <figure class="relative w-full h-72 sm:h-96 lg:h-full">
                            <img class="size-full absolute top-0 start-0 object-cover rounded-xl"
                                src="https://images.unsplash.com/photo-1671726203394-491c8b574a0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                                alt="Blog Image">
                        </figure>
                    </div>
                    <div class="space-y-3 ">
                        <h2 class="text-2xl font-bold md:text-3xl dark:text-white">Ten una vista mas detallada sobre como
                            llegar
                        </h2>
                        <div id="map" class="w-full  inset-0" style="height: 400px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YZ_TU27pADC0ThLH7U5QvSgG42fsuv8&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            // Obtener las coordenadas desde el servidor en el formato lat,lng
            const gMaps = '{{ $medico->doctor->google_map_direction }}';
            const coordinates = gMaps.split(',').map(Number);

            // Crear el mapa
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: {
                    lat: coordinates[0],
                    lng: coordinates[1]
                },
                styles: [{
                    "stylers": [{
                            "grayscale": 1
                        },
                        {
                            "contrast": 1.2
                        },
                        {
                            "opacity": 0.16
                        }
                    ]
                }]
            });
            // Añadir un marcador en las coordenadas
            new google.maps.Marker({
                position: {
                    lat: coordinates[0],
                    lng: coordinates[1]
                },
                map: map
            });
        }
    </script>
    <!-- End Card Section -->


@endsection
