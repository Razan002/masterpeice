<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    // عرض نموذج تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // عملية تسجيل الدخول
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // التحقق من الدور بناءً على العمود 'role' في جدول المستخدمين
        $user = Auth::user();
        
        if ($user->role == 'general_admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role == 'product_owner') {
            return redirect()->intended('/product-owner/dashboard');
        }

        return redirect()->intended('/user/dashboard');
    }

    return back()->withErrors([
        'email' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
    ]);
}

    // عملية تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}