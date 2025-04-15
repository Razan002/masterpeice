<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('media', 'destination')  // تحميل العلاقات بشكل مسبق (Eager Loading)
        ->paginate(9);  // تحديد عدد العناصر في الصفحة (9 عناصر لكل صفحة)
        
        $destinations = Destination::all();
        return view('package', compact('packages', 'destinations')); // تغيير 'packages.index' إلى 'package'
    }

    public function detailspackages($id)
    {
        $package = Package::findOrFail($id);
        return view('detailspackages', compact('package'));
    }
    
    
}

