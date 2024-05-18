<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
class EngineerController extends Controller
{
    /**
     * Handle the search request for engineers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        // Assuming you have a role or type column to identify engineers
        $engineers = User::where(function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })->where('role', 'engineer') // Adjust according to your role system
          ->get(['id', 'name', 'email']);

        return response()->json($engineers);
    }

    public function dashboard()
    {
        $user = auth()->user();  // Fetch the logged-in user
        $projects = $user->assignedProjects;  // Fetch projects related to the engineer
    
        // Enhance projects with task status counts specific to this engineer
        $projects->each(function ($project) use ($user) {
            $project->in_progress_tasks_count = $project->tasks()
                ->where('status', 'in progress')
                ->where('assigned_to', $user->id)  // Ensure tasks are assigned to this engineer
                ->count();
            $project->pending_tasks_count = $project->tasks()
                ->where('status', 'pending')
                ->where('assigned_to', $user->id)  // Ensure tasks are assigned to this engineer
                ->count();
            $project->overdue_tasks_count = $project->tasks()
                ->where('due_date', '<', now())
                ->where('status', '!=', 'completed')
                ->where('assigned_to', $user->id)  // Ensure tasks are assigned to this engineer
                ->count();
        });
    
        // Retrieve only tasks assigned to this engineer, grouped by status
        $tasks = $user->tasks()->with('project')->get()->groupBy('status');
    
        return view('engineers.dashboard', compact('projects', 'tasks'));
    }
    
    

    public function showProject(Project $project)
    {
        $tasks = $project->tasks()->where('assigned_to', auth()->id())->get(); // Ensure you have a relationship or query to get tasks assigned to the engineer
        return view('engineers.project_detail', compact('project', 'tasks'));
    }
   

}