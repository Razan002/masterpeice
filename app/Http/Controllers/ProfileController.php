<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;

class ProfileController extends Controller
{
    // عرض الصفحة الشخصية للمستخدم
    public function show()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();
    
        return view('users.profile', compact('user', 'bookings'));
    }
    

    // تحديث بيانات المستخدم
    public function update(Request $request)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
        ]);

        // استرجاع المستخدم الحالي
        $user = Auth::user();

        // تحديث بيانات المستخدم
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'تم حفظ التعديلات بنجاح!');
    }

    // إلغاء الحجز
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // التأكد أن الحجز يعود للمستخدم الحالي
        if ($booking->user_id != Auth::id()) {
            return redirect()->route('profile.show')->with('error', 'ليس لديك صلاحية لإلغاء هذا الحجز.');
        }

        // إلغاء الحجز
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('profile.show')->with('success', 'تم إلغاء الحجز بنجاح!');
    }
}
