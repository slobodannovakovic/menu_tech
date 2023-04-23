<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    public function index(): Response
    {
        $currencies = Currency::orderBy('name')->get();

        return response($currencies, 200);
    }
}
