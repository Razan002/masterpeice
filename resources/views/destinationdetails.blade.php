@include('components.header')

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <!-- Main Card -->
        <div class="card shadow-sm">
            <div class="row g-0">
                <!-- Image Section -->
                <div class="col-md-8">
                    <div class="destination-hero">
                        <img src="{{ Storage::url('images/'.$destination->image) }}" 
                             class="img-fluid rounded-start" 
                             alt="{{ $destination->name }}"
                             style="height: 100%; object-fit: cover;">
                    </div>
                </div>
                
                <!-- Info Section -->
                <div class="col-md-4">
                    <div class="card-body h-100 d-flex flex-column">
                        <h1 class="card-title display-6">{{ $destination->name }}</h1>
                        
                        <!-- Price & Discount -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if($destination->price > 0)
                                <span class="badge bg-primary fs-5">
                                    {{ number_format($destination->price, 2) }} JOD
                                </span>
                            @else
                                <span class="badge bg-success fs-5">FREE</span>
                            @endif
                            
                            @if($destination->discount)
                                <span class="badge bg-danger fs-5">
                                    Save {{ $destination->discount }}%
                                </span>
                            @endif
                        </div>
                        
                        <!-- Quick Facts -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                <span>{{ $destination->location }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                <span>Suggested duration: 2-3 hours</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                <span>Open daily from 9:00 AM to 6:00 PM</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-auto">
                            <button class="btn btn-primary btn-lg w-100 mb-2" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#bookingModal">
                                <i class="fas fa-ticket-alt me-2"></i> Book Now
                            </button>
                            <a href="#" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-map-marked-alt me-2"></i> Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="card-title mb-4">About {{ $destination->name }}</h2>
                        <div class="card-text">
                            <p class="lead">{{ $destination->description }}</p>
                            <hr>
                            <h4 class="mt-4">Highlights</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Guided tours available
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Family-friendly environment
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Wheelchair accessible
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Visitor Reviews</h3>
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating-stars me-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <span class="ms-2">4.5 (128 reviews)</span>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Be the first to review this destination!
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Gallery</h3>
                        <div class="row g-2">
                            @for($i = 1; $i <= 6; $i++)
                            <div class="col-4 col-md-6 col-lg-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <img src="https://via.placeholder.com/300x200?text={{ $destination->name }}+{{ $i }}" 
                                         class="img-thumbnail" 
                                         alt="Gallery Image {{ $i }}">
                                </a>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Contact Card -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Contact Information</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-phone-alt me-2 text-primary"></i>
                                +962 6 123 4567
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                info@{{ str_replace(' ', '', strtolower($destination->name)) }}.com
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-globe me-2 text-primary"></i>
                                www.{{ str_replace(' ', '', strtolower($destination->name)) }}.com
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ $destination->location }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <input type="hidden" name="total_price" value="{{ $destination->price }}">
                
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="bookingModalLabel">
                        <i class="fas fa-ticket-alt me-2"></i>
                        Book {{ $destination->name }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Select Date</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        <small class="text-muted">Open from 9:00 AM to 6:00 PM</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="onlinePayment" value="online" checked>
                            <label class="form-check-label" for="onlinePayment">
                                <i class="fas fa-credit-card me-2"></i> Online Payment
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="onSpotPayment" value="on_spot">
                            <label class="form-check-label" for="onSpotPayment">
                                <i class="fas fa-money-bill-wave me-2"></i> Pay On Spot
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price Summary</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Ticket x1</span>
                                    <span>{{ number_format($destination->price, 2) }} JOD</span>
                                </div>
                                @if($destination->discount)
                                <div class="d-flex justify-content-between text-danger">
                                    <span>Discount ({{ $destination->discount }}%)</span>
                                    <span>-{{ number_format($destination->price * $destination->discount / 100, 2) }} JOD</span>
                                </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>
                                        @if($destination->discount)
                                            {{ number_format($destination->price * (1 - $destination->discount / 100), 2) }}
                                        @else
                                            {{ number_format($destination->price, 2) }}
                                        @endif
                                        JOD
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-2"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $destination->name }} Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://via.placeholder.com/800x500?text={{ $destination->name }}" 
                     class="img-fluid" 
                     alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

@include('components.footer')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('booking_date').min = today;
        
        // Calculate and update total price if discount exists
        @if($destination->discount)
            const originalPrice = {{ $destination->price }};
            const discount = {{ $destination->discount }};
            const discountedPrice = originalPrice * (1 - discount / 100);
            document.querySelector('input[name="total_price"]').value = discountedPrice.toFixed(2);
        @endif
    });

    // Enhanced form submission with loading state
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...';
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Confirmed!',
                    html: `
                        <p>${data.message}</p>
                        <div class="alert alert-info mt-3 text-start">
                            <h6>Booking Details:</h6>
                            <p>Destination: ${document.querySelector('.card-title').textContent}</p>
                            <p>Date: ${document.getElementById('booking_date').value}</p>
                            <p>Total: ${document.querySelector('input[name="total_price"]').value} JOD</p>
                        </div>
                    `,
                    confirmButtonText: 'View Tickets',
                    showCancelButton: true,
                    cancelButtonText: 'Close'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/my-bookings';
                    } else {
                        window.location.reload();
                    }
                });
            } else {
                throw new Error(data.message || 'Booking failed. Please try again.');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Booking Failed',
                text: error.message,
                confirmButtonText: 'Try Again'
            });
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        });
    });
</script>
@endsection