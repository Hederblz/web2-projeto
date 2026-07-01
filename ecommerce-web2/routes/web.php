<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\CacheBrowser;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->middleware(CacheBrowser::class);

Route::get('/dashboard', function () {
    return redirect('/categorias');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index')
        ->middleware(CacheBrowser::class);
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show')
        ->middleware(CacheBrowser::class);
    Route::resource('categorias', CategoriaController::class)->except(['index', 'show']);

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index')
        ->middleware(CacheBrowser::class);
    Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show')
        ->middleware(CacheBrowser::class);
    Route::resource('produtos', ProdutoController::class)->except(['index', 'show']);

    Route::resource('pedidos', App\Http\Controllers\PedidoController::class);
});

require __DIR__.'/auth.php';