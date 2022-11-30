<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderPack;
use App\Models\Pack;
use App\Models\PromoCode;
use App\Models\User;
use App\Observers\ActivityLogObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Bridge\RefreshToken;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\Token;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(ActivityLogObserver::class);
        Order::observe(ActivityLogObserver::class);
        Pack::observe(ActivityLogObserver::class);
        PromoCode::observe(ActivityLogObserver::class);
        OrderPack::observe(ActivityLogObserver::class);
        PersonalAccessClient::observe(ActivityLogObserver::class);
        Token::observe(ActivityLogObserver::class);
    }
}
