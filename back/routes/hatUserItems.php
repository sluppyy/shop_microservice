<?php

use App\Http\Controllers\UserItems\HatUserItemsController;

Route::middleware('auth')
  ->prefix('hatUserItems')
  ->controller(HatUserItemsController::class)
  ->group(function () {
    Route::get('/', 'index')->name('hatUserItems.index');
  });