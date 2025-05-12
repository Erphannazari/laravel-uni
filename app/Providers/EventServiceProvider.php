<?php

namespace App\Providers;

use App\Listeners\LogUserActivity;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            LogUserActivity::class,
        ],
        Login::class => [
            LogUserActivity::class,
        ],
        Logout::class => [
            LogUserActivity::class,
        ],
    ];

    public function boot()
    {
        User::observe(UserObserver::class);
    }
} 