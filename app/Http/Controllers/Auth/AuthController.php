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
            'email' => '    invalid Email .',
            'password' => 'incorrect password.',
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
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone' => ['required', 'regex:/^07[0-9]{8}$/'],
    ], [
        'phone.regex' => 'The phone number must start with 07 and contain exactly 10 digits.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.confirmed' => 'The password confirmation does not match.',
    ]);

    $validator->after(function ($validator) use ($request) {
        $password = $request->password;

        if (!preg_match('/^[A-Z]/', $password)) {
            $validator->errors()->add('password', 'The password must start with an uppercase letter.');
        }

        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $validator->errors()->add('password', 'The password must contain at least one special character.');
        }

        if (!preg_match('/[0-9]/', $password)) {
            $validator->errors()->add('password', 'The password must contain at least one number.');
        }

        preg_match_all('/[a-z]/', $password, $lowercaseMatches);
        if (count($lowercaseMatches[0]) < 5) {
            $validator->errors()->add('password', 'The password must contain at least 5 lowercase letters.');
        }
    });

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // إنشاء المستخدم
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->address = $request->address;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->save();

    Auth::login($user);

    return redirect('/home');
}
}

