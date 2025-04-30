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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // التحقق من الدور بناءً على العمود 'role' في جدول المستخدمين
            $user = Auth::user();
            
            if ($user->role == 'general_admin') {
                // التوجيه إلى لوحة التحكم الخاصة بـ general_admin
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role == 'product_owner') {
                // التوجيه إلى لوحة التحكم الخاصة بـ product_owner
                return redirect()->intended(route('product_owner.dashboard'));
            }
    
            // إذا لم يكن المستخدم من أي من الأدوار المذكورة
            return redirect()->intended('/home');
        }
    
        return back()->withErrors([
            'email' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
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
