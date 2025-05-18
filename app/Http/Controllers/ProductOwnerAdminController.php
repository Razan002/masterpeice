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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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
    
$product = Product::where('owner_id', Auth::id())->findOrFail($id);
    
    
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
public function showProfile()
{
    $user = Auth::user();
    return view('product_owner.profile.show', compact('user'));
}

/**
 * Update profile information
 */
public function updateProfile(Request $request)
{
    $user = Auth::user();
    
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'phone' => ['nullable', 'string', 'max:20'],
        'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'current_password' => ['nullable', 'required_with:password', 'current_password'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);
    
    // Update basic info
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    
    // Update profile photo if uploaded
    if ($request->hasFile('profile_photo')) {
        // Delete old photo if exists
        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }
        
        $path = $request->file('profile_photo')->store('profile-photos', 'public');
        $user->profile_photo_path = $path;
    }
    
    // Update password if provided
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    
    $user->save();
    
    return redirect()->route('product_owner.profile')->with('success', 'Profile updated successfully');
}

/**
 * Show change password form
 */
public function showChangePasswordForm()
{
    return view('product_owner.profile.change-password');
}

/**
 * Process password change
 */
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    
    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();
    
    return redirect()->route('product_owner.profile')->with('success', 'Password changed successfully');
}

}