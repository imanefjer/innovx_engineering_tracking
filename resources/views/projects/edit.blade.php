@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Project: {{ $project->name }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $project->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date->toDateString()) }}">
                        </div>

                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $project->due_date->toDateString()) }}">
                        </div>
                        <div class="form-group">
                            <label for="engineers">Assign Engineers</label>
                            <select multiple class="form-control" id="engineers" name="engineers[]">
                                @foreach ($allEngineers as $engineer)
                                    <option value="{{ $engineer->id }}" {{ in_array($engineer->id, $project->engineers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $engineer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
