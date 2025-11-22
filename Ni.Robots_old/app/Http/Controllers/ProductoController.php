<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Fabricante;
use App\Models\FotosProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        if ($request->filled('tipo_producto')) {
            $query->where('tipo_producto', $request->tipo_producto);
        }

        // Filtrar por fabricante
        if ($request->filled('id_fabricante')) {
            $query->where('id_fabricante', $request->id_fabricante);
        }

        // Include average rating calculation
        $productos = $query->withAvg('calificaciones', 'puntuacion')
            ->paginate(12)
            ->appends($request->except('page'));
        $fabricantes = Fabricante::all();
        session()->put('productos', $productos);

        return view('Productos.index-user', compact('productos', 'fabricantes'));
    }

    public function index_fab(){
        $id = Auth::user()->role->roleable_id;
        $productos = Producto::where('id_fabricante', $id)->get();
        return view('Administracion.Fabricante.productos', compact('productos'));
    }

    public function index_admin(Request $request)
    {
        $productos = session()->get('productos');

        if (!$productos) {
            $query = Producto::query();
            $productos = $query->paginate(4)->appends($request->except('page'));
        }

        $fabricantes = Fabricante::all();

        return view('administracion.index', compact('productos', 'fabricantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fabricantes = Fabricante::all();
        return view('productos.create', compact('fabricantes'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario es un fabricante
        $user = auth()->user();
        $isFabricante = $user->role->role_type === 'fabricante';

        // Validar los datos de entrada
        $validated = $request->validate([
            'nombre_prod' => 'required|string|max:100',
            'descripcion' => 'required|string|max:400',
            'foto_prod.*' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'precio' => 'required|numeric',
            'color' => 'required|string|max:100',
            'tipo_afectacion' => 'required|string|max:100',
            'nivel_afectacion' => 'required|string|max:100',
            'grupo_usuarios' => 'required|string|max:100',
            'existencias' => 'required|integer',
            'tipo_producto' => 'required',
            // Validar id_fabricante solo si el usuario NO es fabricante
            'id_fabricante' => $isFabricante ? 'nullable' : 'required|exists:fabricantes,id',
        ]);

        // Si el usuario es fabricante, asignar automáticamente su ID de fabricante
        if ($isFabricante) {
            $validated['id_fabricante'] = $user->role->roleable_id; // Asignar el ID del fabricante asociado al usuario autenticado
        }

        // Manejar la foto principal
        if ($request->hasFile('foto_prod') && $request->file('foto_prod')[0]) {
            $imageName = time() . '_main.' . $request->foto_prod[0]->extension();
            $request->foto_prod[0]->storeAs('public/images/productos', $imageName);
            $validated['foto_prod'] = $imageName;
        }

        // Obtener los nombres correspondientes a nivel_afectacion y tipo_afectacion
        $tipoAfectacion = DB::table('categorias_afectaciones')->where('id', $validated['tipo_afectacion'])->value('nombre');
        $nivelAfectacion = DB::table('tipos_afectaciones')->where('id', $validated['nivel_afectacion'])->value('tipo');

        // Guardar el nombre en lugar del ID
        $validated['tipo_afectacion'] = $tipoAfectacion;
        $validated['nivel_afectacion'] = $nivelAfectacion;

        // Generar un ID único
        $validated['unique_id'] = Str::random(7);

        // Crear un nuevo registro de Producto
        $producto = Producto::create($validated);

        // Manejar las fotos adicionales
        if ($request->hasFile('foto_prod')) {
            foreach ($request->foto_prod as $index => $photo) {
                if ($index > 0 && $photo) { // Ignorar la primera foto, ya que es la principal
                    $photoName = time() . '_' . $index . '.' . $photo->extension();
                    $photo->storeAs('public/images/productos', $photoName);

                    // Guardar la foto en la tabla `fotos_productos`
                    FotosProducto::create([
                        'nombre' => $photoName,
                        'id_producto' => $producto->id,
                    ]);
                }
            }
        }

        return redirect()->route('productos.create')->with('success', 'Producto creado exitosamente');
    }




    public function searchByName(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $productos = Producto::where('nombre_prod', 'LIKE', '%' . $searchTerm . '%')->get();
        $html = '';

        $html = View::make('productos.partials.search_result', ['productos' => $productos])->render();
        $response = ['html' => $html];
        return response()->json($response);
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        // Cargar las fotos del producto
        $producto->load('fotos');

        // Calcular el promedio de calificaciones
        $promedioCalificaciones = $producto->calificaciones()->avg('puntuacion');

        // Calcular el número total de calificaciones
        $totalRatings = $producto->calificaciones()->count();

        // Calcular el porcentaje para cada calificación
        $ratingsPercentages = [];
        foreach (range(5, 1) as $stars) {
            $count = $producto->calificaciones()->where('puntuacion', $stars)->count();
            $percentage = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
            $ratingsPercentages[$stars] = $percentage;
        }
        // Obtener los primeros 2 comentarios con calificaciones
        $comentarios = $producto->calificaciones()
            ->select()
            ->with('user')
            ->limit(2)
            ->get();


        // Obtener los 10 productos mejor calificados
        $mejorCalificados = Producto::with('fotos')
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        // Obtener productos con el mismo nivel de afectacion
        $productosMismoNivel = Producto::where('nivel_afectacion', $producto->nivel_afectacion)
            ->where('id', '!=', $producto->id) // Excluir el producto actual
            ->with('fotos')
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        $productoCardMejorCalificados = View::make('productos.partials.producto_card', [
            'mejorCalificados' => $mejorCalificados,
            'promedioCalificaciones' => $promedioCalificaciones,
        ])->render();

        // Renderizar la vista parcial para los productos con el mismo nivel de afectacion
        $productoCardMismoNivel = View::make('productos.partials.producto_card', [
            'mejorCalificados' => $productosMismoNivel,
            'promedioCalificaciones' => $promedioCalificaciones,
        ])->render();
        // Pasar el producto, el promedio de calificaciones, el total de calificaciones, los porcentajes y los comentarios a la vista
        return view('productos.producto', [
            'producto' => $producto,
            'promedioCalificaciones' => $promedioCalificaciones,
            'totalRatings' => $totalRatings,
            'ratingsPercentages' => $ratingsPercentages,
            'comentarios' => $comentarios,

            'productCardView' => $productoCardMejorCalificados,
            'productCardSameLevel' => $productoCardMismoNivel
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit')->with('producto', $producto);
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

    public function rate_prod(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:300',
            'id_prod' => 'required|exists:productos,id',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Insertar la calificación en la tabla calificacion_prod
        try {
            DB::table('calificacion_prod')->insert([
                'puntuacion' => $validatedData['puntuacion'],
                'comentario' => $validatedData['comentario'],
                'id_prod' => $validatedData['id_prod'],
                'id_user' => $userId,
                'created_at' => now(), // Marca de tiempo de creación
                'updated_at' => now(), // Marca de tiempo de actualización
            ]);

            // Retornar respuesta exitosa
            return response()->json(['message' => 'Tu reseña se ha enviado correctamente.'], 200);
        } catch (\Exception $e) {
            // Retornar error en caso de excepción
            return response()->json(['message' => 'Error al enviar la reseña: ' . $e->getMessage()], 500);
        }
    }
}
