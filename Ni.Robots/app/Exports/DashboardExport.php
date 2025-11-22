<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\CancelledAppointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DashboardExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new ExecutiveDashboardSheet($this->filters);
        $sheets[] = new PerformanceMetricsSheet($this->filters);
        $sheets[] = new SalesAnalyticsSheet($this->filters);
        $sheets[] = new InventoryManagementSheet($this->filters);
        $sheets[] = new MedicalOperationsSheet($this->filters);

        return $sheets;
    }
}

// Hoja 1: Dashboard Ejecutivo - Diseño moderno
class ExecutiveDashboardSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Calcular métricas principales
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_seen_at')
                         ->where('last_seen_at', '>=', now()->subDays(7))
                         ->count();

        $totalProducts = Producto::count();
        $lowStock = Producto::where('existencias', '<', 10)->count();

        $totalSales = Compra::sum('total') ?? 0;
        $salesThisMonth = Compra::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total') ?? 0;
        $salesLastMonth = Compra::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->sum('total') ?? 0;
        $salesGrowth = $salesLastMonth > 0 ? (($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100 : 0;

        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancellationRate = ($completedAppointments + $pendingAppointments) > 0 ? 
            (CancelledAppointment::count() / ($completedAppointments + $pendingAppointments + CancelledAppointment::count())) * 100 : 0;

        $data = [
            // Header Section
            ['DASHBOARD EJECUTIVO', '', '', '', 'PERFORMANCE REPORT'],
            ['Sistema de Gestión Integral', '', '', '', now()->format('M d, Y')],
            [''],
            
            // KPI Cards Section
            ['PRINCIPALES INDICADORES', '', '', '', 'TENDENCIA', 'ESTADO'],
            ['Usuarios Activos', $activeUsers, 'de ' . $totalUsers . ' total', ($totalUsers > 0 ? round(($activeUsers/$totalUsers)*100, 1) : 0) . '%', $activeUsers > ($totalUsers * 0.3) ? '↗️' : '↘️', $activeUsers > ($totalUsers * 0.3) ? 'BUENO' : 'MEJORABLE'],
            ['Ventas del Mes', '$' . number_format($salesThisMonth, 0), 'vs $' . number_format($salesLastMonth, 0), number_format($salesGrowth, 1) . '%', $salesGrowth > 0 ? '↗️' : '↘️', $salesGrowth > 0 ? 'EXCELENTE' : 'ATENCIÓN'],
            ['Productos Stock Bajo', $lowStock, 'de ' . $totalProducts . ' total', round(($lowStock/$totalProducts)*100, 1) . '%', $lowStock > 5 ? '↗️' : '↘️', $lowStock == 0 ? 'ÓPTIMO' : 'ALERTA'],
            ['Tasa Cancelación', number_format($cancellationRate, 1) . '%', $completedAppointments . ' completadas', $pendingAppointments . ' pendientes', $cancellationRate < 10 ? '↘️' : '↗️', $cancellationRate < 10 ? 'BAJA' : 'ALTA'],
            [''],
            
            // Performance Overview
            ['RESUMEN DE RENDIMIENTO', '', '', '', '', ''],
            ['ÁREA', 'MÉTRICA', 'ACTUAL', 'META', 'VARIACIÓN', 'ESTADO'],
            ['Ventas', 'Volumen Mensual', '$' . number_format($salesThisMonth, 0), '$' . number_format($salesLastMonth * 1.1, 0), number_format($salesGrowth, 1) . '%', $salesGrowth >= 10 ? '✅' : '⚠️'],
            ['Usuarios', 'Tasa Actividad', round(($activeUsers/$totalUsers)*100, 1) . '%', '30%', round((($activeUsers/$totalUsers)*100) - 30, 1) . 'pp', ($activeUsers/$totalUsers)*100 >= 30 ? '✅' : '⚠️'],
            ['Inventario', 'Stock Saludable', ($totalProducts - $lowStock) . ' productos', '95%', round((($totalProducts - $lowStock)/$totalProducts)*100 - 95, 1) . 'pp', (($totalProducts - $lowStock)/$totalProducts)*100 >= 95 ? '✅' : '⚠️'],
            ['Citas', 'Tasa Éxito', round((1 - $cancellationRate/100)*100, 1) . '%', '90%', round((1 - $cancellationRate/100)*100 - 90, 1) . 'pp', (1 - $cancellationRate/100)*100 >= 90 ? '✅' : '⚠️'],
            [''],
            
            // Quick Insights
            ['ANÁLISIS RÁPIDO', '', '', '', '', ''],
            ['HALLazGO', 'IMPACTO', 'RECOMENDACIÓN', 'PRIORIDAD', 'RESPONSABLE', 'TIMELINE'],
            ['Crecimiento ventas ' . ($salesGrowth > 0 ? 'positivo' : 'estancado'), $salesGrowth > 0 ? 'Alto' : 'Medio', $salesGrowth > 0 ? 'Mantener estrategia actual' : 'Revisar estrategia comercial', $salesGrowth > 0 ? 'Media' : 'Alta', 'Comercial', '30 días'],
            ['Stock bajo en ' . $lowStock . ' productos', $lowStock > 5 ? 'Alto' : 'Medio', 'Revisar y reabastecer inventario crítico', $lowStock > 5 ? 'Alta' : 'Media', 'Operaciones', '15 días'],
            ['Tasa actividad usuarios ' . round(($activeUsers/$totalUsers)*100, 1) . '%', 'Medio', 'Implementar programa de engagement', 'Media', 'Marketing', '45 días'],
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return '🏠 Dashboard';
    }

    public function styles(Worksheet $sheet)
    {
        // Configuración general
        $sheet->getStyle('A1:F100')->getFont()->setName('Calibri');
        $sheet->getStyle('A1:F100')->getFont()->setSize(10);
        
        // Header principal
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2C3E50']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '34495E']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Sección KPI Cards
        $sheet->getStyle('A4:F4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '27AE60']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Estilos para las filas de KPIs
        $kpiRows = [5, 6, 7, 8];
        foreach ($kpiRows as $row) {
            $sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BDC3C7']]],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8F9F9']],
            ]);
        }

        // Sección Performance
        $sheet->getStyle('A10:F10')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '3498DB']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A11:F11')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
        ]);

        // Sección Insights
        $sheet->getStyle('A18:F18')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E67E22']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A19:F19')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
        ]);

        // Colores condicionales para estados
        $statusColors = [
            'EXCELENTE' => '27AE60',
            'BUENO' => '2ECC71', 
            'MEJORABLE' => 'F39C12',
            'ATENCIÓN' => 'E74C3C',
            'ALERTA' => 'E74C3C',
            'BAJA' => '27AE60',
            'ALTA' => 'E74C3C'
        ];

        foreach ($statusColors as $status => $color) {
            $sheet->getStyle("F5:F8")->getFill()->setFillType(Fill::FILL_SOLID);
        }

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 15,
            'C' => 20,
            'D' => 15,
            'E' => 12,
            'F' => 12,
        ];
    }
}

