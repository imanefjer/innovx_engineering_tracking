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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|integer|exists:projects,id',
            'assigned_to' => 'required|integer|exists:users,id',
            'status' => 'required|string',
            'due_date' => 'required|date'
        ]);
        Task::create($validated);
        return redirect()->route('tasks.index');
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
