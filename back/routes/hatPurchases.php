<?php
use App\Http\Controllers\Products\HatPurchasesController;

Route::middleware('auth')
  ->prefix('hatPurchases')
  ->controller(HatPurchasesController::class)
  ->group(function () {
    Route::get('/', 'index')->name('hatPurchases.index');
  });