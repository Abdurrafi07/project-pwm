<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-gradient-primary text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 70vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Welcome to Multi-Role Application
                    </h1>
                    <p class="lead mb-4">
                        Secure authentication system with role-based access control. 
                        Admin approval required for new users.
                    </p>
                    <div class="text-center mt-3">
                        <p class="mb-0">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
