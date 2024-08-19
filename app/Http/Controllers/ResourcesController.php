<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourcesController extends Controller
{
    public function getDepartamentos()
    {
        // Consultar todos los departamentos
        $departamentos = DB::table('departamentos')
            ->pluck('nombre', 'id');

        // Retornar los departamentos como JSON
        return response()->json($departamentos);
    }

    public function getMunicipios($departamento_id)
    {
        $municipios = DB::table('municipios')
            ->where('departamento_id', $departamento_id)
            ->pluck('nombre', 'id');
        return response()->json($municipios);
    }

    public function getCategoriasAfectacion()
    {
        $categoriasAfectacion = DB::table('categorias_afectaciones')
            ->pluck('nombre', 'id');
        return response()->json($categoriasAfectacion);
    }

    public function getTiposAfectacion($categoria_id)
    {
        $tiposAfectacion = DB::table('tipos_afectaciones')
            ->where('categoria_id', $categoria_id)
            ->pluck('tipo', 'id');
        return response()->json($tiposAfectacion);
    }

}
