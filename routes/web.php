<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('dashboard', function(){
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::prefix('dashboard')->middleware('auth')->group(function(){
    // Products
    Route::prefix('products')->middleware('auth')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('category/{id}', [ProductController::class, 'index'])->name('products.filter');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('create', [ProductController::class, 'store'])->name('products.store');
    });
    Route::prefix('product')->group(function(){
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
        Route::put('edit/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
        Route::get('{id}', [ProductController::class, 'show'])->name('product.show')->middleware('auth');
        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('auth');
    });

    /*
     * Categorias
     */
    Route::get('categorias', static function () {
        return view('admin.categories.index');
    })->name('categorias.index');

    // Archives
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index')->middleware('auth');
    Route::post('/archives', [ArchiveController::class, 'store'])->name('archives.store')->middleware('auth');
    Route::delete('/archive/delete/{id}', [ArchiveController::class, 'destroy']);
});
