@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Información básica del usuario -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email"  name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="profile_picture" class="block text-sm font-medium text-gray-700">Foto de perfil</label>
                <input type="file" name="profile_picture" id="profile_picture"
                    class="mt-1 block w-full text-sm text-gray-500">
            </div>

            <div>
                <label for="domicilio" class="block text-sm font-medium text-gray-700">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" value="{{ old('domicilio', $user->domicilio) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento</label>
                <select id="departamento" name="departamento" value="{{ old('departamento', $user->departamento) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm  @error('departamento') ring-red-500 @enderror"
                    required>
                    <option value="">Selecciona un departamento</option>
                    <!-- Opciones -->
                </select>

            </div>

            <div>
                <label for="municipio" class="block text-sm font-medium text-gray-700">Municipio</label>
                <select id="municipio" name="municipio" value="{{ old('municipio', $user->municipio) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('municipio') ring-red-500 @enderror"
                    required>
                    <option value="">Selecciona un municipio</option>
                    <!-- Opciones -->
                </select>
            </div>
        </div>

        <!-- Campos adicionales si el usuario es paciente -->
        @if ($user->esPaciente())
            <h3 class="text-lg mt-6 font-medium leading-6 text-gray-900">Información del Paciente</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="biografia" class="block text-sm font-medium text-gray-700">Biografía</label>
                    <textarea name="biografia" id="biografia" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('biografia', $user->paciente->biografia) }}</textarea>
                </div>

                <div>
                    <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                    <input type="number" name="edad" id="edad" value="{{ old('edad', $user->paciente->edad) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="peso" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                    <input type="number" name="peso" id="peso" value="{{ old('peso', $user->paciente->peso) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="altura" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                    <input type="number" name="altura" id="altura"
                        value="{{ old('altura', $user->paciente->altura) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                    <select name="genero" id="genero"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Masculino"
                            {{ old('genero', $user->paciente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="Femenino"
                            {{ old('genero', $user->paciente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ old('genero', $user->paciente->genero) == 'Otro' ? 'selected' : '' }}>
                            Otro</option>
                    </select>
                </div>

                <div>
                    <label for="condicion" class="block text-sm font-medium text-gray-700">Condición médica</label>
                    <input type="text" name="condicion" id="condicion"
                        value="{{ old('condicion', $user->paciente->condicion) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="tipo_afectacion" class="block text-sm font-medium text-gray-700">Tipo de afectación</label>
                    <select id="tipo_afectacion" name="tipo_afectacion"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('municipio') ring-red-500 @enderror"
                            required>
                            <option value="">selecciona tu tipo de afectacion</option>
        
                            <!-- Opciones -->
                    </select>
                    
                </div>

                <div>
                    <label for="nivel_afectacion" class="block text-sm font-medium text-gray-700">Nivel de
                        afectación</label>
                        <select id="nivel_afectacion" name="nivel_afectacion"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('municipio') ring-red-500 @enderror"
                        required>
                        <option value="">selecciona tu nivel de afectacion</option>
                        <!-- Opciones -->
                    </select>
                </div>
            </div>
        @endif

        <!-- Botón para enviar el formulario -->
        <div class="mt-6">
            <button type="submit"
                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar cambios
            </button>
        </div>
    </form>
    @vite('resources/js/resources/Cargas_Tipos_niveles_Afectacion.js')
    @vite('resources/js/resources/Cargar_ciudades_departamentos.js')
@endsection