// Hoja 2: Métricas de Performance - Diseño tipo Scorecard
class PerformanceMetricsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Métricas detalladas
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_seen_at')
                         ->where('last_seen_at', '>=', now()->subDays(7))
                         ->count();
        $newUsersThisMonth = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        $totalProducts = Producto::count();
        $lowStock = Producto::where('existencias', '<', 10)->count();
        $outOfStock = Producto::where('existencias', '<=', 0)->count();

        $totalSales = Compra::sum('total') ?? 0;
        $salesThisMonth = Compra::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total') ?? 0;
        $salesLastMonth = Compra::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->sum('total') ?? 0;
        $avgTransaction = Compra::avg('total') ?? 0;
        $totalTransactions = Compra::count();

        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = CancelledAppointment::count();
        $totalDoctors = Doctor::count();

        $data = [
            ['MÉTRICAS DE PERFORMANCE', '', '', '', 'SCORECARD MENSUAL'],
            ['Indicadores Clave de Rendimiento', '', '', '', now()->format('M Y')],
            [''],
            
            // Scorecards Superiores
            ['USUARIOS', $totalUsers, 'ACTIVOS', $activeUsers, 'TASA ACTIVIDAD', round(($activeUsers/$totalUsers)*100, 1) . '%'],
            ['PRODUCTOS', $totalProducts, 'STOCK BAJO', $lowStock, 'DISPONIBILIDAD', round((($totalProducts - $lowStock)/$totalProducts)*100, 1) . '%'],
            ['VENTAS', '$' . number_format($salesThisMonth, 0), 'TRANSACCIONES', $totalTransactions, 'TICKET PROMEDIO', '$' . number_format($avgTransaction, 0)],
            ['CITAS', $completedAppointments, 'PENDIENTES', $pendingAppointments, 'TASA ÉXITO', ($completedAppointments + $pendingAppointments) > 0 ? round(($completedAppointments/($completedAppointments + $pendingAppointments))*100, 1) . '%' : '0%'],
            [''],
            
            // Análisis Detallado
            ['ANÁLISIS DETALLADO POR ÁREA', '', '', '', '', ''],
            ['CATEGORÍA', 'INDICADOR', 'ACTUAL', 'PREVIO', 'VARIACIÓN', 'TENDENCIA'],
            
            // Usuarios
            ['👥 USUARIOS', 'Total Registrados', $totalUsers, $totalUsers - $newUsersThisMonth, '+' . $newUsersThisMonth, '↗️'],
            ['', 'Activos (7d)', $activeUsers, '-', round(($activeUsers/$totalUsers)*100, 1) . '%', $activeUsers > ($totalUsers * 0.3) ? '↗️' : '↘️'],
            ['', 'Nuevos Mes', $newUsersThisMonth, '-', '-', $newUsersThisMonth > 0 ? '↗️' : '➡️'],
            ['', 'Tasa Retención', round(($activeUsers/$totalUsers)*100, 1) . '%', '30%', round((($activeUsers/$totalUsers)*100) - 30, 1) . 'pp', ($activeUsers/$totalUsers)*100 >= 30 ? '✅' : '⚠️'],
            
            // Inventario  
            ['📦 INVENTARIO', 'Total Productos', $totalProducts, '-', '-', '➡️'],
            ['', 'Stock Bajo (<10)', $lowStock, '-', round(($lowStock/$totalProducts)*100, 1) . '%', $lowStock == 0 ? '✅' : '⚠️'],
            ['', 'Sin Stock', $outOfStock, '-', round(($outOfStock/$totalProducts)*100, 1) . '%', $outOfStock == 0 ? '✅' : '🔴'],
            ['', 'Disponibilidad', round((($totalProducts - $lowStock)/$totalProducts)*100, 1) . '%', '95%', round((($totalProducts - $lowStock)/$totalProducts)*100 - 95, 1) . 'pp', (($totalProducts - $lowStock)/$totalProducts)*100 >= 95 ? '✅' : '⚠️'],
            
            // Ventas
            ['💰 VENTAS', 'Volumen Mensual', '$' . number_format($salesThisMonth, 0), '$' . number_format($salesLastMonth, 0), number_format($salesThisMonth - $salesLastMonth, 0), $salesThisMonth > $salesLastMonth ? '↗️' : '↘️'],
            ['', 'Crecimiento', number_format(($salesLastMonth > 0 ? (($salesThisMonth - $salesLastMonth)/$salesLastMonth)*100 : 0), 1) . '%', '10%', '-', $salesThisMonth > $salesLastMonth ? '✅' : '⚠️'],
            ['', 'Transacciones', $totalTransactions, '-', '-', $totalTransactions > 0 ? '✅' : '🔴'],
            ['', 'Valor Promedio', '$' . number_format($avgTransaction, 0), '-', '-', $avgTransaction > 50 ? '✅' : '⚠️'],
            
            // Citas Médicas
            ['⏱️ CITAS', 'Total Doctores', $totalDoctors, '-', '-', '➡️'],
            ['', 'Completadas', $completedAppointments, '-', '-', $completedAppointments > 0 ? '✅' : '⚠️'],
            ['', 'Pendientes', $pendingAppointments, '-', '-', $pendingAppointments == 0 ? '✅' : '⚠️'],
            ['', 'Canceladas', $cancelledAppointments, '-', ($completedAppointments + $pendingAppointments) > 0 ? round(($cancelledAppointments/($completedAppointments + $pendingAppointments + $cancelledAppointments))*100, 1) . '%' : '0%', $cancelledAppointments == 0 ? '✅' : '⚠️'],
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return '📈 Performance';
    }

    public function styles(Worksheet $sheet)
    {
        // Header principal
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2C3E50']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '34495E']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Scorecards
        $scorecardRanges = ['A4:F4', 'A5:F5', 'A6:F6', 'A7:F7'];
        $scorecardColors = ['3498DB', '2ECC71', 'E67E22', '9B59B6'];
        
        foreach ($scorecardRanges as $index => $range) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $scorecardColors[$index]]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => 'FFFFFF']]],
            ]);
        }

        // Sección análisis detallado
        $sheet->getStyle('A9:F9')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '7F8C8D']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A10:F10')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Grupos de métricas
        $groupRanges = [
            'A11:F14' => 'BDD8E6', // Usuarios - Azul claro
            'A15:F18' => 'D4EFDF', // Inventario - Verde claro  
            'A19:F22' => 'FAE5D3', // Ventas - Naranja claro
            'A23:F26' => 'E8DAEF', // Citas - Púrpura claro
        ];

        foreach ($groupRanges as $range => $color) {
            $sheet->getStyle($range)->applyFromArray([
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BDC3C7']]],
            ]);
        }

        // Encabezados de grupo
        $groupHeaders = ['A11', 'A15', 'A19', 'A23'];
        foreach ($groupHeaders as $cell) {
            $sheet->getStyle($cell)->applyFromArray([
                'font' => ['bold' => true, 'size' => 11],
            ]);
        }

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 18,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 12,
        ];
    }
}

