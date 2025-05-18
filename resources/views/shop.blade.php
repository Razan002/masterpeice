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

<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Categories</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('product.index') }}" 
                               class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                                All Products
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('product.index', ['category' => $category->id]) }}" 
                                   class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                                    {{ $category->name }}
                                    <span class="badge bg-primary float-end">{{ $category->products_count ?? '' }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
              
                <div class="row mb-5">
                    <div class="col-12">
                        <form action="{{ route('product.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Local Products</h6>
                    <h1 class="mb-5">Explore Local Products</h1>
                </div>

             <!-- Products Display -->
@if($products->count() > 0)
<div class="row g-4 justify-content-center">
    @foreach($products as $product)
        <div class="col-lg-3 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="package-item">
                <div class="overflow-hidden">
                    <a href="{{ route('product.show', $product->id) }}">
                       <img class="img-fluid w-100" src="{{ asset('storage/' .$product->image) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    </a>
                </div>
                <div class="text-center p-3">
                    <h5 class="mb-2" style="font-size: 1rem;">{{Str::limit( $product->name, 15)}}</h5>
                    <div class="price-overlay">
                        <span class="price-badge">JD{{ number_format($product->price, 2) }}</span>
                        {{-- @if($product->quantity < 1)
                            <span class="badge bg-danger ms-1">Out of Stock</span>
                        @endif --}}
                    </div>
                    <p style="font-size: 0.8rem;">{{ Str::limit($product->description, 25) }}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" 
                                   class="form-control form-control-sm mb-2" 
                                   @if($product->quantity < 1) disabled @endif>
                            <button type="submit" class="btn btn-sm w-100 
                                @if($product->quantity >= 1) btn-primary @else btn-secondary disabled @endif"
                                @if($product->quantity < 1) disabled @endif>
                                <i class="fa fa-shopping-cart me-1"></i> 
                                @if($product->quantity >= 1) Add to Cart @else Out of Stock @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
@else
    <div class="alert alert-info text-center">
        No products found matching your criteria.
    </div>
@endif
    </div>
</div>
    </div>
</div>

@include('components.footer')
