<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function getDoctores($especialidad)
    {
        $doctores = DB::table('users as u')
            ->join('roles as r', 'u.id', '=', 'r.user_id')
            ->join('doctor as d', function ($join) {
                $join->on('r.roleable_id', '=', 'd.id')
                    ->where('r.role_type', 'doctor');
            })
            ->where('d.especialidad', $especialidad)
            ->select('u.*', 'd.especialidad', 'd.id as id_doc')
            ->get();

        return response()->json($doctores);
    }
}
