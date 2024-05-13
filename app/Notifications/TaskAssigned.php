<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task; // Make sure to import the Task model if not already imported

class TaskAssigned extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have been assigned a new task: ' . $this->task->name,
            'task_id' => $this->task->id,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'message' => 'You have been assigned a new task: ' . $this->task->name,
        ];
    }

}
