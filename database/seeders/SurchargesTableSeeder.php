<?php

namespace Database\Seeders;

use App\Models\Surcharge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurchargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surcharges = [
            ['currency_id' => 1, 'percentage' => 5.00],
            ['currency_id' => 2, 'percentage' => 5.00],
            ['currency_id' => 3, 'percentage' => 7.50],
            ['currency_id' => 4, 'percentage' => 5.00]
        ];

        foreach($surcharges as $surcharge) {
            Surcharge::create($surcharge);
        }
    }
}
