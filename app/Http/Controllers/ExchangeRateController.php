<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class ExchangeRateController extends Controller
{
    public function __construct(
        private ExchangeRateRepositoryInterface $exchangeRateRepository
    ) {}

    public function index(): Response
    {
        $exchangeRates = $this->exchangeRateRepository->all();

        return response($exchangeRates, 200);
    }

    public function show(string $currencyPair): Response
    {
        $currencies = explode('-', $currencyPair);

        if(!isset($currencies[1])) {
            return response(['error' => 'Exchange Rate Not Found'], 404);
        }

        $exchangeRate = $this->exchangeRateRepository->show(
                            baseCurrency: $currencies[0],
                            purchaseCurrency: $currencies[1]
                        );

        return $exchangeRate
                ? response($exchangeRate, 200)
                : response(['error' => 'Exchange Rate Not Found'], 404);
    }
}
