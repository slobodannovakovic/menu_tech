<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\ExchangeRatesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExchangeRateCalculationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(ExchangeRatesTableSeeder::class);
    }

    /** @test */
    public function calculates_exchange_rate_cost_for_selected_currencies(): void
    {
        $response = $this->get('/api/cost-calculation/usd/eur/1');

        $response->assertStatus(200)
                ->assertJsonFragment(['amount' => 1.1301]);
    }

    /** @test */
    public function returns_422_if_params_unprocessable(): void
    {
        $response = $this->get('/api/cost-calculation/usd/xxx/1');

        $response->assertStatus(422);
    }
}
