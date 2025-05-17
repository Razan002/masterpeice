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
                @foreach($package->media as $media)
                    <div class="col-12 mb-4">
                        <img src="{{ asset('storage/images/' . $media->media) }}" alt="Image" class="img-fluid rounded">
                    </div>
                @endforeach
            </div>
        </div>
        
        
        <div class="col-md-6">
            <h2 class="mb-4">{{ $package->title }} Details</h2>
            <p class="lead">{{ $package->description }}</p>
            <p class="h4 text-primary mb-4">Price: {{ $package->price }} JOD</p>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
               
                <input type="hidden" name="total_price" value="{{ $package->price }}">

                <div class="mb-4">
                    <label class="form-label"> Date</label>
                    <input type="text" class="form-control" 
                           value="{{ $package->date ? \Carbon\Carbon::parse($package->date)->format('d M, Y') : 'لم يتم تحديد تاريخ' }}" 
                           readonly>
                           <input type="hidden" name="booking_date" value="{{ $package->date }}">

                </div>
            
               
                <div class="mb-4">
                    <label for="people_count" class="form-label">Number of People</label>
                    <input type="number" class="form-control" id="people_count" name="people_count" min="1" max="{{ $package->max_people }}" required>
                </div>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Availability:</span>
                    <span>{{ $package->is_available ? 'Available' : 'Not Available' }}</span>
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
                
                
                <div class="mb-4">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="online">Online Payment</option>
                        <option value="on_spot">Pay on Spot</option>
                    </select>
                </div>
            
                {{-- <div class="mb-4">
                    <label for="custom_package_details" class="form-label">Custom Package Details (Optional)</label>
                    <textarea class="form-control" id="custom_package_details" name="custom_package_details" rows="3"></textarea>
                </div> --}}
            
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                    Book Now
                </button>

                @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

            </form>
              <!-- Reviews Section -->
        {{-- <div class="reviews-section">
            <h2 class="mb-4" style="color: var(--primary-color);">Customer Reviews</h2>
            
            
            @if($package->reviews && $package->reviews->count() > 0)
                <div class="reviews-list">
                    @foreach($package->reviews as $review)
                        <div class="review-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="reviewer-name" style="font-weight: bold; font-size: 1.1rem;">
                                    {{ $review->user->name ?? 'Anonymous' }}
                                </div>
                                <div class="review-date">
                                    {{ $review->created_at->format('d M Y') }}
                                </div>
                            </div>
                            
                            <div class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            
                            <div class="review-comment mt-2">
                                {{ $review->comment }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert-info">
                    No reviews yet. Be the first to review!
                </div>
            @endif
            
            
            @auth
                @php
                    $userBooking = auth()->user()->bookings()
                        ->where('package_id', $package->id)
                        ->first();
                @endphp
                
                @if($userBooking)
                    <div class="add-review mt-5">
                        <h3 class="mb-3" style="color: var(--primary-color);">Write Your Review</h3>
                        
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <input type="hidden" name="booking_id" value="{{ $userBooking->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label">Your Rating</label>
                                <div class="rating-stars">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                               {{ old('rating') == $i ? 'checked' : '' }} required>
                                        <label for="star{{ $i }}">★</label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Review</label>
                                <textarea class="form-control" id="comment" name="comment" rows="4" 
                                          placeholder="Share your experience..." required>{{ old('comment') }}</textarea>
                          
                            </div>
                            
                            <button type="submit" style="background-color: var(--primary-color);">
                                <i class="fas fa-paper-plane me-2"></i> Submit Review
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert-info mt-4">
                        You need to book first to leave a review. 
                        <a href="{{ route('bookings.create', ['package' => $package->id]) }}" 
                           style="color: var(--primary-color); text-decoration: underline;">
                            Book Now
                        </a>
                    </div>
                @endif
            @else
                <div class="alert-info mt-4">
                    <a href="{{ route('login') }}" style="color: var(--primary-color); text-decoration: underline;">
                        Sign in
                    </a> 
                    to leave a review
                </div>
            @endauth
        </div> --}}
    </div>
        </div>
    </div>
</div>
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


@include('components.footer')