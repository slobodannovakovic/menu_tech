<?php

namespace App\Repositories\Contracts;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Collection;

interface ExchangeRateRepositoryInterface
{
    public function all(): Collection;

    public function show(string $baseCurrency, string $purchaseCurrency): ?ExchangeRate;
}