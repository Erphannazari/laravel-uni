@extends('admin.layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Activity Logs</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter Logs</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ request('user_name') }}" placeholder="Search by user name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="activity_type">Activity Type</label>
                                <select class="form-control" id="activity_type" name="activity_type">
                                    <option value="">All Activities</option>
                                    <option value="login" {{ request('activity_type') == 'login' ? 'selected' : '' }}>Login</option>
                                    <option value="logout" {{ request('activity_type') == 'logout' ? 'selected' : '' }}>Logout</option>
                                    <option value="register" {{ request('activity_type') == 'register' ? 'selected' : '' }}>Register</option>
                                    <option value="user_created" {{ request('activity_type') == 'user_created' ? 'selected' : '' }}>User Created</option>
                                    <option value="user_updated" {{ request('activity_type') == 'user_updated' ? 'selected' : '' }}>User Updated</option>
                                    <option value="user_deleted" {{ request('activity_type') == 'user_deleted' ? 'selected' : '' }}>User Deleted</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Activity Logs List</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Activity Type</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activityLogs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->user ? $log->user->name : 'System' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $log->activity_type == 'login' ? 'success' : ($log->activity_type == 'logout' ? 'warning' : ($log->activity_type == 'register' ? 'info' : ($log->activity_type == 'user_deleted' ? 'danger' : 'primary'))) }}">
                                            {{ str_replace('_', ' ', ucfirst($log->activity_type)) }}
                                        </span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No activity logs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $activityLogs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 