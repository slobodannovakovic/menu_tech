<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CurrencyEloquentRepository;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
