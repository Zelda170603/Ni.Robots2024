{{-- Este archivo demuestra cómo usar el layout mejorado para el reporte de libros --}}
@extends('layouts.pdf')

@section('title', 'Catálogo de Libros')
@section('subtitle', 'Inventario Completo de Biblioteca Digital')
@section('description', 'Listado detallado de todos los libros disponibles con información de autores, editoriales y categorías')
@section('company', 'BiblioTech - Sistema de Gestión Bibliotecaria')

@section('total_count', $books->count())
@section('filters_applied', request('categoria') || request('autor') ? 'Por categoría y/o autor' : 'Ninguno')

@section('additional_stats')
<div class="stat-item">
    <span class="stat-number">{{ $books->whereNotNull('autor_id')->count() }}</span>
    <span class="stat-label">Con Autor</span>
</div>
<div class="stat-item">
    <span class="stat-number">{{ $books->whereNotNull('file_url')->count() }}</span>
    <span class="stat-label">PDF Disponible</span>
</div>
@endsection

@section('content')
<!-- Información del catálogo -->
<div class="alert alert-info">
    <strong>📚 Información del Catálogo:</strong> Este documento contiene <strong>{{ $books->count() }}</strong> libros registrados en nuestra biblioteca digital.
    Incluye información completa de autores, editoriales, categorías y disponibilidad de archivos digitales.
</div>

@if($books->count() > 0)
    <!-- Estadísticas rápidas por categoría -->
    @php
        $categorias = $books->groupBy('categoria')->map->count()->sortDesc();
        $topCategoria = $categorias->keys()->first();
    @endphp

    @if($categorias->count() > 1)
    <div class="alert alert-success">
        <strong>📊 Categoría Principal:</strong> <strong>{{ $topCategoria }}</strong> con {{ $categorias->first() }} libros ({{ round(($categorias->first() / $books->count()) * 100, 1) }}% del catálogo)
    </div>
    @endif

    <!-- Tabla principal de libros -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">ID</th>
                    <th style="width: 25%;">Título</th>
                    <th style="width: 15%;">Autor</th>
                    <th style="width: 12%;">Editorial</th>
                    <th style="width: 12%;">Categoría</th>
                    <th style="width: 10%;">Grupo</th>
                    <th style="width: 8%;">Fecha</th>
                    <th style="width: 6%;">Páginas</th>
                    <th style="width: 8%;">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="text-center font-bold">#{{ $book->id }}</td>
                    <td>
                        <div style="font-weight: bold; margin-bottom: 2px; font-size: 10px;">{{ Str::limit($book->title, 40) }}</div>
                        @if($book->isbn)
                            <div style="font-size: 8px; color: #718096;">ISBN: {{ $book->isbn }}</div>
                        @endif
                    </td>
                    <td style="font-size: 9px;">
                        @if($book->autor)
                            <span class="badge badge-secondary">👤 {{ $book->autor->nombre }}</span>
                        @else
                            <span style="color: #718096; font-style: italic;">Sin autor</span>
                        @endif
                    </td>
                    <td style="font-size: 9px;">
                        @if($book->editorial)
                            <span class="badge badge-info">🏢 {{ Str::limit($book->editorial->nombre, 15) }}</span>
                        @else
                            <span style="color: #718096; font-style: italic;">Sin editorial</span>
                        @endif
                    </td>
                    <td>
                        @switch($book->categoria)
                            @case('Ficción')
                                <span class="badge badge-primary">📖 Ficción</span>
                                @break
                            @case('Ciencia')
                                <span class="badge badge-success">🔬 Ciencia</span>
                                @break
                            @case('Historia')
                                <span class="badge badge-warning">📜 Historia</span>
                                @break
                            @case('Biografía')
                                <span class="badge badge-info">👤 Biografía</span>
                                @break
                            @default
                                <span class="badge badge-secondary">{{ $book->categoria }}</span>
                        @endswitch
                    </td>
                    <td class="text-center" style="font-size: 9px;">
                        @switch($book->grupo_usuarios)
                            @case('Público')
                                <span class="badge badge-success">🌍 Público</span>
                                @break
                            @case('Estudiantes')
                                <span class="badge badge-primary">🎓 Estudiantes</span>
                                @break
                            @case('Profesores')
                                <span class="badge badge-warning">👨‍🏫 Profesores</span>
                                @break
                            @default
                                <span class="badge badge-secondary">{{ $book->grupo_usuarios }}</span>
                        @endswitch
                    </td>
                    <td class="text-center" style="font-size: 9px;">
                        @if($book->fecha_publicacion)
                            {{ \Carbon\Carbon::parse($book->fecha_publicacion)->format('Y') }}
                        @else
                            <span style="color: #718096;">N/A</span>
                        @endif
                    </td>
                    <td class="text-center" style="font-size: 9px;">
                        @if($book->paginas)
                            <strong>{{ number_format($book->paginas) }}</strong>
                        @else
                            <span style="color: #718096;">N/A</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($book->file_url)
                            <span class="badge badge-success">📄 PDF</span>
                        @else
                            <span class="badge badge-danger">❌ Sin PDF</span>
                        @endif
                        @if($book->portada)
                            <br><span class="badge badge-info" style="margin-top: 2px;">🖼️ Portada</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Resumen estadístico del catálogo -->
    <div class="summary">
        <div class="summary-header">
            <h3>📊 Análisis del Catálogo Bibliotecario</h3>
            <div class="subtitle">Estadísticas generales y distribución de contenido</div>
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $books->count() }}</div>
                <div class="summary-label">📚 Total Libros</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #48bb78;">{{ $books->whereNotNull('file_url')->count() }}</div>
                <div class="summary-label">📄 PDFs Disponibles</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #4299e1;">{{ $books->whereNotNull('portada')->count() }}</div>
                <div class="summary-label">🖼️ Con Portada</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #667eea;">{{ $books->whereNotNull('autor_id')->count() }}</div>
                <div class="summary-label">👤 Con Autor</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #ed8936;">{{ $books->groupBy('categoria')->count() }}</div>
                <div class="summary-label">🏷️ Categorías</div>
            </div>

            <div class="summary-item">
                <div class="summary-number" style="color: #9f7aea;">{{ $books->whereNotNull('paginas')->avg('paginas') ? round($books->whereNotNull('paginas')->avg('paginas')) : 0 }}</div>
                <div class="summary-label">📖 Páginas Promedio</div>
            </div>
        </div>
    </div>

    <!-- Análisis por categorías -->
    @if($categorias->count() > 0)
    <div style="background: white; border-radius: 12px; padding: 20px; margin: 20px 0; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h4 style="font-size: 14px; margin-bottom: 15px; color: #2d3748; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
            📊 Distribución por Categorías
        </h4>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            @foreach($categorias->take(6) as $categoria => $cantidad)
            <div style="background: #f8fafc; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0; flex: 1; min-width: 120px; text-align: center;">
                <div style="font-weight: bold; font-size: 16px; color: #667eea;">{{ $cantidad }}</div>
                <div style="font-size: 9px; color: #718096; text-transform: uppercase; letter-spacing: 0.5px;">{{ $categoria }}</div>
                <div style="font-size: 8px; color: #a0aec0;">{{ round(($cantidad / $books->count()) * 100, 1) }}%</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Información de acceso por grupos -->
    @php
        $gruposDistribucion = $books->groupBy('grupo_usuarios')->map->count();
    @endphp

    @if($gruposDistribucion->count() > 0)
    <div class="alert alert-warning">
        <strong>👥 Acceso por Grupos:</strong>
        Público: {{ $gruposDistribucion->get('Público', 0) }} libros,
        Estudiantes: {{ $gruposDistribucion->get('Estudiantes', 0) }} libros,
        Profesores: {{ $gruposDistribucion->get('Profesores', 0) }} libros
    </div>
    @endif

