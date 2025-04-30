<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductOwnerAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:product_owner']);
    }

    public function dashboard()
    {
        // حساب عدد المنتجات الخاصة بمالك المنتج الحالي
        $productsCount = Product::where('owner_id', Auth::id())->count();
        
        // باقي الإحصائيات...
        $newOrdersCount = Order::whereHas('products', function($query) {
            $query->where('owner_id', Auth::id());
        })->where('status', 'pending')->count();
        
        $totalSales = OrderProduct::whereHas('product', function($query) {
            $query->where('owner_id', Auth::id());
        })->sum(DB::raw('quantity * price'));
        
        $lowStockCount = Product::where('owner_id', Auth::id())
                               ->where('quantity', '<', 10)
                               ->count();
        
        // جلب أحدث الطلبات
        $recentOrders = Order::whereHas('products', function($query) {
            $query->where('owner_id', Auth::id());
        })->latest()->take(5)->get();
        
        // جلب أحدث المنتجات
        $products = Product::where('owner_id', Auth::id())
                          ->latest()
                          ->take(5)
                          ->get();
        
        // بيانات المخطط البياني (يمكنك تعديلها حسب احتياجاتك)
        $salesChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [12000, 19000, 3000, 5000, 2000, 3000]
        ];
        
        return view('product_owner.dashboard', compact(
            'productsCount',
            'newOrdersCount',
            'totalSales',
            'lowStockCount',
            'recentOrders',
            'products',
            'salesChart'
        ));
    }
    /**
     * عرض نموذج إنشاء منتج جديد
     */

     public function index()
{
    $products = Product::where('owner_id', Auth::id())->get();
    return view('product_owner.products.index', compact('products'));
}
public function create()
{
    $categories = Category::all(); // تأكد من استيراد نموذج Category
    return view('product_owner.products.create', compact('categories'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        
        'quantity' => 'required|integer|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive,out_of_stock',
        
    ]);

    $validated['owner_id'] = Auth::id();
    
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($validated);

    return redirect()->route('product_owner.products.index')
           ->with('success', 'Product added successfully');
}

public function edit($id)
{
    $product = Product::where('owner_id', Auth::id())->findOrFail($id);
    $categories = Category::all(); // إذا كنت تستخدم فئات للمنتجات
    return view('product_owner.products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $product = Product::where('owner_id', Auth::id())->findOrFail($id);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive,out_of_stock',
    ]);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($validated);

    return redirect()->route('product_owner.products.index')
           ->with('success', 'Product updated successfully');
}

public function destroy($id)
{
    
    $product = Product::where('user_id', Auth::id())->findOrFail($id);
    
    
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }
    
 
    $product->delete();

    
    return redirect()->route('product_owner.products.index')
                     ->with('success', 'Product deleted successfully');
}

public function indexOrders()
{
    $orders = Order::whereHas('products', function($query) {
        $query->where('owner_id', Auth::id());
    })->with(['user', 'products'])->latest()->get();

    return view('product_owner.orders.index', compact('orders'));
}

public function showOrder($id)
{
    $order = Order::whereHas('products', function($query) {
        $query->where('owner_id', Auth::id());
    })->with(['user', 'products' => function($query) {
        $query->where('owner_id', Auth::id());
    }])->findOrFail($id);

    return view('product_owner.orders.show', compact('order'));
}


}