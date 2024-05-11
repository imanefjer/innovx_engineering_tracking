@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">My Assigned Projects</h1>
    <div class="row justify-content-center">
        @forelse ($projects as $project)
            <div class="col-md-8 col-lg-6 mb-4">
                <!-- Card with hover effect and more padding -->
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Project
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $project->name }}</div>
                                <p class="text-muted mt-2 mb-0">{{ $project->description }}</p>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('engineers.projects.show', $project->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No projects currently assigned.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
