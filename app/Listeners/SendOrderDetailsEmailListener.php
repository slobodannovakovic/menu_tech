<?php

namespace App\Listeners;

use App\Mail\SendOrderDetailsEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderDetailsEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $purchesedCurrency = strtolower($event->order->currency_label);
        $currencesForNotification = config('order.emailForCurrencies');
        $emailToAddresses = config('order.emailTo');

        if(in_array($purchesedCurrency, $currencesForNotification)) {
            foreach($emailToAddresses as $emailAddress) {
                Mail::to($emailAddress)->send(new SendOrderDetailsEmail($event->order));
            }
        }

        
    }
}
