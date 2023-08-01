<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $messages = Message::where('sender_id', $user->id)
                           ->orWhere('receiver_id', $user->id)
                           ->orderBy('created_at', 'asc')
                           ->get();

        return view('messages.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        $recipient = User::find($request->receiver_id);
        $recipient->notify(new NewMessageNotification('You have a new message: ' . $request->message));

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }
}

