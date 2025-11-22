<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                <h1 class="text-2xl font-bold">Fabricantes</h1>
            </div>
            <div class="p-4">
                @if ($fabricantes->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($fabricantes as $fabricante)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold">{{ $fabricante->nombre }}</h2>
                                <img src="{{ Storage::url('images/fabricantes/' . $fabricante->foto_fabr) }}" alt="Foto de {{ $fabricante->nombre }}" class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
                                <p class="mt-2"><strong>Ubicación:</strong> {{ $fabricante->ubicacion }}</p>
                                <p><strong>Descripción:</strong> {{ $fabricante->descripcion }}</p>
                                <p><strong>Dirección:</strong> {{ $fabricante->direccion }}</p>
                                <p><strong>Correo:</strong> {{ $fabricante->correo }}</p>
                                <p><strong>Teléfono:</strong> {{ $fabricante->telefono }}</p>
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('fabricantes.edit', $fabricante->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $fabricantes->links() }}
                    </div>
                @else
                    <p>No hay fabricantes disponibles.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
