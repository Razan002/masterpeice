<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'package', 'destination'])
            ->latest();
            
        // فلترة حسب النوع
        if ($request->has('type')) {
            if ($request->type == 'package') {
                $query->where('reviewable_type', 'App\Models\Package');
            } elseif ($request->type == 'destination') {
                $query->where('reviewable_type', 'App\Models\Destination');
            }
        }
        
        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhere('comment', 'like', "%$search%");
        }
        
        $reviews = $query->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }
}