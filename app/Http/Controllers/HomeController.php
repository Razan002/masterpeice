<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator; // لتفعيل Pagination للـ Collections

class HomeController extends Controller
{
    public function index()
    {
        // استرجاع الجولات والوجهات
        $packages = Package::with(['destination', 'media'])
            ->latest()
            ->take(3)
            ->get();
            
        $destinations = Destination::latest()->take(4)->get();

        // تعريف الخدمات كـ Array ثابت
        $staticServices = [
            [
                'icon' => 'fa-map-marker-alt',
                'title' => 'Guided Tours',
                'description' => 'Explore the hidden gems of Al-Salt with our experienced local guides...',
            ],
            [
                'icon' => 'fa-utensils',
                'title' => 'Local Cuisine ',
                'description' => 'Indulge in Al-Salt\'s traditional flavors with our curated food tours...',
            ],
            [
                'icon' => 'fa-hiking',
                'title' => 'Scenic Hikes',
                'description' => 'Join us on breathtaking hikes through Al-Salt’s mountains and valleys...',
            ],
            [
                'icon' => 'fa-shopping-basket',
                'title' => 'Shopping Tours',
                'description' => 'Discover Al-Salt’s vibrant markets for local crafts and souvenirs...',
            ],
            [
                'icon' => 'fa-hotel',
                'title' => 'Hotel Reservations',
                'description' => 'We offer a wide range of accommodations in Al-Salt...',
            ],
            [
                'icon' => 'fa-calendar',
                'title' => 'Event Planning',
                'description' => 'We specialize in organizing unique events and experiences...',
            ],
        ];

        // تحويل المصفوفة إلى Collection ثم تطبيق Pagination يدويًا
        $services = collect($staticServices);
        $currentPage = Paginator::resolveCurrentPage('page');
        $perPage = 4; // عدد الخدمات في كل صفحة
        $currentPageItems = $services->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $services = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $services->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('home', compact('packages', 'destinations', 'services'));
    }
}