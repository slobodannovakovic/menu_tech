<?php

namespace App\Listeners;

use App\Data\OrderData;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\DiscountRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class ApplyOrderDiscountListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private CurrencyRepositoryInterface $currencyRepository,
        private ExchangeRateRepositoryInterface $exchangeRateRepository,
        private DiscountRepositoryInterface $discountRepository,
        private OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $currency = $this->currencyRepository->findByName(
            strtolower($event->order->currency_label)
        );
        $discount = $this->discountRepository->findByCurrencyId($currency->id);

        if(!is_null($discount)) {
            $discountAmount = ($discount->amount / 100) * $event->order->base_currency_amount;
            $dataToAdd = [
                'base_currency_amount' => $event->order->base_currency_amount - $discountAmount,
                'discount_percentage' => $discount->amount,
                'discount_amount' => round($discountAmount, 6)
            ];

            $orderData = new OrderData(
                $event->request,
                $this->exchangeRateRepository,
                $this->currencyRepository,
                $dataToAdd
            );

            $this->orderRepository->update($event->order->id, $orderData);
        }
    }
}
