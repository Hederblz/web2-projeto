<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;

Route::resource('categorias', CategoriaController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('users', UserController::class);
