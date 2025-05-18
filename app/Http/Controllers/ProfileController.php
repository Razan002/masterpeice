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
use App\Models\Order;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();
        $orders = Order::with('products')->where('user_id', $user->id)->latest()->get();
    
        return view('users.profile', compact('user', 'bookings', 'orders'));
    }
    
    // عرض تفاصيل طلب معين
    public function showOrder($id)
    {
        $order = Order::with('products')->where('user_id', Auth::id())->findOrFail($id);
        return view('users.order-details', compact('order'));
    }
    

    // تحديث بيانات المستخدم
   // تحديث بيانات المستخدم
public function update(Request $request)
{
    // التحقق من صحة المدخلات
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:500',
        'password' => 'nullable|string|min:8|confirmed'
    ]);

    $user = User::findOrFail(Auth::id());

    if ($request->filled('password')) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

    foreach ($validated as $key => $value) {
        $user->$key = $value;
    }
    $user->save();

    return back()->with('success', 'changes saved successfully!');  
}

    // إلغاء الحجز
    // public function cancelBooking($bookingId)
    // {
    //     $booking = Booking::findOrFail($bookingId);

    //     // التأكد أن الحجز يعود للمستخدم الحالي
    //     if ($booking->user_id != Auth::id()) {
    //         return redirect()->route('profile.show')->with('error', 'ليس لديك صلاحية لإلغاء هذا الحجز.');
    //     }

    //     // إلغاء الحجز
    //     $booking->update(['status' => 'cancelled']);

    //     return redirect()->route('profile.show')->with('success', 'تم إلغاء الحجز بنجاح!');
    // }

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
        return back()->with('error', 'you must book a package or destination before adding a review.');
    }

    // إذا كان هناك حجز صالح، يتم إضافة المراجعة
    $review = new Review();
    $review->user_id = $user->id;
    $review->destination_id = $request->destination_id;  // أو `package_id`
    $review->booking_id = $booking->id;  // حفظ الـ booking_id في المراجعة
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->save();

    return back()->with('success', '   review added successfully!');
}
}


// public function showDestinationDetails($id)
// {
//     // استرجاع تفاصيل الـ destination
//     $destination = Destination::findOrFail($id);

//     // استرجاع المراجعات المرتبطة بالـ destination
//     $reviews = Review::where('destination_id', $destination->id)->get();

//     // تمرير الـ destination و الـ reviews إلى الـ view
//     return view('destinationdetails', compact('destination', 'reviews'));
// }


