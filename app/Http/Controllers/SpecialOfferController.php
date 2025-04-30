<?php

namespace App\Http\Controllers;

use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
    public function index()
    {
        $offers = SpecialOffer::all(); // جلب كل العروض
        return view('specialOffers.index', compact('offers'));
    }

    public function create()
    {
        return view('specialOffers.create'); // عرض صفحة إضافة العرض الخاص
    }

    public function store(Request $request)
    {
        // إضافة عرض خاص جديد
        SpecialOffer::create([
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'package_id' => $request->package_id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('specialOffers.index');
    }
}
