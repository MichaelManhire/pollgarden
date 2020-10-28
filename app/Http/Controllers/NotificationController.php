<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readNotifications = Auth::user()->readNotifications;
        $unreadNotifications = Auth::user()->unreadNotifications;

        Auth::user()->unreadNotifications->markAsRead();

        return view('notifications.index', [
            'readNotifications' => $readNotifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }
}
