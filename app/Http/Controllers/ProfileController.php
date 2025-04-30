<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;
use App\Models\Review;
use App\Models\Destination;
use App\Models\Package;
use App\Models\SpecialOffer;

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

    public function addReview(Request $request)
{
    // التحقق من أن المستخدم قد حجز بالفعل
    $user = Auth::user();
    
    // التحقق من الحجز
    $booking = Booking::where('user_id', $user->id)
        ->where('status', '!=', 'cancelled')
        ->where('destination_id', $request->destination_id)  // أو `package_id` حسب الحالة
        ->first();

    if (!$booking) {
        return back()->with('error', 'لا يمكنك إضافة مراجعة لأنك لم تقم بالحجز لهذا المكان.');
    }

    // إذا كان هناك حجز صالح، يتم إضافة المراجعة
    $review = new Review();
    $review->user_id = $user->id;
    $review->destination_id = $request->destination_id;  // أو `package_id`
    $review->booking_id = $booking->id;  // حفظ الـ booking_id في المراجعة
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->save();

    return back()->with('success', 'تم إضافة المراجعة بنجاح!');
}


public function showDestinationDetails($id)
{
    // استرجاع تفاصيل الـ destination
    $destination = Destination::findOrFail($id);

    // استرجاع المراجعات المرتبطة بالـ destination
    $reviews = Review::where('destination_id', $destination->id)->get();

    // تمرير الـ destination و الـ reviews إلى الـ view
    return view('destinationdetails', compact('destination', 'reviews'));
}

}
