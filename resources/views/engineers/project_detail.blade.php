@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <h2 class="mt-4 mb-4 text-secondary">{{ $project->name }} - Tasks Overview</h2>
    
    <!-- Search and Filter Bar -->
    <div class="d-flex justify-content-between mb-4">
        <input type="text" class="form-control w-75" placeholder="Search tasks..." id="taskSearch">
        
    </div>

    <div class="row">
        @foreach(['Pending', 'In Progress', 'Completed'] as $status)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-{{ strtolower(str_replace(' ', '-', $status)) }} text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ ucwords($status) }}</h5>
                        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $status)) }}">{{ $status }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($tasks->where('status', strtolower($status)) as $task)
                            <li class="list-group-item">
                                <div>
                                    <h6 class="mb-1">{{ $task->name }}</h6>
                                    <p class="mb-1">Due on {{ $task->due_date->toFormattedDateString() }}</p>
                                    @if($status == 'Completed')
                                        <p class="mb-2">Completed on: {{ $task->updated_at->toFormattedDateString() }}</p>
                                    @endif

                                    @if($task->status == 'in progress')
                                        <p class="mb-2">Total Hours Logged: <strong>{{ $task->timeLogs->sum('hours') }} hours</strong></p>
                                        
                                        <div class="mb-3">
                                            @foreach ($task->timeLogs as $log)
                                                <div><small class="text-muted">{{ $log->date->toDateString() }}:</small> {{ $log->hours }} hours</div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="log-time-form card card-body mt-2">
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
                                                        <button type="submit" class="btn btn-primary p-1 mt-2">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline mt-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-sm btn-success mt-3">Complete Task</button>
                                        </form>
                                    @endif

                                    @if($task->status == 'pending')
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="in progress">
                                            <button type="submit" class="btn btn-sm btn-primary">Start Task</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item">No tasks under {{ $status }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Responsive CSS -->
<style>
    body {
        background-color: #f4f6f9;
        color: #343a40;
    }
    .card {
        border-radius: 10px;
        border: none;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .card-header {
        background-color: #343a40;
        color: white;
        font-size: 1.25rem;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .list-group-item {
        border: none;
        border-bottom: 1px solid #e9ecef;
        padding: 20px;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
    .list-group-item h6 {
        font-weight: bold;
    }
    .badge {
        font-size: 0.875rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
    }
    .badge-pending {
        background-color: #ffcc00;
        color: #343a40;
    }
    .badge-in-progress {
        background-color: #17a2b8;
        color: white;
    }
    .badge-completed {
        background-color: #28a745;
        color: white;
    }
    .form-control {
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ced4da;
    }
    .form-control:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    }
    .btn-primary {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .log-time-form {
        background-color: #f8f9fa;
        border-radius: 0.375rem;
    }
    @media (max-width: 768px) {
        .form-control.w-75 {
            width: 100% !important;
        }
        .form-control.w-25 {
            width: 100% !important;
            margin-top: 10px !important;
        }
        .d-flex {
            flex-direction: column;
        }
    }
</style>

<!-- JavaScript for Search and Filter -->
<script>
    document.getElementById('taskSearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        document.querySelectorAll('.list-group-item').forEach(function(item) {
            const taskName = item.querySelector('h6').innerText.toLowerCase();
            item.style.display = taskName.includes(searchValue) ? '' : 'none';
        });
    });

    document.getElementById('taskFilter').addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        document.querySelectorAll('.list-group-item').forEach(function(item) {
            const taskStatus = item.querySelector('.badge').innerText.toLowerCase();
            item.style.display = filterValue === '' || taskStatus === filterValue ? '' : 'none';
        });
    });
</script>
@endsection
