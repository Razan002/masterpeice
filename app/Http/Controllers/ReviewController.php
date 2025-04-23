<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        // التحقق من أن المستخدم قد حجز هذه الوجهة
        $booking = Booking::where('user_id', Auth::id())
                        ->where('destination_id', $validated['destination_id'])
                        ->where('status', 'confirmed')
                        ->first();

        if (!$booking) {
            return back()->with('error', 'You must book this destination before reviewing it.');
        }

        // التحقق من عدم وجود مراجعة سابقة لهذا الحجز
        if (Review::where('booking_id', $booking->id)->exists()) {
            return back()->with('error', 'You have already reviewed this booking.');
        }

        // إنشاء المراجعة
        Review::create([
            'user_id' => Auth::id(),
            'destination_id' => $validated['destination_id'],
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}