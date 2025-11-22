@extends('layouts.pdf')

@section('title', 'Reporte Completo del Dashboard')
@section('subtitle', 'Resumen Ejecutivo del Sistema')
@section('description', 'Exportación completa de todas las métricas y datos del dashboard')

@section('total_count', $totalUsers)
@section('filters_applied', 'Todos los datos del sistema')

@section('additional_stats')
<div class="stat-item">
    <span class="stat-number">{{ $totalProducts }}</span>
    <span class="stat-label">Productos</span>
</div>
<div class="stat-item">
    <span class="stat-number">${{ number_format($totalSales, 0) }}</span>
    <span class="stat-label">Ventas</span>
</div>
<div class="stat-item">
    <span class="stat-number">{{ $pendingAppointments }}</span>
    <span class="stat-label">Citas</span>
</div>
@endsection

@section('content')
<!-- Resumen Ejecutivo -->
<div class="summary">
    <div class="summary-header">
        <h3>📊 Resumen Ejecutivo del Sistema</h3>
        <div class="subtitle">Estado actual de todas las áreas de gestión</div>
    </div>

    <div class="summary-grid">
        <div class="summary-item">
            <div class="summary-number">{{ $totalUsers }}</div>
            <div class="summary-label">👥 Usuarios Totales</div>
            <div class="summary-detail" style="font-size: 9px; color: #718096; margin-top: 4px;">
                {{ $activeUsers }} activos
            </div>
        </div>

        <div class="summary-item">
            <div class="summary-number">{{ $totalProducts }}</div>
            <div class="summary-label">📦 Productos</div>
            <div class="summary-detail" style="font-size: 9px; color: #718096; margin-top: 4px;">
                {{ $lowStock }} bajo stock
            </div>
        </div>

        <div class="summary-item">
            <div class="summary-number">${{ number_format($totalSales, 0) }}</div>
            <div class="summary-label">💰 Ventas Totales</div>
            <div class="summary-detail" style="font-size: 9px; color: #718096; margin-top: 4px;">
                ${{ number_format($salesThisMonth, 0) }} este mes
            </div>
        </div>

        <div class="summary-item">
            <div class="summary-number">{{ $pendingAppointments }}</div>
            <div class="summary-label">⏳ Citas Pendientes</div>
            <div class="summary-detail" style="font-size: 9px; color: #718096; margin-top: 4px;">
                {{ $completedAppointments }} completadas
            </div>
        </div>
    </div>
</div>

<!-- Métricas Detalladas -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th colspan="4" style="text-align: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    📈 MÉTRICAS DETALLADAS
                </th>
            </tr>
            <tr>
                <th style="width: 30%;">Categoría</th>
                <th style="width: 30%;">Métrica</th>
                <th style="width: 20%;">Valor</th>
                <th style="width: 20%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            <!-- Usuarios -->
            <tr style="background: #f8fafc;">
                <td colspan="4" style="font-weight: bold; color: #2d3748;">👥 USUARIOS</td>
            </tr>
            <tr>
                <td>Registro</td>
                <td>Total de Usuarios</td>
                <td class="text-center">{{ $totalUsers }}</td>
                <td class="text-center"><span class="badge badge-primary">Total</span></td>
            </tr>
            <tr>
                <td>Actividad</td>
                <td>Usuarios Activos (7 días)</td>
                <td class="text-center">{{ $activeUsers }}</td>
                <td class="text-center"><span class="badge badge-success">Activos</span></td>
            </tr>

            <!-- Productos -->
            <tr style="background: #f8fafc;">
                <td colspan="4" style="font-weight: bold; color: #2d3748;">📦 INVENTARIO</td>
            </tr>
            <tr>
                <td>Stock</td>
                <td>Total de Productos</td>
                <td class="text-center">{{ $totalProducts }}</td>
                <td class="text-center"><span class="badge badge-primary">Inventario</span></td>
            </tr>
            <tr>
                <td>Alertas</td>
                <td>Productos con Bajo Stock</td>
                <td class="text-center">{{ $lowStock }}</td>
                <td class="text-center"><span class="badge badge-warning">Alerta</span></td>
            </tr>

            <!-- Ventas -->
            <tr style="background: #f8fafc;">
                <td colspan="4" style="font-weight: bold; color: #2d3748;">💰 VENTAS</td>
            </tr>
            <tr>
                <td>Ingresos</td>
                <td>Ventas Totales</td>
                <td class="text-center">${{ number_format($totalSales, 2) }}</td>
                <td class="text-center"><span class="badge badge-success">Total</span></td>
            </tr>
            <tr>
                <td>Mensual</td>
                <td>Ventas Este Mes</td>
                <td class="text-center">${{ number_format($salesThisMonth, 2) }}</td>
                <td class="text-center"><span class="badge badge-info">Actual</span></td>
            </tr>
            <tr>
                <td>Promedio</td>
                <td>Ticket Promedio</td>
                <td class="text-center">${{ number_format($avgSales, 2) }}</td>
                <td class="text-center"><span class="badge badge-secondary">Promedio</span></td>
            </tr>

            <!-- Citas -->
            <tr style="background: #f8fafc;">
                <td colspan="4" style="font-weight: bold; color: #2d3748;">⏳ CITAS MÉDICAS</td>
            </tr>
            <tr>
                <td>Pendientes</td>
                <td>Citas por Atender</td>
                <td class="text-center">{{ $pendingAppointments }}</td>
                <td class="text-center"><span class="badge badge-warning">Pendiente</span></td>
            </tr>
            <tr>
                <td>Completadas</td>
                <td>Citas Atendidas</td>
                <td class="text-center">{{ $completedAppointments }}</td>
                <td class="text-center"><span class="badge badge-success">Completado</span></td>
            </tr>
            <tr>
                <td>Canceladas</td>
                <td>Citas Canceladas</td>
                <td class="text-center">{{ $cancelledAppointments }}</td>
                <td class="text-center"><span class="badge badge-danger">Cancelado</span></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Top Productos -->
