<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('sender_id', '=', Auth::id())
            ->orWhere('recipient_id', '=', Auth::id())
            ->latest()
            ->get();

        $messages = $messages
            ->unique(function ($message) {
                return $message->partner();
            })
            ->paginate(10);

        return view('messages.index', ['messages' => $messages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Message::class);

        $message = $this->validateMessage();

        $message['sender_id'] = Auth::id();

        $message = Message::create($message);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Get the messages.
        $messages = Message::where([
            ['sender_id', '=', Auth::id()],
            ['recipient_id', '=', $user->id],
        ])
            ->orWhere([
                ['sender_id', '=', $user->id],
                ['recipient_id', '=', Auth::id()],
            ])
            ->latest();

        // Mark the messages as read.
        $messages->get()->each->markAsRead();

        // Paginate the messages.
        $messages = $messages->paginate(10);

        return view('messages.show', ['messages' => $messages, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $updatedMessage = $this->validateMessage();

        $message->update($updatedMessage);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        return back();
    }

    protected function validateMessage()
    {
        return request()->validate([
            'recipient_id' => 'required|integer|exists:users,id',
            'body' => 'required|string|max:1000',
        ]);
    }
}
