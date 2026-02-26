<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/create', [CategoriaController::class, 'create']);
Route::post('/categorias/save', [CategoriaController::class, 'save']);
Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit']);
Route::post('/categorias/update', [CategoriaController::class, 'update']);
Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete']);
