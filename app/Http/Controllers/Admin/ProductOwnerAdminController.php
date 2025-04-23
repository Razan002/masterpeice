<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // إذا كنت تستخدم نموذج Product
use App\Models\Booking; // إذا كنت بحاجة لإدارة الحجوزات

class ProductOwnerAdminController extends Controller
{
    public function __construct()
    {
        // تطبيق middleware للتحقق من أن المستخدم لديه دور product_owner
        $this->middleware(['auth', 'role:product_owner']);
    }

    /**
     * عرض لوحة تحكم مالك المنتج
     */
    public function dashboard()
    {
        $products = Product::where('owner_id', auth()->id())->get();
        $bookings = Booking::whereHas('product', function($query) {
            $query->where('owner_id', auth()->id());
        })->get();

        return view('product_owner.dashboard', compact('products', 'bookings'));
    }

    /**
     * عرض قائمة المنتجات الخاصة بمالك المنتج
     */
    public function products()
    {
        $products = Product::where('owner_id', auth()->id())->get();
        return view('product_owner.products.index', compact('products'));
    }

    /**
     * عرض نموذج إنشاء منتج جديد
     */
    public function createProduct()
    {
        return view('product_owner.products.create');
    }

    /**
     * حفظ المنتج الجديد
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $validated['owner_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('product_owner.products')
               ->with('success', 'تم إضافة المنتج بنجاح');
    }
}