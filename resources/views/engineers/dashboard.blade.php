@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 h2">My Assigned Projects</h1>
    <div class="row">
        @forelse ($projects as $project)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold h5">{{ $project->name }}</h5>
                        <hr>
                        <p class="card-text">{{ $project->description }}</p>
                        <ul class="list-unstyled">
                            <li><strong>Start:</strong> {{ $project->start_date->toFormattedDateString() }}</li>
                            <li><strong>End:</strong> {{ $project->due_date->toFormattedDateString() }}</li>
                            <li>                        
                                <div>
                                    <span class="badge badge-primary">{{ $project->in_progress_tasks_count }} In Progress</span>
                                    <span class="badge badge-danger">{{ $project->pending_tasks_count }} Pending</span>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('engineers.projects.show', $project->id) }}" class="btn btn-primary">
                            View Project
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No projects currently assigned.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
