<?php

use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [HomeController::class , 'index'])->name('home');
Route::get('/products/{details}' , [ProductDetailsController::class , 'show'])->name('products-details');

Route::get('/cart' , [CartController::class , 'index'])->name('cart');
Route::post('/cart' , [CartController::class , 'store']);
Route::delete('/cart/{id}' , [CartController::class , 'destroy'])->name('cart.destroy'); 
// Route::put('/profile' , [ProfileController::class, 'edit'])->name('profile.update');