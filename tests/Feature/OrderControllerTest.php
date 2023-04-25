<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\OrdersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(OrdersTableSeeder::class);
    }

    /** @test */
    public function returns_all_orders(): void
    {
        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
                ->assertJsonIsArray()
                ->assertJsonCount(1);
    }

    /** @test */
    public function returns_specific_order(): void
    {
        $response = $this->getJson('/api/orders/1');

        $response->assertStatus(200)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'base_currency_amount',
                    'currency_label',
                    'currency_amount',
                    'exchange_rate',
                    'surcharge_percentage',
                    'surcharge_amount' 
                ]);
    }

    /** @test */
    public function returns_404_if_order_not_found(): void
    {
        $response = $this->getJson('/api/orders/2');
        
        $response->assertStatus(404);
    }

    /** @test */
    public function can_create_order(): void
    {
        $response = $this->postJson('/api/orders', [
            'base_currency_amount' => 113.0107,
            'currency_label' => 'EUR',
            'currency_amount' => 100,
            'exchange_rate' => 0.884872,
            'surcharge_percentage' => 5,
            'surcharge_amount' => 118.6612
        ]);

        $orders = $this->getJson('/api/orders');
        
        $response->assertStatus(201);
        $orders->assertJsonCount(2);
    }
}
