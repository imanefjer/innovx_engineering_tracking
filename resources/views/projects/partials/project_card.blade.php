{{-- resources/views/projects/partials/project_card.blade.php --}}
<div class="card project-card">
    <div class="card-body">
        <h5 class="card-title">{{ $project->name }}</h5>
        <p class="card-text">{{ $project->description }}</p>
        <p><strong>Start Date:</strong> {{ $project->start_date->toDateString() }}</p>
        <p><strong>End Date:</strong> {{ $project->due_date->toDateString() }}</p>
        <div class="mt-3">
            <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
