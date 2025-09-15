@extends('layouts.auth')

@section('title', 'Register ')

@section('content')
    <div class="flex min-h-full flex-col justify-center sm:px-6 lg:px-8 py-24 px-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="relative ">
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-neutral-600">
                <div id="progress-bar" class="dark:bg-blue-300 bg-blue-600 h-2.5 rounded-full" style="width: 33%;"></div>
            </div>
            <!-- Stepper Icons -->
            <ol class="absolute top-0 left-0 flex items-center justify-between w-full -translate-y-1/2">
                <li class="flex w-1/3 justify-center items-center" id="step-1-nav">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700">
                        <svg id="step-1-icon" class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                        </svg>
                    </div>
                </li>
                <li class="flex w-1/3 justify-center items-center" id="step-2-nav">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700">
                        <svg id="step-2-icon" class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z" />
                            <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z" />
                        </svg>
                    </div>
                </li>
                <li class="flex w-1/3 justify-center items-center" id="step-3-nav">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700">
                        <svg id="step-3-icon" class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                        </svg>
                    </div>
                </li>
            </ol>
        </div>

        <form action="{{ route('create_doctor') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-8 ">
            @csrf
            <!-- Step 1 -->
            <div id="step-1-content" class="gap-4 mb-4 flex-col">
                <h2
                    class="mt-6 text-start text-3xl font-extrabold leading-9 tracking-tight text-opacity-100 background-text dark-background-text bg-clip-text text-transparent">
                    Introduce tus datos personales</h2>
                <div>
                    <label for="name"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Name') }}</label>
                    <div class="mt-2">
                        <input id="name" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2  text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') ring-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Email Address') }}</label>
                    <div class="mt-2">
                        <input id="email" type="email"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') ring-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Password') }}</label>
                    <div class="mt-2">
                        <input id="password" type="password"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') ring-red-500 @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password-confirm"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Confirm Password') }}</label>
                    <div class="mt-2">
                        <input id="password-confirm" type="password"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div>
                    <label for="profile_picture"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Profile Picture') }}</label>
                    <div class="mt-2">

                        <div class="flex items-center gap-2">
                            <div class="shrink-0">
                                <img class="shrink-0 size-16 rounded-full"
                                    src="https://th.bing.com/th/id/OIP.OWHqt6GY5jrr7ETvJr8ZXwHaHa?rs=1&pid=ImgDetMain"
                                    alt="Avatar">
                            </div>
                            <input id="profile_picture" type="file"
                                class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800  text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('profile_picture') ring-red-500 @enderror"
                                name="profile_picture" accept="image/*">
                        </div>

                        <p class="mt-1 text-sm text-gray-800 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 800x400px).</p>
                        @error('profile_picture')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="departamento"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Departamento') }}</label>
                    <div class="mt-2">
                        <select id="departamento" name="departamento"
                            class="bg-blue-300 dark:bg-main_color text-blue-800 dark:text-blue-300  block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2  shadow-sm ring-1 ring-inset  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('departamento') ring-red-500 @enderror"
                            required>
                            <option value="">Selecciona un departamento</option>
                            <!-- Opciones -->
                        </select>

                        @error('departamento')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="municipio"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Municipio') }}</label>
                    <div class="mt-2">
                        <select id="municipio" name="municipio"
                            class="bg-blue-300 dark:bg-main_color text-blue-800 dark:text-blue-300  block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('municipio') ring-red-500 @enderror"
                            required>
                            <option value="">Selecciona un municipio</option>
                            <!-- Opciones -->
                        </select>

                        @error('municipio')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="domicilio"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Domicilio') }}</label>
                    <div class="mt-2">
                        <input id="domicilio" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0  border-blue-800 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('domicilio') ring-red-500 @enderror"
                            name="domicilio" value="{{ old('domicilio') }}" required>

                        @error('domicilio')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Step 2: Información Profesional del Doctor -->
            <div id="step-2-content" class="gap-4 mb-4 flex-col" style="display: none;">
                <h2
                    class="mt-6 text-start text-3xl font-extrabold leading-9 tracking-tight text-opacity-100 background-text dark-background-text bg-clip-text text-transparent">
                    Necesitamos conocer más sobre tu labor como profesional de la salud
                </h2>

                <!-- Cedula -->
                <div>
                    <label for="cedula"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Cedula</label>
                    <div class="mt-2">
                        <input id="cedula" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="cedula" value="{{ old('cedula') }}" required>
                        @error('cedula')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Biografia -->
                <div>
                    <label for="biografia"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Biografia</label>
                    <div class="mt-2">
                        <textarea id="biografia"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="biografia" required>{{ old('biografia') }}</textarea>
                        @error('biografia')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Edad -->
                <div>
                    <label for="edad"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Edad</label>
                    <div class="mt-2">
                        <input id="edad" type="number"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="edad" value="{{ old('edad') }}" required>
                        @error('edad')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Especialidad -->
                <div>
                    <label for="especialidad"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Especialidad</label>
                    <div class="mt-2">
                        <select id="especialidad" name="especialidad"
                            class="bg-blue-300 dark:bg-main_color text-blue-800 dark:text-blue-300 block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                            <option value="">Seleccionar especialidad</option>
                            @foreach ($specialties as $especialidad)
                                <option value="{{ $especialidad->name }}"
                                    @if (old('specialty') == $especialidad->name) selected @endif>
                                    {{ $especialidad->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('especialidad')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Telefono -->
                <div>
                    <label for="telefono"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Teléfono</label>
                    <div class="mt-2">
                        <input id="telefono" type="number"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="telefono" value="{{ old('telefono') }}" required>
                        @error('telefono')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="genero"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('Genero') }}</label>
                    <div class="mt-2">
                        <select id="genero" name="genero"
                            class="bg-blue-300 dark:bg-main_color text-blue-800 dark:text-blue-300 block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('genero') ring-red-500 @enderror"
                            required>
                            <option value="">Selecciona el género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>

                        @error('genero')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="area"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">{{ __('area') }}</label>
                    <div class="mt-2">
                        <input id="area" type="text"
                        class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        name="area" value="{{ old('area') }}" required>

                        @error('area')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Direccion Consultorio -->
                <div>
                    <label for="direccion_consultorio"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Dirección del
                        Consultorio</label>
                    <div class="mt-2">
                        <input id="direccion_consultorio" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="direccion_consultorio" value="{{ old('direccion_consultorio') }}" required>
                        @error('direccion_consultorio')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Google Maps Direction -->

                <div>
                    <label for="google_map_direction"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Haz
                        click en la ubicacion de tu centro de atecion en el mapa</label>

                    <div id="map" style="height: 400px; width: 100%;"></div>
                    <input type="hidden" id="google_map_direction" name="google_map_direction"
                        value="{{ old('google_map_direction') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    @error('google_map_direction')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <!-- Titulación -->
                <div>
                    <label for="titulacion"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Titulación</label>
                    <div class="mt-2">
                        <input id="titulacion" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="titulacion" value="{{ old('titulacion') }}" required>
                        @error('titulacion')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Codigo MINSA -->
                <div>
                    <label for="cod_minsa"
                        class="block text-sm font-bold leading-6 text-blue-800 dark:text-blue-300">Código MINSA</label>
                    <div class="mt-2">
                        <input id="cod_minsa" type="text"
                            class="bg-transparent block w-full rounded-md border-1 dark:border-0 border-blue-800 py-2 text-blue-800 dark:text-blue-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            name="cod_minsa" value="{{ old('cod_minsa') }}" required>
                        @error('cod_minsa')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>


            <!-- Step 3 -->
            <div id="step-3-content" class="flex flex-col gap-4 mb-4">

                <p class="font-bold text-lg dark:text-gray-400 text-blue-900 text-center">Tu privacidad es importante</p>
                <p class="mt-2 text-md font-bold dark:text-gray-200 text-blue-900">
                    La información que nos proporciones será utilizada exclusivamente para mejorar tu experiencia dentro de
                    la aplicación. Nos aseguramos de que todos tus datos se manejen con total confidencialidad y seguridad.
                    Solo recopilamos los datos estrictamente necesarios y nunca compartiremos tu información con terceros
                    sin
                    tu consentimiento explícito.
                </p>
                <p class="mt-2 text-mm font-light dark:text-gray-400 text-blue-700">
                    Si tienes alguna pregunta sobre cómo gestionamos tu información, no dudes en contactarnos.
                </p>
            </div>


            <!-- Button Group -->
            <div class="flex justify-evenly items-center gap-4 mt-5">
                <button id="prev-btn" type="button"
                    class="py-2 px-3 items-center gap-x-1 text-sm font-bold rounded-lg border border-blue-800 dark:border-gray-200 dark:text-gray-200 text-blue-800  shadow-smfocus:outline-none "
                    disabled>
                    anterior
                </button>
                <button id="next-btn" type="button"
                    class="py-2 px-3 items-center gap-x-1 text-sm font-bold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    siguiente
                </button>
                <button id="finish-btn" type="submit"
                    class="py-2 px-3 items-center gap-x-1 text-sm font-bold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700"
                    style="display: none;">
                    enviar
                </button>
            </div>
        </form>
    </div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YZ_TU27pADC0ThLH7U5QvSgG42fsuv8&callback=initMap"></script>
    <script>
        var map;
        var marker;

        function initMap() {
            var center = {
                lat: 12.865416,
                lng: -85.207229
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: center
            });

            map.addListener('click', function(e) {
                var latLng = e.latLng;
                var lat = latLng.lat();
                var lng = latLng.lng();

                alert('Latitude: ' + lat + ', Longitude: ' + lng);

                if (marker) {
                    marker.setPosition(latLng);
                } else {
                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                }
                document.getElementById('google_map_direction').value = lat + ', ' + lng;
            });
        }
    </script>
    @vite('resources/js/resources/Cargar_ciudades_departamentos.js')
    @vite('resources/js/stepper.js')
@endsection
