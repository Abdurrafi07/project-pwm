@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold mb-3">User Management</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $pendingUsers }}</h4>
                        <p class="mb-0">Pending Approvals</p>
                    </div>
                    <i class="fas fa-clock fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalUsers }}</h4>
                        <p class="mb-0">Total Users</p>
                    </div>
                    <i class="fas fa-users fa-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus me-2"></i>Add New User
    </a>

    <a href="{{ route('admin.users.pending') }}" class="btn btn-warning mb-3">
        <i class="fas fa-clock me-2"></i>Pending Users
    </a>

    <a href="{{ route('admin.users.all') }}" class="btn btn-info text-white mb-3">
        <i class="fas fa-list me-2"></i>All Users
    </a>
</div>
@endsection
