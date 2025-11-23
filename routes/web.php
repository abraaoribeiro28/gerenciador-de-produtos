<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::prefix('dashboard')->middleware('auth')->group(function(){
    /*
     * Categorias
     */
    Route::get('categorias', static function () {
        return view('admin.categories.index');
    })->name('categorias.index');

    /*
     * Produtos
     */
    Route::get('produtos', static function () {
       return view('admin.products.index');
    })->name('produtos.index');

    // Archives
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index')->middleware('auth');
    Route::post('/archives', [ArchiveController::class, 'store'])->name('archives.store')->middleware('auth');
    Route::delete('/archive/delete/{id}', [ArchiveController::class, 'destroy']);
});
