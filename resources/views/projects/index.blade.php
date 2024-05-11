@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <!-- Clean and Functional Header -->
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
    </div>

    <!-- Simplified Search Bar -->
    <div class="mb-5">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search projects..." name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">Search</button>
            </div>
        </div>
    </div>

    <!-- Streamlined Project Cards -->
    <div class="row">
        @foreach ($projects as $project)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->name }}</h5>
                    <p class="card-text">{{ $project->description }}</p>
                    <div class="mb-2 text-muted">
                        <strong>Start:</strong> {{ $project->start_date->toDateString() }}<br>
                        <strong>End:</strong> {{ $project->due_date->toDateString() }}
                    </div>
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-primary btn-sm">View</a>
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
