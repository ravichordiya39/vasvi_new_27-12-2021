<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\RegisterEvent;
use App\Events\OtpEvent;
use App\Events\PasswordChangeEvent;
use App\Events\PrivateCouponEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\RegisterEventListener;
use App\Listeners\OtpListener;
use App\Listeners\PasswordChangeListener;
use App\Listeners\PrivateCouponListener;
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
        RegisterEvent::class => [
            RegisterEventListener::class,
        ],
        OtpEvent::class => [
            OtpListener::class,
        ],
        PasswordChangeEvent::class => [
            PasswordChangeListener::class,
        ],
        PrivateCouponEvent::class => [
            PrivateCouponListener::class,
        ],
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
