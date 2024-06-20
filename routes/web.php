<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;

Route::get('/', function () {
    return view('Administracion.index');
});

Route::resource('fabricantes', FabricanteController::class);

Route::resource('productos', ProductoController::class);
Route::post('productos/search', [ProductoController::class, 'search_filter'])->name('productos.search_filter');
Route::post('productos/searchByName', [ProductoController::class, 'searchByName'])->name('productos.searchByName');
Route::get("Administracion/productos/create",[ProductoController::class, "create"])->name('productos.create');
Route::get("Administracion/productos",[ProductoController::class, "index_admin"])->name('productos.index-admin');
Route::get('/Login',function () {
    return view('login_&_Register.Login');
});