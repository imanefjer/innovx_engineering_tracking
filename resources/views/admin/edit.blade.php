@extends('layouts.app')

@section('content')
<div class="container mt-3 border rounded p-4">
    <h1 class ="mb-3">Edit User</h1>
    <form method="POST" action="{{ route('admin.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password (optional)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password to change">
        </div>

        <div class="form-group mb-3">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="administrator" {{ $user->role == 'administrator' ? 'selected' : '' }}>Administrator</option>
                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="engineer" {{ $user->role == 'engineer' ? 'selected' : '' }}>Engineer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-info ">Update User</button>
    </form>
</div>
@endsection
