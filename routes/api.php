<?php

use Illuminate\Support\Facades\Route;
use Omotolaawokunle\ExchangeRate\Http\Controllers\ExchangeRateController;

Route::prefix('/api/exchange')->middleware('api')->group(function () {
    Route::post('/', [ExchangeRateController::class, 'getExchangeRate'])->name('exchange-rate.index');
    Route::view('docs', 'exchange-rate::docs');
});
