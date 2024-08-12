<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CentroAtencionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('Administracion.index');
});
/********************************************/
Route::get('/send-notification', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/send-notification', [NotificationController::class, 'to_users'])->name('notifications.send');
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
Route::post('/notifications/create', [NotificationController::class, 'store'])->name('send-notification.store');
/********************************************/
Route::resource('fabricantes', FabricanteController::class);


Route::resource('Centro_atencion', CentroAtencionController::class);
Route::post('/Centro_atencion/{city}', [CentroAtencionController::class, 'get_city']);
Route::get('/departamentos', [RegisterController::class, 'getDepartamentos']);
Route::get('/municipios/{departamento_id}', [CentroAtencionController::class, 'getMunicipios'])->name('municipios.get');
/*******************************************/
Route::resource('productos', ProductoController::class);

Route::post('productos/search', [ProductoController::class, 'search_filter'])->name('productos.search_filter');
Route::post('productos/rate', [ProductoController::class, 'rate_prod'])->name('productos.rate_prod')->middleware('auth');
Route::post('productos/searchByName', [ProductoController::class, 'searchByName'])->name('productos.searchByName');
Route::get("Administracion/productos/create",[ProductoController::class, "create"])->name('productos.create');
Route::get("Administracion/productos",[ProductoController::class, "index_admin"])->name('productos.index-admin');
/*******************************************/
Route::get('/compra/process/{orderId}',[CompraController::class, "process"])->name('payment.process');
Route::get("producto/pago", [CompraController::class, "pago"])->name("productos.pago");
Route::get("/compra", [CompraController::class, "show"]);
/******************************************/
Route::get('/Login',function () {
    return view('login_&_Register.Login');
});
/*******************************************/
Route::post("carrito/store/{productoId}", [CarritoController::class, 'addProducto'])->name('carrito.add');
Route::get('/carrito/total', [CarritoController::class, 'getCartTotal'])->name('carrito.total');
Route::get("carrito", [CarritoController::class, 'Show']);
Route::put("carrito/update",[CarritoController::class, 'updateQuantity'])->name("carrito.update");
Route::delete("carrito/delete/{productoId}",[CarritoController::class,'removeProducto'])->name("carrito.delete");

/*******************************************/
Route::get('mensajes',[MensajesController::class,"index"])->name('Mensajes.index');
Route::get('mensajes/get-contactlist', [MensajesController::class, 'contact_list_messages']);
Route::get('mensajes/get-messages/{receiver_id}', [MensajesController::class, 'show']);
Route::post('mensajes/searchByName', [MensajesController::class, 'searchByName'])->name('mensajes.searchByName');
Route::get('mensajes/{name}/{id}', [MensajesController::class, "chat_with"]);
Route::post('mensajes/send-message', [MensajesController::class, 'store'])->name('mensajes.send-message');




Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

