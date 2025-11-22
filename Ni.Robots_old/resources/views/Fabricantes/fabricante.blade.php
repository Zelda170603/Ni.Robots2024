<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Fabricante</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                <h1 class="text-2xl font-bold">{{ $fabricante->nombre }}</h1>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <p class="font-semibold text-lg">Foto:</p>
                    <img src="{{ Storage::url('public/images/fabricantes/' . $fabricante->foto_fabr) }}" alt="Foto de {{ $fabricante->nombre }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                </div>
                           
                <div class="mb-4">
                    <p class="font-semibold text-lg">Ubicación:</p>
                    <p>{{ $fabricante->ubicacion }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-lg">Descripción:</p>
                    <p>{{ $fabricante->descripcion }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-lg">Dirección:</p>
                    <p>{{ $fabricante->direccion }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-lg">Correo:</p>
                    <p>{{ $fabricante->correo }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-lg">Teléfono:</p>
                    <p>{{ $fabricante->telefono }}</p>
                </div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('fabricantes.edit', ['fabricante' => $fabricante->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                    
                    <form action="{{ route('fabricantes.destroy', $fabricante->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

