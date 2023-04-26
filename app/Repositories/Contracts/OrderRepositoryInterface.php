<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use App\Data\OrderData;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function all(): Collection;

    public function show(int $orderId): ?Order;

    public function save(OrderData $data): Order;
}