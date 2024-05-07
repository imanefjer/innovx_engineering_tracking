@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class ="m-4">{{ $project->name }} - Tasks</h2>
    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item">
                {{ $task->name }} - Due on {{ $task->due_date->toFormattedDateString() }}
                <span class="float-right">{{ $task->status }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection