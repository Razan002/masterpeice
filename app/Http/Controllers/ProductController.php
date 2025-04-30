<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with(['category' => function($query) {
            $query->select('id', 'name');
        }]);
    
        if(request()->filled('search')) {
            $query->where('name', 'like', '%'.request('search').'%');
        }
    
        if(request()->filled('category')) {
            $query->where('category_id', request('category'));
        }
    
        $products = $query->paginate(12);
    
        $categoriesQuery = Category::query();
        
        if(request()->filled('search')) {
            $categoriesQuery->withCount(['products' => function($q) {
                $q->where('name', 'like', '%'.request('search').'%');
            }]);
        } else {
            $categoriesQuery->withCount('products');
        }
    
        $categories = $categoriesQuery->get();
    
        return view('shop', compact('products', 'categories'));
    }

    public function cart()
    {
        $cartItems = session()->get('cart', []);
        
        // جلب بيانات كاملة لكل منتج من الداتابيز
        $productsInCart = [];
        $total = 0;
        
        foreach ($cartItems as $productId => $item) {
            $product = Product::find($productId);
            
            if ($product) {
                $productsInCart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'description' => $product->description,
                    'quantity' => $item['quantity'],
                    'total' => $product->price * $item['quantity']
                ];
                
                $total += $product->price * $item['quantity'];
            }
        }
        
        return view('cart.index', [
            'cartItems' => $productsInCart,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    $product = Product::findOrFail($productId);
    $quantity = $request->input('quantity', 1);
    
    $cart = session()->get('cart', []);
    
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        $cart[$productId] = [
            'quantity' => $quantity
        ];
    }
    
    session()->put('cart', $cart);
    
    return redirect()->route('cart')->with('success', 'تمت إضافة المنتج إلى السلة!');
}

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart')->with('success', 'Cart updated!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }

    // في ProductController أو CheckoutController
public function checkout()
{
    $cartItems = session()->get('cart', []);
    
    if (empty($cartItems)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }

    $productsInCart = [];
    $total = 0;
    
    foreach ($cartItems as $productId => $item) {
        $product = Product::find($productId);
        
        if ($product) {
            $productsInCart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity']
            ];
            
            $total += $product->price * $item['quantity'];
        }
    }
    
    return view('checkout', [
        'cartItems' => $productsInCart,
        'total' => $total
    ]);
}

public function processCheckout(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'payment_method' => 'required'
    ]);
    
    $cartItems = session()->get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }
    
    // هنا يمكنك إضافة عملية الدفع الفعلية حسب طريقة الدفع المختارة
    // مثلاً: stripe, paypal, etc.
    
    // بعد اكتمال الدفع بنجاح:
    session()->forget('cart'); // حذف محتويات السلة
    
    return redirect()->route('checkout.success')->with([
        'order_id' => uniqid(), // رقم طلب فريد
        'total' => array_reduce($cartItems, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0)
    ]);
}

public function checkoutSuccess()
{
    if (!session()->has('order_id')) {
        return redirect()->route('home');
    }
    
    return view('checkout-success', [
        'order_id' => session('order_id'),
        'total' => session('total')
    ]);
}
}