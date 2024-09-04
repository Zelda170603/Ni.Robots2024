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

// Rutas principales

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('Administracion', [ProductoController::class, "index_admin"])->middleware('admin');

// Rutas de notificaciones
Route::middleware('auth')->controller(NotificationController::class)->group(function () {
    Route::get('/send-notification', 'create')->name('notifications.create');
    Route::post('/send-notification', 'to_users')->name('notifications.send');
    Route::get('/notifications', 'index');
    Route::post('/notifications/mark-as-read', 'markAsRead');
    Route::delete('/notifications/{id}', 'destroy');
    Route::post('/notifications/create', 'store')->name('send-notification.store');
});


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
Route::middleware('auth')->controller(CompraController::class)->group(function () {
    Route::get('/compra/process/{orderId}', 'process')->name('payment.process');
    Route::get('producto/pago', 'pago')->name("productos.pago");
    Route::get('/compra', 'show');
});

// Rutas de carrito
Route::middleware('auth')->controller(CarritoController::class)->group(function () {
    Route::post('carrito/store/{productoId}', 'addProducto')->name('carrito.add');
    Route::get('/carrito/total', 'getCartTotal')->name('carrito.total');
    Route::get('carrito', 'show');
    Route::put('carrito/update', 'updateQuantity')->name("carrito.update");
    Route::delete('carrito/delete/{productoId}', 'removeProducto')->name("carrito.delete");
});


// Rutas de mensajes

Route::middleware('auth')->controller(MensajesController::class)->group(function () {
    Route::get('mensajes', 'index')->name('mensajes.index');
    Route::get('mensajes/get-contactlist', 'contact_list_messages');
    Route::get('mensajes/get-messages/{receiver_id}', 'show');
    Route::post('mensajes/searchByName', 'searchByName')->name('mensajes.searchByName');
    Route::post('mensajes/get_users', 'get_users')->name('mensajes.get_users');
    Route::get('mensajes/{name}/{id}', 'chat_with');
    Route::post('mensajes/send-message', 'store')->name('mensajes.send-message');
});


// Rutas de centro de atención
Route::resource('Centro_atencion', CentroAtencionController::class);
Route::post('/Centro_atencion/{city}', [CentroAtencionController::class, 'get_city']);

// Rutas de recursos
Route::controller(ResourcesController::class)->group(function () {
    Route::get('/departamentos', 'getDepartamentos');
    Route::get('/municipios/{departamento_id}', 'getMunicipios')->name('municipios.get');
    Route::get('/categorias-afectacion', 'getCategoriasAfectacion');
    Route::get('/tipos-afectacion/{categoria_id}', 'getTiposAfectacion')->name('tiposAfectacion.get');
});


// Rutas de fabricantes
Route::resource('fabricantes', FabricanteController::class);
Route::get('Administracion/productos', [FabricanteController::class, 'get_products']);
Route::get('Administracion/productos/compras', [FabricanteController::class, "showPendingOrders"]);

Route::get('Administracion/Libros/create', [BookController::class, 'create'])->name('books.create');
Route::get('Administracion/Libros', [BookController::class, 'index_admin'])->name('books.index_admin');


Route::controller(BookController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('Administracion/books', 'index_admin')->name('books.index_admin');
        Route::get('Administracion/books/create', 'create')->name('books.create');   // Muestra el formulario de creación
        Route::post('Administracion/books', 'store')->name('books.store');           // Almacena el nuevo libro
        Route::get('Administracion/books/{book}/edit', 'edit')->name('books.edit');  // Muestra el formulario de edición
        Route::put('Administracion/books/{book}', 'update')->name('books.update');   // Actualiza el libro
        Route::delete('Administracion/books/{book}', 'destroy')->name('books.destroy'); // Elimina el libro
    });
    Route::post('books/rate', 'rate_book')->name('books.rate_book');
    Route::post('books/searchByName', 'searchByName')->name('books.searchByName');
    Route::get('books', 'index')->name('books.index');            // Lista todos los libros
    Route::get('books/{book}', 'show')->name('books.show');       // Muestra un libro específico
});

Route::resource('Administracion/autores', AutoreController::class);
Route::resource('Administracion/editoriales', EditorialeController::class);

Route::resource('Administracion/usuarios', UserController::class);




// Autenticación
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
