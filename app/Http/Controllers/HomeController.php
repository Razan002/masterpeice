<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // استرجاع الجولات والوجهات من قاعدة البيانات
        $packages = Package::with(['destination', 'media'])
        ->latest()
        ->take(3)
        ->get();
        $destinations = Destination::latest()->take(4)->get(); // تأكد من أنك تسترجع الوجهات بشكل صحيح

        // تمرير البيانات إلى الـ View
        return view('home', compact('packages', 'destinations'));  // تأكد من أن اسم الـ View هو home
    }
}
