<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;


Route::get('/', function () {
    return view('home.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('auth');
Route::get('/products/category/{id}', [ProductController::class, 'index'])->name('products.filter')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products/create', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::put('/product/edit/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('auth');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('auth');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('auth');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');

// Archives
Route::get('/archives', [ArchiveController::class, 'index'])->name('archives')->middleware('auth');
Route::post('/archives', [ArchiveController::class, 'store'])->name('archives.store')->middleware('auth');
Route::delete('/archive/delete/{id}', [ArchiveController::class, 'destroy']);

