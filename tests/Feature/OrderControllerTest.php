<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\Event;
use Database\Seeders\OrdersTableSeeder;
use Database\Seeders\CurrenciesTableSeeder;
use Database\Seeders\SurchargesTableSeeder;
use Database\Seeders\ExchangeRatesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CurrenciesTableSeeder::class);
        $this->seed(ExchangeRatesTableSeeder::class);
        $this->seed(SurchargesTableSeeder::class);
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
            'currencyToBuy' => 'eur',
            'costInBaseCurrency' => 118.6612,
            'currencyToBuyAmount' => 100,
            'baseCurrency' => 'usd'
        ]);

        $orders = $this->getJson('/api/orders');
        
        $response->assertStatus(201);
        $orders->assertJsonCount(2);
    }

    /** @test */
    public function dispathes_event_after_order_created(): void
    {
        Event::fake();

        $this->postJson('/api/orders', [
            'currencyToBuy' => 'eur',
            'costInBaseCurrency' => 118.6612,
            'currencyToBuyAmount' => 100,
            'baseCurrency' => 'usd'
        ]);

        Event::assertDispatched(OrderCreatedEvent::class);
    }
}
