<?php

namespace App\Observers;

use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user)
    {
        if (Auth::check()) {
            ActivityLogService::logUserCreated($user, Auth::user());
        }
    }

    public function updated(User $user)
    {
        if (Auth::check()) {
            ActivityLogService::logUserUpdated($user, Auth::user());
        }
    }

    public function deleted(User $user)
    {
        if (Auth::check()) {
            ActivityLogService::logUserDeleted($user, Auth::user());
        }
    }
} 