<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//roles
Route::middleware(['auth','admin'])->group(function () {

//categorias admin
    Route::get('/admin/categorias', [CategoriaController::class, 'index']);
    Route::get('/admin/categorias/create', [CategoriaController::class, 'create']);
    Route::post('/admin/categorias/save', [CategoriaController::class, 'save']);
    Route::get('/admin/categorias/edit/{id}', [CategoriaController::class, 'edit']);
    Route::post('/admin/categorias/update', [CategoriaController::class, 'update']);
    Route::get('/admin/categorias/delete/{id}', [CategoriaController::class, 'delete']);

//productos admin
    Route::get('/admin/productos', [ProductoController::class, 'index']);
    Route::get('/admin/productos/create', [ProductoController::class, 'create']);
    Route::post('/admin/productos/save', [ProductoController::class, 'save']);
    Route::get('/admin/productos/edit/{id}', [ProductoController::class, 'edit']);
    Route::post('/admin/productos/update', [ProductoController::class, 'update']);
    Route::get('/admin/productos/delete/{id}', [ProductoController::class, 'delete']);
});
//carrito
Route::get('/carrito', [CarritoController::class, 'index']);
Route::get('/carrito/add/{id}', [CarritoController::class, 'add']);
Route::get('/carrito/delete/{id}', [CarritoController::class, 'delete']);
Route::post('/carrito/update', [CarritoController::class, 'update']);

//pedidos
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::get('/pedidos/crear', [PedidoController::class, 'crearPedido']);
Route::get('/pedidos/detalle/{id}', [PedidoController::class, 'detalle']);



