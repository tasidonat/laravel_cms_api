<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Route::get('categories', [CategoryController::class, 'index']);
    //Route::post('categories', [CategoryController::class, 'store']);
    Route::resource('categories', CategoryController::class);
});