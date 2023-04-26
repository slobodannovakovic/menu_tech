<?php

namespace App\Repositories\Contracts;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection;

interface DiscountRepositoryInterface
{
    public function all(): Collection;

    public function find(int $discontId): ?Discount;

    public function findByCurrencyId(int $currencyId): ?Discount;
}