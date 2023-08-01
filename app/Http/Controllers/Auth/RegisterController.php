<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\SufficientCoins;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:Male,Female',
            'hobbies' => 'required|min:3',
            'hobbies.*' => 'string',
            'instagram' => 'required|url',
            'mobile_number' => 'required|digits:10',
        ];

        $request->validate($rules);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'hobbies' => json_encode($request->input('hobbies')),
            'instagram' => $request->input('instagram'),
            'mobile_number' => $request->input('mobile_number'),
        ]);
    }

    protected function create(array $data)
    {
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
