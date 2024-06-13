<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Fabricante;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipo_productos = TipoProducto::all();
        $fabricantes = Fabricante::all();
        return view('productos.create', compact('tipo_productos','fabricantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'nombre_prod' => 'required|string|max:100',
            'descripcion' => 'required|string|max:400',
            'foto_prod' => 'required|image|mimes:jpeg,png,jpg,gif',
            'precio' => 'required|integer',
            'color' => 'required|string|max:100',
            'nivel_amputacion' => 'required|string|max:100',
            'grupo_usuarios' => 'required|string|max:100',
            'existencias' => 'required|integer',
            'id_tipo_producto' => 'required|exists:tipo_producto,id',
            'id_fabricante' => 'required|exists:fabricantes,id',
        ]);
        // Manejar el archivo de imagen
        if ($request->hasFile('foto_prod')) {
            $imageName = time() . '.' . $request->foto_prod->extension();
            $request->foto_prod->storeAs('public/images/productos', $imageName);
            $validated['foto_prod'] = $imageName;
        }
        // Crear un nuevo registro de Producto
        Producto::create($validated);
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
