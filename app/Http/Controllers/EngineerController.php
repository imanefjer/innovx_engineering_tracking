<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Notification;
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
        $tasks = $user->tasks()->with('project')->get()->groupBy('status');

        return view('engineers.dashboard', compact('projects', 'tasks'));
    }


    public function showProject(Project $project)
    {
        $tasks = $project->tasks()->where('assigned_to', auth()->id())->get(); // Ensure you have a relationship or query to get tasks assigned to the engineer
        return view('engineers.project_detail', compact('project', 'tasks'));
    }
    public function notifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications; // Assuming your User model is correctly linked to the Notification model

        return view('engineers.notifications', compact('notifications'));
    }
    public function markNotificationAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        if ($notification->user_id === auth()->id()) {
            $notification->update(['status' => 'read']);
            return back()->with('success', 'Notification marked as read.');
        }
        return back()->with('error', 'You do not have permission to mark this notification as read.');
    }


}