@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h1 class="h3 mb-0">Project Details: {{ $project->name }}</h1>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="font-weight-bold">Description:</h5>
                    <p>{{ $project->description }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="font-weight-bold">Start Date:</h5>
                    <p>{{ $project->start_date->toFormattedDateString() }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="font-weight-bold">Due Date:</h5>
                    <p>{{ $project->due_date->toFormattedDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="font-weight-bold m-3">Assigned Engineers</h3>
                    @if($project->engineers->isEmpty())
                        <div class="alert alert-info">No engineers assigned to this project.</div>
                    @else
                        <div class="list-group">
                            @foreach ($project->engineers as $engineer)
                                <div class="list-group-item list-group-item-action flex-column align-items-start mb-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $engineer->name }}</h5>
                                        <small>{{ $engineer->email }}</small>
                                    </div>
                                    <p class="mb-1">
                                        <strong>Tasks:</strong>
                                        <ul class="list-unstyled">
                                            @foreach ($engineer->tasks as $task)
                                                <li>{{ $task->name }} - Due: {{ $task->due_date->toFormattedDateString() }}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit Project</a>
            </div>
        </div>
    </div>
</div>
@endsection
