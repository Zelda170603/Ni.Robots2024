<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Doctor\HorarioController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CentroAtencionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\AutoreController;
use App\Http\Controllers\EditorialeController;
use App\Http\Controllers\AppointmentController; //citas
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\Api\FabricanteDashboardController;
use App\Http\Controllers\Api\DoctorDashboardController;

Route::post('/chatbot', [ChatbotController::class, "handleChatRequest"]);

// Rutas principales

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/atencion_medica', [HomeController::class, 'atencion_medica'])->name('atencion_medica');
route::get('/Administracion/doctor/index', [AdministracionController::class, "doctor"])->middleware('doctor')->name("doctor.index");
route::get('/Administracion/fabricante/index', [AdministracionController::class, "fabricante"])->middleware('fabricante');


// Rutas del Dashboard 
Route::controller(DashboardController::class)->group(function () {
    Route::get('/Administracion', 'index')->name('dashboard');
    Route::get('/Administracion/export-doctors', 'exportDoctors')->name('dashboard.export.doctors');
    Route::get('/Administracion/export-sales-manufacturer', 'exportSalesByManufacturer')->name('dashboard.export.sales.manufacturer');
    Route::get('/Administracion/usuarios-por-ciudad',  'mapaUsuarios');
});
// Rutas de notificaciones
Route::middleware('auth')->controller(NotificationController::class)->group(function () {
    Route::get('/send-notification', 'create')->name('notifications.create');
    Route::post('/send-notification', 'to_users')->name('notifications.send');
    Route::get('/notifications', 'index');
    Route::post('/notifications/mark-as-read', 'markAsRead');
    Route::delete('/notifications/{id}', 'destroy');
    Route::post('/notifications/create', 'store')->name('send-notification.store');
});


Route::get('books', [BookController::class, 'index_admin'])->name('books.index_admin');
    Route::get('books/export-excel', [BookController::class, 'exportExcel'])->name('books.exportExcel');
    Route::get('books/export-pdf', [BookController::class, 'exportPDF'])->name('books.exportPDF');

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


Route::controller(ProfileController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/perfil', 'index')->name('user_perfil');
        Route::get('/perfil/configuracion', 'edit')->name('edit_profile');
        Route::put('/perfil/configuracion', 'update')->name('update_profile');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('Administracion/usuarios', 'index_admin')->name('get_users');
    });
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
  // Videollamada (AGORA + Polling)
    Route::post('mensajes/start-video-call', 'startVideoCall')->name('mensajes.start-video-call');
    Route::post('mensajes/accept-video-call', 'acceptVideoCall')->name('mensajes.accept-video-call');
    Route::post('mensajes/end-video-call', 'endVideoCall')->name('mensajes.end-video-call');
    Route::post('mensajes/check-video-call-status', 'checkVideoCallStatus')->name('mensajes.check-video-call-status');
    Route::post('mensajes/cleanup-expired-calls', 'cleanupExpiredCalls')->name('mensajes.cleanup-expired-calls');
}
);


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

Route::resource('Administracion/autores', AutoreController::class);
Route::resource('Administracion/editoriales', EditorialeController::class);


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
    // Rutas Médicos
    Route::resource('medicos', 'App\Http\Controllers\Admin\DoctorController');

    // Rutas Pacientes
    Route::resource('pacientes', 'App\Http\Controllers\Admin\PatientController');

    // Rutas Reportes
    Route::controller(ChartController::class)->group(function () {
        Route::get('/reportes/citas/line', 'appointments');
        Route::get('/reportes/doctors/column', 'doctors');
        Route::get('/reportes/doctors/column/data', 'doctorsJson');
    });
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


Route::controller(UserController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        // Rutas principales de usuarios
        Route::get('Administracion/usuarios', 'index_admin')->name('usuarios.index');
        Route::get('Administracion/usuarios/create', 'create')->name('usuarios.create');
        Route::post('Administracion/usuarios', 'store')->name('usuarios.store');
        Route::get('Administracion/usuarios/{user}/edit', 'edit')->name('usuarios.edit');
        Route::put('Administracion/usuarios/{user}', 'update')->name('usuarios.update');
        Route::delete('Administracion/usuarios/{user}', 'destroy')->name('usuarios.destroy');
        
        // Rutas de exportación
        Route::get('Administracion/usuarios/export-excel', 'exportExcel')->name('usuarios.exportExcel');
        Route::get('Administracion/usuarios/export-pdf', 'exportPDF')->name('usuarios.exportPDF');
    });
});

// Rutas para exportación del dashboard
Route::get('/dashboard/export', [DashboardController::class, 'exportView'])->name('dashboard.export.view');
// Rutas para exportación directa del dashboard
Route::get('/dashboard/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPDF'])->name('dashboard.export.pdf');

Route::middleware('web')->get('/session/check', function (\Illuminate\Http\Request $request) {
    if (!auth()->check()) {
        return response()->json(['ok'=>false, 'reason'=>'guest'], 401);
    }
    $ok = auth()->user()->current_session_id === $request->session()->getId();
    return $ok
        ? response()->json(['ok'=>true])
        : response()->json(['ok'=>false, 'reason'=>'stale'], 409);
})->name('session.check');


//Ruta para mis pacientes
Route::middleware(['auth', 'doctor'])->get('/pacientes', [UserController::class, 'misPacientes'])->name('doctor.pacientes');

//Rutas para expedientes médicos
Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/expedientes/{pacienteId}', [ExpedienteController::class, 'show'])->name('expedientes.show');
    Route::post('/expedientes', [ExpedienteController::class, 'store'])->name('expedientes.store');
    Route::get('/expedientes/{expedienteId}/details', [ExpedienteController::class, 'getExpediente'])->name('expedientes.details');
    
    // Nuevas rutas para exportar
    Route::get('/expedientes/export/excel/{pacienteId?}', [ExpedienteController::class, 'exportExcel'])->name('expedientes.export.excel');
    Route::get('/expedientes/export/pdf/{pacienteId?}', [ExpedienteController::class, 'exportPDF'])->name('expedientes.export.pdf');
    Route::get('/expedientes/reportes/{pacienteId?}', [ExpedienteController::class, 'reportes'])->name('expedientes.reportes');
});


//Rutas de chepe, dashboa
Route::prefix('api/fabricante')->middleware('fabricante')->group(function () {
    Route::get('/ventas-semana', [FabricanteDashboardController::class, 'ventasUltimaSemana']);
    Route::get('/ventas-por-categoria', [FabricanteDashboardController::class, 'ventasPorCategoria']);
    Route::get('/productos-mas-vendidos', [FabricanteDashboardController::class, 'productosMasVendidos']);
    Route::get('/compras-por-estado', [FabricanteDashboardController::class, 'comprasPorEstado']);
});

Route::middleware('doctor')->get('/api/doctor/pacientes-por-afectacion', [DoctorDashboardController::class, 'pacientesPorAfectacion']);
Route::middleware('doctor')->get('/api/doctor/citas-semana', [DoctorDashboardController::class, 'citasUltimaSemana']);
Route::middleware('doctor')->get('/api/doctor/niveles-afectacion', [DoctorDashboardController::class, 'pacientesPorNivelAfectacion']);


//rutas api

