<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'sender_id' => 2, // Assuming Jane Smith
            'receiver_id' => 3, // Assuming Alice Johnson
            'message' => 'Please update me on the project status by EOD.',
            'sent_at' => now()
        ]);

        Message::create([
            'sender_id' => 3, // Assuming Alice Johnson
            'receiver_id' => 2, // Assuming Jane Smith
            'message' => 'I have uploaded the latest status report in the system.',
            'sent_at' => now()
        ]);

        // Add more messages as necessary
    }
}
