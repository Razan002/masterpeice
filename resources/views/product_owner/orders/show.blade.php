@extends('layouts.app2')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Details #{{ $order->id }}</h1>
        <a href="{{ route('product_owner.orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Orders
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/default-product.png') }}" 
                                                 width="50" height="50" class="rounded-circle mr-3">
                                            <div>
                                                <h6 class="mb-0">{{ $product->name }}</h6>
                                                <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($product->pivot->price, 2) }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total:</th>
                                    <th>${{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Summary</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Customer Information</h6>
                        <p class="mb-1">{{ $order->user->name }}</p>
                        <p class="mb-1">{{ $order->user->email }}</p>
                        <p class="mb-0">{{ $order->user->phone ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Order Information</h6>
                        <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        <p class="mb-1"><strong>Order Status:</strong> 
                            <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p class="mb-0"><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                    </div>

                    @if($order->shipping_address)
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Shipping Address</h6>
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Order Notes</h6>
                        <p class="mb-0">{{ $order->notes ?? 'No notes' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection