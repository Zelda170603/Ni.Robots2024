<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Compra_producto;
use App\Models\Compra;
class FabricanteDashboardController extends Controller
{
    public function ventasUltimaSemana()
    {
        $user = Auth::user();

        // Verificar que el usuario tenga un rol de fabricante
        if (!$user->role || $user->role->role_type !== 'fabricante') {
            return response()->json([
                'error' => 'No autorizado o no es fabricante.'
            ], 403);
        }

        // Obtener el ID del fabricante (desde roleable_id)
        $fabricanteId = $user->role->roleable_id;

        // Fechas: últimos 7 días (incluye hoy)
        $start = Carbon::now()->subDays(6)->startOfDay();
        $end = Carbon::now()->endOfDay();

        // Obtener las compras de productos de este fabricante en la última semana
        $ventas = Compra_producto::where('fabricante_id', $fabricanteId)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        // Crear lista de días (últimos 7)
        $dias = collect();
        for ($i = 0; $i < 7; $i++) {
            $dias->push($start->copy()->addDays($i)->format('Y-m-d'));
        }

        // Contar ventas por día (cantidad total o número de ventas)
        $ventasPorDia = $dias->mapWithKeys(function ($dia) use ($ventas) {
            $totalDia = $ventas->whereBetween('created_at', [
                $dia . ' 00:00:00',
                $dia . ' 23:59:59'
            ])->count(); // O usa ->sum('cantidad') si prefieres total de productos vendidos
            return [$dia => $totalDia];
        });

        // Retornar JSON
        return response()->json([
            'dias' => $ventasPorDia->keys(),
            'ventas' => $ventasPorDia->values(),
        ]);
    }

    public function ventasPorCategoria()
    {
        // Obtenemos la cantidad total vendida por cada tipo de producto
        $ventas = Compra_producto::join('productos', 'compra_productos.producto_id', '=', 'productos.id')
            ->select('productos.tipo_producto', DB::raw('SUM(compra_productos.cantidad) as total_vendidos'))
            ->groupBy('productos.tipo_producto')
            ->get();

            
        // Devolvemos los datos en formato JSON
        return response()->json($ventas);
    }
    public function productosMasVendidos()
    {
        $user = Auth::user();

        // Verificar que el usuario sea fabricante
        if (!$user->role || $user->role->role_type !== 'fabricante') {
            return response()->json([
                'error' => 'No autorizado o no es fabricante.'
            ], 403);
        }

        $fabricanteId = $user->role->roleable_id;

        // Obtener los productos más vendidos del fabricante
        $productos = Compra_producto::join('productos', 'compra_productos.producto_id', '=', 'productos.id')
            ->where('compra_productos.fabricante_id', $fabricanteId)
            ->select('productos.nombre_prod', DB::raw('SUM(compra_productos.cantidad) as total_vendidos'))
            ->groupBy('productos.id', 'productos.nombre_prod')
            ->orderByDesc('total_vendidos')
            ->take(10) // top 10 productos
            ->get();

        return response()->json($productos);
    }

    public function comprasPorEstado()
    {
        // Contar la cantidad de compras por estado
        $estados = ['pendiente', 'pagado', 'enviado']; // ajusta según los estados que tengas
        $series = [];
        $labels = [];

        foreach ($estados as $estado) {
            $labels[] = ucfirst($estado);
            $series[] = Compra::where('status', $estado)->count();
        }

        return response()->json([
            'labels' => $labels,
            'series' => $series,
        ]);
    }
}
