<!DOCTYPE html>
<html>
<head>
    <title>Create Producto</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h1 class="text-2xl font-bold">Crear Nuevo Producto</h1>
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
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="nombre_prod" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre_prod" id="nombre_prod" value="{{ old('nombre_prod') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="foto_prod" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto_prod" id="foto_prod" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="number" name="precio" id="precio" value="{{ old('precio') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" name="color" id="color" value="{{ old('color') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="nivel_afectacion" class="block text-sm font-medium text-gray-700">Nivel de Afectación</label>
                        <input type="text" name="nivel_afectacion" id="nivel_afectacion" value="{{ old('nivel_afectacion') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="grupo_usuarios" class="block text-sm font-medium text-gray-700">Grupo de Usuarios</label>
                        <input type="text" name="grupo_usuarios" id="grupo_usuarios" value="{{ old('grupo_usuarios') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="existencias" class="block text-sm font-medium text-gray-700">Existencias</label>
                        <input type="number" name="existencias" id="existencias" value="{{ old('existencias') }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="id_tipo_producto" class="block text-sm font-medium text-gray-700">Tipo de Producto</label>
                        <select name="id_tipo_producto" id="id_tipo_producto" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                            @foreach($tipo_productos as $tipo_producto)
                                <option value="{{ $tipo_producto->id }}" {{ old('id_tipo_producto') == $tipo_producto->id ? 'selected' : '' }}>{{ $tipo_producto->nombre_tipo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="id_fabricante" class="block text-sm font-medium text-gray-700">Fabricante</label>
                        <select name="id_fabricante" id="id_fabricante" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                            @foreach($fabricantes as $fabricante)
                                <option value="{{ $fabricante->id }}" {{ old('id_fabricante') == $fabricante->id ? 'selected' : '' }}>{{ $fabricante->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">
                            Crear Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
