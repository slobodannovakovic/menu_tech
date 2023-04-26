<?php

namespace App\Providers;

use App\Events\OrderCreatedEvent;
use App\Listeners\ApplyOrderDiscountListener;
use App\Listeners\SendOrderDetailsEmailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        OrderCreatedEvent::class => [
            SendOrderDetailsEmailListener::class,
            ApplyOrderDiscountListener::class
        ]
        /* Registered::class => [
            SendEmailVerificationNotification::class,
        ], */
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
