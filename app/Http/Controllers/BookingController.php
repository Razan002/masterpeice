<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'people_count' => 'required|integer|min:1',
            'payment_method' => 'required|in:online,on_spot',
            'booking_date' => 'required|date|after_or_equal:today'
        ]);
    
        
    
        // التحقق من عدم وجود حجز آخر في نفس اليوم
        $existingBookingOnDate = Booking::where('user_id', Auth::id())
            ->whereDate('booking_date', $request->booking_date)
            ->exists();
            
        if ($existingBookingOnDate) {
            return back()->with('error', 'لديك حجز فعال في هذا التاريخ، لا يمكن حجز أكثر من باقة في نفس اليوم!');
        }
    
        if ($request->package_id) {
            return $this->handlePackageBooking($request);
        }
    }

    protected function handlePackageBooking($request)
    {
        $package = Package::findOrFail($request->package_id);

        if (!$package->is_available) {
            return back()->with('error', 'هذه الباقة غير متاحة للحجز حالياً!');
        }

        if (Carbon::parse($request->booking_date)->lt(Carbon::today())) {
            return back()->with('error', 'لا يمكن الحجز في تاريخ قديم!');
        }

        // التحقق من عدم التكرار لنفس الباقة
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('package_id', $package->id)
            ->whereDate('booking_date', $request->booking_date)
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'لديك حجز فعال لهذه الباقة في نفس التاريخ!');
        }

        // إنشاء الحجز
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'booking_date' => $request->booking_date,
            'payment_method' => $request->payment_method,
            'people_count' => $request->people_count,
            'total_price' => $package->price * $request->people_count,
            'status' => 'confirmed'
        ]);

        // تحديث حالة الباقة إذا وصلت للحد الأقصى
        $totalBooked = Booking::where('package_id', $package->id)
            ->whereDate('booking_date', $request->booking_date)
            ->sum('people_count');

        if ($totalBooked >= $package->max_people) {
            $package->update(['is_available' => false]);
        }

        return redirect()->route('home')->with('success', 'تم الحجز بنجاح!')->with('booking_id', $booking->id);
    }

    protected function createBooking($request, $base_price, $discount, $package = null, $destination = null)
    {
        // نفس المنطق السابق مع إضافة التحقق من التاريخ
        $existingBookingOnDate = Booking::where('user_id', Auth::id())
            ->whereDate('booking_date', $request->booking_date)
            ->exists();
            
        if ($existingBookingOnDate) {
            return back()->with('error', 'لديك حجز فعال في هذا التاريخ، لا يمكن حجز أكثر من باقة في نفس اليوم!');
        }

        if ($discount > 0) {
            $base_price = $base_price * (1 - $discount / 100);
        }

        $total_price = $base_price * $request->people_count;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'package_id' => $package ? $package->id : null,
            'destination_id' => $destination ? $destination->id : null,
            'booking_date' => $request->booking_date,
            'payment_method' => $request->payment_method,
            'people_count' => $request->people_count,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        if ($package) {
            $newTotalBooked = Booking::where('package_id', $package->id)
                ->where('booking_date', $request->booking_date)
                ->sum('people_count');
                
            if ($newTotalBooked >= $package->max_people) {
                $package->update(['is_available' => false]);
            }
        }
        
        return redirect()->route('home')->with('success', 'تم الحجز بنجاح!')->with('booking_id', $booking->id);
    }
}