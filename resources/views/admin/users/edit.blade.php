@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold mb-3">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role_id" class="form-select" required>
                @foreach(\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection