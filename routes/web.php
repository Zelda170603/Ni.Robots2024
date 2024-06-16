<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('fabricantes', FabricanteController::class);

Route::resource('productos', ProductoController::class);
Route::get('productos/search', [ProductoController::class, 'search_filter'])->name('productos.search_filter');

Route::get('/Login',function () {
    return view('login_&_Register.Login');
});