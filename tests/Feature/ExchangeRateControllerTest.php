<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\ExchangeRatesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExchangeRateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(ExchangeRatesTableSeeder::class);
    }
    
    /** @test */
    public function returns_all_exchange_rates(): void
    {
        $response = $this->getJson('/api/exchange-rates');
        
        $response
            ->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonCount(3);
    }

    /** @test */
    public function returns_specific_exchange_rate(): void
    {
        $response = $this->getJson('/api/exchange-rates/usd-jpy');
        
        $response
            ->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'base_currency', 'purchase_currency', 'amount' 
            ])
            ->assertJsonFragment(['amount' => 107.170000]);
    }

    /** @test */
    public function returns_404_if_exchange_rate_not_found(): void
    {
        $response = $this->getJson('/api/exchange-rates/usd-rsd');

        $response->assertStatus(404);        
    }

    /** @test */
    public function returns_404_if_purchse_currency_param_is_missing(): void
    {
        $response = $this->getJson('/api/exchange-rates/usd');

        $response->assertStatus(404);        
    }
}
