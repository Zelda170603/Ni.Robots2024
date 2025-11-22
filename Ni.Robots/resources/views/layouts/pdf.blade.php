<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Reporte Profesional')</title>
    <style>
        /* Reset y configuración base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fuente compatible con dompdf */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/DejaVuSans-Bold.ttf') }}") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #1a202c;
            background-color: #ffffff;
        }

        .page {
            width: 100%;
            min-height: 100vh;
            background: white;
            position: relative;
        }

        /* HEADER CON FONDO BLANCO Y LETRAS OSCURAS */
        .header {
            background: #ffffff;
            color: #2d3748;
            padding: 25px 35px;
            border-bottom: 3px solid #667eea;
            position: relative;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* CONTENEDOR DEL LOGO PENSADO PARA LOGOS HORIZONTALES (AJUSTADO) */
        .logo-container {
            width: 180px;               /* ancho fijo para que no se haga gigante */
            height: 70px;
            background: #667eea;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #667eea;
            padding: 8px 14px;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.2);
            overflow: hidden;           /* evita que una imagen muy ancha se salga */
        }

        .logo-img {
            max-width: 100%;            /* que nunca sea más grande que el contenedor */
            height: auto;               /* respeta proporción */
            object-fit: contain;
            filter: brightness(0) invert(1); /* si tu logo ya es oscuro, puedes quitar esto */
        }

        .logo-fallback {
            width: 100%;
            height: 100%;
            background: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #667eea;
            font-size: 14px;
        }

        .header-title {
            flex: 1;
        }

        .header-title h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 4px;
            color: #2d3748;
        }

        .header-title .subtitle {
            font-size: 12px;
            color: #718096;
            font-weight: normal;
        }

        .header-right {
            text-align: right;
            font-size: 11px;
        }

        .header-right .date {
            background: #f8fafc;
            padding: 6px 12px;
            border-radius: 6px;
            margin-bottom: 8px;
            border: 1px solid #e2e8f0;
            color: #4a5568;
            font-weight: 600;
        }

        .header-right .page-info {
            color: #718096;
        }

        /* SECCIÓN DE INFORMACIÓN DEL REPORTE */
        .report-info {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 20px 35px;
            border-bottom: 3px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-meta h2 {
            font-size: 16px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .report-meta .description {
            font-size: 12px;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .report-meta .filters {
            font-size: 10px;
            color: #718096;
            background: white;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .report-stats {
            text-align: right;
        }

        .stat-item {
            display: inline-block;
            background: white;
            padding: 8px 15px;
            margin-left: 10px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
            display: block;
        }

        .stat-label {
            font-size: 10px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* CONTENIDO PRINCIPAL */
        .main-content {
            padding: 25px 35px;
        }

        /* ALERTAS Y NOTIFICACIONES */
        .alert {
            background: linear-gradient(135deg, #ebf8ff 0%, #bee3f8 100%);
            border: 1px solid #90cdf4;
            border-left: 4px solid #4299e1;
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 11px;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border-color: #f59e0b;
            border-left-color: #d97706;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%);
            border-color: #68d391;
            border-left-color: #38a169;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2 0%, #fed7d7 100%);
            border-color: #fc8181;
            border-left-color: #e53e3e;
        }

        /* TABLAS MEJORADAS */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        th {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            color: white;
            text-align: left;
            font-weight: bold;
            padding: 12px 10px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #2d3748;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tr:hover {
            background-color: #edf2f7;
        }

        /* BADGES MODERNOS */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid transparent;
        }

        .badge-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
            color: white;
        }

        /* SECCIÓN DE RESUMEN MEJORADA */
        .summary {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .summary-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .summary-header h3 {
            font-size: 16px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .summary-header .subtitle {
            font-size: 11px;
            color: #718096;
        }

        .summary-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 15px;
        }

        .summary-item {
            flex: 1;
            min-width: 120px;
            text-align: center;
            background: white;
            padding: 15px 10px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .summary-number {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .summary-label {
            font-size: 10px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }

        /* ESTADO VACÍO */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px dashed #cbd5e0;
            margin: 20px 0;
        }

        .empty-state h3 {
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 11px;
            color: #718096;
        }

        /* FOOTER MEJORADO */
        .footer {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            padding: 20px 35px;
            margin-top: 30px;
            font-size: 10px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .footer-logo {
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-info {
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-right {
            text-align: right;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-right .generated-by {
            font-weight: bold;
            color: white;
        }

        /* UTILIDADES */
        .text-left { text-align: left; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-uppercase { text-transform: uppercase; }
        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
        .mb-3 { margin-bottom: 15px; }
        .mt-1 { margin-top: 5px; }
        .mt-2 { margin-top: 10px; }
        .mt-3 { margin-top: 15px; }

        @media print {
            .page {
                margin: 0;
                padding: 0;
            }
            .header, .footer {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- HEADER -->
        <header class="header">
            <div class="header-content">
                <div class="header-left">
                    <div class="logo-container">
                        <?php
                        $logoPath = public_path('images/logo.png');
                        if (file_exists($logoPath)) {
                            $logoData = base64_encode(file_get_contents($logoPath));
                            echo '<img src="data:image/png;base64,' . $logoData . '" alt="Logo" class="logo-img">';
                        } else {
                            echo '<div class="logo-fallback">LOGO</div>';
                        }
                        ?>
                    </div>
                    <div class="header-title">
                        <h1>@yield('title', 'Reporte del Sistema')</h1>
                        <div class="subtitle">@yield('company', 'Sistema de Gestión Profesional')</div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="date">{{ now()->format('d/m/Y H:i') }}</div>
                    <div class="page-info">Página <span class="page-number">1</span></div>
                </div>
            </div>
        </header>

        <!-- INFORMACIÓN DEL REPORTE -->
        <div class="report-info">
            <div class="report-meta">
                <h2>@yield('subtitle', 'Detalles del Reporte')</h2>
                <div class="description">@yield('description', 'Resumen general del sistema')</div>
                <div class="filters">
                    <strong>Filtros aplicados:</strong> @yield('filters_applied', 'Ninguno')
                </div>
            </div>
            <div class="report-stats">
                <div class="stat-item">
                    <span class="stat-number">@yield('total_count', '0')</span>
                    <span class="stat-label">Total Registros</span>
                </div>
                @yield('additional_stats')
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="main-content">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-logo">
                        <span style="font-weight: bold; font-size: 12px;">SG</span>
                    </div>
                    <div class="footer-info">
                        <div>© {{ date('Y') }} Sistema de Gestión</div>
                        <div>Reporte generado automáticamente</div>
                    </div>
                </div>
                <div class="footer-right">
                    <div>Generado por: <span class="generated-by">{{ Auth::user()->name ?? 'Sistema' }}</span></div>
                    <div>{{ now()->format('d/m/Y \a \l\a\s H:i') }}</div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
