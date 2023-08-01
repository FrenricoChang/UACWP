<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function showFriendList(Request $request)
    {
        $user = auth()->user();
        $query = $user->friends()->where('accepted', true);

        $genderFilter = $request->input('gender_filter');
        $hobbyFilter = $request->input('hobby_filter');

        if ($genderFilter && $genderFilter !== 'all') {
            $query->where('gender', $genderFilter);
        }

        if ($hobbyFilter) {
            $query->where(function ($q) use ($hobbyFilter) {
                $q->where('hobbies', 'like', '%' . $hobbyFilter . '%')
                  ->orWhere('field_of_work', 'like', '%' . $hobbyFilter . '%');
            });
        }

        $friends = $query->get();

        return view('profile.friends', compact('friends'));
    }
}

