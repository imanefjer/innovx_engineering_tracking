<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Notification;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all(); // Assuming you have users to whom you can send notifications


        Notification::send($users, new TaskAssigned());
        
    }
}
