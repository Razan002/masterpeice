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

    // تغيير عدد المنتجات في الصفحة إلى 3
    $products = $query->paginate(3); // هنا تم التغيير من 12 إلى 3

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

    // دالة عرض المنتج المفرد
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        // الحصول على منتجات ذات صلة (نفس الفئة)
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->inRandomOrder()
                                ->limit(4)
                                ->get();
        
        return view('single-products', compact('product', 'relatedProducts')); // تغيير هنا
    }

    public function cart()
    {
        $cartItems = session()->get('cart', []);
        
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
    'quantity' => $quantity,
    'price' => $product->price
];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart')->with('success', '   product added to cart !');
    }

public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $request->quantity;

        // تأكدي من وجود السعر داخل السلة
        if (!isset($cart[$id]['price'])) {
            $product = Product::find($id);
            if ($product) {
                $cart[$id]['price'] = $product->price;
            }
        }

        $cart[$id]['total'] = $cart[$id]['price'] * $request->quantity;

        session()->put('cart', $cart);

        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return response()->json([
            'success' => true,
            'item_total' => number_format($cart[$id]['total'], 2),
            'cart_total' => number_format($cartTotal, 2),
        ]);
    }

    return response()->json(['success' => false], 404);
}

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
        
        session()->forget('cart');
        
        return redirect()->route('checkout.success')->with([
            'order_id' => uniqid(),
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
