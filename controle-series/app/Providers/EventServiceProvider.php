<?php

namespace App\Providers;

use App\Events\DeletedSerie;
use App\Events\NovaSerie;
use App\Listeners\DeleteSerieCover;
use App\Listeners\LogEmailNewSerie;
use App\Listeners\SendEmailNewSerie;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NovaSerie::class => [
            SendEmailNewSerie::class,
            LogEmailNewSerie::class
        ],
        DeletedSerie::class => [
            DeleteSerieCover::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
