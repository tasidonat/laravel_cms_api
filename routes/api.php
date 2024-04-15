<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{posts}', [PostController::class, 'show']);
Route::get('comments', [CommentController::class, 'index']);
Route::get('comments/{comment}', [CommentController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('categories', [CategoryController::class, 'store']);
    Route::patch('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/{posts}', [PostController::class, 'update']);
    Route::delete('posts/{posts}', [PostController::class, 'destroy']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
});