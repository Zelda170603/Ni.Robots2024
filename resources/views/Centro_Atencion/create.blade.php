@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <div class="text-slate-900 dark:text-white">
            <h1 class="text-2xl font-bold">Crear Nuevo Centro de atencion</h1>
        </div>
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('CentroAtencion.store') }}" class="pt-4" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="shrink-0 items-center mb-5 justify-center w-full">
                    <label for="foto_centro"
                        class="upload-container flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 mb-2">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                    upload</span>
                                or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                800x400px)</p>
                        </div>
                        <input id="foto_centro" name="foto_centro[]" type="file" class="hidden"
                            onchange="handleFileUpload(this)" />
                    </label>
                    <div id="thumbnails" class="flex justify-between gap-2 mb-4">
                        <label for="foto_centro_2"
                            class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                            </div>
                            <input id="foto_centro_2" name="foto_centro[]" type="file" class="hidden"
                                onchange="handleFileUpload(this)" />
                        </label>
                        <label for="foto_centro_3"
                            class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                            </div>
                            <input id="foto_centro_3" name="foto_centro[]" type="file" class="hidden"
                                onchange="handleFileUpload(this)" />
                        </label>
                        <label for="foto_centro_4"
                            class="upload-container flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Fotos Secundarias</p>
                            </div>
                            <input id="foto_prod_4" name="foto_centro[]" type="file" class="hidden"
                                onchange="handleFileUpload(this)" />
                        </label>
                    </div>
                </div>
                <div>
                    <div class="mb-5">
                        <label for="nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div class="mb-5">
                        <label for="correo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                        <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-5">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea id="descripcion" name="descripcion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('descripcion') }}</textarea>
                    </div>
                </div>
                <!-- Foto principal -->
                <div class="mb-5">
                    <label for="telefono"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="direccion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="mb-5">
                    <label for="departamento"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                    <select id="departamento" name="departamento" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona un departamento</option>
                        @foreach ($cities as $id => $nombre)
                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="municipio"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipio</label>
                    <select id="municipio" name="municipio" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona un municipio</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="google_map_direction"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Haz
                        click en la ubicacion de tu centro de atecion en el mapa</label>

                    <div id="map" class="w-full h-72"></div>
                    <input type="hidden" id="google_map_direction" name="google_map_direction"
                        value="{{ old('google_map_direction') }}" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div class="mb-5">
                    <label for="tipo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                    <select id="tipo" name="tipo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Minsa" {{ old('tipo') == 'Minsa' ? 'selected' : '' }}>Minsa</option>
                        <option value="Psicologia" {{ old('tipo') == 'Psicologia' ? 'selected' : '' }}>Psicologia
                        </option>
                        <option value="Terapia" {{ old('tipo') == 'Terapia' ? 'selected' : '' }}>Terapia</option>
                        <option value="Otros" {{ old('tipo') == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Guardar</button>
            </div>
        </form>
    </div>

    <script>
        function handleFileUpload(input) {
            if (input.files && input.files.length > 0) {
                // Agregar la clase verde al contenedor del input
                const container = input.closest('.upload-container');
                // Modo claro
                container.classList.add('bg-green-100', 'border-green-500');
                container.classList.remove('bg-gray-50', 'border-gray-300');
                // Modo oscuro
                container.classList.add('dark:bg-green-900', 'dark:border-green-500');
                container.classList.remove('dark:bg-gray-700', 'dark:border-gray-600');
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YZ_TU27pADC0ThLH7U5QvSgG42fsuv8&callback=initMap" async
        defer></script>
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
@endsection
