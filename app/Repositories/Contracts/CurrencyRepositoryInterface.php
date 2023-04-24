<?php

namespace App\Repositories\Contracts;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyRepositoryInterface
{
    public function all(): Collection;
}