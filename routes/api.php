<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user',    function (Request $req) {
        return $req->user();
    });

    Route::prefix('posts')->group(function () {
        Route::get('/',       [PostController::class, 'index']);
        Route::get('/{post}', [PostController::class, 'show']);

        Route::middleware('permission:manage posts')->group(function () {
            Route::post('/',        [PostController::class, 'store']);
            Route::put('/{post}',   [PostController::class, 'update']);
            Route::delete('/{post}', [PostController::class, 'destroy']);
        });
    });
});
