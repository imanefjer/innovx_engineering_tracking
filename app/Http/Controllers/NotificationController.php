<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            $notifications = $user->notifications()->latest()->get();
            return response()->json($notifications);
        }
        return response()->json([], 401);
    }
}
