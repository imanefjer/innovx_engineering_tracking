@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Assign Tasks</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project_id }}">

        <div class="row">
            @foreach ($engineers as $engineer)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $engineer->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input type="text" class="form-control border border-muted" id="taskName" name="tasks[{{ $engineer->id }}][name]" required>
                            </div>
                            <div class="form-group">
                                <label for="taskDescription">Task Description</label>
                                <textarea class="form-control" id="taskDescription" name="tasks[{{ $engineer->id }}][description]" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="taskStatus">Status</label>
                                <select class="form-control" id="taskStatus" name="tasks[{{ $engineer->id }}][status]" required>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control border border-muted"" id="startDate" name="tasks[{{ $engineer->id }}][start_date]" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dueDate">Due Date</label>
                                    <input type="date" class="form-control border border-muted"" id="dueDate" name="tasks[{{ $engineer->id }}][due_date]" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="estimatedHours">Estimated Hours</label>
                                    <input type="number" class="form-control border border-muted"" id="estimatedHours" name="tasks[{{ $engineer->id }}][estimated_hours]" required min="1" step="0.01">
                                </div>
                                <!-- Add more fields here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Assign Tasks</button>
    </form>
</div>
@endsection
