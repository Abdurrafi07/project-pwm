<!-- resources/views/auth/pending-approval.blade.php -->
@extends('layouts.app')

@section('title', 'Pending Approval')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-hourglass-half fa-5x text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning mb-3">Account Pending Approval</h3>
                    <p class="text-muted mb-4">
                        Your account is waiting for administrator approval. You cannot login until your account is approved.
                    </p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Please contact your administrator if you need urgent access.
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
