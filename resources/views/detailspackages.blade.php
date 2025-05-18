@include('components.header')

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">{{ $package->title }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                @if($package->media->isNotEmpty())
                    <img src="{{ asset('storage/' . $package->media->first()->media) }}" alt="{{ $package->title }}" class="img-fluid rounded">
                @else
                    <p class="text-center py-5">No image available</p>
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <h2 class="mb-4">{{ $package->title }} Details</h2>
            <p class="lead">{{ $package->description }}</p>
            <p class="h4 text-primary mb-4">Price: {{ $package->price }} JOD</p>

            <!-- Display available spots -->
            @php
                $totalBookings = $package->bookings->sum('people_count');
                $availableSpots = max(0, $package->max_people - $totalBookings);
                $isFullyBooked = $availableSpots <= 0;
            @endphp

            <div class="alert {{ $isFullyBooked ? 'alert-danger' : 'alert-success' }} mb-4">
                <i class="fas fa-users me-2"></i>
                @if($isFullyBooked)
                    This package is fully booked
                @else
                    Available spots: {{ $availableSpots }} out of {{ $package->max_people }}
                @endif
            </div>

            @if(!$isFullyBooked && $package->is_available && $package->date >= now())
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="total_price" value="{{ $package->price }}">
                <input type="hidden" name="booking_date" value="{{ $package->date }}">

                <div class="mb-4">
                    <label class="form-label">Date</label>
                    <input type="text" class="form-control" 
                           value="{{ $package->date ? \Carbon\Carbon::parse($package->date)->format('d M, Y') : 'Date not specified' }}" 
                           readonly>
                </div>
            
                <div class="mb-4">
                    <label for="people_count" class="form-label">Number of People</label>
                    <input type="number" class="form-control" id="people_count" name="people_count" 
                           min="1" max="{{ $availableSpots }}" required
                           oninput="updateTotalPrice(this.value)">
                    <small class="text-muted">Maximum allowed: {{ $availableSpots }} people</small>
                </div>

                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Availability:</span>
                        <span class="badge bg-{{ $package->is_available ? 'success' : 'danger' }}">
                            {{ $package->is_available ? 'Available' : 'Not Available' }}
                        </span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Meal Included:</span>
                        <span>{{ $package->meal ?? 'Not specified' }}</span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Day of Week:</span>
                        <span>{{ $package->day_of_week ?? 'Not specified' }}</span>
                    </li>
                    
                    @if($package->has_museum)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Museum Name:</span>
                        <span>{{ $package->museum_name ?? 'No museum specified' }}</span>
                    </li>
                    @endif
                </ul>
                
                <div class="mb-4">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="online">Online Payment</option>
                        <option value="on_spot">Pay on Spot</option>
                    </select>
                </div>

                <div class="mb-4">
                    <p class="h5">Total Price: <span id="totalPrice">{{ $package->price }}</span> JOD</p>
                </div>
            
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                    Book Now
                </button>
            </form>
            @else
            <div class="alert alert-warning">
                @if($isFullyBooked)
                    Booking is not available because the package is fully booked
                @elseif(!$package->is_available)
                    This package is currently unavailable
                @else
                    The package date has passed
                @endif
            </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

   <!-- Reviews Section -->
<div class="row mt-5">
    <div class="col-12">
        <h3 class="mb-4 border-bottom pb-2">Traveler Reviews</h3>
        
        @if($package->reviews->count() > 0)
            <div class="reviews-container d-flex flex-nowrap overflow-auto pb-3">
                @foreach($package->reviews as $review)
                    <div class="card mb-3 me-3" style="min-width: 280px;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="card-title mb-0 fw-bold">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}" style="font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="card-text small">{{ $review->comment }}</p>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Posted on {{ $review->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                No reviews yet. Be the first to review this package!
            </div>
        @endif
            <!-- Add Review Form -->
            @auth
                <div class="add-review mt-5">
                    <h4 class="mb-3">Add Your Review</h4>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating-input">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" class="star-label"><i class="fas fa-star"></i></label>
                                @endfor
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Review</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    <a href="{{ route('login') }}" class="alert-link">Login</a> to leave a review.
                </div>
            @endauth

            
        </div>
        
    </div>
</div>

<script>
    function updateTotalPrice(peopleCount) {
        const pricePerPerson = {{ $package->price }};
        document.getElementById('totalPrice').textContent = pricePerPerson * peopleCount;
    }
</script>

@include('components.footer')

<style>
    .hero-header {
        background-size: cover;
        background-position: center;
    }
    
    .img-fluid.rounded {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
    }
    
    /* Reviews section styling */
    .rating {
        unicode-bidi: bidi-override;
        direction: ltr;
    }
    
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    
    .rating-input input {
        display: none;
    }
    
    .rating-input label {
        color: #ddd;
        font-size: 1.5rem;
        padding: 0 0.2rem;
        cursor: pointer;
    }
    
    .rating-input input:checked ~ label,
    .rating-input input:hover ~ label {
        color: #ffc107;
    }
    
    .star-label {
        transition: color 0.2s;
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>