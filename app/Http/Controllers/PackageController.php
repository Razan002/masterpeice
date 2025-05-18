<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use App\Models\Booking; // أضف هذا الاستيراد
use Illuminate\Http\Request;
use Carbon\Carbon;

class PackageController extends Controller
{
    public function index()
    {
        // جلب الباقات النشطة فقط
        $packages = Package::with(['media', 'destination', 'bookings']) // أضف bookings للعلاقة
            ->where('date', '>=', Carbon::today())
            ->where('is_available', true)
            ->orderBy('date', 'asc')
            ->paginate(9);

        // حساب عدد الحجوزات لكل باقة وتحديث حالة is_available
        foreach ($packages as $package) {
            $totalBookings = $package->bookings->sum('people_count');
            if ($totalBookings >= $package->max_people) {
                $package->update(['is_available' => false]);
            }
        }

        $destinations = Destination::all();

        // جلب آخر 3 حزم نشطة
        $latestPackages = Package::with(['media', 'destination', 'bookings'])
            ->where('date', '>=', Carbon::today())
            ->where('is_available', true)
            ->latest()
            ->take(3)
            ->get();

        return view('package', compact('packages', 'destinations', 'latestPackages'));
    }

    public function detailspackages($id)
    {
        $package = Package::with(['media', 'destination', 'bookings'])->findOrFail($id);

        // حساب عدد الحجوزات للباقة الحالية
        $totalBookings = $package->bookings->sum('people_count');
        $availableSpots = max(0, $package->max_people - $totalBookings);

        // التحقق من صلاحية الباقة
        if ($package->date < Carbon::today() || !$package->is_available || $availableSpots <= 0) {
            return redirect()->route('package')
                ->with('error', 'package_not_available');
        }

        // جلب باقات أخرى مقترحة
        $latestPackages = Package::with(['media', 'destination', 'bookings'])
            ->where('id', '!=', $id)
            ->where('date', '>=', Carbon::today())
            ->where('is_available', true)
            ->latest()
            ->take(3)
            ->get();

        return view('detailspackages', compact('package', 'latestPackages', 'availableSpots'));
    }

    // دالة لتعطيل الباقات المنتهية الصلاحية (يمكن استدعاؤها يومياً عبر Cron Job)
    public function disableExpiredPackages()
    {
        $expiredCount = Package::where('date', '<', Carbon::today())
            ->where('is_available', true)
            ->update(['is_available' => false]);
            
        return response()->json([
            'message' => 'desabled  ' . $expiredCount . ' expired packages.',
        ]);
    }

    // دالة إضافية لإعادة تفعيل الباقات إذا لزم الأمر
    public function enablePackage($id)
    {
        $package = Package::findOrFail($id);
        $package->update(['is_available' => true]);
        
        return back()->with('success', 'package_reactivated');
    }
    
}