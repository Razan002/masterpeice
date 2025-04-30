@include('components.header')
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Shop</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 fw-bold">Your Shopping Cart</h1>
            <nav aria-label="breadcrumb">
               
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(!empty($cartItems))
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cart Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 120px">Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url('images/'.$item['image']) }}" 
                                             alt="{{ $item['name'] }}" 
                                             class="img-fluid rounded"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <p class="small text-muted mb-0">{{ Str::limit($item['description'], 50) }}</p>
                                    </td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="{{ $item['quantity'] }}" 
                                                   min="1" 
                                                   class="form-control form-control-sm" 
                                                   style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>${{ number_format($item['total'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mb-4">
                <a href="{{ route('product.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
              <a href="{{ route('checkout.create') }}" class="btn btn-primary">
    Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
</a>
                
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal:</span>
                        <span>${{ number_format(array_reduce($cartItems, function($carry, $item) {
                            return $carry + ($item['price'] * $item['quantity']);
                        }, 0), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Tax:</span>
                        <span>$0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span>${{ number_format(array_reduce($cartItems, function($carry, $item) {
                            return $carry + ($item['price'] * $item['quantity']);
                        }, 0), 2) }}</span>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button class="btn btn-primary" type="button">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
            <h3 class="mb-3">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet</p>
            <a href="{{ route('checkout.success') }}" class="btn btn-primary px-4">
                <i class="fas fa-store me-2"></i> Start Shopping
            </a>
        </div>
    </div>
    @endif
</div>

@include('components.footer')

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .quantity-input {
        max-width: 70px;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 0 !important;
    }
</style>