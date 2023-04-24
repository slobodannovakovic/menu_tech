<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CurrencyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    public function __construct(
        private CurrencyRepositoryInterface $currencyRepository
    ) {}

    public function index(): Response
    {
        $currencies = $this->currencyRepository->all();

        return response($currencies, 200);
    }
}
