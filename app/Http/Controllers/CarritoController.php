<?php

namespace App\Http\Controllers;

use App\Models\carrito;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecarritoRequest;
use App\Http\Requests\UpdatecarritoRequest;

class CarritoController extends Controller
{
    // Agregar un producto al carrito
    public function addProducto(Request $request, $productoId)
    {
        // Lógica para añadir el producto al carrito
        $producto = Producto::findOrFail($productoId); // Busca el producto por su ID
        
        
        $html = '<li class="flex py-6">
                    <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="' . asset('storage/images/productos/' . $producto->foto_prod) . '"
                            alt="' . $producto->nombre_prod . '"
                            class="h-full w-full object-cover object-center">
                    </div>
                    <div class="ml-4 flex flex-1 flex-col">
                        <div>
                            <div class="flex justify-between text-base font-medium text-gray-900 dark:text-gray-100">
                                <h3>
                                    <a href="#">' . $producto->nombre_prod . '</a>
                                </h3>
                                <p class="ml-4">$' . number_format($producto->precio, 2) . '</p>
                            </div>
                            <p class="mt-1 text-sm text-gray-500  dark:text-gray-200">' . $producto->color . '</p>
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                            <p class="text-gray-500  dark:text-gray-100">Qty 1</p>
                            <div class="flex">
                                <button type="button"
                                    class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-600">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>';

        // Retorna la respuesta en formato JSON
        return response()->json(['html' => $html]);
    }

    // Mostrar el carrito
    public function show()
    {
        $carritos = Carrito::where('user_id', auth()->id())->with('producto')->get();

        return view('carrito.show', compact('carritos'));
    }

    // Eliminar un producto del carrito
    public function removeProducto($productoId)
    {
        $carrito = Carrito::where('user_id', auth()->id())->where('producto_id', $productoId)->first();
        if ($carrito) {
            $carrito->delete();
        }

        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
