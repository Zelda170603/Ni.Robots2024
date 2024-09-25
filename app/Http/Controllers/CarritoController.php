<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\carrito;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecarritoRequest;
use App\Http\Requests\UpdatecarritoRequest;

class CarritoController extends Controller
{
    // Agregar un producto al carrito
    public function addProducto($productoId)
    {
        // Lógica para añadir el producto al carrito
        Producto::findOrFail($productoId);
        // Crear o actualizar el carrito para el usuario
        $carrito = Carrito::where('user_id', Auth::id())->where('producto_id', $productoId)->first();
        if ($carrito) {
            // Establecer la cantidad a 1 para asegurar que solo una unidad sea mostrada
            $carrito->cantidad = 1;
            $carrito->save();
        } else {
            // Crear una nueva entrada en el carrito con cantidad 1
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $productoId,
                'cantidad' => 1
            ]);
        }
        return response()->json(['html' => "success"]);
    }


    public function show()
    {
        $carritos = Carrito::where('user_id', auth()->id())->with('producto')->get();

        $html = '';

        foreach ($carritos as $carrito) {
            $producto = $carrito->producto;
            $productoId = $producto->id;
            $html .= '<li class="flex items-center py-6">
                        <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-400 dark:border-gray-200">
                            <img src="' . asset('storage/images/productos/' . $producto->foto_prod) . '"
                                alt="' . $producto->nombre_prod . '"
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="ml-4 flex flex-1 flex-col">
                            <div>
                                <div class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                    <h3><a href="#">' . $producto->nombre_prod . '</a></h3>
                                    <p class="ml-4" id="price-' . $productoId . '" data-price="' . $producto->precio . '">$' . number_format($producto->precio * $carrito->cantidad, 2) . '</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-200">' . $producto->color . '</p>
                            </div>
                            <div class="flex items-end justify-between text-sm">
                                <label for="counter-input-' . $productoId . '" class="sr-only">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center">
                                        <button type="button" onclick="decrementQuantity(' . $productoId . ')" id="decrement-button-' . $productoId . '" data-input-counter-decrement="counter-input-' . $productoId . '" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2 w-2 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <input type="text" id="counter-input-' . $productoId . '" data-input-counter class="w-8 shrink-0 border-0 bg-transparent text-center text-sm font-light text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="' . $carrito->cantidad . '" required data-stock="' . $producto->existencias . '"/>
                                        <button type="button" onclick="incrementQuantity(' . $productoId . ')" id="increment-button-' . $productoId . '" data-input-counter-increment="counter-input-' . $productoId . '" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2 w-2 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" onclick="deleteProductFromCart(' . $productoId . ')" class="self-center font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-600" data-product-id="' . $productoId . '">
                                    <svg class="w-5 h-5 pb-2 text-gray-800 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>';
        }

        return response()->json(['html' => $html]);
    }



    // Eliminar un producto del carrito
    public function removeProducto($productoId)
    {
        // Buscar el carrito del usuario con el producto dado
        $carrito = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $productoId)
            ->firstOrFail();
        // Eliminar el producto del carrito
        $carrito->delete();
        return response()->json(['success' => true, 'message' => 'Producto eliminado del carrito']);
    }


    public function updateQuantity(Request $request)
    {
        try {
            // Validar la solicitud
            // Actualizar la cantidad en el carrito
            $carrito = Carrito::where('user_id', Auth::id())
                ->where('producto_id', $request->productoId)
                ->firstOrFail();

            $carrito->cantidad = $request->cantidad;
            $carrito->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getCartTotal()
    {
        $carritos = Carrito::where('user_id', auth()->id())->with('producto')->get();
        $subtotal = 0;
        foreach ($carritos as $carrito) {
            $subtotal += $carrito->producto->precio * $carrito->cantidad;
        }
        $tax = $subtotal * 0.15; // 15% de IVA
        $total = $subtotal + $tax;
        return response()->json([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    public function pago()
    {
        $carritos = Carrito::where('user_id', auth()->id())->with('producto')->get();
        $user = User::Where('id', Auth::id());
        $subtotal = 0;

        foreach ($carritos as $carrito) {
            $subtotal += $carrito->producto->precio * $carrito->cantidad;
        }

        $tax = $subtotal * 0.15;
        $total = $subtotal + $tax;

        return view('Productos.pago', [
            'carritos' => $carritos,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'user' => $user,
        ]);
    }
}
