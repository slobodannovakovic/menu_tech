<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'base_currency_amount' => 113.0107,
            'currency_label' => 'EUR',
            'currency_amount' => 100,
            'exchange_rate' => 0.884872,
            'surcharge_percentage' => 5,
            'surcharge_amount' => 118.6612
        ]);
    }
}
