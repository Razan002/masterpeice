@include('components.header')

<style>
    :root {
        --primary-color: #86B817;
        --primary-dark: #160d2a;
        --secondary-color: #6c757d;
        --light-color: #f8f9fa;
        --dark-color: #1f2937;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
    }

    body {
        background-color: #f5f7fa;
    }

    .main-content {
        padding: 100px 0;
        background-color: #f5f7fa;
    }
    
    .profile-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 15px;
        padding: 30px;
        margin: 20px auto;
        max-width: 1200px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }
    
    .profile-card, .booking-card, .order-card {
        border: none;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
    }
    
    .profile-card:hover, .booking-card:hover, .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        border-color: var(--primary-color);
    }
    
    .badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    
    .bg-success { background-color: var(--success-color) !important; }
    .bg-danger { background-color: var(--danger-color) !important; }
    .bg-warning { background-color: var(--warning-color) !important; color: var(--dark-color); }
    .bg-info { background-color: var(--info-color) !important; }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(134, 184, 23, 0.3);
        transition: all 0.3s ease;
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(134, 184, 23, 0.4);
        color: white;
    }

    .btn-outline-primary {
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        background: transparent;
    }

    .btn-outline-primary:hover {
        background: var(--primary-color);
        color: white;
    }
    
    h3, h4, h5, h6 {
        color: var(--dark-color);
        font-weight: 700;
    }
    
    h4 {
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 8px;
        color: var(--primary-dark);
    }
    
    h4:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 3px;
    }
    
    .text-muted { color: var(--secondary-color) !important; }
    
    .alert-info {
        background-color: #e0f2fe;
        color: #0369a1;
        border-radius: 12px;
        border: none;
        border-left: 4px solid var(--info-color);
    }

    /* Card Headers */
    .profile-card .card-body {
        background-color: #ffffff;
    }

    .booking-card .card-header,
    .order-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px 12px 0 0 !important;
        padding: 15px;
        background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
    }

    /* Booking Details */
    .booking-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    
    .booking-detail-item {
        margin-bottom: 8px;
    }
    
    .booking-detail-item strong {
        display: block;
        color: var(--secondary-color);
        font-size: 0.85rem;
        margin-bottom: 2px;
    }
    
    .booking-detail-item span {
        font-weight: 500;
        color: var(--dark-color);
    }
    
    .booking-features {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #e5e7eb;
    }
    
    .feature-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    
    .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 6px;
        color: var(--dark-color);
    }
    
    .feature-list li i {
        color: var(--primary-color);
        margin-right: 8px;
        font-size: 0.9rem;
    }

    /* Order Items */
    .order-items {
        max-height: 150px;
        overflow-y: auto;
        padding-right: 8px;
    }
    
    .order-items::-webkit-scrollbar {
        width: 4px;
    }
    
    .order-items::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .order-items::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border-bottom: none;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        background-color: #f8fafc;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(134, 184, 23, 0.25);
    }

    /* Footer */
    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e5e7eb;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .main-content {
            padding: 80px 0;
        }
        
        .profile-container {
            padding: 25px;
        }
        
        .booking-details {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .main-content {
            padding: 60px 0;
        }
        
        .profile-container {
            padding: 20px;
            margin: 15px;
        }
        
        .profile-card, .booking-card, .order-card {
            margin-bottom: 15px;
        }
        
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.3rem; }
    }
    
    @media (max-width: 576px) {
        .main-content {
            padding: 40px 0;
        }
        
        .profile-container {
            padding: 15px;
            margin: 10px;
        }
        
        .btn-primary {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        
        .order-card .card-header,
        .booking-card .card-header {
            padding: 12px;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .order-card .badge,
        .booking-card .badge {
            margin-top: 8px;
        }
    }
</style>

<!-- باقي الكود يبقى كما هو بدون تغيير -->
<div class="main-content">
    <div class="container">
        <div class="profile-container">
            <!-- User Information -->
            <div class="card profile-card mb-4 text-center">
                <div class="card-body">
                    <h3>{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p>{{ $user->phone ?? 'No phone number available' }}</p>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Information
                    </button>
                </div>
            </div>

            <!-- Bookings -->
            <h4 class="mb-3">My Bookings</h4>

            @if($bookings->isEmpty())
                <div class="alert alert-info text-center py-4">No bookings yet</div>
            @else
                <div class="row">
                    @foreach($bookings as $booking)
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card booking-card h-100">
                            <div class="card-header">
                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                    @if($booking->package)
                                        {{ $booking->package->name }}
                                    @elseif($booking->destination)
                                        {{ $booking->destination->name }}
                                    @endif
                                    <span class="badge 
                                        @if($booking->status == 'confirmed') bg-success
                                        @elseif($booking->status == 'cancelled') bg-danger
                                        @else bg-warning @endif">
                                        {{ $booking->status }}
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="booking-details">
                                    <div class="booking-detail-item">
                                        <strong>Booking Date</strong>
                                        <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="booking-detail-item">
                                        <strong>Total Price</strong>
                                        <span>{{ $booking->total_price }} JOD</span>
                                    </div>
                                    <div class="booking-detail-item">
                                        <strong>People</strong>
                                        <span>{{ $booking->people_count ?? 'N/A' }}</span>
                                    </div>
                                    <div class="booking-detail-item">
                                        <strong>Payment Method</strong>
                                        <span>{{ $booking->payment_method ?? 'Not specified' }}</span>
                                    </div>
                                </div>

                                @if($booking->package || $booking->destination)
                                <div class="booking-features">
                                    <h6 class="mb-2">Included Features</h6>
                                    <ul class="feature-list">
                                        @if($booking->package && !empty($booking->package->features))
                                            @forelse((array)$booking->package->features as $feature)
                                                <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                                            @empty
                                                <li><i class="fas fa-check-circle"></i> No specific features listed</li>
                                            @endforelse
                                        @elseif($booking->destination)
                                            <li><i class="fas fa-check-circle"></i> Guided Tour</li>
                                            <li><i class="fas fa-check-circle"></i> Entrance Fees</li>
                                            <li><i class="fas fa-check-circle"></i> Local Guide</li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">
                                <small class="text-muted">
                                    Booked on: {{ $booking->created_at->format('Y-m-d') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Orders -->
            <h4 class="mb-4">My Orders</h4>

            @if($orders->isEmpty())
                <div class="alert alert-info text-center py-4">No orders yet</div>
            @else
                <div class="row">
                    @foreach($orders as $order)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card order-card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                <span class="badge 
                                    @if($order->status == 'completed') bg-success
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-warning @endif">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="order-info mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Date:</span>
                                        <strong>{{ $order->created_at->format('Y-m-d') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Total:</span>
                                        <strong>{{ $order->total }} JOD</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Payment:</span>
                                        <strong>{{ $order->payment_method }}</strong>
                                    </div>
                                </div>
                                
                                <div class="order-items mb-3">
                                    <h6 class="mb-2">Items ({{ $order->products->count() }})</h6>
                                    <div class="items-preview">
                                        @foreach($order->products->take(2) as $product)
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('storage/' .$product->image) }}" alt="{{ $product->name }}" 
                                                class="rounded me-2" width="40" height="40">
                                            <div class="text-truncate">
                                                <small>{{ $product->name }}</small>
                                                <div class="text-muted">
                                                    <small>{{ $product->pivot->quantity }} × {{ $product->pivot->price }} JOD</small>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @if($order->products->count() > 2)
                                        <div class="text-center">
                                            <small class="text-primary">+{{ $order->products->count() - 2 }} more items</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

       <!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Personal Information -->
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Address Information -->
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $user->address ?? '' }}</textarea>
                            </div>
                          
                        </div>
                    </div>

                    <!-- Password Change Section -->
                   <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</div>

@include('components.footer')