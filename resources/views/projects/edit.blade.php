@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header ">
                    <h1 class="h4 mb-0">Edit Project: {{ $project->name }}</h1>
                </div>
                <div class="card-body">
                    <!-- Section to display assigned engineers -->
                    <div class="mb-4">
                        <h3 class="h5">Assigned Engineers</h3>
                        <ul class="list-group">
                            @foreach ($project->engineers as $engineer)
                                <li class="list-group-item">{{ $engineer->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form action="{{ route('projects.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $project->description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date->toDateString()) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $project->due_date->toDateString()) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="estimated_hours" class="form-label">Estimated Hours</label>
                            <input type="number" class="form-control" id="estimated_hours" name="estimated_hours" value="{{ $project->estimated_hours }}" step="any" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="engineers" class="form-label">Assign Engineers</label>
                            <select multiple class="form-control" id="engineers" name="engineers[]">
                                @foreach ($unassignedEngineers as $engineer)
                                    <option value="{{ $engineer->id }}">
                                        {{ $engineer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
