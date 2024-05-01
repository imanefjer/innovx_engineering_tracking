<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all(); // Get all projects
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create'); // Return the form for creating a new project
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'estimated_hours' => 'required|numeric',
            'engineers' => 'required|array',
            'engineers.*' => 'exists:users,id'
        ]);

        $project = Project::create($validated);
        $project->engineers()->sync($request->engineers);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }


    public function show(Project $project)
    {
        return view('projects.show', compact('project')); // Show a single project
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project')); // Return the edit form
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);
        $project->update($validated);
        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    
    }
}
