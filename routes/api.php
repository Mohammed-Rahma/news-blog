<?php

use App\Http\Controllers\api\V1\LoginController;
use App\Http\Controllers\Api\V1\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products' , ProductsController::class); 
Route::post('/access-tokens' , [LoginController::class , 'store'])->middleware('guest:sanctum');
Route::delete('/access-tokens' , [LoginController::class , 'destory'])->middleware('auth:sanctum');
Route::get('/access-tokens' , [LoginController::class , 'index'])->middleware('auth:sanctum');
