<!-- resources/views/auth/registration-success.blade.php -->
@extends('layouts.app')

@section('title', 'Registration Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h3 class="fw-bold text-success mb-3">Registration Successful!</h3>
                    <p class="text-muted mb-4">
                        Your account has been created successfully. Please wait for admin approval before you can login.
                    </p>
                    <div class="alert alert-warning">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Pending Approval:</strong> An administrator will review and approve your account soon.
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection