<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function all(): Collection;

    public function show(int $orderId): ?Order;

    public function save(Request $request): Order;
}