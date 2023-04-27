<?php

namespace App\Jobs;

use App\Services\HttpService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\GetExchangeRatesService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Repositories\Contracts\ExchangeRateRepositoryInterface;

class GetExchangeRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $backoff = 3;

    /**
     * Execute the job.
     */
    public function handle(
        HttpService $httpService,
        ExchangeRateRepositoryInterface $exchangeRateRepository
    ): void
    {
        (new GetExchangeRatesService)->syncRatesWithApi($httpService, $exchangeRateRepository);
    }
}
