<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Doctor\HorarioController;
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
use App\Http\Controllers\AppointmentController; //citas
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'handleChatRequest']);
// Rutas principales

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/atencion_medica', [HomeController::class, 'atencion_medica'])->name('atencion_medica');
route::get('/Administracion/doctor/index', [AdministracionController::class, "doctor"])->middleware('doctor')->name("doctor.index");
route::get('/Administracion/fabricante/index', [AdministracionController::class, "fabricante"])->middleware('fabricante');
Route::get('/Administracion', [ProductoController::class, "index_admin"])->middleware('admin');

// Rutas de notificaciones
Route::middleware('auth')->controller(NotificationController::class)->group(function () {
    Route::get('Administracion/send-notification', 'create')->name('notifications.create');
    Route::post('/send-notification', 'to_users')->name('notifications.send');
    Route::get('notifications', 'index');
    Route::post('/notifications/mark-as-read', 'markAsRead');
    Route::delete('/notifications/{id}', 'destroy');
    Route::post('/notifications/create', 'store')->name('send-notification.store');
});


// Rutas de productos
Route::controller(ProductoController::class)->group(function () {
    Route::middleware('fabricante')->group(function () {
        Route::get('Administracion/fabricante/productos/create', 'create')->name('productos.create');
        Route::post('Administracion/fabricante/productos', 'store')->name('productos.store');
        Route::get('Administracion/fabricante/productos/{producto}/edit', 'edit')->name('productos.edit');
        Route::put('Administracion/fabricante/productos/{producto}', 'update')->name('productos.update');
        Route::delete('Administracion/fabricante/productos/{producto}', 'destroy')->name('productos.destroy');
    });
    // Subgrupo con middleware 'auth'
    Route::middleware('auth')->group(function () {
        Route::post('productos/rate', 'rate_prod')->name('productos.rate_prod');
    });
    // Subgrupo sin middleware'
    Route::get('/productos', 'index')->name('productos.index');
    Route::post('/productos/searchByName', 'searchByName')->name('productos.searchByName');
    Route::get('/productos/{producto}', 'show')->name('productos.show');
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/perfil', 'index')->name('user_perfil');
        Route::get('/perfil/configuracion', 'edit')->name('edit_profile');
        Route::put('/perfil/configuracion', 'update')->name('update_profile');
    });

    Route::get('Administracion/usuarios', 'index_admin')->middleware('auth')->name("get_users");
});

// Rutas de fabricantes
Route::controller(FabricanteController::class)->group(function () {
    Route::get('Administracion/fabricante/productos', 'get_products')->name('get_productos');
    Route::get('Administracion/fabricante/reseñas', 'get_reviews')->name('get_reviews');
    Route::get('Administracion/fabricante/create', 'create')->name('fabricantes.create');
    Route::post('Administracion/fabricante/create', 'store')->name('fabricantes.store');
    Route::get('/Administracion/fabricante/productos/compras', "showAllOrders")->name('showOrders');
    Route::get('/Administracion/fabricante/productos/compras_pendientes', "showPendingOrders")->name('showPendingOrders');
    Route::get('/Administracion/fabricante/productos/compras_canceladas', "showCancellOrders")->name('showCancellOrders');
    Route::get('/Administracion/fabricante/productos/compras_completadas', "showCompletedOrders")->name('showCompletedOrders');
})->middleware('fabricante');


// Rutas de compras
Route::middleware('auth')->controller(CompraController::class)->group(function () {
    Route::get('/compra/process/{orderId}', 'process')->name('payment.process');
    Route::get('producto/pago', 'pago')->name("productos.pago");
    Route::get('/compras', 'show')->name('mis_compras');
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
Route::controller(CentroAtencionController::class)->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('Administracion/Centro_atencion/create', 'create')->name('CentroAtencion.create');
        Route::post('Administracion/Centro_atencion', 'store')->name('CentroAtencion.store');
        Route::get('Administracion/Centro_atencion/{Centro_atencion}', 'show')->name('CentroAtencion.show');
        Route::get('Administracion/{Centro_atencion}/edit', 'edit')->name('CentroAtencion.edit');
        Route::put('Administracion/Centro_atencion/{Centro_atencion}', 'update')->name('CentroAtencion.update');
        Route::patch('Administracion/Centro_atencion/{Centro_atencion}', 'update')->name('CentroAtencion.update');
        Route::delete('Administracion/Centro_atencion/{Centro_atencion}', 'destroy')->name('CentroAtencion.destroy');
    });

    Route::get('/Centro_atencion', 'index')->name('CentroAtencion.index');
    Route::post('/Centro_atencion/{city}', 'get_city');
    Route::post('/Centro_atencion_municipio/{city}', 'get_centros');
});