// Hoja 3: Análisis de Ventas - Diseño tipo reporte financiero
// Hoja 3: Análisis de Ventas - Diseño tipo reporte financiero
class SalesAnalyticsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $filters;
    protected $salesByMonth;
    protected $salesByDay;
    protected $topProducts;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        $this->calculateSalesData();
    }

    protected function calculateSalesData()
    {
        $now = Carbon::now();
        
        // Ventas por mes del año actual
        $this->salesByMonth = Compra::selectRaw('MONTH(created_at) as month, SUM(total) as total, COUNT(*) as transactions')
            ->whereYear('created_at', $now->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Ventas por día de la semana
        $this->salesByDay = Compra::selectRaw('DAYNAME(created_at) as day, SUM(total) as total')
            ->whereYear('created_at', $now->year)
            ->groupBy('day')
            ->orderByRaw('FIELD(day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        // Top productos por ventas
        $this->topProducts = DB::table('compra_productos')
            ->join('productos', 'compra_productos.producto_id', '=', 'productos.id')
            ->selectRaw('productos.nombre_prod, SUM(compra_productos.cantidad) as total_vendido, SUM(compra_productos.cantidad * productos.precio) as total_ingresos')
            ->groupBy('productos.id', 'productos.nombre_prod')
            ->orderByDesc('total_ingresos')
            ->limit(10)
            ->get();
    }

    public function collection()
    {
        $now = Carbon::now();
        
        $data = [
            ['ANÁLISIS DE VENTAS', '', '', '', 'REPORTE FINANCIERO'],
            ['Análisis Detallado de Performance Comercial', '', '', '', $now->year],
            [''],
            
            // Resumen Ejecutivo
            ['RESUMEN EJECUTIVO VENTAS', '', '', '', '', ''],
            ['PERÍODO', 'VENTAS TOTALES', 'TRANSACCIONES', 'TICKET PROMEDIO', 'CRECIMIENTO ANUAL', 'ESTADO'],
            ['Año Actual', '$' . number_format($this->salesByMonth->sum('total'), 0), $this->salesByMonth->sum('transactions'), '$' . number_format($this->salesByMonth->sum('total') / max($this->salesByMonth->sum('transactions'), 1), 0), 'N/A', 'EN CURSO'],
            [''],
            
            // Ventas Mensuales
            ['DISTRIBUCIÓN MENSUAL DE VENTAS', '', '', '', '', ''],
            ['MES', 'VENTAS', 'TRANSACCIONES', 'TICKET PROMEDIO', '% DEL TOTAL', 'TENDENCIA'],
        ];

        $totalAnnual = $this->salesByMonth->sum('total');
        $monthNames = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $previousMonthSales = 0;
        foreach ($this->salesByMonth as $sale) {
            $percentage = $totalAnnual > 0 ? ($sale->total / $totalAnnual) * 100 : 0;
            $avgTicket = $sale->transactions > 0 ? $sale->total / $sale->transactions : 0;
            $trend = $sale->total > $previousMonthSales ? '↗️' : ($sale->total < $previousMonthSales ? '↘️' : '➡️');
            
            $data[] = [
                $monthNames[$sale->month] ?? $sale->month,
                '$' . number_format($sale->total, 0),
                $sale->transactions,
                '$' . number_format($avgTicket, 0),
                number_format($percentage, 1) . '%',
                $trend
            ];
            $previousMonthSales = $sale->total;
        }

        $data[] = ['TOTAL ANUAL', '$' . number_format($totalAnnual, 0), $this->salesByMonth->sum('transactions'), '$' . number_format($totalAnnual / max($this->salesByMonth->sum('transactions'), 1), 0), '100%', ''];

        $data[] = [''];
        $data[] = ['ANÁLISIS POR DÍA DE LA SEMANA', '', '', '', '', ''];
        $data[] = ['DÍA', 'VENTAS', '% DEL TOTAL', 'EFICIENCIA', 'RANKING', 'RECOMENDACIÓN'];

        $dayNames = [
            'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];

        $dayTotals = $this->salesByDay->pluck('total', 'day');
        $maxDaySales = $this->salesByDay->max('total');
        
        foreach ($this->salesByDay as $index => $sale) {
            $percentage = $totalAnnual > 0 ? ($sale->total / $totalAnnual) * 100 : 0;
            $efficiency = $maxDaySales > 0 ? ($sale->total / $maxDaySales) * 100 : 0;
            $ranking = $index + 1;
            
            $recommendation = '';
            if ($ranking <= 2) {
                $recommendation = 'Focalizar esfuerzos';
            } elseif ($ranking >= 6) {
                $recommendation = 'Implementar promociones';
            } else {
                $recommendation = 'Mantener estrategia';
            }

            $data[] = [
                $dayNames[$sale->day] ?? $sale->day,
                '$' . number_format($sale->total, 0),
                number_format($percentage, 1) . '%',
                number_format($efficiency, 0) . '%',
                '#' . $ranking,
                $recommendation
            ];
        }

        $data[] = [''];
        $data[] = ['TOP 10 PRODUCTOS POR INGRESOS', '', '', '', '', ''];
        $data[] = ['PRODUCTO', 'UNIDADES VENDIDAS', 'INGRESOS TOTALES', 'PRECIO PROMEDIO', 'RANKING', 'CATEGORÍA'];

        $counter = 1;
        foreach ($this->topProducts as $product) {
            $avgPrice = $product->total_vendido > 0 ? $product->total_ingresos / $product->total_vendido : 0;
            $category = $product->total_ingresos > 10000 ? 'ESTRELLA' : ($product->total_ingresos > 5000 ? 'MEDIO' : 'BÁSICO');
            
            $data[] = [
                $product->nombre_prod,
                number_format($product->total_vendido, 0),
                '$' . number_format($product->total_ingresos, 0),
                '$' . number_format($avgPrice, 0),
                '#' . $counter++,
                $category
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return '💰 Ventas';
    }

    public function styles(Worksheet $sheet)
    {
        // Header principal
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '27AE60']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2ECC71']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Secciones principales
        $sections = [
            'A4:F4' => '3498DB',
            'A8:F8' => 'E67E22', 
            'A22:F22' => '9B59B6',
            'A35:F35' => '34495E'
        ];

        foreach ($sections as $range => $color) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        // Encabezados de tablas
        $headerRanges = ['A5:F5', 'A9:F9', 'A23:F23', 'A36:F36'];
        foreach ($headerRanges as $range) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        // Total anual destacado - CORREGIDO: usar $this->salesByMonth
        $totalRow = 9 + count($this->salesByMonth) + 1;
        $sheet->getStyle("A{$totalRow}:F{$totalRow}")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F39C12']],
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 18,
        ];
    }
}

// Hoja 4: Gestión de Inventario - Diseño tipo reporte de operaciones
class InventoryManagementSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Productos con más stock
        $topStock = Producto::select('nombre_prod', 'existencias', 'precio', 'created_at')
            ->orderByDesc('existencias')
            ->limit(15)
            ->get();

        // Productos con bajo stock
        $lowStock = Producto::where('existencias', '<', 10)
            ->orderBy('existencias')
            ->limit(15)
            ->get();

        // Análisis de valor de inventario
        $totalInventoryValue = Producto::sum(DB::raw('existencias * precio'));
        $avgPrice = Producto::avg('precio') ?? 0;

        $data = [
            ['GESTIÓN DE INVENTARIO', '', '', '', 'REPORTE DE STOCK'],
            ['Análisis de Disponibilidad y Valor de Productos', '', '', '', now()->format('M d, Y')],
            [''],
            
            // Resumen de Inventario
            ['RESUMEN DE INVENTARIO', '', '', '', '', ''],
            ['INDICADOR', 'VALOR', 'DETALLE', 'ESTADO', 'TENDENCIA', 'ACCIÓN'],
            ['Valor Total Inventario', '$' . number_format($totalInventoryValue, 0), Producto::count() . ' productos', 'ESTABLE', '➡️', 'MONITOREAR'],
            ['Precio Promedio', '$' . number_format($avgPrice, 0), 'Por producto', 'COMPETITIVO', '➡️', 'MANTENER'],
            ['Productos Stock Bajo', $lowStock->count(), 'de ' . Producto::count() . ' total', $lowStock->count() == 0 ? 'ÓPTIMO' : 'ALERTA', $lowStock->count() > 5 ? '↗️' : '↘️', $lowStock->count() > 0 ? 'REVISAR' : 'CONTINUAR'],
            ['Tasa Disponibilidad', round(((Producto::count() - $lowStock->count()) / Producto::count()) * 100, 1) . '%', 'Productos disponibles', 'ALTA', '➡️', 'MANTENER'],
            [''],
            
            // Top Productos por Stock
            ['TOP 15 PRODUCTOS - MAYOR STOCK', '', '', '', '', ''],
            ['#', 'PRODUCTO', 'EXISTENCIAS', 'VALOR UNITARIO', 'VALOR TOTAL', 'CLASIFICACIÓN'],
        ];

        $counter = 1;
        foreach ($topStock as $product) {
            $totalValue = $product->existencias * $product->precio;
            
            $classification = '';
            if ($product->existencias >= 100) {
                $classification = '🔵 SOBRE-STOCK';
            } elseif ($product->existencias >= 50) {
                $classification = '🟢 ÓPTIMO';
            } elseif ($product->existencias >= 20) {
                $classification = '🟡 NORMAL';
            } elseif ($product->existencias >= 10) {
                $classification = '🟠 BAJO';
            } else {
                $classification = '🔴 CRÍTICO';
            }

            $data[] = [
                $counter++,
                $product->nombre_prod,
                number_format($product->existencias, 0),
                '$' . number_format($product->precio, 2),
                '$' . number_format($totalValue, 2),
                $classification
            ];
        }

        $data[] = [''];
        $data[] = ['ALERTAS - PRODUCTOS STOCK BAJO', '', '', '', '', ''];
        $data[] = ['#', 'PRODUCTO', 'EXISTENCIAS', 'VALOR UNITARIO', 'DÍAS SIN MOVIMIENTO', 'PRIORIDAD'];

        $counter = 1;
        foreach ($lowStock as $product) {
            $daysInactive = $product->created_at ? $product->created_at->diffInDays(now()) : 'N/A';
            
            $priority = '';
            if ($product->existencias == 0) {
                $priority = '🔴 URGENTE';
            } elseif ($product->existencias < 3) {
                $priority = '🟠 ALTA';
            } elseif ($product->existencias < 5) {
                $priority = '🟡 MEDIA';
            } else {
                $priority = '🟢 BAJA';
            }

            $data[] = [
                $counter++,
                $product->nombre_prod,
                number_format($product->existencias, 0),
                '$' . number_format($product->precio, 2),
                $daysInactive,
                $priority
            ];
        }

        $data[] = [''];
        $data[] = ['RECOMENDACIONES INVENTARIO', '', '', '', '', ''];
        $data[] = ['PRODUCTO', 'RECOMENDACIÓN', 'IMPACTO', 'INVERSIÓN EST.', 'TIMELINE', 'RESPONSABLE'];

        // Recomendaciones basadas en el análisis
        $criticalProducts = $lowStock->where('existencias', '<', 3);
        foreach ($criticalProducts->take(5) as $product) {
            $investment = $product->precio * 20; // Sugerir reabastecimiento de 20 unidades
            $data[] = [
                $product->nombre_prod,
                'Reabastecer 20 unidades',
                'Alto',
                '$' . number_format($investment, 0),
                '7 días',
                'Compras'
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return '📦 Inventario';
    }

    public function styles(Worksheet $sheet)
    {
        // Header principal
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E67E22']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F39C12']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Secciones principales
        $sections = [
            'A4:F4' => '3498DB',
            'A11:F11' => '27AE60',
            'A28:F28' => 'E74C3C',
            'A46:F46' => '9B59B6'
        ];

        foreach ($sections as $range => $color) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        // Encabezados de tablas
        $headerRanges = ['A5:F5', 'A12:F12', 'A29:F29', 'A47:F47'];
        foreach ($headerRanges as $range) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        // Colores para clasificaciones
        $classificationColors = [
            '🔵 SOBRE-STOCK' => '3498DB',
            '🟢 ÓPTIMO' => '27AE60',
            '🟡 NORMAL' => 'F39C12', 
            '🟠 BAJO' => 'E67E22',
            '🔴 CRÍTICO' => 'E74C3C'
        ];

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 30,
            'C' => 12,
            'D' => 15,
            'E' => 15,
            'F' => 15,
        ];
    }
}

