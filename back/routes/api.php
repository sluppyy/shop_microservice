<?php

use App\Http\Controllers\Api\ApiHatProductsController;
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

Route::prefix('products')->group(function () {
    Route::prefix('hat')->group(function () {
        Route::get('/', [ApiHatProductsController::class, 'index']);
        Route::get('/{id}', [ApiHatProductsController::class, 'show']);
    });
});