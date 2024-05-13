<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'type', 'status', 'notification_date'];
    protected $casts = [
        'notification_date' => 'datetime',
    ];
    public function notifiable()
    {
        return $this->morphTo();
    }
}
