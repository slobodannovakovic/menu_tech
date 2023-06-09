<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'base_currency_amount',
        'currency_label',
        'currency_amount',
        'exchange_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'discount_percentage',
        'discount_amount'
    ];
}
