<?php
use App\Http\Controllers\UserBalancesController;

Route::middleware('auth')
  ->prefix('balance')
  ->controller(UserBalancesController::class)
  ->group(function () {
    Route::get('/', 'index')->name('balance.index');
  });