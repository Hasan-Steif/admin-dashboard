<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);


    Route::middleware(['permission:manage posts'])->group(function () {
        Route::post('/posts', [PostController::class, 'store']);
        Route::put('/posts/{post}', [PostController::class, 'update']);
        Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    });
});
