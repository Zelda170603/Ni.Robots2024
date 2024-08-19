<?php

namespace App\Http\Controllers;

use App\Models\Centro_Atencion;
use App\Models\Fotos_Centro_Atencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class CentroAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centros = Centro_Atencion::all();
        return view('centro_atencion.index', compact('centros'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        // Cargar los departamentos
        $cities = DB::table('departamentos')->pluck('nombre', 'id');
        return view('centro_atencion.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'google_map_direction' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'foto_principal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fotos_secundarias.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $centro = Centro_Atencion::create($request->only([
            'nombre',
            'correo',
            'telefono',
            'direccion',
            'ciudad',
            'departamento',
            'google_map_direction',
            'descripcion',
            'tipo'
        ]));

        if ($request->hasFile('foto_principal')) {
            $fotoPrincipalName = time() . '_principal.' . $request->foto_principal->extension();
            $request->foto_principal->storeAs('public/images/centro_atencion', $fotoPrincipalName);
            Fotos_Centro_Atencion::create([
                'centro_atencion_id' => $centro->id,
                'foto' => $fotoPrincipalName,
                'principal' => true,
            ]);
        }
        if ($request->hasFile('fotos_secundarias')) {
            foreach ($request->file('fotos_secundarias') as $index => $fotoSecundaria) {
                $fotoSecundariaName = time() . '_secundaria_' . $index . '.' . $fotoSecundaria->extension();
                $fotoSecundaria->storeAs('public/images/centro_atencion', $fotoSecundariaName);
                Fotos_Centro_Atencion::create([
                    'centro_atencion_id' => $centro->id,
                    'foto' => $fotoSecundariaName,
                ]);
            }
        }
        return redirect()->route('Centro_atencion.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $centro = Centro_Atencion::find($id);
        $coordenadas = $centro->google_maps_direction;
        return view('centro_atencion.show', compact('centro', 'coordenadas'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Centro_Atencion $centroAtencion)
    {
        return view('centro_atencion.edit', compact('centroAtencion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Centro_Atencion $centroAtencion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'google_map_direction' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:Minsa,Psicologia,Terapia,Otros',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $centroAtencion->update($request->all());

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $path = $foto->store('public/fotos_centro_atencion');
                Fotos_Centro_Atencion::create([
                    'centro_atencion_id' => $centroAtencion->id,
                    'url' => $path,
                    'principal' => $index === 0, // la primera foto es principal
                ]);
            }
        }

        return redirect()->route('centro_atencion.index')->with('success', 'Centro de atención actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Centro_Atencion $centroAtencion)
    {
        $centroAtencion->delete();
        return redirect()->route('centro_atencion.index')->with('success', 'Centro de atención eliminado exitosamente.');
    }

    public function get_city($city)
    {
        try {
            // Obtener los centros de atención para la ciudad especificada con la foto principal
            $centros = Centro_Atencion::where('ciudad', $city)->with('fotoPrincipal')->get();

            // Renderizar la vista parcial para cada centro de atención
            $html = '';
            foreach ($centros as $centro) {
                $html .= View::make('Centro_Atencion.partials.getformap', ['centro' => $centro])->render();
            }

            // Devolver el HTML renderizado como respuesta
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            // Devolver una respuesta con el mensaje de error y un código de estado 500
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
