<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DemoApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});







Route::prefix('demo')->group(function () {
    Route::get('/', [DemoApiController::class, 'index']);
    Route::post('/', [DemoApiController::class, 'store']);
    Route::get('/{id}', [DemoApiController::class, 'show']);
    Route::put('/{id}', [DemoApiController::class, 'update']);
    Route::delete('/{id}', [DemoApiController::class, 'destroy']);
});
