@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
    <ul class="list-group mt-3">
        @foreach ($projects as $project)
        <li class="list-group-item">
            {{ $project->name }}
            <a href="{{ route('projects.show', $project) }}" class="btn btn-info">View</a>
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
@endsection
