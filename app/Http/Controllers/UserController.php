<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Booking;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * عرض نموذج التسجيل
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * معالجة طلب التسجيل
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => ['required', 'in:admin,product_owner,user'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],  // إضافة الدور مباشرة
        ]);

        Auth::login($user);

        return $this->redirectToDashboard($user);
    }

    /**
     * عرض صفحة الملف الشخصي للمستخدم الحالي
     */
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    /**
     * عرض بيانات مستخدم معين
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * عرض نموذج تعديل بيانات المستخدم
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * تحديث بيانات المستخدم
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => ['required', 'in:admin,product_owner,user']
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        
        // تحديث الدور
        $user->role = $validated['role'];  // تحديث العمود 'role' مباشرة
        $user->save();

        return redirect()->route('user.show', $user->id)
                         ->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * التوجيه للوحة التحكم حسب الدور
     */
    protected function redirectToDashboard(User $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'مرحباً أيها الأدمن!');
        }

        if ($user->role == 'product_owner') {
            return redirect()->route('product-owner.dashboard')->with('success', 'مرحباً بمالك المنتج!');
        }

        return redirect()->route('home')->with('success', 'تم التسجيل بنجاح!');
    }

    /**
     * تحديث بيانات الملف الشخصي
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20'
        ]);

        $user->update($validated);

        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    /**
     * إلغاء الحجز
     */
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        // التحقق من ملكية الحجز
        if ($booking->user_id != Auth()->id()) {
            abort(403);
        }

        // التحقق من وقت الإلغاء
        if (now()->diffInHours($booking->booking_date) < 48) {
            return back()->with('error', 'لا يمكن الإلغاء قبل أقل من 48 ساعة من الموعد');
        }

        $booking->update(['status' => 'cancelled']);
        
        return back()->with('success', 'تم إلغاء الحجز بنجاح');
    }
}
