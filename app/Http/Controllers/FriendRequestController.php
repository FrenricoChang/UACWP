<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\FriendRequestNotification;

class FriendRequestController extends Controller
{
    public function sendFriendRequest(Request $request)
    {
        // Logic to save the friend request to the database
        $friendRequest = FriendRequest::create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $request->recipient_id,
            // Other friend request data as needed
        ]);

        // Notify the recipient about the friend request
        $recipient = User::find($request->recipient_id);
        $recipient->notify(new FriendRequestNotification(auth()->user()));

        // Redirect back or show a success message
        // ...
    }
}

