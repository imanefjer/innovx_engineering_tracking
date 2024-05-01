<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password'),
            'role' => 'administrator'
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager'
        ]);

        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'password' => bcrypt('password'),
            'role' => 'engineer'
        ]);

        User::create([
            'name' => 'Bob Lee',
            'email' => 'bob.lee@example.com',
            'password' => bcrypt('password'),
            'role' => 'engineer'
        ]);

        // Add additional users as necessary
    }
}
