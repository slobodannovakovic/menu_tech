<?php

namespace Tests\Unit;

use App\Models\ExchangeRate;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Database\Seeders\ExchangeRatesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ExchangeRateEloquentRepository;

class ExchangeRateEloquentRepositoryTest extends TestCase
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
        $exchangeRateEloquentRepo = (new ExchangeRateEloquentRepository)->all();

        $this->assertSame(3, $exchangeRateEloquentRepo->count());
    }

    /** @test */
    public function all_method_returns_eloquent_collection(): void
    {
        $exchangeRates = (new ExchangeRateEloquentRepository)->all();

        $this->assertInstanceOf(Collection::class, $exchangeRates);
    }

    /** @test */
    public function returns_specific_exchange_rate(): void
    {
        $exchangeRate = (new ExchangeRateEloquentRepository)->show('usd', 'eur');

        $this->assertInstanceOf(ExchangeRate::class, $exchangeRate);

        $this->assertSame(0.884872, $exchangeRate->amount);
    }
}
