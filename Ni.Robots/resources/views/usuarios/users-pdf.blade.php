@extends('layouts.pdf')

@section('title', 'Reporte de Usuarios')
@section('subtitle', 'Listado General de Usuarios del Sistema')
@section('description', 'Información detallada de todos los usuarios registrados con sus roles, estados y ubicaciones')

@section('total_count', $stats['total'])
@section('filters_applied', request()->anyFilled(['role_type', 'estado', 'departamento', 'municipio']) ? 'Filtros aplicados' : 'Ninguno')

@section('additional_stats')
<div class="stat-item">
    <span class="stat-number">{{ $stats['activos'] }}</span>
    <span class="stat-label">Activos</span>
</div>
<div class="stat-item">
    <span class="stat-number">{{ $stats['administradores'] }}</span>
    <span class="stat-label">Admins</span>
</div>
@endsection

@section('content')
<!-- Alerta informativa -->
<div class="alert alert-info">
    <strong>📊 Información del Reporte:</strong> Este documento contiene información de <strong>{{ $stats['total'] }}</strong> usuarios registrados en el sistema.
    Los datos incluyen roles, estados de cuenta y ubicaciones geográficas.
</div>

@if($stats['total'] > 0)
    <!-- Tabla principal de usuarios -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 20%;">Usuario</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 12%;">Rol</th>
                    <th style="width: 8%;">Estado</th>
                    <th style="width: 20%;">Ubicación</th>
                    <th style="width: 10%;">Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="text-center font-bold">#{{ $user->id }}</td>
                    <td>
                        <div style="font-weight: bold; margin-bottom: 2px;">{{ $user->name }}</div>
                        @if($user->phone)
                            <div style="font-size: 9px; color: #718096;">📞 {{ $user->phone }}</div>
                        @endif
                    </td>
                    <td style="font-size: 9px;">{{ $user->email }}</td>
                    <td>
                        @if($user->role)
                            @switch($user->role->role_type)
                                @case('administrador')
                                    <span class="badge badge-primary">👤 Admin</span>
                                    @break
                                @case('paciente')
                                    <span class="badge badge-info">🏥 Paciente</span>
                                    @break
                                @case('doctor')
                                    <span class="badge badge-success">👨‍⚕️ Médico</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ ucfirst($user->role->role_type) }}</span>
                            @endswitch
                        @else
                            <span class="badge badge-warning">⚠️ Sin Rol</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($user->estado)
                            <span class="badge badge-success">✅ Activo</span>
                        @else
                            <span class="badge badge-danger">❌ Inactivo</span>
                        @endif
                    </td>
                    <td style="font-size: 9px;">
                        <div><strong>{{ $user->municipio ?? 'N/A' }}</strong></div>
                        <div style="color: #718096;">{{ $user->departamento ?? 'N/A' }}</div>
                    </td>
                    <td class="text-center" style="font-size: 9px;">
                        <div>{{ $user->created_at->format('d/m/Y') }}</div>
                        <div style="color: #718096;">{{ $user->created_at->format('H:i') }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Resumen estadístico -->
    <div class="summary">
        <div class="summary-header">
            <h3>📈 Resumen Estadístico de Usuarios</h3>
            <div class="subtitle">Distribución por categorías principales</div>
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $stats['total'] }}</div>
                <div class="summary-label">👥 Total Usuarios</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #48bb78;">{{ $stats['activos'] }}</div>
                <div class="summary-label">✅ Usuarios Activos</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #f56565;">{{ $stats['inactivos'] }}</div>
                <div class="summary-label">❌ Usuarios Inactivos</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #667eea;">{{ $stats['administradores'] }}</div>
                <div class="summary-label">👤 Administradores</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #4299e1;">{{ $stats['pacientes'] }}</div>
                <div class="summary-label">🏥 Pacientes</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #48bb78;">{{ $stats['medicos'] }}</div>
                <div class="summary-label">👨‍⚕️ Médicos</div>
            </div>
        </div>
    </div>

    <!-- Análisis adicional por ubicación -->
    @if($stats['departamentos_count'] > 0)
    <div class="alert alert-success">
        <strong>🌍 Distribución Geográfica:</strong>
        Los usuarios están distribuidos en {{ $stats['departamentos_count'] }} departamentos diferentes.
        El departamento con mayor cantidad de usuarios es:
        <strong>{{ $stats['departamento_mas_comun'] }}</strong>
    </div>
    @endif

@else
    <!-- Estado vacío -->
    <div class="empty-state">
        <h3>😔 No se encontraron usuarios</h3>
        <p>No existen usuarios que coincidan con los filtros aplicados. Intenta ajustar los criterios de búsqueda.</p>
    </div>
@endif

<!-- Notas adicionales -->
<div style="margin-top: 20px; padding: 15px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #667eea;">
    <h4 style="font-size: 12px; margin-bottom: 8px; color: #2d3748;">📝 Notas del Reporte:</h4>
    <ul style="font-size: 10px; color: #4a5568; margin-left: 15px;">
        <li>Los usuarios inactivos no pueden acceder al sistema hasta ser reactivados</li>
        <li>Los usuarios sin rol asignado tienen acceso limitado al sistema</li>
        <li>La información de ubicación es opcional y puede no estar disponible para todos los usuarios</li>
        <li>Este reporte se actualiza en tiempo real basado en la información actual de la base de datos</li>
    </ul>
</div>
@endsection