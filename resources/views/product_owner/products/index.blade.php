@extends('layouts.app2')

@section('title', 'My Products')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Products</h1>
        <a href="{{ route('product_owner.products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Add New Product
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" width="50" height="50" class="img-thumbnail">
                                @else
                                <img src="{{ asset('images/default-product.png') }}" width="50" height="50" class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td class="{{ $product->quantity < 10 ? 'text-danger font-weight-bold' : '' }}">
                                {{ $product->quantity }}
                            </td>
                           <td>
                                        <a href="{{ route('product_owner.products.edit', $product->id) }}" class="btn btn-sm btn-circle btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('product_owner.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-circle btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection