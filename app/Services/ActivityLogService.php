<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    public static function log($activityType, $description, $userId = null)
    {
        if ($userId === null && Auth::check()) {
            $userId = Auth::id();
        }

        return ActivityLog::create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'description' => $description
        ]);
    }

    public static function logUserRegistration(User $user)
    {
        return self::log(
            'register',
            "New user registered: {$user->name} ({$user->email})",
            $user->id
        );
    }

    public static function logUserLogin(User $user)
    {
        return self::log(
            'login',
            "User logged in: {$user->name}",
            $user->id
        );
    }

    public static function logUserLogout(User $user)
    {
        return self::log(
            'logout',
            "User logged out: {$user->name}",
            $user->id
        );
    }

    public static function logUserCreated(User $user, User $createdBy)
    {
        return self::log(
            'user_created',
            "User {$user->name} was created by {$createdBy->name}",
            $createdBy->id
        );
    }

    public static function logUserUpdated(User $user, User $updatedBy)
    {
        return self::log(
            'user_updated',
            "User {$user->name} was updated by {$updatedBy->name}",
            $updatedBy->id
        );
    }

    public static function logUserDeleted(User $user, User $deletedBy)
    {
        return self::log(
            'user_deleted',
            "User {$user->name} was deleted by {$deletedBy->name}",
            $deletedBy->id
        );
    }
} 