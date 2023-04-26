<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CurrencyEloquentRepository implements CurrencyRepositoryInterface
{
    public function all(): Collection
    {
        return Currency::orderBy('name')->get();
    }

    public function findByName(string $name): ?Currency
    {
        return Currency::firstWhere('name', $name);
    }
}