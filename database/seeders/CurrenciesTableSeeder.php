<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'usd', 'label' => 'USD', 'description' => 'US Dollar'],
            ['name' => 'gbp', 'label' => 'GBP', 'description' => 'GB Pound'],
            ['name' => 'jpy', 'label' => 'JPY', 'description' => 'Japan Yen'],
            ['name' => 'eur', 'label' => 'EUR', 'description' => 'Euro']
        ];

        foreach($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
