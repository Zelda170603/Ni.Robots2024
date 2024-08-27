<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\carrito;
use App\Models\Compra;
use App\Models\Compra_producto;
use App\Notifications\OrdenRealizadaNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Str;

class CompraController extends Controller
{
    private $client;
    private $client_id;
    private $client_secret;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com',
        ]);
        $this->client_id = env('PAYPAL_CLIENT_ID');
        $this->client_secret = env('PAYPAL_CLIENT_SECRET');
    }

    private function getAccessToken()
    {
        try {
            $response = $this->client->request('POST', "/v1/oauth2/token", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => "application/x-www-form-urlencoded",
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ],
                'auth' => [
                    $this->client_id,
                    $this->client_secret,
                    'basic'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            Log::error('Error getting PayPal access token: ' . $e->getMessage());
            return null;
        }
    }

    public function process($orderId)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['error' => 'Unable to obtain access token'], 500);
        }
        try {
            $response = $this->client->request('GET', '/v2/checkout/orders/' . $orderId, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $accessToken"
                ]
            ]);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == "APPROVED") {
                $user = Auth::user()->id;
                $carritos = Carrito::where('user_id', $user)->get();
                if ($carritos->isEmpty()) {
                    return response()->json(['error' => 'No items in cart'], 400);
                }

                $total = $carritos->sum(function ($carrito) {
                    return $carrito->producto->precio * $carrito->cantidad;
                });
                $compra = Compra::create([
                    'user_id' => $user,
                    'compra_id' => Str::random(7),
                    'carrito_id' => $carritos->first()->id,
                    'total' => $total,
                    'status' => 'completada',
                    'paypal_order_id' => $orderId,
                ]);

                foreach ($carritos as $carrito) {
                    // Obtén el producto
                    $producto = Producto::find($carrito->producto_id);
                    // Crea la relación en Compra_Producto con la cantidad y fabricante
                    Compra_Producto::create([
                        'compra_id' => $compra->id,
                        'producto_id' => $carrito->producto_id,
                        'fabricante_id' => $producto->id_fabricante, // Asume que existe un campo 'id_fabricante' en 'productos'
                        'cantidad' => $carrito->cantidad,
                    ]);
                    // Reduce la existencia del producto según la cantidad comprada
                    $producto->existencias -= $carrito->cantidad;
                    $producto->save();
                    // Notifica al fabricante del producto sobre la compra
                    $fabricante = $producto->fabricante->role->user;
                    $fabricante->notify(new OrdenRealizadaNotification($compra, $producto, $carrito->cantidad));
                }
                Carrito::where('user_id', $user)->delete();
                return response()->json(['compra_id' => $compra->id]);
            } else {
                return response()->json(['error' => 'Payment not approved'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error processing PayPal order: ' . $e->getMessage());
            return response()->json(['error' => 'Error processing order: ' . $e->getMessage()], 500);
        }
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

    public function show()
    {
        $user = Auth::user()->id;
        $compras = Compra::with('compraProductos.producto')->where('user_id', $user)->get();
        if ($compras->isEmpty()) {
            $compras = collect(); // Asegurarse de que siempre se pase una colección
        }
        return view('productos.compras', compact('compras'));
    }
}
