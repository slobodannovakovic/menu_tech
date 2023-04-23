<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchange_rates = [
            ['base_currency' => 'usd', 'purchase_currency' => 'jpy', 'amount' => 107.17],
            ['base_currency' => 'usd', 'purchase_currency' => 'gbp', 'amount' => 0.711178],
            ['base_currency' => 'usd', 'purchase_currency' => 'eur', 'amount' => 0.884872],
        ];

        foreach($exchange_rates as $exchange_rate) {
            ExchangeRate::create($exchange_rate);
        }
    }
}
