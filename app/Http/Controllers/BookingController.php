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
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'payment_method' => 'required|in:online,on_spot',
            'people_count' => 'required|integer|min:1',
        ]);

        if (!$request->package_id && !$request->destination_id) {
            return back()->with('error', 'يجب اختيار باقة أو وجهة!');
        }

        try {
            if ($request->package_id) {
                $package = Package::findOrFail($request->package_id);
                
                $totalBookedPeople = Booking::where('package_id', $package->id)
                    ->where('booking_date', $request->booking_date)
                    ->sum('people_count');
                
                $availablePeople = $package->max_people - $totalBookedPeople;
                
                if ($availablePeople <= 0) {
                    return back()->with('error', 'هذه الباقة ممتلئة بالكامل لهذا التاريخ!');
                }
                
                if ($request->people_count > $availablePeople) {
                    return back()->with('error', "لا يوجد سوى $availablePeople أماكن متبقية في هذه الباقة!");
                }
                
                $base_price = $package->price;
                $discount = $package->discount ?? 0;
            } 
            elseif ($request->destination_id) {
                $destination = Destination::findOrFail($request->destination_id);
                $base_price = $destination->price;
                $discount = $destination->discount ?? 0;
            }

            if ($discount > 0) {
                $base_price = $base_price * (1 - $discount / 100);
            }

            $total_price = $base_price * $request->people_count;

            Booking::create([
                'user_id' => Auth::id(),
                'package_id' => $request->package_id,
                'destination_id' => $request->destination_id,
                'booking_date' => $request->booking_date,
                'payment_method' => $request->payment_method,
                'people_count' => $request->people_count,
                'total_price' => $total_price,
                'status' => 'pending',
            ]);

            if ($request->package_id) {
                $newTotalBooked = $totalBookedPeople + $request->people_count;
                if ($newTotalBooked >= $package->max_people) {
                    $package->update(['is_available' => false]);
                }
            }

            return back()->with('success', 'تم الحجز بنجاح!');
        } catch (\Exception $e) {
            return back()->with('error', 'فشل الحجز: ' . $e->getMessage());
        }
    }
}