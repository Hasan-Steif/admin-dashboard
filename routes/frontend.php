<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Support\Facades\Route;








// routes/web.php
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('frontend.comments.store');
