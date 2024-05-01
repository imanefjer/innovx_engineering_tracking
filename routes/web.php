<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'preventCache'])->name('dashboard'); // Adding caching prevention here as well

// Adding 'preventCache' to existing auth middleware group for user profiles
Route::middleware(['auth', 'preventCache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);

});

// Adding 'preventCache' to the admin group
Route::middleware(['auth', 'admin', 'preventCache'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/search-users', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/edit-user/{user}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update-user/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/create-user', [AdminController::class, 'create'])->name('admin.create-user');
    Route::post('/admin/store-user', [AdminController::class, 'store'])->name('admin.store-user');
});
Route::middleware(['auth', 'manager', 'preventCache'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');  
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/assign-tasks', [ProjectController::class, 'assignTasks'])->name('projects.assign_tasks');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks', [TaskController::class, 'store1'])->name('tasks.store1');


});


require __DIR__.'/auth.php';
