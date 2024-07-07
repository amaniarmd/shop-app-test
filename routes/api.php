<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/{id}', [ProductController::class, 'store'])->middleware('auth:api');
    Route::patch('/{id}', [ProductController::class, 'update'])->middleware('auth:api');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware('auth:api');
});



