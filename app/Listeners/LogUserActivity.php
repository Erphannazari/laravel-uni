<?php

namespace App\Listeners;

use App\Services\ActivityLogService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handleLogin(Login $event)
    {
        ActivityLogService::logUserLogin($event->user);
    }

    public function handleLogout(Logout $event)
    {
        if ($event->user) {
            ActivityLogService::logUserLogout($event->user);
        }
    }

    public function handleRegistered(Registered $event)
    {
        ActivityLogService::logUserRegistration($event->user);
    }

    public function subscribe($events)
    {
        return [
            Login::class => 'handleLogin',
            Logout::class => 'handleLogout',
            Registered::class => 'handleRegistered',
        ];
    }
} 