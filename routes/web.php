<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//categorias
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/create', [CategoriaController::class, 'create']);
Route::post('/categorias/save', [CategoriaController::class, 'save']);
Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit']);
Route::post('/categorias/update', [CategoriaController::class, 'update']);
Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete']);

//productos
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/create', [ProductoController::class, 'create']);
Route::post('/productos/save', [ProductoController::class, 'save']);
Route::get('/productos/edit/{id}', [ProductoController::class, 'edit']);
Route::post('/productos/update', [ProductoController::class, 'update']);
Route::get('/productos/delete/{id}', [ProductoController::class, 'delete']);


//carrito
Route::get('/carrito', [CarritoController::class, 'index']);
Route::get('/carrito/add/{id}', [CarritoController::class, 'add']);
Route::get('/carrito/delete/{id}', [CarritoController::class, 'delete']);
Route::post('/carrito/update', [CarritoController::class, 'update']);
