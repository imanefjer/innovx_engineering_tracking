@extends('layouts.app')
@section("extra-css")
<link href="css/app.css" rel="stylesheet">
<style>
    .chart-container {
        height: 100%;  /* Ensures containers take full height of their parent */
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .chart-container canvas {
        height: 100% !important;  /* Important to override default canvas height */
        width: 100% !important;
    }
</style>
@section('content')
<div class="container mt-5">
@if ($errors->any())b
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Project Details: {{ $project->name }}</h1>
            <div>
                <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addTaskModal">
                    Add Task
                </button>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary m-2">
                    Edit Project
                </a>
            </div>
        </div>

        <div class="card-body">
             <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Description:</h5>
                    <p>{{ $project->description }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Completion Task Percentage:</h5>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ max($completionPercentage, 10) }}%; min-width: 30px;" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($completionPercentage, 2) }}%</div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Start Date:</h5>
                    <p>{{ $project->start_date->toFormattedDateString() }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Due Date:</h5>
                    <p>{{ $project->due_date->toFormattedDateString() }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Estimated Hours:</h5>
                    <p>{{ $project->estimated_hours }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Actual Hours:</h5>
                    <p>{{ $project->actual_hours }}</p>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                    @if ($totalTasks > 0)
                        <div class="col-sm-12 col-md-4">
                            <div class="chart-container">
                                <canvas id="taskStatusChart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="chart-container">
                                <canvas id="engineerHoursComparisonChart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="chart-container">
                                <canvas id="engineerHoursPieChart"></canvas>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="alert alert-info">No tasks available for charting.</div>
                        </div>
                    @endif
                </div>
            </div>

            

            <div class="modal fade" id="addTaskModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form action="{{ route('tasks.store1') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">

                                <div class="form-group">
                                    <label for="name">Task Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                   
                                    <label for="assigned_to">Assign to Engineer:</label>
                                    <select class="form-control" id="assigned_to" name="assigned_to">
                                        @foreach($engineers as $engineer) <!-- Change this line -->
                                            <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estimated_hours">Estimated Hours:</label>
                                    <input type="number" class="form-control" id="estimated_hours" name="estimated_hours" required min="1" step="0.01">
                                </div>
                                
                                <input type="hidden" id="status" name="status"  value="pending">

                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="due_date">Due Date:</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Task</button>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4">
                @if($project->engineers->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-info">No engineers assigned to this project.</div>
                    </div>
                @else
                    @php $colSize = 12 / min(3, max(1, count($project->engineers))); @endphp
                    @foreach ($project->engineers as $engineer)
                        <div class="col-sm-12 col-md-{{ $colSize }} mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-header bg-info text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">{{ $engineer->name }}</h5>
                                        <small>{{ $engineer->email }}</small>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        @forelse ($engineer->tasks as $task)
                                            <li class="list-group-item">
                                                <h6 class="mb-1">{{ $task->name }}</h6>
                                                <p class="mb-1">Due: {{ $task->due_date->toFormattedDateString() }}</p>
                                                <p class="mb-1">Estimated Hours: {{ $task->estimated_hours }}</p>
                                                <p class="mb-1">Actual Hours: {{ $task->actual_hours }}</p>
                                                <p class="mb-2">Status: <span class="badge badge-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in progress' ? 'primary' : 'danger') }}">{{ $task->status }}</span></p>
                                                @if ($task->status == "completed" && $task->completed_at)
                                                    <p class="mb-0">Completed on: {{ $task->completed_at->toFormattedDateString() }}</p>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="list-group-item">No tasks assigned.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-css')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('extra-js')

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('taskStatusChart').getContext('2d');
    var taskStatusChart = new Chart(ctx, {
        type: 'pie', // or 'line', 'bar', etc.
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                label: 'Task Status',
                data: [{{ $completedTasks }}, {{ $inProgressTasks }}, {{ $pendingTasks }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Tasks Distribution'
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Fetch the data passed from Laravel controller
    var engineerContributions = @json($engineerContributions);

    // Prepare data arrays for the bar chart
    var labels = Object.keys(engineerContributions);
    var estimatedData = labels.map(label => engineerContributions[label].estimated);
    var actualData = labels.map(label => engineerContributions[label].actual);

    // Bar Chart for Estimated vs Actual Hours
    var ctxBar = document.getElementById('engineerHoursComparisonChart').getContext('2d');
    var engineerHoursComparisonChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Estimated Hours',
                data: estimatedData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Actual Hours',
                data: actualData,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                display: true,
                position: 'top'
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Estimated VS Actual Hours'
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Pie Chart for Actual Hours Distribution
    var ctxPie = document.getElementById('engineerHoursPieChart').getContext('2d');
    var engineerHoursPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Actual Hours Distribution',
                data: actualData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 2
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'right'
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Engineers Total Contribution'
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
