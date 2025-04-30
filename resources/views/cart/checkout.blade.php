
@include('components.header')
{{-- resources/views/cart/checkout.blade.php --}}

<div class="checkout-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="checkout-title mb-4">Checkout</h2>
                
                <div class="checkout-card card border-0 shadow-sm">
                    <div class="card-body">
                        <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="cart-section mb-5">
                                        <h4 class="section-title">
                                            <i class="fas fa-shopping-cart me-2"></i>Your Cart
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="table cart-table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($cartItems as $item)
                                                        <tr>
                                                            <td class="product-name">{{ $item['name'] }}</td>
                                                            <td>{{ $item['quantity'] }}</td>
                                                            <td>${{ number_format($item['price'], 2) }}</td>
                                                            <td>${{ number_format($item['total'], 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="shipping-section mb-4">
                                        <h4 class="section-title">
                                            <i class="fas fa-truck me-2"></i>Shipping Information
                                        </h4>
                                        <div class="form-group mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" id="address" name="address" class="form-control form-control-lg" required>
                                        </div>
                                    </div>

                                    <div class="payment-section">
                                        <h4 class="section-title">
                                            <i class="fas fa-credit-card me-2"></i>Payment Method
                                        </h4>
                                        <div class="form-group">
                                            <select id="payment_method" name="payment_method" class="form-select form-select-lg" required>
                                                <option value="" disabled selected>Select payment method</option>
                                                <option value="credit_card">Credit Card</option>
                                                <option value="paypal">PayPal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="order-summary card border-0 shadow-sm sticky-top">
                                        <div class="card-body">
                                            <h4 class="summary-title mb-4">
                                                <i class="fas fa-receipt me-2"></i>Order Summary
                                            </h4>
                                            <div class="summary-item d-flex justify-content-between mb-2">
                                                <span>Subtotal:</span>
                                                <span>${{ number_format($total, 2) }}</span>
                                            </div>
                                            <div class="summary-item d-flex justify-content-between mb-2">
                                                <span>Shipping:</span>
                                                <span>Free</span>
                                            </div>
                                            <div class="summary-item d-flex justify-content-between mb-2">
                                                <span>Tax:</span>
                                                <span>$0.00</span>
                                            </div>
                                            <hr class="my-3">
                                            <div class="summary-total d-flex justify-content-between fw-bold fs-5">
                                                <span>Total:</span>
                                                <span>${{ number_format($total, 2) }}</span>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-lg w-100 mt-4 checkout-btn" data-bs-toggle="modal" data-bs-target="#orderModal">
                                                <i class="fas fa-lock me-2"></i>Place Order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to place the order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('checkout-form').submit()">Confirm Order</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --dark-color: #2b2d42;
        --light-color: #f8f9fa;
        --success-color: #4cc9f0;
        --text-color: #495057;
        --border-radius: 12px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .checkout-container {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding-top: 2rem;
        padding-bottom: 4rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .checkout-title {
        font-weight: 800;
        color: var(--dark-color);
        position: relative;
        padding-bottom: 15px;
        font-size: 2.2rem;
        letter-spacing: -0.5px;
        margin-bottom: 2rem;
    }
    
    .checkout-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }
    
    .checkout-card {
        border-radius: var(--border-radius);
        overflow: hidden;
        border: none;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        background-color: white;
    }
    
    .checkout-card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .section-title {
        font-size: 1.4rem;
        color: var(--dark-color);
        margin-bottom: 1.8rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid #eee;
        font-weight: 700;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 12px;
        color: var(--primary-color);
        font-size: 1.2em;
    }
    
    .cart-table {
        border-radius: var(--border-radius);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .cart-table thead {
        background-color: var(--dark-color) !important;
        color: white;
    }
    
    .cart-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
    }
    
    .cart-table td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    
    .cart-table tr:last-child td {
        border-bottom: none;
    }
    
    .product-name {
        font-weight: 600;
        color: var(--dark-color);
    }
    
    .order-summary {
        border-radius: var(--border-radius);
        background-color: #fff;
        top: 20px;
        box-shadow: var(--box-shadow);
        border: none;
    }
    
    .summary-title {
        font-size: 1.3rem;
        color: var(--dark-color);
        font-weight: 700;
    }
    
    .summary-item {
        font-size: 0.95rem;
        color: var(--text-color);
        padding: 0.5rem 0;
    }
    
    .summary-total {
        color: var(--dark-color);
        font-size: 1.2rem;
        padding: 1rem 0;
    }
    
    .checkout-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 15px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: var(--transition);
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 1rem;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        width: 100%;
        margin-top: 1.5rem;
    }
    
    .checkout-btn:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(67, 97, 238, 0.4);
    }
    
    .checkout-btn:active {
        transform: translateY(1px);
    }
    
    .form-control-lg, .form-select-lg {
        padding: 14px 16px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        font-size: 1rem;
        transition: var(--transition);
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.6rem;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(72, 149, 239, 0.25);
    }
    
    hr {
        opacity: 0.15;
        margin: 1.5rem 0;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .checkout-card {
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .checkout-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }
        
        .order-summary {
            position: static !important;
            margin-top: 2.5rem;
        }
        
        .section-title {
            font-size: 1.2rem;
        }
    }
    
    /* Hover effects */
    .cart-table tbody tr {
        transition: var(--transition);
    }
    
    .cart-table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }
    
    /* Payment method styling */
    .payment-method-option {
        display: flex;
        align-items: center;
        padding: 12px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .payment-method-option:hover {
        border-color: var(--accent-color);
    }
    
    .payment-method-option i {
        margin-right: 12px;
        font-size: 1.5rem;
        color: var(--primary-color);
    }
</style>