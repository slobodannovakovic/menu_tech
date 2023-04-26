<?php

namespace App\Repositories\Contracts;

use App\Models\Surcharge;
use Illuminate\Database\Eloquent\Collection;

interface SurchargeRepositoryInterface
{
    public function all(): Collection;

    public function show(int $surchargeId): ?Surcharge;
}