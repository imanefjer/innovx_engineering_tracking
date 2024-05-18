@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Pending Tasks Section -->
        <div class="col-md-6 mb-5">
            <div class="tasks-section">
                <div class="section-header">
                    <h2 class="section-title">Pending Tasks</h2>
                </div>
                @if($pendingTasks->isEmpty())
                    <div class="empty-state">No pending tasks at the moment.</div>
                @else
                    <div class="tasks-list">
                        @foreach ($pendingTasks as $task)
                            <a class="task-card pending" href="{{ route('engineers.projects.show', $task->project_id) }}">
                                <div class="task-info">
                                    <h5 class="task-name">{{ $task->name }}</h5>
                                    <p class="task-priority text-{{ $task->priority === 'high' ? 'danger' : ($task->priority === 'medium' ? 'warning' : 'secondary') }}">{{ ucfirst($task->priority) }} Priority</p>
                                </div>
                                <div class="task-date">{{ $task->due_date->format('Y-m-d') }}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Overdue Tasks Section -->
        <div class="col-md-6 mb-5">
            <div class="tasks-section">
                <div class="section-header">
                    <h2 class="section-title">Overdue Tasks</h2>
                </div>
                @if($overdueTasks->isEmpty())
                    <div class="empty-state">No overdue tasks at the moment.</div>
                @else
                    <div class="tasks-list">
                        @foreach ($overdueTasks as $task)
                            <a class="task-card overdue" href="{{ route('engineers.projects.show', $task->project_id) }}">
                                <div class="task-info">
                                    <h5 class="task-name">{{ $task->name }}</h5>
                                    <p class="task-date">Original Due Date: {{ $task->due_date->format('Y-m-d') }}</p>
                                </div>
                                <div class="task-status">Overdue</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 1200px;
    }
    .tasks-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .section-header {
        margin-bottom: 20px;
    }
    .section-title {
        font-size: 1.2rem;
        color: #333;
        border-bottom: 2px solid #ccc;
        padding-bottom: 10px;
    }
    .empty-state {
        text-align: center;
        font-size: 1.2rem;
        color: #777;
    }
    .tasks-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .task-card {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.3s;
    }
    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
          text-decoration: none;


    }
    .task-card.pending {
        border-left: 6px solid #17a2b8;
    }
    .task-card.overdue {
        border-left: 6px solid #dc3545;
    }
    .task-info {
        display: flex;
        flex-direction: column;
    }
    .task-name {
        font-size: 1.2rem;
        color: #333;
        margin: 0;
    }
    .task-priority,
    .task-date,
    .task-status {
        font-size: 0.9rem;
        color: #555;
    }
    .task-status {
        font-weight: bold;
        color: #dc3545;
    }
</style>
