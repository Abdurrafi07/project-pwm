<!-- resources/views/admin/pending-users.blade.php -->
@extends('layouts.app')

@section('title', 'Pending Users')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold">
                    <i class="fas fa-user-clock me-2"></i>Pending Users
                </h1>
                <p class="text-muted">Review and approve new user registrations</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-clock me-2"></i>Users Awaiting Approval
            </h5>
        </div>
        <div class="card-body p-0">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <i class="fas fa-user me-2 text-muted"></i>
                                        {{ $user->name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $user->role->display_name }}</span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('admin.approve-user', $user) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Approve this user?')">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject-user', $user) }}" class="d-inline ms-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Reject and delete this user? This action cannot be undone.')">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center p-3">
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center p-5">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5>No Pending Users</h5>
                    <p class="text-muted">All users have been processed.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection