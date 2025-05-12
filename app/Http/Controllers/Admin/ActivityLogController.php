<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')
            ->orderBy('created_at', 'desc');

        // Filter by user name
        if ($request->has('user_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        // Filter by activity type
        if ($request->has('activity_type')) {
            $query->where('activity_type', $request->activity_type);
        }

        $activityLogs = $query->paginate(15);

        return view('admin.activity-logs.index', compact('activityLogs'));
    }
} 