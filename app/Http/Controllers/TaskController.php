<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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
    
            Task::create([
                'project_id' => $project_id,
                'assigned_to' => $engineer_id,
                'name' => $task['name'],
                'description' => $task['description'],
                'status' => $task['status'],
                'start_date' => $task['start_date'],
                'estimated_hours' => $task['estimated_hours'],
                'due_date' => $task['due_date'],
            ]);
        }
    
        return redirect()->route('projects.index')->with('success', 'Tasks assigned successfully!');
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
}
