<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    // 1. Show the login form
    public function create()
    {
        return view('auth.login'); // عرض صفحة الـ login
    }

    // 2. Handle login request
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect user after successful login
            return redirect()->intended(route('home')); // يمكنك تحديد الصفحة التي ترغب بتوجيه المستخدم إليها
        }

        // If login fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // 3. Handle logout request
    public function destroy()
    {
        Auth::logout(); // Logout user
        return redirect()->route('home'); // Redirect to home or any other page
    }
}
