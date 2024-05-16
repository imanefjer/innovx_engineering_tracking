<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Task;
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
                $view->with('pendingTasksCount', $pendingTasksCount);
            } else {
                $view->with('pendingTasksCount', 0);  // No pending tasks if no user is logged in
            }
        });
    }
}
