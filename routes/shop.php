<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [HomeController::class , 'index'])->name('home');
Route::get('/products/{details}' , [ProductDetailsController::class , 'show'])->name('products-details');

// Route::put('/profile' , [ProfileController::class, 'edit'])->name('profile.update');