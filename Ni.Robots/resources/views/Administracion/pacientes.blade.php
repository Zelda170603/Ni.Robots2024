@extends('layouts.adminLY')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="p-6 max-w-5xl mx-auto">

    <!-- Título -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Mis Pacientes</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Lista de pacientes asociados a tus citas médicas.</p>
    </div>

    <!-- Tabla de pacientes -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-xs font-semibold text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3">Foto</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Edad</th>
                        <th class="px-6 py-3">Teléfono</th>
                        <th class="px-6 py-3">Condición</th>
                        <th class="px-6 py-3">Correo</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    @if($paciente->role->user->profile_picture)
                                        <img src="{{ asset('storage/' . $paciente->role->user->profile_picture) }}" alt="{{ $paciente->role->user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-gray-400"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $paciente->role->user->name ?? 'Sin nombre' }}
                            </td>
                            <td class="px-6 py-3">{{ $paciente->edad ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $paciente->telefono ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $paciente->condicion ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $paciente->role->user->email ?? 'N/A' }}</td>
                            <td class="px-6 py-3">
                                <div class="flex justify-center gap-2">
                                    <!-- Botón Ver Expediente -->
                                    <a href="{{ route('expedientes.show', $paciente->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" 
                                       title="Ver Expediente">
                                        <i class="fas fa-file-medical"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-info-circle mr-2"></i>No tienes pacientes registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection