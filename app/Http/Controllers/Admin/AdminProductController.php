<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * عرض جميع المنتجات فقط (بدون تصنيفات أو بحث)
     */
    public function index()
    {
        $products = Product::latest()->paginate(9); // 9 منتجات لكل صفحة
        return view('admin.products.index', compact('products'));
    }

    /**
     * عرض تفاصيل منتج معين
     */
 public function show(Product $product)
{
    $product->load('owner'); // تأكد من تحميل علاقة المالك
    return view('admin.products.show', compact('product'));
}
}