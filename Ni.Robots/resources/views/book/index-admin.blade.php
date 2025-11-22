@extends('layouts.adminLY')

@section('content')
<div class="p-4 col-span-4">

    <!-- Header con título y botones de exportación -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Libros</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Administra y filtra el catálogo de libros</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('books.exportExcel', request()->all()) }}" 
                    class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-file-excel"></i>
                    Exportar Excel
                </a>
                <a href="{{ route('books.exportPDF', request()->all()) }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-file-pdf"></i>
                    Exportar PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-gray-50 dark:bg-gray-800 rounded-xl p-4 shadow-sm">
        <div class="flex items-center gap-2 mb-3">
            <i class="fas fa-filter text-primary-600 dark:text-primary-400"></i>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Filtros</h2>
        </div>
        
        <form method="GET" action="{{ route('books.index_admin') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Autor -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Autor</label>
                <select name="autor_id" 
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todos los autores</option>
                    @foreach($autores as $id => $nombre)
                        <option value="{{ $id }}" {{ request('autor_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Editorial -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Editorial</label>
                <select name="editorial_id" 
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todas las editoriales</option>
                    @foreach($editoriales as $id => $nombre)
                        <option value="{{ $id }}" {{ request('editorial_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                <input type="text" name="categoria" placeholder="Ej: Novela" value="{{ request('categoria') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <!-- Grupo de usuarios -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grupo de usuarios</label>
                <input type="text" name="grupo_usuarios" placeholder="Ej: Juvenil" value="{{ request('grupo_usuarios') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <!-- Fechas de publicación -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha publicación (desde)</label>
                <input type="date" name="fecha_publicacion_min" value="{{ request('fecha_publicacion_min') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha publicación (hasta)</label>
                <input type="date" name="fecha_publicacion_max" value="{{ request('fecha_publicacion_max') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <!-- Páginas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Páginas (mín)</label>
                <input type="number" name="paginas_min" placeholder="0" value="{{ request('paginas_min') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Páginas (máx)</label>
                <input type="number" name="paginas_max" placeholder="1000" value="{{ request('paginas_max') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <!-- Botón de filtro -->
            <div class="md:col-span-2 lg:col-span-4 flex justify-end pt-2">
                <button type="submit" class="flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                    <i class="fas fa-search"></i>
                    Aplicar Filtros
                </button>
            </div>
        </form>
    </div>

    <!-- Tabla de libros -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">ID</th>
                        <th scope="col" class="px-4 py-3 font-medium">Portada</th>
                        <th scope="col" class="px-4 py-3 font-medium">Título</th>
                        <th scope="col" class="px-4 py-3 font-medium">Archivo</th>
                        <th scope="col" class="px-4 py-3 font-medium">Descripción</th>
                        <th scope="col" class="px-4 py-3 font-medium">Publicación</th>
                        <th scope="col" class="px-4 py-3 font-medium">ISBN</th>
                        <th scope="col" class="px-4 py-3 font-medium">Páginas</th>
                        <th scope="col" class="px-4 py-3 font-medium text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $book->id }}</td>
<td class="px-4 py-3">
    <div class="w-16 h-20 md:w-20 md:h-24 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-600 flex items-center justify-center bg-gray-100 dark:bg-gray-600">
        @if($book->portada)
            <img src="{{ asset($book->portada) }}" 
                 alt="{{ $book->title }}" 
                 class="w-full h-full object-cover">
        @else
            <i class="fas fa-book text-gray-400 text-xl"></i>
        @endif
    </div>
</td>

                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white max-w-xs truncate">{{ $book->title }}</td>
                        <td class="px-4 py-3">
                            @if($book->file_url)
                                <a href="{{ $book->file_url }}" target="_blank" 
                                   class="text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300 flex items-center gap-1">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    {{ Str::limit($book->file_url, 20, '...') }}
                                </a>
                            @else
                                <span class="text-gray-400">No disponible</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 max-w-xs">{{ Str::limit($book->descripcion, 30, '...') }}</td>
                        <td class="px-4 py-3">{{ $book->fecha_publicacion ? \Carbon\Carbon::parse($book->fecha_publicacion)->format('d/m/Y') : 'N/A' }}</td>
                        <td class="px-4 py-3 font-mono">{{ $book->isbn ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-center">{{ $book->paginas ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('books.show', $book->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 p-2 rounded-full hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 p-2 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" 
                                            title="Eliminar" 
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            {{ $books->links() }}
        </div>
    </div>
</div>

<!-- Estilos adicionales para mejorar la paginación en modo oscuro -->
<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }
    
    .pagination li {
        margin: 0 2px;
    }
    
    .pagination li a, 
    .pagination li span {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
    }
    
    .pagination li a {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .dark .pagination li a {
        background-color: #4b5563;
        color: #e5e7eb;
        border: 1px solid #6b7280;
    }
    
    .pagination li a:hover {
        background-color: #e5e7eb;
    }
    
    .dark .pagination li a:hover {
        background-color: #6b7280;
    }
    
    .pagination li.active span {
        background-color: #0ea5e9;
        color: white;
        border: 1px solid #0ea5e9;
    }
    
    .pagination li.disabled span {
        background-color: #f9fafb;
        color: #9ca3af;
        border: 1px solid #e5e7eb;
    }
    
    .dark .pagination li.disabled span {
        background-color: #374151;
        color: #6b7280;
        border: 1px solid #4b5563;
    }
</style>
@endsection
