<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;




Route::get('/products', [ProductController::class, 'index'])->name('product.list');
Route::post('/products/save', [ProductController::class, 'save']);
Route::get('/products/get/{id}', [ProductController::class, 'get']);
Route::post('/products/update', [ProductController::class, 'update']);
Route::get('/products/delete/{id}', [ProductController::class, 'delete']);

Route::post('/orders/save', [ProductController::class, 'saveOrder']);
