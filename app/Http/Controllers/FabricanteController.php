<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fabricante;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreFabricanteRequest;
use App\Http\Requests\UpdateFabricanteRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabricantes = Fabricante::paginate(1);
        return view('fabricantes.index', compact('fabricantes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Fabricantes.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'foto_fabr' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ubicacion' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'direccion' => 'required|string|max:100',
            'google_map_direction' => 'required|string|max:300',
            'correo' => 'required|string|email|max:100',
            'telefono' => 'required|numeric',
        ]);
         // Manejar el archivo de imagen
        if ($request->hasFile('foto_fabr')) {
            $imageName = time() . '.' . $request->foto_fabr->extension();
            $request->foto_fabr->storeAs('public/images/fabricantes', $imageName);
            $validated['foto_fabr'] = $imageName;
        }
        // Generar unique_id
        $validated['unique_id'] = Str::random(10);
        // Crear un nuevo registro de Fabricante
        Fabricante::create($validated);
        return redirect()->route('fabricantes.create')->with('success', 'Fabricante creado exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Fabricante $fabricante)
    {
        return view('fabricantes.fabricante')->with('fabricante', $fabricante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.edit')->with('fabricante', $fabricante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validar los datos de entrada
    $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'foto_fabr' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'ubicacion' => 'required|string|max:100',
        'descripcion' => 'required|string|max:500',
        'direccion' => 'required|string|max:100',
        'correo' => 'required|string|email|max:100',
        'telefono' => 'required|numeric',
    ]);

    $fabricante = Fabricante::findOrFail($id);

    // Manejar el archivo de imagen
    if ($request->hasFile('foto_fabr')) {
        // Eliminar la imagen anterior si existe
        if ($fabricante->foto_fabr && Storage::exists('public/images/fabricantes/' . $fabricante->foto_fabr)) {
            Storage::delete('public/images/fabricantes/' . $fabricante->foto_fabr);
        }
        // Subir la nueva imagen
        $imageName = time() . '.' . $request->foto_fabr->extension();
        $request->foto_fabr->storeAs('public/images/fabricantes', $imageName);
        $validated['foto_fabr'] = $imageName;
    } else {
        // Mantener la foto actual si no se ha subido una nueva
        $validated['foto_fabr'] = $request->current_foto_fabr;
    }

    // Actualizar el registro de Fabricante
    $fabricante->update($validated);

    return redirect()->route('fabricantes.edit', $fabricante->id)->with('success', 'Fabricante actualizado exitosamente');
}

    // Método para eliminar el fabricante
    public function destroy(Fabricante $fabricante)
    {
        $fabricante->delete();
        return redirect()->route('fabricantes.index')->with('success', 'Fabricante eliminado con éxito.');
    }
}
