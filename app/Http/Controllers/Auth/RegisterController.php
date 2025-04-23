<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // عرض نموذج التسجيل
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // عملية التسجيل
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|in:general_admin,product_owner,user' // تحديث الأدوار المسموحة
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // ... باقي الحقول ...
        ]);
    
        // تعيين الدور (افتراضي 'user' إذا لم يتم تحديد)
        $role = $request->input('role', 'user');
        $user->assignRole($role);
    
        Auth::login($user);
    
        $user = Auth::user();
            
        if ($user->role == 'general_admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role == 'product_owner') {
            return redirect()->intended('/product-owner/dashboard');
        }

        return redirect()->intended('/user/dashboard');
    }
}