// Rutas de recursos
Route::controller(ResourcesController::class)->group(function () {
    Route::get('/departamentos', 'getDepartamentos');
    Route::get('/municipios/{departamento_id}', 'getMunicipios')->name('municipios.get');
    Route::get('/categorias-afectacion', 'getCategoriasAfectacion');
    Route::get('/tipos-afectacion/{categoria_id}', 'getTiposAfectacion')->name('tiposAfectacion.get');
    Route::get('/getDoctores/{especialidad}', 'getDoctores')->name('doctores.get');
});




Route::controller(BookController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('Administracion/books', 'index_admin')->name('books.index_admin');
        Route::get('Administracion/books/create', 'create')->name('books.create');   // Muestra el formulario de creación
        Route::post('Administracion/books', 'store')->name('books.store');           // Almacena el nuevo libro
        Route::get('Administracion/books/{book}/edit', 'edit')->name('books.edit');  // Muestra el formulario de edición
        Route::put('Administracion/books/{book}', 'update')->name('books.update');   // Actualiza el libro
        Route::delete('Administracion/books/{book}', 'destroy')->name('books.destroy'); // Elimina el libro
    });
    Route::middleware('auth')->group(function () {
        Route::post('books/rate', 'rate_book')->name('books.rate_book');
    });

    Route::post('books/searchByName', 'searchByName')->name('books.searchByName');
    Route::get('books', 'index')->name('books.index');            // Lista todos los libros
    Route::get('books/{book}', 'show')->name('books.show');       // Muestra un libro específico
});




// Autenticación
Auth::routes();
Route::get("register/patient", [RegisterController::class, "register_patient"])->name("register_patient");
Route::post("register/patient", [RegisterController::class, "create_patient"])->name("create_patient");
Route::get("register/doctor", [RegisterController::class, "register_doctor"])->name("register_doctor");
Route::post("register/doctor", [RegisterController::class, "create_doctor"])->name("create_doctor");

Route::get('doctores', [DoctorController::class, 'index_user'])->name('view_doctores_user');
Route::post('doctores/searchByName', [DoctorController::class, 'searchByName'])->name('doctores.searchByName');
Route::get('doctor/{doctor}', [DoctorController::class, 'show'])->name('show.doctor');


Route::middleware('admin')->group(function () {
    // Rutas Especialidades
    Route::controller(SpecialtyController::class)->group(function () {
        Route::get('/especialidades', 'index');
        Route::get('/especialidades/create', 'create');
        Route::get('/especialidades/{specialty}/edit', 'edit');
        Route::post('/especialidades', 'sendData');
        Route::put('/especialidades/{specialty}', 'update');
        Route::delete('/especialidades/{specialty}', 'destroy');
    });

    // Rutas Reportes
    Route::controller(ChartController::class)->group(function () {
        Route::get('/reportes/citas/line', 'appointments');
        Route::get('/reportes/doctors/column', 'doctors');
        Route::get('/reportes/doctors/column/data', 'doctorsJson');
    });
    Route::resource('Administracion/autores', AutoreController::class);
    Route::resource('Administracion/editoriales', EditorialeController::class);
});


Route::middleware('doctor')->controller(HorarioController::class)->group(function () {
    Route::get('/horario', 'edit');
    Route::post('/horario', 'store');
});



Route::middleware('auth')->group(function () {
    // Rutas de Citas
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/reservarcitas/create', 'create');
        Route::get('/reservarcitas/create/{medico}', 'create_with_medico')->name("create_with_medico");
        Route::post('/reservarcitas', 'store');
        Route::get('/miscitas', 'index');
        Route::get('/miscitas/{appointment}', 'show');
        Route::post('/miscitas/{appointment}/cancel', 'cancel');
        Route::post('/miscitas/{appointment}/confirm', 'confirm');
        Route::get('/miscitas/{appointment}/cancel', 'formCancel');
    });

    // JSON Endpoints
    Route::controller(App\Http\Controllers\Api\SpecialtyController::class)->group(function () {
        Route::get('/especialidades/{specialty}/medicos', 'doctors');
    });

    Route::controller(App\Http\Controllers\Api\HorarioController::class)->group(function () {
        Route::get('/horario/horas', 'hours');
    });
});
