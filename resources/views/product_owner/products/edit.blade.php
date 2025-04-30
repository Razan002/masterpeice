@extends('layouts.app2')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('product_owner.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- العمود الأول -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>
{{-- 
                    <div class="mb-3">
                        <label for="cost_price" class="form-label">Cost Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}">
                        </div>
                    </div> --}}
                </div>

                <!-- العمود الثاني -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity in Stock *</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail" width="100">
                                {{-- <a href="#" class="text-danger ms-2" onclick="event.preventDefault(); document.getElementById('remove-image').submit();">
                                    <i class="fas fa-trash-alt"></i> Remove Image
                                </a> --}}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="featured" name="featured" {{ $product->featured ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">Featured Product</label>
            </div> --}}

            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('product_owner.products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

        @if($product->image)
            {{-- <form id="remove-image" action="{{ route('product_owner.products.remove-image', $product->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form> --}}
        @endif
    </div>
</div>
@endsection