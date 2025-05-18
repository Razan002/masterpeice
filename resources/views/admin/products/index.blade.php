@include('components.app')

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Products</h6>
            <h1 class="mb-5">Our Products</h1>
        </div>

        @if($products->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s"> <!-- تغيير الأعمدة لجعل البطاقات أصغر -->
                        <div class="package-item h-100 shadow-sm rounded"> <!-- إضافة shadow-sm و rounded للشكل -->
                            <div class="overflow-hidden" style="height: 180px;"> <!-- تحديد ارتفاع ثابت للصور -->
<a href="{{ route('admin.products.show', $product->id) }}">

                                <img class="img-fluid w-100 h-100 object-fit-cover" 
                                     src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     style="transition: transform 0.3s ease;">
                                </a>
                            </div>
                            <div class="text-center p-3"> <!-- تقليل padding -->
                                <h5 class="mb-1 fs-6">{{ $product->name }}</h5> <!-- تصغير حجم الخط -->
                                <p class="text-primary fw-bold mb-1">${{ number_format($product->price, 2) }}</p>
                                <p class="small text-muted mb-2">{{ Str::limit($product->description, 40) }}</p> <!-- تصغير الوصف -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4"> <!-- تصغير margin-top -->
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="alert alert-info text-center">
                No products found.
            </div>
        @endif
    </div>
</div>

<style>
    .package-item {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.1);
    }
    .package-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .package-item:hover img {
        transform: scale(1.05);
    }
</style>