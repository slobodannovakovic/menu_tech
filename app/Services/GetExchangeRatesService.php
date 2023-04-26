<?php

namespace App\Services;

use App\Services\HttpService;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class GetExchangeRatesService
{
    public function syncRatesWithApi(
        HttpService $httpService,
        ExchangeRateRepositoryInterface $exchangeRateRepository
    ): void
    {
        $exchangeRates = $httpService->get(
            'https://api.apilayer.com/currency_data/live',
            'source=USD&currencies=EUR%2CGBP%2CJPY&apikey=NUw93cpGEiDJp5rX1v5RkZofIAsXtz4Q'
        );

        foreach($exchangeRates['quotes'] as $rate => $amount) {
            $exchangeRateRepository->update(
                strtolower($exchangeRates['source']),
                strtolower(substr($rate, -3)),
                ['amount' => $amount]
            );
        }
    }
}