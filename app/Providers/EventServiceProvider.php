<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\NewUser;
use App\Events\NewAsset;
use App\Events\NewVendor;
use App\Events\NewAssignment;

use App\Listeners\WelcomeNewUser;
use App\Listeners\ListenNewAsset;
use App\Listeners\ListenNewVendor;
use App\Listeners\ListenNewAssignment;

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
        NewUser::class => [
            WelcomeNewUser::class,
        ],
        NewAsset::class => [
            ListenNewAsset::class,
        ],
        NewVendor::class => [
            ListenNewVendor::class,
        ],
        NewAssignment::class => [
            ListenNewAssignment::class,
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
