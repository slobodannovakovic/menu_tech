<?php

namespace App\Services;

use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class CostCalculationService
{
    public function __construct(
        private ExchangeRateRepositoryInterface $exchangeRateRepository
    ) {}

    public function calculate(
        string $baseCurrency,
        string $purchaseCurrency,
        int $baseCurrencyAmount
    ): ?float
    {
        $exchangeRate = $this->exchangeRateRepository->show($baseCurrency, $purchaseCurrency);
        
        if(is_null($exchangeRate)) {
            return null;
        }

        return round($baseCurrencyAmount / $exchangeRate->amount, 4);
    }
}