@extends('layouts.app')

@section('title', 'All Users')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold">
                    <i class="fas fa-users me-2"></i>All Users
                </h1>
                <p class="text-muted">Manage all registered users</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Registered Users
            </h5>
        </div>
        <div class="card-body p-0">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Active</th>
                                <th>Registered</th>
                                <th>Approved By</th>
                                <th>Actions</th>
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
                                    <td>
                                        @if($user->is_approved)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Approved
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge bg-success">
                                                <i class="fas fa-toggle-on me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-toggle-off me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($user->approver)
                                            {{ $user->approver->name }}
                                            <small class="text-muted d-block">
                                                {{ $user->approved_at->format('M d, Y') }}
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Toggle Active/Inactive -->
                                            @if($user->is_active)
                                                <form action="{{ route('admin.users.deactivate', $user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-ban me-1"></i>Deactivate
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check-circle me-1"></i>Activate
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Delete -->
                                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
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
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5>No Users Found</h5>
                    <p class="text-muted">No users have been registered yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
