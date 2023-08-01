<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $user = auth()->user();
        $userIdToAdd = $request->input('user_id');

        // Check if the user is not already in the Wishlist
        if (!$user->wishlist->contains($userIdToAdd)) {
            $user->wishlist()->attach($userIdToAdd);
        }
    }
}
