<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\NotificationController;
use App\Models\Mensajes;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('Administracion.index');
});
/********************************************/

Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
Route::post('/notifications/create', [NotificationController::class, 'store'])->name('send-notification.store');
/********************************************/
Route::resource('fabricantes', FabricanteController::class);
/*******************************************/
Route::resource('productos', ProductoController::class);
Route::post('productos/search', [ProductoController::class, 'search_filter'])->name('productos.search_filter');
Route::post('productos/searchByName', [ProductoController::class, 'searchByName'])->name('productos.searchByName');
Route::get("Administracion/productos/create",[ProductoController::class, "create"])->name('productos.create');
Route::get("Administracion/productos",[ProductoController::class, "index_admin"])->name('productos.index-admin');
Route::get('/Login',function () {
    return view('login_&_Register.Login');
});
/*******************************************/
Route::get('mensajes',[MensajesController::class,"index"])->name('Mensajes.index');
Route::get('mensajes/get-contactlist', [MensajesController::class, 'contact_list_messages']);
Route::get('mensajes/get-messages/{receiver_id}', [MensajesController::class, 'show']);
Route::post('mensajes/searchByName', [MensajesController::class, 'searchByName'])->name('mensajes.searchByName');
Route::get('mensajes/{name}/{id}', [MensajesController::class, "chat_with"]);
Route::post('mensajes/send-message', [MensajesController::class, 'store'])->name('mensajes.send-message');
Route::get('mensajes/prueba', function(){
    return view('mensajes.prueba');
});


Auth::routes();
/******************************************
Route::get('/home', [HomeController::class, 'index'])->name('home');*/
