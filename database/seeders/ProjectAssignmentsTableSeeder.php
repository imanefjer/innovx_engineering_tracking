<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\ProjectAssignment;

class ProjectAssignmentsTableSeeder extends Seeder
{
    public function run()
    {
        ProjectAssignment::create([
            'project_id' => 1, // Assuming Project Alpha
            'user_id' => 3, // Assuming Alice Johnson
            'role' => 'Lead Engineer',
        ]);

        ProjectAssignment::create([
            'project_id' => 1, // Assuming Project Alpha
            'user_id' => 4, // Assuming Bob Lee
            'role' => 'Support Engineer',
        ]);

        // Add more project assignments as necessary
    }
}
