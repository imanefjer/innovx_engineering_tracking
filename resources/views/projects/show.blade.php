@extends('layouts.app')

@section('content')
<div class="container mt-5">
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="font-weight-bold">Estimated Hours:</h5>
                    <p>{{ $project->estimated_hours }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="font-weight-bold">Actual Hours:</h5>
                    <p>{{ $project->actual_hours }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <h3 class="font-weight-bold m-3">Assigned Engineers</h3>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addTaskModal">
                        Add Task
                    </button>
                </div>
            </div>

            <div class="modal fade" id="addTaskModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form action="{{ route('tasks.store1') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">

                                <div class="form-group">
                                    <label for="name">Task Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                   
                                    <label for="assigned_to">Assign to Engineer:</label>
                                    <select class="form-control" id="assigned_to" name="assigned_to">
                                        @foreach($engineers as $engineer) <!-- Change this line -->
                                            <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estimated_hours">Estimated Hours:</label>
                                    <input type="number" class="form-control" id="estimated_hours" name="estimated_hours" required min="1" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="due_date">Due Date:</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Task</button>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    
                    @if($project->engineers->isEmpty())
                        <div class="alert alert-info">No engineers assigned to this project.</div>
                    @else
                        <div class="list-group">
                        @foreach ($project->engineers as $engineer)
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $engineer->name }}</h5>
                                    <small>{{ $engineer->email }}</small>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @forelse ($engineer->tasks as $task)
                                    <li class="list-group-item">
                                        <h6>{{ $task->name }}</h6>
                                        <div>Due: {{ $task->due_date->toFormattedDateString() }}</div>
                                        <div>Estimated Hours: {{ $task->estimated_hours }}</div>
                                        <div>Actual Hours: {{ $task->actual_hours }}</div>
                                        <div>Status: <span class="badge badge-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in progress' ? 'primary' : 'warning') }}">{{ $task->status }}</span></div>
                                        @if ($task->status == "completed" && $task->completed_at)
                                            <div>Completed on: {{ $task->completed_at->toFormattedDateString() }}</div>
                                        @endif
                                    </li>
                                @empty
                                    <li class="list-group-item">No tasks assigned.</li>
                                @endforelse
                            </ul>
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
@section('extra-css')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
