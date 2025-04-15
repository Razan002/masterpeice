<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    // عرض نموذج تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // عملية تسجيل الدخول
    public function login(Request $request)
    {
        // التحقق من المدخلات
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // عرض نموذج التسجيل
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // عملية التسجيل
    public function register(Request $request)
    {
        // التحقق من المدخلات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // إنشاء مستخدم جديد
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        // تسجيل الدخول بعد النجاح
        Auth::login($user);

        return redirect('/home');
    }

    // عملية تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
