<?php

namespace App\Data;

use App\Http\Requests\OrderControllerStoreRequest;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

final class OrderData
{
    public function __construct(
        private OrderControllerStoreRequest $request,
        private ExchangeRateRepositoryInterface $exchangeRateRepository,
        private CurrencyRepositoryInterface $currencyRepository
    )
    {}

    public function toArray(): array
    {
        $exchangeRate = $this->exchangeRateRepository->show(
            $this->request->baseCurrency,
            $this->request->currencyToBuy
        );

        $surcharge = $this->currencyRepository
                        ->findByName($this->request->currencyToBuy)
                        ->surcharge;
        
        $cost = round($this->request->currencyToBuyAmount / $exchangeRate->amount, 6);

        return [
            'base_currency_amount' => (float) round($this->request->costInBaseCurrency, 6),
            'currency_label' => strtoupper($this->request->currencyToBuy),
            'currency_amount' => (int) $this->request->currencyToBuyAmount,
            'exchange_rate' => (float) round($exchangeRate->amount, 6),
            'surcharge_percentage' => (float) $surcharge->percentage,
            'surcharge_amount' => (float) round(($cost * ($surcharge->percentage / 100)), 6),
            'discount_percentage' => null,
            'discount_amount' => null
        ];
    }
}