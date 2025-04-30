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
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="package-item">
                <div class="overflow-hidden">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img class="img-fluid w-100" src="{{ Storage::url('images/'.$product->image) }}" alt="{{ $product->name }}">
                      
                    </a>
                </div>
                <div class="d-flex border-bottom">
                    <small class="flex-fill text-center border-end py-2">
                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                        {{ $product->category->name }}
                    </small>
                    
                    <small class="flex-fill text-center border-end py-2">
                        <i class="fa fa-calendar-alt text-primary me-2"></i>
                        {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}
                    </small>
                    <small class="flex-fill text-center py-2">
                        <i class="fa fa-box text-primary me-2"></i>
                        {{ $product->quantity }} in stock
                    </small>
                </div>
                <div class="text-center p-4">
                    <h5 class="mb-2">{{ $product->name }}</h5>
                    <div class="mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <small class="fa fa-star text-primary"></small>
                        @endfor
                    </div>

                    <div class="price-overlay">
                        <span class="price-badge">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <p>{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-shopping-cart me-2"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
        @else
            <div class="alert alert-info text-center">
                No products found matching your criteria.
            </div>
        @endif
    </div>
</div>

@include('components.footer')