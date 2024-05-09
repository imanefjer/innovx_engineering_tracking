<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'hours', 'date'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    protected $casts = [
        'date' => 'date',  // Ensures that 'date' is treated as a Carbon instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
