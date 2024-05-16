<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use App\Models\User;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); // Get all tasks
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create'); // Return the form for creating a new task
    }

    public function store(Request $request)
    {
        $project_id = $request->input('project_id');
        foreach ($request->input('tasks', []) as $engineer_id => $task) {
            $validatedTask = $request->validate([
                "tasks.$engineer_id.name" => 'required|string|max:255',
                "tasks.$engineer_id.description" => 'required|string',
                "tasks.$engineer_id.status" => 'required|string',
                "tasks.$engineer_id.start_date" => 'required|date',
                "tasks.$engineer_id.estimated_hours" => 'required|numeric|min:1',
                "tasks.$engineer_id.due_date" => 'required|date',
            ]);

            $newTask = Task::create([
                'project_id' => $project_id,
                'assigned_to' => $engineer_id,
                'name' => $task['name'],
                'description' => $task['description'],
                'status' => 'pending', // Set status to pending automatically
                'start_date' => $task['start_date'],
                'estimated_hours' => $task['estimated_hours'],
                'due_date' => $task['due_date'],
            ]);
        }
        
        

        return redirect()->route('projects.index')->with('success', 'Tasks assigned successfully!');
    }

    public function showPending()
    {
        $currentUserId = auth()->id();  // Get the ID of the currently authenticated user

        $pendingTasks = Task::where('status', 'pending')
                            ->where('assigned_to', $currentUserId)
                            ->get();

        return view('tasks.pending', compact('pendingTasks'));
    }
    public function store1(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|string',
            'start_date' => 'required|date',
            'estimated_hours' => 'required|numeric|min:1',
            'due_date' => 'required|date',
        ]);

        $task = new Task($validatedData);
        $task->save();

        
        // Check if there is already an assignment, if not, create it
        $assignment = ProjectAssignment::firstOrCreate([
            'project_id' => $validatedData['project_id'],
            'user_id' => $validatedData['assigned_to']
        ]);
        
        return redirect()->route('projects.show', $validatedData['project_id'])
                         ->with('success', 'Task added successfully!');
    }


    
    public function show(Task $task)
    {
        return view('tasks.show', compact('task')); // Show a single task
    }
    

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task')); // Return the edit form
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'required|date'
        ]);
        $task->update($validated);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
   
    public function logTime(Request $request, Task $task)
{
    // Prevent logging time if the task is completed
    if ($task->status === 'Completed') {
        return back()->withErrors(['msg' => 'Cannot log time on a completed task']);
    }

    // Validate input data
    $validated = $request->validate([
        'hours' => 'required|numeric|min:0.1|max:24',
        'date' => 'required|date'
    ]);

    // Create a new time log
    $task->timeLogs()->create([
        'user_id' => auth()->id(),
        'hours' => $validated['hours'],
        'date' => $validated['date']
    ]);

    // Update the actual hours in the task table
    $task->increment('actual_hours', $validated['hours']);
    $project = $task->project;
    $project->actual_hours = $project->tasks()->sum('actual_hours');
    $project->save();
    return back()->with('success', 'Time logged successfully');
}

    public function showProject(Project $project)
    {
        $tasks = $project->tasks()->with('timeLogs')->get(); // Ensures time logs are loaded with tasks
        return view('engineers.project_details', compact('project', 'tasks'));
    }
    public function complete(Request $request, Task $task)
    {
        // toDO - Add validation to ensure the task is not already completed and also check if the task is done the number of hours >0
        if ($task->status === 'completed') {
            return back()->with('error', 'This task is already completed.');
        }

        $task->status = 'completed';
        $task->completed_at = now(); // Optionally record the completion time
        $task->save();

        return back()->with('success', 'Task marked as completed.');
    }
    public function updateStatus(Request $request, Task $task)
    {
       $validated = $request->validate([
            'status' => 'required|string|in:in progress'
        ]);
        \Log::info('Status update requested', ['task_id' => $task->id, 'requested_status' => $request->status]);
    
        if ($task->status === 'pending' && $validated['status'] === 'in progress') {
            $task->status = $request->status;
            $task->save();
    
            \Log::info('Status updated successfully', ['task_id' => $task->id, 'new_status' => $task->status]);
    
            return back()->with('success', 'Task started successfully!');
        }
    
        \Log::error('Failed to update status', ['task_id' => $task->id, 'requested_status' => $request->status]);
    
        return back()->withError('Invalid operation.');
    }
    
    
    




}
