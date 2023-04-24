<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Currency;
use App\Repositories\CurrencyEloquentRepository;
use Database\Seeders\CurrenciesTableSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyEloquentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CurrenciesTableSeeder::class);
    }
    
    /** @test */
    public function returns_all_currencies(): void
    {
        $currenciesEloquentRepo = (new CurrencyEloquentRepository)->all();

        $this->assertSame(4, $currenciesEloquentRepo->count());
    }

    /** @test */
    public function all_method_returns_eloquent_collection(): void
    {
        $currenciesEloquentRepo = (new CurrencyEloquentRepository)->all();

        $this->assertInstanceOf(Collection::class, $currenciesEloquentRepo);
    }
}
