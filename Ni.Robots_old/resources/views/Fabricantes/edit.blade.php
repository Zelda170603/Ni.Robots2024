<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fabricante</title>
    @vite('resources/css/app.css')    
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                <h1 class="text-2xl font-bold">Editar Fabricante</h1>
            </div>
            <div class="p-4">
                <form action="{{ route('fabricantes.update', $fabricante->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ $fabricante->nombre }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="foto_fabr" class="block text-sm font-medium text-gray-700">Nueva Foto</label>
                        <input type="file" name="foto_fabr" id="foto_fabr" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="current_foto_fabr" class="block text-sm font-medium text-gray-700">Foto Actual</label>
                        <input type="hidden" name="current_foto_fabr" value="{{ $fabricante->foto_fabr }}">
                        <img src="{{ Storage::url('public/images/fabricantes/' . $fabricante->foto_fabr) }}" alt="Foto de {{ $fabricante->nombre }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" value="{{ $fabricante->ubicacion }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{ $fabricante->direccion }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">{{ $fabricante->descripcion }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="email" name="correo" id="correo" value="{{ $fabricante->correo }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ $fabricante->telefono }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-700">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
