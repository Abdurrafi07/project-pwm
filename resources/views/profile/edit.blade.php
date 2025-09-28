@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container py-5">

    {{-- Profile Information --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Profile Information</h5>
            <p class="text-muted">Update your account's profile information and email address.</p>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" type="text" 
                           class="form-control" 
                           value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" 
                           class="form-control" 
                           value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                @if (session('status') === 'profile-updated')
                    <span class="text-success ms-2">Saved.</span>
                @endif
            </form>
        </div>
    </div>

    {{-- Update Password --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Update Password</h5>
            <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input id="current_password" name="current_password" type="password" class="form-control">
                    @error('current_password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" name="password" type="password" class="form-control">
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                @if (session('status') === 'password-updated')
                    <span class="text-success ms-2">Saved.</span>
                @endif
            </form>
        </div>
    </div>

    {{-- Delete Account --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-danger">Delete Account</h5>
            <p class="text-muted">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-3">
                    <label for="password_delete" class="form-label">Password</label>
                    <input id="password_delete" name="password" type="password" class="form-control" placeholder="Enter your password to confirm">
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</div>
@endsection
