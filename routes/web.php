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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/admin/products' , ProductsController::class);
Route::resource('/admin/categories' , CategoriesController::class);
Route::get('/admin/products/trashed' , [ProductsController::class , 'trashed'])->name('products.trashed');
Route::put('/admin/products/{product}/retore' , [ProductsController::class , 'reatore'])->name('products.reatore');
Route::delete('/admin/products/{product}/forceDelete' , [ProductsController::class , 'forceDelete'])->name('products.forceDelete');


