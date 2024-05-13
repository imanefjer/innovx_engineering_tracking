@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 ">Add new User</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.store-user') }}">
                        @csrf
                        <!-- errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control rounded" id="name" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control rounded" id="email" name="email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control rounded" id="password" name="password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="administrator">Administrator</option>
                                <option value="manager">Manager</option>
                                <option value="engineer">Engineer</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info ">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
