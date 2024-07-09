<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\carrito;
use App\Models\Fabricante;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Database\Seeders\ProductoSeeder;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        // Filtrar por nombre del producto
        if ($request->filled('nombre_prod')) {
            $query->where('nombre_prod', 'like', '%' . $request->nombre_prod . '%');
        }

        // Filtrar por descripción
        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        // Filtrar por precio
        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->whereBetween('precio', [$request->precio_min, $request->precio_max]);
        } elseif ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        } elseif ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        // Filtrar por color
        if ($request->filled('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }

        // Filtrar por tipo de producto
        if ($request->filled('id_tipo_producto')) {
            $query->where('id_tipo_producto', $request->id_tipo_producto);
        }

        // Filtrar por fabricante
        if ($request->filled('id_fabricante')) {
            $query->where('id_fabricante', $request->id_fabricante);
        }

        // Paginación con parámetros de filtro
        $productos = $query->paginate(4)->appends($request->except('page'));

        $tipo_productos = TipoProducto::all();
        $fabricantes = Fabricante::all();

        return view('productos.index-user', compact('productos', 'tipo_productos', 'fabricantes'));
    }

    public function index_admin(Request $request)
    {
        $query = Producto::query();
        $productos = $query->paginate(4)->appends($request->except('page'));

        $tipo_productos = TipoProducto::all();
        $fabricantes = Fabricante::all();

        return view('productos.index-admin', compact('productos', 'tipo_productos', 'fabricantes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipo_productos = TipoProducto::all();
        $fabricantes = Fabricante::all();
        return view('productos.create', compact('tipo_productos', 'fabricantes'));
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
            'nivel_afectacion' => 'required|string|max:100',
            'grupo_usuarios' => 'required|string|max:100',
            'existencias' => 'required|integer',
            'id_tipo_producto' => 'required|exists:tipo_productos,id',
            'id_fabricante' => 'required|exists:fabricantes,id',
        ]);
        // Manejar el archivo de imagen
        if ($request->hasFile('foto_prod')) {
            $imageName = time() . '.' . $request->foto_prod->extension();
            $request->foto_prod->storeAs('public/images/productos', $imageName);
            $validated['foto_prod'] = $imageName;
        }

        $validated['unique_id'] = Str::random(7);
        // Crear un nuevo registro de Producto
        Producto::create($validated);
        return redirect()->route('productos.create')->with('success', 'Producto creado exitosamente');
    }

    public function searchByName(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $productos = Producto::where('nombre_prod', 'LIKE', '%' . $searchTerm . '%')->get();
        $html = '';
        foreach ($productos as $producto) {
            $html .= '<a href="" class="result-prod">
                        <div class="">
                            <span>' . $producto->nombre_prod . '</span>  
                        </div>
                    </a>';
        }

        $response = ['html' => $html];

        // Mostrar en consola lo que se está devolviendo
        \Illuminate\Support\Facades\Log::info('Response from searchByName:', $response);

        return response()->json($response);
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('producto.producto')->with('producto', $producto);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('producto.edit')->with('producto', $producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'nombre_prod' => 'required|string|max:100',
            'descripcion' => 'required|string|max:400',
            'foto_prod' => 'required|image|mimes:jpeg,png,jpg,gif',
            'precio' => 'required|integer',
            'color' => 'required|string|max:100',
            'nivel_afectacion' => 'required|string|max:100',
            'grupo_usuarios' => 'required|string|max:100',
            'existencias' => 'required|integer',
            'id_tipo_producto' => 'required|exists:tipo_productos,id',
            'id_fabricante' => 'required|exists:fabricantes,id',
        ]);

        // Manejar el archivo de imagen
        if ($request->hasFile('foto_prod')) {
            // Eliminar la imagen anterior si existe
            if ($producto->foto_prod && Storage::exists('public/images/productos/' . $producto->foto_prod)) {
                Storage::delete('public/images/productos/' . $producto->foto_prod);
            }
            // Subir la nueva imagen
            $imageName = time() . '.' . $request->foto_prod->extension();
            $request->foto_prod->storeAs('public/images/productos', $imageName);
            $validated['foto_prod'] = $imageName;
        } else {
            // Mantener la foto actual si no se ha subido una nueva
            $validated['foto_prod'] = $producto->foto_prod;
        }

        // Actualizar el registro del Producto
        $producto->update($validated);

        return redirect()->route('productos.edit', $producto->id)->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'producto eliminado con éxito.');
    }

    public function pago()
    {
        $carritos = Carrito::where('user_id', auth()->id())->with('producto')->get();
        $subtotal = 0;

        foreach ($carritos as $carrito) {
            $subtotal += $carrito->producto->precio * $carrito->cantidad;
        }

        $tax = $subtotal * 0.15; // 15% de IVA
        $total = $subtotal + $tax;

        return view('Productos.payment', [
            'carritos' => $carritos,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);
    }
}
