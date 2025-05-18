<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض المنتجات مع التصفية والبحث
    public function index()
    {
        $query = Product::with(['category:id,name']);

        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request()->filled('category')) {
            $query->where('category_id', request('category'));
        }

$products = $query->paginate(perPage: 3);

        $categoriesQuery = Category::query();

        if (request()->filled('search')) {
            $categoriesQuery->withCount(['products' => function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%');
            }]);
        } else {
            $categoriesQuery->withCount('products');
        }

        $categories = $categoriesQuery->get();

        return view('shop', compact('products', 'categories'));
    }

    // عرض منتج مفرد
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('single-products', compact('product', 'relatedProducts'));
    }

    // عرض السلة
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

    // إضافة منتج إلى السلة
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

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    // تحديث الكمية في السلة باستخدام Ajax
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;

            if (!isset($cart[$id]['price'])) {
                $product = Product::find($id);
                if ($product) {
                    $cart[$id]['price'] = $product->price;
                }
            }

            $cart[$id]['total'] = $cart[$id]['price'] * $request->quantity;
            session()->put('cart', $cart);

            $cartTotal = array_sum(array_map(function ($item) {
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

    // عرض صفحة الدفع
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

    // معالجة الطلب وتقليل الكمية
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

        foreach ($cartItems as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                if ($product->quantity >= $item['quantity']) {
                    $product->decrement('quantity', $item['quantity']);
                } else {
                    return redirect()->route('cart')->with('error', "Sorry, not enough stock for product: {$product->name}");
                }
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.success')->with([
            'order_id' => uniqid(),
            'total' => array_reduce($cartItems, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0)
        ]);
    }

    // صفحة نجاح الطلب
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
    // إزالة منتج من السلة
public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart')->with('success', 'Product removed from cart!');
}
}
