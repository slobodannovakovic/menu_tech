<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\CostCalculationController;

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

Route::get('currencies', [CurrencyController::class, 'index']);

Route::get('exchange-rates', [ExchangeRateController::class, 'index']);

Route::get('exchange-rates/{currencyPair}', [
    ExchangeRateController::class, 'show'
]);

Route::get('cost-calculation/{baseCurrency}/{purchaseCurrency}/{baseCurrencyAmount}', [
    CostCalculationController::class, 'calculate'
]);
