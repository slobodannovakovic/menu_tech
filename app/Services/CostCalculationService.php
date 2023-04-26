<?php

namespace App\Services;

use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class CostCalculationService
{
    public function __construct(
        private ExchangeRateRepositoryInterface $exchangeRateRepository,
        private CurrencyRepositoryInterface $currencyRepository
    ) {}

    public function calculate(
        string $baseCurrency,
        string $purchaseCurrency,
        int $purchaseCurrencyAmount
    ): ?float
    {
        $exchangeRate = $this->exchangeRateRepository->show($baseCurrency, $purchaseCurrency);
        
        if(is_null($exchangeRate)) {
            return null;
        }

        $surchargePercentage = $this->currencyRepository
                        ->findByName($purchaseCurrency)
                        ->surcharge
                        ->percentage;
        $cost = $purchaseCurrencyAmount / $exchangeRate->amount;
        $surchargeAmount = ($surchargePercentage / 100) * $cost;

        return round($cost + $surchargeAmount, 4);
    }
}