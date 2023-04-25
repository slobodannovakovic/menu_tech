<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OrderEloquentRepository;
use App\Repositories\CurrencyEloquentRepository;
use App\Repositories\ExchangeRateEloquentRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CurrencyRepositoryInterface::class,
            CurrencyEloquentRepository::class
        );

        $this->app->bind(
            ExchangeRateRepositoryInterface::class,
            ExchangeRateEloquentRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderEloquentRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