// Hoja 5: Operaciones Médicas - Diseño tipo reporte clínico
class MedicalOperationsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $filters;
    protected $doctors;
    protected $specialtyStats;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        $this->calculateMedicalData();
    }

    protected function calculateMedicalData()
    {
        // Doctores con estadísticas de citas
        $this->doctors = Doctor::withCount(['appointments as total_citas'])
            ->withCount(['appointments as completed_citas' => function($query) {
                $query->where('status', 'completed');
            }])
            ->withCount(['appointments as pending_citas' => function($query) {
                $query->where('status', 'pending');
            }])
            ->orderByDesc('total_citas')
            ->get();

        // Estadísticas por especialidad - CORREGIDO: usando joins en lugar de subconsultas
        $this->specialtyStats = Doctor::select('especialidad')
            ->selectRaw('COUNT(*) as total_doctores')
            ->selectRaw('COALESCE(SUM(completed_appointments.count), 0) as citas_completadas')
            ->selectRaw('COALESCE(SUM(pending_appointments.count), 0) as citas_pendientes')
            ->leftJoin(DB::raw('(SELECT doctor_id, COUNT(*) as count FROM appointments WHERE status = "completed" GROUP BY doctor_id) as completed_appointments'), 
                'doctor.id', '=', 'completed_appointments.doctor_id')
            ->leftJoin(DB::raw('(SELECT doctor_id, COUNT(*) as count FROM appointments WHERE status = "pending" GROUP BY doctor_id) as pending_appointments'), 
                'doctor.id', '=', 'pending_appointments.doctor_id')
            ->groupBy('especialidad')
            ->orderByDesc('citas_completadas')
            ->get();

        // Si la consulta anterior no funciona, usar esta alternativa más simple:
        if ($this->specialtyStats->isEmpty()) {
            $this->specialtyStats = Doctor::select('especialidad')
                ->selectRaw('COUNT(*) as total_doctores')
                ->selectRaw('0 as citas_completadas') // Placeholder
                ->selectRaw('0 as citas_pendientes')  // Placeholder
                ->groupBy('especialidad')
                ->get();

            // Calcular manualmente las citas por especialidad
            foreach ($this->specialtyStats as $stat) {
                $doctorsInSpecialty = Doctor::where('especialidad', $stat->especialidad)->get();
                
                $completed = 0;
                $pending = 0;
                
                foreach ($doctorsInSpecialty as $doctor) {
                    $completed += $doctor->appointments()->where('status', 'completed')->count();
                    $pending += $doctor->appointments()->where('status', 'pending')->count();
                }
                
                $stat->citas_completadas = $completed;
                $stat->citas_pendientes = $pending;
            }

            // Reordenar por citas completadas
            $this->specialtyStats = $this->specialtyStats->sortByDesc('citas_completadas')->values();
        }
    }

    public function collection()
    {
        $totalAppointments = Appointment::count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $cancelledAppointments = CancelledAppointment::count();

        $data = [
            ['OPERACIONES MÉDICAS', '', '', '', 'REPORTE CLÍNICO'],
            ['Gestión de Citas y Performance Médica', '', '', '', now()->format('M d, Y')],
            [''],
            
            // Resumen Ejecutivo
            ['RESUMEN EJECUTIVO MÉDICO', '', '', '', '', ''],
            ['INDICADOR', 'TOTAL', 'COMPLETADAS', 'PENDIENTES', 'TASA ÉXITO', 'ESTADO'],
            ['Citas Totales', $totalAppointments, $completedAppointments, $pendingAppointments, 
             round(($completedAppointments / max($totalAppointments, 1)) * 100, 1) . '%', 
             ($completedAppointments / max($totalAppointments, 1)) * 100 > 80 ? '🟢 EXCELENTE' : '🟡 MEJORABLE'],
            ['Doctores Activos', Doctor::count(), '-', '-', '-', '🟢 ACTIVO'],
            ['Tasa Cancelación', $cancelledAppointments, '-', '-', 
             round(($cancelledAppointments / max($totalAppointments + $cancelledAppointments, 1)) * 100, 1) . '%',
             ($cancelledAppointments / max($totalAppointments + $cancelledAppointments, 1)) * 100 < 10 ? '🟢 BAJA' : '🟡 ALTA'],
            [''],
            
            // Performance por Doctor
            ['PERFORMANCE POR DOCTOR', '', '', '', '', ''],
            ['#', 'DOCTOR', 'ESPECIALIDAD', 'TOTAL CITAS', 'COMPLETADAS', 'TASA EFICIENCIA'],
        ];

        $counter = 1;
        foreach ($this->doctors as $doctor) {
            $efficiency = $doctor->total_citas > 0 ? ($doctor->completed_citas / $doctor->total_citas) * 100 : 0;
            
            $data[] = [
                $counter++,
                $doctor->nombre,
                $doctor->especialidad ?? 'General',
                $doctor->total_citas,
                $doctor->completed_citas,
                number_format($efficiency, 1) . '%'
            ];
        }

        $data[] = [''];
        $data[] = ['ANÁLISIS POR ESPECIALIDAD', '', '', '', '', ''];
        $data[] = ['ESPECIALIDAD', 'TOTAL DOCTORES', 'CITAS COMPLETADAS', 'CITAS PENDIENTES', 'PROMEDIO POR DOCTOR', 'DEMANDA'];

        foreach ($this->specialtyStats as $stats) {
            $avgPerDoctor = $stats->total_doctores > 0 ? $stats->citas_completadas / $stats->total_doctores : 0;
            
            $demand = '';
            if ($avgPerDoctor >= 50) {
                $demand = '🔴 ALTA DEMANDA';
            } elseif ($avgPerDoctor >= 30) {
                $demand = '🟡 DEMANDA MEDIA';
            } elseif ($avgPerDoctor >= 15) {
                $demand = '🟢 DEMANDA NORMAL';
            } else {
                $demand = '🔵 BAJA DEMANDA';
            }

            $data[] = [
                $stats->especialidad ?? 'General',
                $stats->total_doctores,
                $stats->citas_completadas,
                $stats->citas_pendientes,
                number_format($avgPerDoctor, 1),
                $demand
            ];
        }

        $data[] = [''];
        $data[] = ['RECOMENDACIONES OPERATIVAS', '', '', '', '', ''];
        $data[] = ['ÁREA', 'RECOMENDACIÓN', 'BENEFICIO', 'PRIORIDAD', 'TIMELINE', 'RESPONSABLE'];

        // Recomendaciones basadas en el análisis
        $lowEfficiencyDoctors = $this->doctors->where('total_citas', '>', 0)
                                      ->where(function($doctor) {
                                          return ($doctor->completed_citas / $doctor->total_citas) < 0.7;
                                      })
                                      ->take(3);

        foreach ($lowEfficiencyDoctors as $doctor) {
            $data[] = [
                'Performance Médica',
                'Capacitación para Dr. ' . $doctor->nombre,
                'Mejora eficiencia +15%',
                'Media',
                '30 días',
                'RRHH'
            ];
        }

        // Usar citas_completadas en lugar de avg_per_doctor
        $highDemandSpecialties = $this->specialtyStats->filter(function($stat) {
            return $stat->citas_completadas >= 50;
        })->take(2);

        foreach ($highDemandSpecialties as $stats) {
            $data[] = [
                'Recursos Humanos',
                'Contratar más ' . ($stats->especialidad ?? 'General'),
                'Reducir lista de espera',
                'Alta',
                '60 días',
                'Dirección'
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return '👨‍⚕️ Médico';
    }

    public function styles(Worksheet $sheet)
    {
        // Header principal
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '9B59B6']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8E44AD']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Secciones principales
        $sections = [
            'A4:F4' => '3498DB',
            'A11:F11' => '27AE60',
            'A30:F30' => 'E67E22',
            'A45:F45' => '34495E'
        ];

        foreach ($sections as $range => $color) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        // Encabezados de tablas
        $headerRanges = ['A5:F5', 'A12:F12', 'A31:F31', 'A46:F46'];
        foreach ($headerRanges as $range) {
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECF0F1']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 20,
            'D' => 12,
            'E' => 15,
            'F' => 15,
        ];
    }
}