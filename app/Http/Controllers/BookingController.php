<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'payment_method' => 'required|in:online,on_spot',
            'total_price' => 'required|numeric',
        ]);
    
        // تحقق من إدخال إما package أو destination
        if (!$request->package_id && !$request->destination_id) {
            return back()->with('error', 'يجب اختيار باقة أو وجهة!');
        }
    
        try {
            Booking::create([
                'user_id' => Auth::id(),
                'package_id' => $request->package_id,
                'destination_id' => $request->destination_id,
                // ... باقي الحقول
            ]);
            return back()->with('success', 'تم الحجز بنجاح!');
        } catch (\Exception $e) {
            return back()->with('error', 'فشل الحجز: ' . $e->getMessage());
        }
    }
}
