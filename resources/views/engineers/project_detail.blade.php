@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <h2 class="mt-4 mb-4">{{ $project->name }} - Tasks</h2>
    @foreach(['Pending', 'In Progress', 'Completed'] as $status)
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h2 class="mb-0">{{ ucwords($status) }}</h2>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($tasks->where('status', strtolower($status)) as $task)
                    <li class="list-group-item">
                    <div class="list-group-item">
                <h5 class="mb-1">{{ $task->name }}</h5>
                <p class="mb-1">Due on {{ $task->due_date->toFormattedDateString() }}</p>
                <p class="mb-2"><strong>Status:</strong> <span class="badge badge-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in progress' ? 'primary' : 'warning') }}">{{ $task->status }}</span>

                <p class="mb-2">Total Hours Logged: <strong>{{ $task->timeLogs->sum('hours') }} hours</strong></p>

                <!-- List all time logs for this task -->
                @if($task->timeLogs->isNotEmpty())
                    <div class="mb-3">
                        @foreach ($task->timeLogs as $log)
                            <div><small class="text-muted">{{ $log->date->toDateString() }}:</small> {{ $log->hours }} hours</div>
                        @endforeach
                    </div>
                @endif

                <!-- Log time form -->
                @if($task->status == 'in progress')
                    <div class="card card-body mt-2">
                        <h6 class="mb-2">Log Time:</h6>
                        <form action="{{ route('tasks.log_time', $task->id) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <input type="number" name="hours" placeholder="Hours spent" min="0.1" step="0.1" required class="form-control">
                                </div>
                                <div class="col">
                                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="form-control">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                       
                    </div>
                     <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-sm btn-success mt-2">Complete Task</button>
                        </form>
                @endif
                @if($task->status === 'pending')
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="in progress">
                        <button type="submit" class="btn btn-sm btn-primary ">Start Task</button>
                    </form>
                @endif
            </div>
                       
                        
                       
                @empty
                    <li class="list-group-item">No tasks under {{ $status }}</li>
                @endforelse
            </ul>
        </div>
    @endforeach
    
</div>
@endsection
