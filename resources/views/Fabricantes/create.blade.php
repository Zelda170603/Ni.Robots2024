<!DOCTYPE html>
<html>
<head>
    <title>Create Fabricante</title>
    @vite('resources/css/app.css')
    <script>
        function updateMap() {
            const address = document.getElementById('ubicacion').value;
            const iframe = document.getElementById('map-iframe');
            iframe.src = `https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=${encodeURIComponent(address)}`;
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nuevo Fabricante</h1>
            </div>
            <div class="p-4">
                @if(session('success'))
                    <div class="mb-4">
                        <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">{{ session('success') }}</p>
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
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="password" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Datos del Fabricante -->
                    <h2 class="text-xl font-bold mt-8 mb-4">Datos del Fabricante</h2>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Fabricante</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="foto_fabr" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto_fabr" id="foto_fabr" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" onchange="updateMap()" required>
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="google_map_direction" class="block text-sm font-medium text-gray-700">Dirección de Google Maps</label>
                        <input type="text" name="google_map_direction" id="google_map_direction" value="{{ old('google_map_direction') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">
                            Crear Fabricante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
