<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('hobby', 'like', "%$keyword%")
                     ->orWhere('field_of_work', 'like', "%$keyword%")
                     ->get();

        return view('search_results', compact('users'));
    }
}
