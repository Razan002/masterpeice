<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        // بدء الاستعلام مع eager loading
        $query = Product::with(['category' => function($query) {
            $query->select('id', 'name'); // تحميل فقط الحقول المطلوبة
        }]);
    
        // تطبيق البحث إذا وجد
        if(request()->filled('search')) {
            $query->where('name', 'like', '%'.request('search').'%');
        }
    
        // تطبيق تصفية الفئة إذا وجدت
        if(request()->filled('category')) {
            $query->where('category_id', request('category'));
        }
    
        // تنفيذ الاستعلام مع الترقيم
        $products = $query->paginate(12);
    
        // جلب الفئات مع عدد المنتجات (مع مراعاة البحث إن وجد)
        $categoriesQuery = Category::query();
        
        if(request()->filled('search')) {
            $categoriesQuery->withCount(['products' => function($q) {
                $q->where('name', 'like', '%'.request('search').'%');
            }]);
        } else {
            $categoriesQuery->withCount('products');
        }
    
        $categories = $categoriesQuery->get();
    
        // DEBUG: يمكنك استخدام هذا للتحقق من البيانات
        // dd($products, $categories);
    
        return view('shop', compact('products', 'categories'));
    }
}