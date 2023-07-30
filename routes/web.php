<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductDetailsController;
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
Route::get('/products/trashed' , [ProductsController::class , 'trashed'])->name('products.trashed');
Route::put('/products/restor/{product}' , [ProductsController::class  , 'restore'])->name('products.restore');
Route::delete('/products/{product}/force' , [ProductsController::class , 'forceDelete'])->name('products.force-delete');
Route::get('/' , [HomeController::class , 'index'])->name('home');
Route::get('/products/{details}' , [ProductDetailsController::class , 'show'])->name('products-details');