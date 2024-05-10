@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class ="m-4">My Assigned Projects</h1>
    <div class="list-group">
        @forelse ($projects as $project)
            <a href="{{ route('engineers.projects.show', $project->id) }}" class="list-group-item list-group-item-action">
                {{ $project->name }}                
            </a>
        @empty
            <p>No projects currently assigned.</p>
        @endforelse
    </div>
</div>
@endsection
