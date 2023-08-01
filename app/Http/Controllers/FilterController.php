<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FilterController extends Controller
{
    public function filterByGender(Request $request)
    {
        $gender = $request->input('gender');
        $users = User::where('gender', $gender)->get();

        return view('filtered_users', compact('users'));
    }
}
