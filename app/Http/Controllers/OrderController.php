<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Contracts\OrderRepositoryInterface;

use function Symfony\Component\String\b;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {}

    public function index(): Response
    {
        $orders = $this->orderRepository->all();

        return response($orders, 200);
    }

    public function store(Request $request): Response
    {
        $order = $this->orderRepository->save($request);

        return response($order, 201);
    }

    public function show(int $orderId): Response
    {
        $order = $this->orderRepository->show($orderId);

        if(is_null($order)) {
            return response(['error' => 'Order Not Found'], 404);
        }

        return response($order, 200);
    }
}
