{{-- resources/views/projects/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="estimated_hours">Estimated Hours for Project</label>
            <input type="number" class="form-control" id="estimated_hours" name="estimated_hours" required step="0.01">
        </div>
        <div class="form-group">
            <label for="engineers">Assign Engineers</label>
            <select multiple class="form-control" id="engineers" name="engineers[]">
                @foreach ($engineers as $engineer)
                    <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
