<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;

// Route::get('admin', function(){
//     return view('admin.layout.dashboard');
// })->middleware('auth')->name('admin');
Route::get('admin', function(){
    return view('home.index');
})->middleware('auth')->name('admin');

Route::get('/', function(){
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/admin');
})->name('dashboard');


Route::prefix('admin')->middleware('auth')->group(function(){
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

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
    Route::prefix('category')->group(function(){
        Route::get('create', [CategoryController::class, 'create'])->name('category.create')->middleware('auth');
        Route::post('create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('auth');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
        Route::put('edit/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');
    });

    // Archives
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index')->middleware('auth');
    Route::post('/archives', [ArchiveController::class, 'store'])->name('archives.store')->middleware('auth');
    Route::delete('/archive/delete/{id}', [ArchiveController::class, 'destroy']);
});
