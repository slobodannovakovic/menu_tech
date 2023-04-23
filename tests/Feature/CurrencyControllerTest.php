<?php

namespace Tests\Feature;

use Database\Seeders\CurrenciesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
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
        $response = $this->getJson('/api/currencies');
        
        $response
            ->assertStatus(200)
            ->assertJsonCount(4);
    }
}
