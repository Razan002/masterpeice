@include('components.header')

<div class="main-content" >
    <div class="container " style="padding: 150px">
        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-5">
                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <img class="img-fluid w-100 "src="{{ asset('storage/' .$product->image) }}" alt="{{ $product->name }}">

                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-7">
                <h2 class="mb-4">{{ $product->name }}</h2>
                
                <div class="d-flex align-items-center mb-4">
                    <span class="badge bg-primary me-2">
                        {{ $product->category->name }}
                    </span>
                    <span class="text-muted">
                        <i class="fas fa-box me-1"></i>
                        {{ $product->quantity }} in stock
                    </span>
                </div>

                <h4 class="text-primary mb-4">${{ number_format($product->price, 2) }}</h4>

                <p class="mb-4">{{ $product->description }}</p>

                <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="input-group me-3" style="width: 120px;">
                        <button class="btn btn-outline-primary" type="button" id="decrement">-</button>
                        <input type="number" name="quantity" value="1" min="1" 
                               max="{{ $product->quantity }}" class="form-control text-center">
                        <button class="btn btn-outline-primary" type="button" id="increment">+</button>
                    </div>
                    
                    <button type="submit" class="btn btn-primary py-2 px-4">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>

        

        {{-- <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <h4 class="mb-4">Related Products</h4>
            @foreach($relatedProducts as $related)
            <div class="col-md-3 col-6">
                <div class="card h-100">
                    <a href="{{ route('product.show', $related->id) }}">
                        <img class="img-fluid w-100 "src="{{ asset('storage/' .$product->image) }}" alt="{{ $product->name }}">

                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($related->name, 20) }}</h5>
                        <p class="text-primary">${{ number_format($related->price, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif --}}
    </div>
</div>

@include('components.footer')

@push('scripts')
<script>
    // Quantity increment/decrement
    document.getElementById('increment').addEventListener('click', function() {
        const input = document.querySelector('input[name="quantity"]');
        if(parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
        }
    });
    
    document.getElementById('decrement').addEventListener('click', function() {
        const input = document.querySelector('input[name="quantity"]');
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });
</script>

@endpush