@if($topProducts->count() > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th colspan="4" style="text-align: center; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);">
                    🏆 TOP 10 PRODUCTOS EN STOCK
                </th>
            </tr>
            <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 60%;">Producto</th>
                <th style="width: 15%;">Existencias</th>
                <th style="width: 15%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $index => $product)
            <tr>
                <td class="text-center font-bold">{{ $index + 1 }}</td>
                <td>{{ $product->nombre_prod }}</td>
                <td class="text-center">{{ $product->existencias }} unidades</td>
                <td class="text-center">
                    @if($product->existencias >= 50)
                        <span class="badge badge-success">Óptimo</span>
                    @elseif($product->existencias >= 20)
                        <span class="badge badge-info">Normal</span>
                    @elseif($product->existencias >= 10)
                        <span class="badge badge-warning">Bajo</span>
                    @else
                        <span class="badge badge-danger">Crítico</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<!-- Ventas por Fabricante -->
@if(!empty($salesByManufacturer))
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th colspan="3" style="text-align: center; background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);">
                    🏭 DISTRIBUCIÓN DE VENTAS POR FABRICANTE
                </th>
            </tr>
            <tr>
                <th style="width: 60%;">Fabricante</th>
                <th style="width: 20%;">Ventas Totales</th>
                <th style="width: 20%;">Participación</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalVentas = array_sum($salesByManufacturer);
            @endphp
            @foreach($salesByManufacturer as $fabricante => $ventas)
            <tr>
                <td>{{ $fabricante }}</td>
                <td class="text-right">${{ number_format($ventas, 2) }}</td>
                <td class="text-center">
                    @if($totalVentas > 0)
                        {{ number_format(($ventas / $totalVentas) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<!-- Resumen Final -->
<div style="margin-top: 25px; padding: 20px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #667eea;">
    <h4 style="font-size: 12px; margin-bottom: 12px; color: #2d3748;">📋 Resumen de Exportación:</h4>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; font-size: 10px; color: #4a5568;">
        <div>
            <strong>📅 Período:</strong> Completo (Todos los datos históricos)<br>
            <strong>👥 Usuarios incluidos:</strong> {{ $totalUsers }} registros<br>
            <strong>📦 Productos incluidos:</strong> {{ $totalProducts }} items
        </div>
        <div>
            <strong>💰 Ventas incluidas:</strong> ${{ number_format($totalSales, 2) }}<br>
            <strong>⏳ Citas incluidas:</strong> {{ $pendingAppointments + $completedAppointments + $cancelledAppointments }}<br>
            <strong>🕒 Generado:</strong> {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</div>
@endsection