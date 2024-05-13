<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssigned extends Notification
{
    use Queueable;
    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database']; // This specifies that the notification is sent to the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have been assigned a new task: ' . $this->task->name,
            'task_id' => $this->task->id,
            'project_id' => $this->task->project_id
        ];
    }
}
