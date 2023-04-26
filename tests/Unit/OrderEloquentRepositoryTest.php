<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Data\OrderData;
use Illuminate\Http\Request;
use Database\Seeders\OrdersTableSeeder;
use Database\Seeders\CurrenciesTableSeeder;
use Database\Seeders\SurchargesTableSeeder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\OrderEloquentRepository;
use Database\Seeders\ExchangeRatesTableSeeder;
use App\Repositories\CurrencyEloquentRepository;
use App\Http\Requests\OrderControllerStoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ExchangeRateEloquentRepository;

class OrderEloquentRepositoryTest extends TestCase
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
            'currencyToBuy' => 'eur',
            'costInBaseCurrency' => 118.6612,
            'currencyToBuyAmount' => 100,
            'baseCurrency' => 'usd'
        ];

        $request = new OrderControllerStoreRequest($requestParams);
        $orderData = new OrderData(
            $request,
            new ExchangeRateEloquentRepository,
            new CurrencyEloquentRepository
        );

        $order = (new OrderEloquentRepository)->save($orderData);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertSame(118.6612, $order->base_currency_amount);
    }
}