@else
    <!-- Estado vacío -->
    <div class="empty-state">
        <h3>📚 No se encontraron libros</h3>
        <p>No existen libros que coincidan con los filtros aplicados. Intenta ajustar los criterios de búsqueda.</p>
    </div>
@endif

<!-- Resumen de archivos digitales -->
@php
    $librosConPdf = $books->whereNotNull('file_url')->count();
    $librosSinPdf = $books->whereNull('file_url')->count();
    $porcentajeDigital = $books->count() > 0 ? round(($librosConPdf / $books->count()) * 100, 1) : 0;
@endphp

<div style="margin-top: 20px; padding: 15px; background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%); border-radius: 8px; border-left: 4px solid #48bb78;">
    <h4 style="font-size: 12px; margin-bottom: 8px; color: #2d3748;">💾 Estado de Digitalización:</h4>
    <div style="font-size: 10px; color: #4a5568;">
        <strong>{{ $porcentajeDigital }}%</strong> del catálogo está disponible en formato digital ({{ $librosConPdf }} de {{ $books->count() }} libros).
        @if($librosSinPdf > 0)
            Quedan <strong>{{ $librosSinPdf }} libros</strong> pendientes de digitalización.
        @endif
    </div>
</div>

<!-- Notas del reporte -->
<div style="margin-top: 15px; padding: 15px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #667eea;">
    <h4 style="font-size: 12px; margin-bottom: 8px; color: #2d3748;">📝 Notas del Catálogo:</h4>
    <ul style="font-size: 10px; color: #4a5568; margin-left: 15px;">
        <li>Los libros sin autor registrado aparecen como "Sin autor" en el listado</li>
        <li>La disponibilidad de archivos PDF se indica con badges de color verde</li>
        <li>Las fechas de publicación pueden no estar disponibles para libros antiguos</li>
        <li>El acceso a los libros está restringido según el grupo de usuarios asignado</li>
        <li>Este catálogo se actualiza automáticamente cuando se agregan nuevos libros</li>
    </ul>
</div>
@endsection
