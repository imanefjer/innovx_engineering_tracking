<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'Project Alpha',
            'description' => 'Description of Project Alpha',
            'manager_id' => 2, // Assuming Jane Smith is the manager
            'start_date' => '2024-01-01',
            'due_date' => '2024-06-01',
            'estimated_hours' => 200,
            'actual_hours' => 0
        ]);

        Project::create([
            'name' => 'Project Beta',
            'description' => 'Description of Project Beta',
            'manager_id' => 2, // Assuming Jane Smith is the manager
            'start_date' => '2024-02-01',
            'due_date' => '2024-07-01',
            'estimated_hours' => 300,
            'actual_hours' => 0
        ]);

        // Add additional projects as necessary
    }
}
