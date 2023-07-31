<?php

use Illuminate\Support\Facades\Route;

Route::get('/' , [HomeController::class , 'index'])->name('home');
Route::get('/products/{details}' , [ProductDetailsController::class , 'show'])->name('products-details');