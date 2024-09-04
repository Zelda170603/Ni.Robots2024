@extends('layouts.app')

@section('content')
    <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-lg">
            <div class=" px-6 py-8 rounded-lg sm:px-12">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2
                        class="mt-6 text-start text-3xl font-extrabold leading-9 tracking-tight text-opacity-100  bg-gradient-to-tr from-blue-300 dark: via-teal-300 to-blue-600 bg-clip-text text-transparent">
                        Bienvenido de nuevo, inicia sesion con tu cuenta</h2>
                </div>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6 pt-4">
                    @csrf

                    <div>
                        <label for="name"
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Name') }}</label>
                        <div class="mt-2">
                            <input id="name" type="text"
                                class="bg-transparent block w-full rounded-md border-0 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') ring-red-500 @enderror"
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Email Address') }}</label>
                        <div class="mt-2">
                            <input id="email" type="email"
                                class="bg-transparent block w-full rounded-md border-0 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') ring-red-500 @enderror"
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Password') }}</label>
                        <div class="mt-2">
                            <input id="password" type="password"
                                class="bg-transparent block w-full rounded-md border-0 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') ring-red-500 @enderror"
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Confirm Password') }}</label>
                        <div class="mt-2">
                            <input id="password-confirm" type="password"
                                class="bg-transparent block w-full rounded-md border-0 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div>
                        <label for="profile_picture"
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Profile Picture') }}</label>
                        <div class="mt-2">

                            <div class="flex items-center gap-2">
                                <div class="shrink-0">
                                    <img class="shrink-0 size-16 rounded-full"
                                        src="https://th.bing.com/th/id/OIP.OWHqt6GY5jrr7ETvJr8ZXwHaHa?rs=1&pid=ImgDetMain"
                                        alt="Avatar">
                                </div>
                                <input id="profile_picture" type="file"
                                    class="bg-transparent block w-full rounded-md border-0  text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('profile_picture') ring-red-500 @enderror"
                                    name="profile_picture" accept="image/*">
                            </div>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Departamento') }}</label>
                        <div class="mt-2">
                            <select id="departamento" name="departamento"
                                class="bg-main_color text-gray-200  block w-full rounded-md border-0 py-2  shadow-sm ring-1 ring-inset  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('departamento') ring-red-500 @enderror"
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Municipio') }}</label>
                        <div class="mt-2">
                            <select id="municipio" name="municipio"
                                class="bg-main_color text-gray-200  block w-full rounded-md border-0 py-2  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('municipio') ring-red-500 @enderror"
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
                            class="block text-sm font-bold leading-6 text-blue-300">{{ __('Domicilio') }}</label>
                        <div class="mt-2">
                            <input id="domicilio" type="text"
                                class="bg-transparent block w-full rounded-md border-0 py-2 text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('domicilio') ring-red-500 @enderror"
                                name="domicilio" value="{{ old('domicilio') }}" required>

                            @error('domicilio')
                                <span class="text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @vite('resources/js/resources/Cargar_ciudades_departamentos.js')
@endsection
