<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpService
{
    public function get(string $baseUrl, string $urlParams): array
    {
        return Http::withOptions(['verify' => false])
                    ->get($baseUrl.'?'.$urlParams)
                    ->json();
    }
}