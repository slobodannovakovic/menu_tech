<?php

namespace App\Repositories;

use App\Models\Order;
use App\Data\OrderData;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderEloquentRepository implements OrderRepositoryInterface
{
    public function all(): Collection
    {
        return Order::orderBy('created_at', 'desc')->get();
    }

    public function show(int $orderId): ?Order
    {
        return Order::find($orderId);
    }

    public function save(OrderData $data): Order
    {
        return Order::create($data->toArray());
    }
}