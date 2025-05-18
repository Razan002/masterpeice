<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminProfileController extends Controller
{


    // عرض صفحة البروفايل
  public function index()
{
    return view('admin.profile', ['user' => auth::user()]);
}
    // تحديث بيانات البروفايل
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully');  
    }

    // تحديث كلمة المرور
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'password does not match'); 
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'password updated successfully');  
    }
}