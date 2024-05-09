@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4 mb-4">{{ $project->name }} - Tasks</h2>
    <div class="list-group">
        @foreach ($tasks as $task)
            <div class="list-group-item">
                <h5 class="mb-1">{{ $task->name }}</h5>
                <p class="mb-1">Due on {{ $task->due_date->toFormattedDateString() }}</p>
                <p class="mb-2"><strong>Status:</strong> <span class="badge badge-{{ $task->status == 'completed' ? 'success' : 'warning' }}">{{ $task->status }}</span></p>
                
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
                @if($task->status !== 'completed')
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
                    <form method="POST" action="{{ route('tasks.complete', $task->id) }}" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success mt-2">Set as Completed</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
