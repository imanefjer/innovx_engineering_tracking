<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class ProjectController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $projects = Project::where('name', 'like', '%' . $search . '%')
                               ->orWhere('description', 'like', '%' . $search . '%')
                               ->get();
        } else {
            $projects = Project::all();
        }

        return view('projects.index', compact('projects'));
    }
   
    public function overdue()
    {
        // search for tasks that are overdue for the project that belongs to the manager
        $overdueProjects = Project::where('manager_id', auth()->id())
            ->with('tasks', function ($query) {
                $query->where('due_date', '<', now())
                    ->where('status', '!=', 'completed');
            })->get();


        
        return view('projects.overdue', compact('overdueProjects'));
    }

   
    

    public function create()
    {
        $engineers = User::where('role', 'engineer')->get(); // Adjust based on your user model
        return view('projects.create', compact('engineers'));
    }

    public function store(Request $request)
    {

        $validatedProject = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after:start_date',
            'estimated_hours' => 'required|numeric|min:0',
            'engineers' => 'required|array',
            'engineers.*' => 'exists:users,id'
        ]);
        $validatedProject['manager_id'] = auth()->id();
        // Create the project with the validated data
        $project = Project::create($validatedProject);

        // Attach engineers to the project
        $project->engineers()->sync($request->engineers);
        $project->save();
        // Redirect to the project index page with a success message
        return redirect()->route('projects.assign_tasks', ['project' => $project->id]);
    }
    public function assignTasks(Project $project)
    {
        $engineers = $project->engineers;
        return view('projects.assign_tasks', ['project_id' => $project->id, 'engineers' => $engineers]);
    }


    public function show(Project $project)
    {
        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->where('status', 'completed')->count();
        $completionPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
        $completedTasks = $project->tasks->where('status', 'completed')->count();
        $inProgressTasks = $project->tasks->where('status', 'in progress')->count();
        $pendingTasks = $project->tasks->where('status', 'pending')->count();
        // Properly pass the $project variable to nested closures
        $project->load(['engineers' => function ($query) use ($project) {
            $query->with(['tasks' => function ($query) use ($project) {
                $query->where('project_id', $project->id);
            }]);
        }]);

        $engineers = User::where('role', 'engineer')->get(); // Adjust based on your user model

        // Prepare data for visualization or further processing
        $engineerContributions = [];
        foreach ($project->engineers as $engineer) {
            $engineerContributions[$engineer->name] = [
                'estimated' => $engineer->tasks->sum('estimated_hours'),
                'actual' => $engineer->tasks->sum('actual_hours')
            ];
        }

        return view('projects.show', compact('project', 'engineers', 'completionPercentage', 'engineerContributions', 'completedTasks', 'inProgressTasks', 'pendingTasks', 'totalTasks'));
    }


    public function edit(Project $project)
    {
        $assignedEngineers = $project->engineers->pluck('id')->toArray();
        $unassignedEngineers = User::where('role', 'engineer')->whereNotIn('id', $assignedEngineers)->get();;
        return view('projects.edit', compact('project', 'unassignedEngineers'));
    }

    public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date|before:due_date',
        'due_date' => 'required|date|after:start_date',
        'engineers' => 'nullable|array',
        'engineers.*' => 'exists:users,id',
        'estimated_hours' => 'required|numeric|min:0'
    ], [
        'start_date.before' => 'The start date must be before the due date.',
        'due_date.after' => 'The due date must be after the start date.'
    ]);

    // Update the project details
    $project->update($validated);

    // Merge existing and new engineers
    if ($request->has('engineers')) {
        $existingEngineers = $project->engineers->pluck('id')->toArray();
        $newEngineers = $request->input('engineers');
        $allEngineers = array_unique(array_merge($existingEngineers, $newEngineers));
        $project->engineers()->sync($allEngineers);
    }
    return $this->show($project);
}


    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    
    }
}