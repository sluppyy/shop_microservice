<?php

use App\Http\Controllers\Api\ApiHatProductsController;
use App\Http\Controllers\Api\ApiUserBalancesController;
use App\Http\Controllers\Api\ApiUserHatItemsController;
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
    Route::prefix('hat')->controller(ApiHatProductsController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/buy', 'buyHat');
        Route::get('/{id}', 'show');
    });
});

Route::prefix('inventories')->group(function () {
    Route::prefix('hat')->group(function () {
        Route::get('/', [ApiHatProductsController::class, 'userItems']);
        Route::post('/take', [ApiUserHatItemsController::class, 'takeItems']);
    });
});

Route::prefix('balance')
    ->controller(ApiUserBalancesController::class)
    ->group(function () {
        Route::get('/', 'show');
        Route::middleware('webHook')->post('/give', 'giveCandies');
    });