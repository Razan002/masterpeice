@include('components.app')

<div class="main-content">
    <div class="container py-5">
        <div class="row">
            <!-- صورة المنتج -->
            <div class="col-md-6">
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         class="img-fluid rounded shadow">
                </div>
            </div>
            
            <!-- تفاصيل المنتج -->
            <div class="col-md-6">
                <h1 class="product-title">{{ $product->name }}</h1>
                
                <!-- معلومات المالك -->
                <div class="owner-info mb-3">
                    <div class="d-flex align-items-center">
                        
                        <div>
                            <h5 class="mb-0">Owner</h5>
                            <p class="mb-0 text-muted">{{ $product->owner->name }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="price-section mb-3">
                    <span class="price">${{ number_format($product->price, 2) }}</span>
                </div>
                
                <div class="product-description mb-4">
                    <p>{{ $product->description }}</p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary" >
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-image-container {
        border: 1px solid #eee;
        padding: 10px;
        border-radius: 8px;
        background: white;
    }
    
    .product-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 1rem;
    }
    
    .price {
        font-size: 1.8rem;
        color: #91c62e;
        font-weight: bold;
    }
    
    .product-description {
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    .owner-info {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #eee;
    }
    .btn-outline-primary
    {
        border-color: #91c62e;
        color: #91c62e;
    }
</style>