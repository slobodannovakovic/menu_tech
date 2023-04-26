<?php

namespace App\Console\Commands;

use App\Jobs\GetExchangeRates;
use Illuminate\Console\Command;

class GetRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get exchange rates from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        GetExchangeRates::dispatch();
    }
}
