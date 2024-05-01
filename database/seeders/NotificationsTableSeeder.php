<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        Notification::create([
            'user_id' => 3, // Assuming Alice Johnson
            'message' => 'Reminder: Weekly project meeting tomorrow at 10 AM.',
            'status' => 'unread',
            'notification_date' => now()
        ]);

        Notification::create([
            'user_id' => 4, // Assuming Bob Lee
            'message' => 'Deadline approaching for task: Database Design.',
            'status' => 'unread',
            'notification_date' => now()
        ]);

        // Add more notifications as necessary
    }
}
