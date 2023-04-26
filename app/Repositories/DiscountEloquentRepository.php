<?php

namespace App\Repositories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\DiscountRepositoryInterface;

class DiscountEloquentRepository implements DiscountRepositoryInterface
{
    public function all(): Collection
    {
        return Discount::all();
    }

    public function find(int $discontId): ?Discount
    {
        return Discount::find($discontId);
    }

    public function findByCurrencyId(int $currencyId): ?Discount
    {
        return Discount::firstWhere('currency_id', $currencyId);
    }
}