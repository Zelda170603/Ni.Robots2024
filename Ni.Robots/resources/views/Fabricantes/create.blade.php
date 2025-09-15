<!DOCTYPE html>
<html>

<head>
    <title>Create Fabricante</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nuevo Fabricante</h1>
            </div>
            <div class="p-4">
                @if (session('success'))
                    <div class="mb-4">
                        <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                            {{ session('success') }}</p>
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

                <form action="{{ route('fabricantes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Datos del Usuario -->
                    <h2 class="text-xl font-bold mb-4">Datos del Usuario</h2>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                            Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Datos del Fabricante -->
                    <h2 class="text-xl font-bold mt-8 mb-4">Datos del Fabricante</h2>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del
                            Fabricante</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="foto_fabr" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto_fabr" id="foto_fabr"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" onchange="updateMap()"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"
                            required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="google_map_direction"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Haz
                            click en la ubicacion de tu centro de atecion en el mapa</label>

                        <div id="map" class="w-full h-72"></div>
                        <input type="hidden" id="google_map_direction" name="google_map_direction"
                            value="{{ old('google_map_direction') }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">
                            Crear Fabricante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YZ_TU27pADC0ThLH7U5QvSgG42fsuv8&callback=initMap" async
        defer></script>
</body>

</html>
