<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'project_id' => 1, // Assuming Project Alpha
            'name' => 'Initial Setup',
            'description' => 'Setup initial project configurations',
            'status' => 'completed',
            'assigned_to' => 3, // Assuming assigned to Alice Johnson
            'start_date' => '2024-01-02',
            'due_date' => '2024-01-15',
            'estimated_hours' => 20,
            'actual_hours' => 18
        ]);

        Task::create([
            'project_id' => 1, // Assuming Project Alpha
            'name' => 'Database Design',
            'description' => 'Design the initial database schema',
            'status' => 'in progress',
            'assigned_to' => 4, // Assuming assigned to Bob Lee
            'start_date' => '2024-01-10',
            'due_date' => '2024-01-20',
            'estimated_hours' => 15,
            'actual_hours' => 10
        ]);

        // Add additional tasks as necessary
    }
}

