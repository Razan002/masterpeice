<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::with('media', 'destination')
            ->paginate(9);

        $destinations = Destination::all();

        // جلب آخر 3 حزم لعرضها في قسم خاص
        $latestPackages = Package::with('media', 'destination')
            ->latest()
            ->take(3)
            ->get();

        return view('package', compact('packages', 'destinations', 'latestPackages'));
    }


    public function detailspackages($id)
    {
        $package = Package::with('media', 'destination')->findOrFail($id);

        $latestPackages = Package::with('media', 'destination')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('detailspackages', compact('package', 'latestPackages'));
    }

    // public function makeAvailable(Package $package)
    // {
    //     $package->update(['is_available' => true]);
    //     return back()->with('success', 'تم تفعيل الباقة بنجاح');
    // }
}
