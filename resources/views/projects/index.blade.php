@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3 m-4">
        <div class="col-md-9">
            <h1 class="m-2"><strong>Projects</strong></h1>
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ route('projects.create') }}" class="btn btn-success">Create New Project</a>
        </div>
    </div>
    
    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('projects.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search projects..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach ($projects as $project)
        <div class="col-md-4 mb-4">
            <div class="card project-card">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->name }}</h5>
                    <p class="card-text">{{ $project->description }}</p>
                    <p><strong>Start Date:</strong> {{ $project->start_date->toDateString() }}</p>
                    <p><strong>End Date:</strong> {{ $project->due_date->toDateString() }}</p>
                    <div class="mt-3">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
