<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h1 class="text-2xl font-bold">Productos</h1>
            </div>
            <div class="p-4">
                @if ($productos->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($productos as $producto)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-bold">{{ $producto->nombre_prod }}</h2>
                                <img src="{{ Storage::url('images/productos/' . $producto->foto_prod) }}" alt="Foto de {{ $producto->nombre_prod }}" class="w-full h-auto object-cover rounded-lg shadow-md mt-2">
                                <p class="mt-2"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                <p><strong>Precio:</strong> {{ $producto->precio }}</p>
                                <p><strong>Color:</strong> {{ $producto->color }}</p>
                                <p><strong>Nivel de Amputación:</strong> {{ $producto->nivel_amputacion }}</p>
                                <p><strong>Grupo de Usuarios:</strong> {{ $producto->grupo_usuarios }}</p>
                                <p><strong>Existencias:</strong> {{ $producto->existencias }}</p>
                                <p><strong>Tipo de Producto:</strong> {{ $producto->tipoProducto->nombre }}</p>
                                <p><strong>Fabricante:</strong> {{ $producto->fabricante->nombre }}</p>
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Editar
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
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
                        {{ $productos->links() }}
                    </div>
                @else
                    <p>No hay productos disponibles.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
