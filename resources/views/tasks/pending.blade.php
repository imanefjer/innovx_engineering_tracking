@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1 class="card-title text-center text-primary mb-4">Pending Tasks</h1>
            @if($pendingTasks->isEmpty())
                <div class="alert alert-info text-center">No pending tasks at the moment.</div>
            @else
                <div class="list-group">
                    @foreach ($pendingTasks as $task)
                        <a href="{{ route('engineers.projects.show', $task->project_id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 p-3 shadow-sm rounded border-0 {{ $loop->odd ? 'bg-light' : 'bg-white' }}">
                            <div class="d-flex flex-column">
                                <h5 class="mb-1 text-dark">{{ $task->name }}</h5>
                            </div>
                            <span class="badge bg-info rounded-pill p-1">{{ $task->due_date->format('Y-m-d') }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 800px;
    }
    .card {
        background-color: #ffffff;
        border-radius: 1rem;
    }
    .card-title {
        font-size: 2rem;
    }
    .list-group-item {
        transition: all 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #e0e0e0;
        transform: scale(1.02);
    }
    .badge {
        font-size: 1rem;
    }
</style>
