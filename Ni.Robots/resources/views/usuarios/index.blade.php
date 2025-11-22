@extends('layouts.adminLY')

@section('content')
<!-- Agregar CDN de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="p-4 col-span-4">

    <!-- Header con título y botones de exportación -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Usuarios</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Administra y filtra los usuarios del sistema</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('usuarios.exportExcel', request()->all()) }}" class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
    <i class="fas fa-file-excel"></i>
    Exportar Excel
</a>
<a href="{{ route('usuarios.exportPDF', request()->all()) }}" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
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
        
        <form method="GET" action="{{ route('usuarios.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Rol -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rol</label>
                <select name="role_type" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todos los roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ request('role_type') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                <select name="estado" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todos los estados</option>
                    <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <!-- Departamento -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Departamento</label>
                <select name="departamento" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todos los departamentos</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento }}" {{ request('departamento') == $departamento ? 'selected' : '' }}>{{ $departamento }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Municipio -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Municipio</label>
                <select name="municipio" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Todos los municipios</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio }}" {{ request('municipio') == $municipio ? 'selected' : '' }}>{{ $municipio }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fechas de creación -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha creación (desde)</label>
                <input type="date" name="fecha_creacion_min" value="{{ request('fecha_creacion_min') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha creación (hasta)</label>
                <input type="date" name="fecha_creacion_max" value="{{ request('fecha_creacion_max') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
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

    <!-- Tabla de usuarios -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">ID</th>
                        <th scope="col" class="px-4 py-3 font-medium">Usuario</th>
                        <th scope="col" class="px-4 py-3 font-medium">Email</th>
                        <th scope="col" class="px-4 py-3 font-medium">Rol</th>
                        <th scope="col" class="px-4 py-3 font-medium">Estado</th>
                        <th scope="col" class="px-4 py-3 font-medium">Ubicación</th>
                        <th scope="col" class="px-4 py-3 font-medium">Fecha Registro</th>
                        <th scope="col" class="px-4 py-3 font-medium text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 overflow-hidden flex items-center justify-center">
                                    @if($user->profile_picture)
                                        <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-gray-400 text-sm"></i>
                                    @endif
                                </div>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                {{ $user->role && $user->role->role_type == 'administrador' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' : 
                                   ($user->role && $user->role->role_type == 'paciente' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                   'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300') }}">
                                {{ $user->role ? ucfirst($user->role->role_type) : 'Sin rol' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                {{ $user->estado ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                {{ $user->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-xs">
                                <div>{{ $user->municipio ?? 'N/A' }}</div>
                                <div class="text-gray-500">{{ $user->departamento ?? 'N/A' }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 p-2 rounded-full hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="#" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 p-2 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
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
            {{ $users->links() }}
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