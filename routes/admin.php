<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('can:view dashboard')
            ->name('dashboard');

        // Users
        Route::resource('users', UserController::class)
            ->middleware('can:manage users');

        // Roles
        Route::resource('roles', RoleController::class)
            ->middleware('can:manage roles');

        // Permissions
        Route::resource('permissions', PermissionController::class)
            ->middleware('can:manage permissions');

        // Blog - Posts
        Route::resource('posts', PostController::class)
            ->middleware('can:manage posts');

        // Blog - Categories
        Route::resource('categories', CategoryController::class)
            ->except(['show'])
            ->middleware('can:manage categories');

        // Blog - Comments
        Route::resource('comments', CommentController::class)
            ->only(['index', 'edit', 'update', 'destroy'])
            ->middleware('can:manage comments');
    });
