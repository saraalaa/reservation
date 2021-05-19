<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function read($notification_id)
    {
        $notification = auth()->user()->notifications()->find($notification_id);
        $notification->markAsRead();
        if (auth()->user()->type == 'doctor')
            return redirect('doctor-reservations');
        if (auth()->user()->type == 'user')
            return redirect(route('home'));
    }
}
