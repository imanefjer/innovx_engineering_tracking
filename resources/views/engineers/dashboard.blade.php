@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Projects</h1>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Search projects, tasks, or team members..." id="search-input">
        </div>
    </div>

    <div class="row" id="project-list">
        @forelse ($projects as $project)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 project-card" data-name="{{ $project->name }}">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title font-weight-bold h5 text">{{ $project->name }}</h5>
                            <span class="badge" style="background-color: {{ $project->status_color }}">{{ $project->status }}</span>
                        </div>
                        <p class="card-text text-secondary">{{ $project->description }}</p>
                        <ul class="list-unstyled text-muted">
                            <li><strong>Start:</strong> {{ $project->start_date->toFormattedDateString() }}</li>
                            <li><strong>End:</strong> {{ $project->due_date->toFormattedDateString() }}</li>
                            <li>
                                <div class="mt-2">
                                    <span class="badge badge-success">{{ $project->in_progress_tasks_count }} In Progress</span>
                                    <span class="badge badge-warning">{{ $project->pending_tasks_count }} Pending</span>
                                    <span class="badge badge-danger">{{ $project->overdue_tasks_count }} Overdue</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center border-0">
                        <a href="{{ route('engineers.projects.show', $project->id) }}" class="btn btn-outline-dark btn-sm">
                            View Project
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No projects currently assigned.</p>
            </div>
        @endforelse
    </div>
</div>

<div class="project-details-pane" id="project-details-pane">
    <!-- Project Details Pane will be dynamically loaded here -->
</div>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
    }

    .search-bar input {
        border-radius: 50px;
        padding: 10px 20px;
        border: 1px solid #ddd;
        width: 100%;
        max-width: 300px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .badge {
        border-radius: 50px;
        padding: 5px 10px;
        font-size: 0.8rem;
    }

    

    @media (max-width: 768px) {
        .search-bar input {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const projectCards = document.querySelectorAll('.project-card');
        const projectDetailsPane = document.getElementById('project-details-pane');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            projectCards.forEach(card => {
                const projectName = card.getAttribute('data-name').toLowerCase();
                if (projectName.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        projectCards.forEach(card => {
            card.addEventListener('click', function() {
                const projectId = card.getAttribute('data-id');
                fetch(`/engineers/projects/${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        projectDetailsPane.innerHTML = `
                            <h4 class="text-primary">${data.name}</h4>
                            <p class="text-secondary">${data.description}</p>
                            <ul class="list-unstyled text-muted">
                                <li><strong>Start:</strong> ${new Date(data.start_date).toLocaleDateString()}</li>
                                <li><strong>End:</strong> ${new Date(data.due_date).toLocaleDateString()}</li>
                                <li><strong>Status:</strong> <span style="background-color: ${data.status_color}">${data.status}</span></li>
                            </ul>
                            <h5 class="mt-4">Tasks</h5>
                            <ul class="list-unstyled text-muted">${data.tasks.map(task => `<li>${task.name}</li>`).join('')}</ul>
                        `;
                        projectDetailsPane.style.display = 'block';
                    });
            });
        });
    });
</script>
@endsection
