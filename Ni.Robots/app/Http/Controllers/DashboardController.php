<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Fabricante;
use App\Models\Specialty;
use App\Models\CancelledAppointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\DashboardExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        // ... (todo tu código existente del index)
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // --- 🔢 MÉTRICAS PRINCIPALES ---
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_seen_at')
                         ->where('last_seen_at', '>=', now()->subDays(7))
                         ->count();

        $totalProducts = Producto::count();
        $lowStock = Producto::where('existencias', '<', 10)->count();

        $totalSales = Compra::sum('total') ?? 0;
        $salesThisMonth = Compra::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total') ?? 0;
        $avgSales = Compra::avg('total') ?? 0;

        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = CancelledAppointment::count();

        // --- ⚠️ ALERTAS ---
        $alerts = [
            ['type' => 'warning', 'message' => "Productos con bajo stock: {$lowStock}"],
            ['type' => 'info', 'message' => "Citas pendientes: {$pendingAppointments}"],
            ['type' => 'success', 'message' => "Usuarios activos esta semana: {$activeUsers}"],
        ];

        // --- 📈 DATOS PARA GRÁFICOS ---
        $salesTrend = $this->getSalesTrend();
        $usersTrend = $this->getUsersTrend();
        $doctorsBySpecialty = $this->getDoctorsBySpecialty();
        $salesByManufacturer = $this->getSalesByManufacturer();
        $userActivityTrend = $this->getUserActivityTrend();

        // Top 5 productos con más existencias
        $topProducts = Producto::select('nombre_prod', 'existencias')
            ->orderByDesc('existencias')
            ->limit(5)
            ->get();

        return view('Administracion.index', compact(
            'totalUsers', 'activeUsers', 'totalProducts', 'lowStock',
            'totalSales', 'salesThisMonth', 'avgSales',
            'pendingAppointments', 'completedAppointments', 'cancelledAppointments',
            'salesTrend', 'usersTrend',
            'salesByManufacturer', 'doctorsBySpecialty',
            'userActivityTrend', 'topProducts',
            'alerts'
        ));
    }

    public function exportExcel()
    {
        $filters = []; // Sin filtros, exporta todo
        $filename = 'reporte-dashboard-' . Carbon::now()->format('Y-m-d_H-i') . '.xlsx';

        return Excel::download(new DashboardExport($filters), $filename);
    }

    /**
     * Exportar PDF con todos los datos del dashboard
     */
    public function exportPDF()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Métricas principales
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_seen_at')
                           ->where('last_seen_at', '>=', now()->subDays(7))
                           ->count();

        $totalProducts = Producto::count();
        $lowStock = Producto::where('existencias', '<', 10)->count();

        $totalSales = Compra::sum('total') ?? 0;
        $salesThisMonth = Compra::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total') ?? 0;
        $avgSales = Compra::avg('total') ?? 0;

        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = CancelledAppointment::count();

        // Datos para gráficos
        $salesTrend = $this->getSalesTrend();
        $doctorsBySpecialty = $this->getDoctorsBySpecialty();
        $salesByManufacturer = $this->getSalesByManufacturer();
        $topProducts = Producto::select('nombre_prod', 'existencias')
                               ->orderByDesc('existencias')
                               ->limit(5)
                               ->get();

        // Recolectar todos los datos en un array
        $data = [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'totalProducts' => $totalProducts,
            'lowStock' => $lowStock,
            'totalSales' => $totalSales,
            'salesThisMonth' => $salesThisMonth,
            'avgSales' => $avgSales,
            'pendingAppointments' => $pendingAppointments,
            'completedAppointments' => $completedAppointments,
            'cancelledAppointments' => $cancelledAppointments,
            'salesTrend' => $salesTrend,
            'doctorsBySpecialty' => $doctorsBySpecialty,
            'salesByManufacturer' => $salesByManufacturer,
            'topProducts' => $topProducts,
        ];

        $pdf = Pdf::loadView('Administracion.dashboard-pdf', $data);
        return $pdf->download('reporte-dashboard-' . Carbon::now()->format('Y-m-d_H-i') . '.pdf');
    }
    public function exportView()
    {
        $fabricantes = Fabricante::all();
        $especialidades = Doctor::select('especialidad')->distinct()->get();
        
        return view('Administracion.export', compact('fabricantes', 'especialidades'));
    }

    /**
     * Obtener estadísticas para el PDF
     */
    private function getDashboardStats($filters = [])
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Aplicar filtros
        $queryUsers = User::query();
        $queryProducts = Producto::query();
        $querySales = Compra::query();
        $queryAppointments = Appointment::query();

        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $fechaInicio = $filters['fecha_inicio'];
            $fechaFin = $filters['fecha_fin'];
            
            $queryUsers->whereBetween('created_at', [$fechaInicio, $fechaFin]);
            $queryProducts->whereBetween('created_at', [$fechaInicio, $fechaFin]);
            $querySales->whereBetween('created_at', [$fechaInicio, $fechaFin]);
            $queryAppointments->whereBetween('created_at', [$fechaInicio, $fechaFin]);
        }

        return [
            'total_users' => $queryUsers->count(),
            'active_users' => User::whereNotNull('last_seen_at')
                                ->where('last_seen_at', '>=', now()->subDays(7))
                                ->count(),
            'total_products' => $queryProducts->count(),
            'low_stock' => Producto::where('existencias', '<', 10)->count(),
            'total_sales' => $querySales->sum('total') ?? 0,
            'sales_this_month' => Compra::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total') ?? 0,
            'pending_appointments' => $queryAppointments->where('status', 'pending')->count(),
            'completed_appointments' => $queryAppointments->where('status', 'completed')->count(),
            'cancelled_appointments' => CancelledAppointment::count(),
            'total_doctors' => Doctor::count(),
            'sales_trend' => $this->getSalesTrend(),
            'doctors_by_specialty' => $this->getDoctorsBySpecialty(),
            'sales_by_manufacturer' => $this->getSalesByManufacturer(),
        ];
    }

    // ... (tus métodos privados existentes: getSalesTrend, getUsersTrend, etc.)
    
    private function getSalesTrend()
    {
        $sales = Compra::selectRaw('DATE(created_at) as date, COALESCE(SUM(total), 0) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $result = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[$date] = 0;
        }

        foreach ($sales as $sale) {
            $result[$sale->date] = floatval($sale->total);
        }

        return $result;
    }

    private function getUsersTrend()
    {
        $users = User::selectRaw('DATE(created_at) as date, COUNT(id) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $result = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[$date] = 0;
        }

        foreach ($users as $user) {
            $result[$user->date] = intval($user->total);
        }

        return $result;
    }

    private function getDoctorsBySpecialty()
    {
        return Doctor::select('especialidad')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('especialidad')
            ->orderByDesc('total')
            ->get()
            ->map(function($item) {
                return [
                    'especialidad' => $item->especialidad ?? 'Sin especialidad',
                    'total' => $item->total
                ];
            });
    }

    private function getSalesByManufacturer()
    {
        $sales = Compra::join('compra_productos', 'compras.id', '=', 'compra_productos.compra_id')
            ->join('productos', 'compra_productos.producto_id', '=', 'productos.id')
            ->join('fabricantes', 'productos.id_fabricante', '=', 'fabricantes.id')
            ->selectRaw('fabricantes.nombre as fabricante, COALESCE(SUM(compra_productos.cantidad * productos.precio), 0) as total')
            ->groupBy('fabricantes.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $result = [];
        foreach ($sales as $sale) {
            $result[$sale->fabricante] = floatval($sale->total);
        }

        return $result;
    }
      
    private function getUserActivityTrend()
    {
        $activity = User::whereNotNull('last_seen_at')
            ->where('last_seen_at', '>=', now()->subDays(15))
            ->selectRaw('DATE(last_seen_at) as date, COUNT(id) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $result = [];
        for ($i = 14; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[$date] = 0;
        }

        foreach ($activity as $act) {
            $result[$act->date] = intval($act->total);
        }

        return $result;
    }

    public function mapaUsuarios()
{ 
    $usuariosPorCiudad = User::select('departamento', DB::raw('count(*) as total'))
        ->groupBy('departamento')
        ->pluck('total', 'departamento'); // Esto devuelve ['León' => 45, 'Managua' => 120, ...]

    return response()->json($usuariosPorCiudad);
}

}