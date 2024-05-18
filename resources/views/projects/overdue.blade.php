@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="tasks-section">
        <div class="section-header">
            <h2 class="section-title">Overdue Tasks</h2>
        </div>
        @forelse($overdueProjects as $project)
            <div class="project-section mb-4">
                @if(!$project->tasks->isEmpty())
                    <h3 class="project-title">{{ $project->name }}</h3>
                    <div class="tasks-list">
                        @foreach ($project->tasks as $task)
                            <a class="task-card overdue" href="{{ route('projects.show', $project->id) }}">
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
        @empty
            <div class="empty-state">No overdue tasks at the moment.</div>
        @endforelse
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .tasks-section {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .section-header {
        margin-bottom: 30px;
        text-align: center;
    }
    .section-title {
        font-size: 2rem;
        color: #333;
        border-bottom: 2px solid #ccc;
        padding-bottom: 10px;
        display: inline-block;
    }
    .empty-state {
        text-align: center;
        font-size: 1.2rem;
        color: #777;
    }
    .project-section {
        margin-bottom: 30px;
    }
    .project-title {
        font-size: 1.5rem;
        color: #555;
        margin-bottom: 15px;
        text-align: center;
    }
    .tasks-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
    .task-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
    }
    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        text-decoration: none;
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
    .task-date {
        font-size: 0.9rem;
        color: #777;
    }
    .task-status {
        font-size: 1rem;
        font-weight: bold;
        color: #dc3545;
    }
</style>
