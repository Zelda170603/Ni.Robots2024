<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CentroAtencionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\AutoreController;
use App\Http\Controllers\EditorialeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

// Rutas principales

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('Administracion', [AdministracionController::class, "index"])->middleware(CheckRole::class);

// Rutas de notificaciones
Route::get('/send-notification', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/send-notification', [NotificationController::class, 'to_users'])->name('notifications.send');
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
Route::post('/notifications/create', [NotificationController::class, 'store'])->name('send-notification.store');

// Rutas de productos

Route::controller(ProductoController::class)->group(function () {
    // Rutas sin middleware adicional
    Route::get('/productos', 'index')->name('productos.index');
    Route::get('Administracion/productos', 'index_admin')->name('productos.index-admin');
    Route::get('Administracion/productos/create', 'create')->name('productos.create');
    Route::post('/productos', 'store')->name('productos.store');
    Route::post('productos/searchByName', 'searchByName')->name('productos.searchByName');
    Route::get('/productos/{producto}', 'show')->name('productos.show');
    Route::get('/productos/{producto}/edit', 'edit')->name('productos.edit');
    Route::put('/productos/{producto}', 'update')->name('productos.update');
    Route::delete('/productos/{producto}', 'destroy')->name('productos.destroy');
    // Subgrupo con middleware 'auth'
    Route::middleware('auth')->group(function () {
        Route::post('productos/rate', 'rate_prod')->name('productos.rate_prod');
    });
});

// Rutas de compras
Route::get('/compra/process/{orderId}', [CompraController::class, "process"])->name('payment.process');
Route::get('producto/pago', [CompraController::class, "pago"])->name("productos.pago");
Route::get('/compra', [CompraController::class, "show"]);

// Rutas de carrito
Route::post('carrito/store/{productoId}', [CarritoController::class, 'addProducto'])->name('carrito.add');
Route::get('/carrito/total', [CarritoController::class, 'getCartTotal'])->name('carrito.total');
Route::get('carrito', [CarritoController::class, 'show']);
Route::put('carrito/update', [CarritoController::class, 'updateQuantity'])->name("carrito.update");
Route::delete('carrito/delete/{productoId}', [CarritoController::class, 'removeProducto'])->name("carrito.delete");

// Rutas de mensajes
Route::get('mensajes', [MensajesController::class, "index"])->name('mensajes.index');
Route::get('mensajes/get-contactlist', [MensajesController::class, 'contact_list_messages']);
Route::get('mensajes/get-messages/{receiver_id}', [MensajesController::class, 'show']);
Route::post('mensajes/searchByName', [MensajesController::class, 'searchByName'])->name('mensajes.searchByName');
Route::get('mensajes/{name}/{id}', [MensajesController::class, "chat_with"]);
Route::post('mensajes/send-message', [MensajesController::class, 'store'])->name('mensajes.send-message');

// Rutas de centro de atención
Route::resource('Centro_atencion', CentroAtencionController::class);
Route::post('/Centro_atencion/{city}', [CentroAtencionController::class, 'get_city']);

// Rutas de recursos
Route::get('/departamentos', [ResourcesController::class, 'getDepartamentos']);
Route::get('/municipios/{departamento_id}', [ResourcesController::class, 'getMunicipios'])->name('municipios.get');
Route::get('/categorias-afectacion', [ResourcesController::class, 'getCategoriasAfectacion']);
Route::get('/tipos-afectacion/{categoria_id}', [ResourcesController::class, 'getTiposAfectacion'])->name('tiposAfectacion.get');

// Rutas de fabricantes
Route::resource('fabricantes', FabricanteController::class);
Route::get('Administracion/productos', [FabricanteController::class, 'get_products']);
Route::get('Administracion/productos/compras', [FabricanteController::class, "showPendingOrders"]);
Route::get('Administracion/Libros/create', [BookController::class, 'create'])->name('books.create');
Route::get('Administracion/Libros', [BookController::class, 'index_admin'])->name('books.index_admin');

Route::resource('books', BookController::class);

Route::resource('Administracion/autores', AutoreController::class);
Route::resource('Administracion/editoriales', EditorialeController::class);
Route::resource('Administracion/usuarios', UserController::class);


Route::get('/books/{id}', [BookController::class, 'visor'])->name('books.show');
Route::get('/booksVISOR/{id}', [BookController::class, 'visor'])->name('books.visor');

// Autenticación
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
