<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Show register form
    public function showForm()
    {
        return view('register');
    }

    // Handle register form submission
    public function register(Request $request)
    {
        // validation
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // save user
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User registered successfully!');
    }
}
