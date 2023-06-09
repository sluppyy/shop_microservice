<?php
use App\Http\Controllers\Products\HatProductsController;

Route::middleware('auth')
  ->prefix('hatProducts')
  ->controller(HatProductsController::class)
  ->group(function () {
    Route::get('/', 'index')->name('hatProducts.index');
    Route::get('/create', 'create')->name('hatProducts.create');
    Route::post('/', 'store')->name('hatProducts.store');
    Route::get('/{id}/edit', 'edit')->name('hatProducts.edit');
    Route::patch('/{id}', 'update')->name('hatProducts.update');
    Route::delete('/{id}', 'destroy')->name('hatProducts.destroy');
  });