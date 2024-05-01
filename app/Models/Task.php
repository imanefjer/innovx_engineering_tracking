<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $dates = ['start_date', 'due_date'];
    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];
    protected $fillable = ['name', 'description', 'status', 'start_date', 'due_date', 'estimated_hours', 'actual_hours', 'project_id', 'assigned_to'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
