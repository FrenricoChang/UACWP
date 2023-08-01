<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller
{
    public function sendFriendRequest(Request $request, $friendId)
    {
        // Check if the friend request already exists or is pending
        $existingRequest = Friend::where('user_id', auth()->user()->id)
                                 ->where('friend_id', $friendId)
                                 ->where('accepted', false)
                                 ->first();

        if (!$existingRequest) {
            Friend::create([
                'user_id' => auth()->user()->id,
                'friend_id' => $friendId,
                'accepted' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Friend request sent.');
    }

    public function acceptFriendRequest(Request $request, $friendId)
    {
        $friendRequest = Friend::where('user_id', $friendId)
                               ->where('friend_id', auth()->user()->id)
                               ->where('accepted', false)
                               ->first();

        if ($friendRequest) {
            $friendRequest->accepted = true;
            $friendRequest->save();
        }

        return redirect()->back()->with('success', 'Friend request accepted.');
    }

    public function rejectFriendRequest(Request $request, $friendId)
    {
        $friendRequest = Friend::where('user_id', $friendId)
                               ->where('friend_id', auth()->user()->id)
                               ->where('accepted', false)
                               ->first();

        if ($friendRequest) {
            $friendRequest->delete();
        }

        return redirect()->back()->with('success', 'Friend request rejected.');
    }
}

