{{-- resources/views/cart/success.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Thank You for Your Order!</h2>
        <p>Your order has been successfully placed. You will receive a confirmation email shortly.</p>
        <p><a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a></p>
    </div>
@endsection
