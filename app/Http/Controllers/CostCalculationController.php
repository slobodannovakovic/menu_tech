<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\CostCalculationService;

class CostCalculationController extends Controller
{
    public function __construct(
        private CostCalculationService $costCalculationService
    ) {}

    public function calculate(
        string $baseCurrency,
        string $purchaseCurrency,
        int $purchaseCurrencyAmount
    ): Response
    {
        $cost = $this->costCalculationService->calculate(
                    $baseCurrency,
                    $purchaseCurrency,
                    $purchaseCurrencyAmount
                );

        if(is_null($cost)) {
            return response(['error' => 'Unable to calculate cost'], 422);
        }

        return response(['amount' => $cost], 200);
    }
}
