<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Http\Request;
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

    public function save(Request $request): Order
    {
        return Order::create($request->all());
    }
}