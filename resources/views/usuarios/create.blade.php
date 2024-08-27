<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nuevo Usuario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Administracion.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="rounded-lg overflow-hidden">
            <div class="text-slate-900 dark:text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nuevo Usuario</h1>
            </div>
            <div class="p-4">
                @if (session('success'))
                    <div class="mb-4">
                        <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div class="flex items-center">
                            <label for="name" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Name') }}</label>
                            <div class="w-2/3">
                                <input id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Email Field -->
                        <div class="flex items-center">
                            <label for="email" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Email Address') }}</label>
                            <div class="w-2/3">
                                <input id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Password Field -->
                        <div class="flex items-center">
                            <label for="password" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Password') }}</label>
                            <div class="w-2/3">
                                <input id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-500 @enderror" name="password" required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Confirm Password Field -->
                        <div class="flex items-center">
                            <label for="password-confirm" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                            <div class="w-2/3">
                                <input id="password-confirm" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="password_confirmation" required>
                            </div>
                        </div>
                
                        <!-- Profile Picture Field -->
                        <div class="flex items-center">
                            <label for="profile_picture" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Profile Picture') }}</label>
                            <div class="w-2/3">
                                <input id="profile_picture" type="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('profile_picture') border-red-500 @enderror" name="profile_picture" accept="image/*">
                                @error('profile_picture')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Departamento Field -->
                        <div class="flex items-center">
                            <label for="departamento" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Departamento') }}</label>
                            <div class="w-2/3">
                                <select id="departamento" name="departamento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('departamento') border-red-500 @enderror" required>
                                    <option value="">Selecciona un departamento</option>
                                    <!-- Populate with departamentos -->
                                </select>
                                @error('departamento')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Municipio Field -->
                        <div class="flex items-center">
                            <label for="municipio" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Municipio') }}</label>
                            <div class="w-2/3">
                                <select id="municipio" name="municipio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('municipio') border-red-500 @enderror" required>
                                    <option value="">Selecciona un municipio</option>
                                    <!-- Populate with municipios -->
                                </select>
                                @error('municipio')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Domicilio Field -->
                        <div class="flex items-center">
                            <label for="domicilio" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Domicilio') }}</label>
                            <div class="w-2/3">
                                <input id="domicilio" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('domicilio') border-red-500 @enderror" name="domicilio" value="{{ old('domicilio') }}" required>
                                @error('domicilio')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Role Selection Dropdown -->
                        <div class="flex items-center">
                            <label for="role" class="w-1/3 text-right pr-4 font-medium text-gray-700">{{ __('Role') }}</label>
                            <div class="w-2/3">
                                <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('role') border-red-500 @enderror" required>
                                    <option value="">Select Role</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="user">User</option>
                                    <!-- Add more roles as needed -->
                                </select>
                                @error('role')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>              
            </div>
        </div>
    </main>
    @vite('resources/js/resources/Cargar_ciudades_departamentos.js')
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
</body>

</html>
