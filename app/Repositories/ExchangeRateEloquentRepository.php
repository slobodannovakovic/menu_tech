<?php

namespace App\Repositories;

use App\Models\ExchangeRate;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ExchangeRateEloquentRepository implements ExchangeRateRepositoryInterface
{
    public function all(): Collection
    {
        return ExchangeRate::get([
            'base_currency',
            'purchase_currency',
            'amount'
        ]);
    }

    public function show(string $baseCurrency, string $purchaseCurrency): ?ExchangeRate
    {
        return ExchangeRate::where('base_currency', $baseCurrency)
                            ->where('purchase_currency', $purchaseCurrency)
                            ->first([
                                'base_currency', 'purchase_currency', 'amount'
                            ]);
    }
}