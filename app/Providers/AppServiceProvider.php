<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Task;
use App\Models\Project;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {  // Check if the user is logged in
                $pendingTasksCount = Task::where('status', 'pending')
                                         ->where('assigned_to', auth()->id())
                                         ->count();
                $overdueTasksCount = Task::where('status', '!=', 'completed')
                                         ->where('assigned_to', auth()->id())
                                         ->where('due_date', '<', now())
                                         ->count();

                $overdueProjectsCount = Project::where('manager_id', auth()->id())
                ->whereHas('tasks', function ($query) {
                    $query->where('due_date', '<', now())
                        ->where('status', '!=', 'completed');
                })->count();
                $view->with('pendingTasksCount', $pendingTasksCount +$overdueTasksCount);
                $view->with('overdueProjectsCount', $overdueProjectsCount);
                                
            } else {
                $view->with('pendingTasksCount', 0);  // No pending tasks if no user is logged in
            }
        });
    }
}
