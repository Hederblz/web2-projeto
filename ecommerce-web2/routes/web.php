<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// 1. Tela Inicial (Aberta para todos)
Route::get('/', function () {
    return view('welcome');
});

// 2. O Dashboard chato do Breeze agora te joga direto pras categorias
Route::get('/dashboard', function () {
    return redirect('/categorias');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rotas PROTEGIDAS (Só entra se fizer Login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SUAS ROTAS VOLTARAM AQUI!
    Route::resource('categorias', CategoriaController::class);
    Route::resource('produtos', ProdutoController::class);
});

require __DIR__.'/auth.php';