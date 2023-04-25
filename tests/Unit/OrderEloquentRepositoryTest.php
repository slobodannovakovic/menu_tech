<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use Database\Seeders\OrdersTableSeeder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\OrderEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class OrderEloquentRepositoryTest extends TestCase
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
        $orders = (new OrderEloquentRepository)->all();

        $this->assertInstanceOf(Collection::class, $orders);
        $this->assertCount(1, $orders);
    }

    /** @test */
    public function returns_specific_order(): void
    {
        $order = (new OrderEloquentRepository)->show(1);

        $this->assertInstanceOf(Order::class, $order);
    }

    /** @test */
    public function returns_null_if_order_not_found(): void
    {
        $order = (new OrderEloquentRepository)->show(2);

        $this->assertNull($order);
    }

    /** @test */
    public function creates_order(): void
    {
        $requestParams = [
            'base_currency_amount' => 113.0107,
            'currency_label' => 'EUR',
            'currency_amount' => 100,
            'exchange_rate' => 0.884872,
            'surcharge_percentage' => 5,
            'surcharge_amount' => 118.6612
        ];

        $request = new Request($requestParams);

        $order = (new OrderEloquentRepository)->save($request);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertSame(113.0107, $order->base_currency_amount);
    }
}
