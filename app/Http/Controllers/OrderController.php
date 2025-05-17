<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // تأكد من أن المستخدم مسجل الدخول
    }
    /**
     * Show the checkout page with cart details.
     */
    public function create()
{
    $cart = session()->get('cart', []);
    

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'سلتك فارغة!');
    }

    // تجهيز المنتجات من السلة
    $cartItems = [];
    $total = 0;

    // جلب المنتجات في السلة وتحديث الكمية والسعر
    foreach ($cart as $productId => $item) {
        $product = Product::find($productId);
        
        if ($product) {
            $cartItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity']
            ];
            
            $total += $product->price * $item['quantity'];
        }
    }

 
    return view('cart.checkout', [
        'cartItems' => $cartItems,
        'total' => $total
    ]);
}

public function show($id)
{
    $order = Order::where('owner_id', Auth::id())->findOrFail($id);
    return view('product_owner.orders.show', compact('order'));
}
    /**
     * Process the order and store it in the database.
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required'
        ]);
    
        // حساب المجموع الإجمالي للسلة
        $cart = session()->get('cart', []);
        $total = 0;
    
        // حساب المجموع الإجمالي بناءً على الكميات والأسعار
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }
    
        // إنشاء طلب جديد مع تمرير total
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total, // تأكد من أن total يتم تمريره هنا
            'status' => 'pending',
            'address' => $request->address,
            'payment_method' => $request->payment_method
        ]);
    
        // إضافة المنتجات إلى الطلب
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $order->products()->attach($productId, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
            }
        }
    
        // مسح السلة بعد إتمام الطلب
        session()->forget('cart');
    
        // إعادة توجيه المستخدم إلى صفحة النجاح مع رسالة النجاح
        return redirect()->route('checkout.create')->with('success', 'تمت معالجة طلبك بنجاح!');
    }
    
    /**
     * Show the order success page.
     */
    public function success()
    {
        return view('cart.success');
    }
}
