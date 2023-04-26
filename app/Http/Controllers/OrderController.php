<?php

namespace App\Http\Controllers;

use App\Data\OrderData;
use Illuminate\Http\Response;
use App\Events\OrderCreatedEvent;
use App\Http\Requests\OrderControllerStoreRequest;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private ExchangeRateRepositoryInterface $exchangeRateRepository,
        private CurrencyRepositoryInterface $currencyRepository
    ) {}

    public function index(): Response
    {
        $orders = $this->orderRepository->all();

        return response($orders, 200);
    }

    public function store(OrderControllerStoreRequest $request): Response
    {
        $order = $this->orderRepository->save(
            new OrderData(
                $request,
                $this->exchangeRateRepository,
                $this->currencyRepository
            )
        );

        OrderCreatedEvent::dispatch($order);

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
