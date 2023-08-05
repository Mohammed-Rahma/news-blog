<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth' , 'auth.type:user'])->group(function () {
        Route::get('/products/trashed', [ProductsController::class, 'trashed'])->name('products.trashed');
        Route::put('/products/restor/{product}', [ProductsController::class, 'restore'])->name('products.restore');
        Route::delete('/products/{product}/force', [ProductsController::class, 'forceDelete'])->name('products.force-delete');
        Route::resource('/admin/products', ProductsController::class);
        Route::resource('/admin/categories', CategoriesController::class);
    });
