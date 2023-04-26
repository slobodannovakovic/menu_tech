<?php

namespace App\Repositories;

use App\Models\Surcharge;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\SurchargeRepositoryInterface;

class SurchargeRepository implements SurchargeRepositoryInterface
{
    public function all(): Collection
    {
        return Surcharge::all();
    }

    public function show(int $surchargeId): ?Surcharge
    {
        return Surcharge::find($surchargeId);
    }
}