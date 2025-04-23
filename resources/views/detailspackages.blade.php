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

<!-- Page Content -->
<div class="container py-5">
    <div class="row">
        <!-- Left Section with Images -->
        <div class="col-md-6">
            <div class="row">
                @foreach($package->media as $media)
                    <div class="col-12 mb-4">
                        <img src="{{ asset('storage/images/' . $media->media) }}" alt="Image" class="img-fluid rounded">
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Right Section with Details -->
        <div class="col-md-6">
            <h2 class="mb-4">{{ $package->title }} Details</h2>
            <p class="lead">{{ $package->description }}</p>
            <p class="h4 text-primary mb-4">Price: {{ $package->price }} JOD</p>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="destination_id" value="{{ $package->destination_id }}">
                <input type="hidden" name="total_price" value="{{ $package->price }}">
                
                <!-- Travel Date -->
                <div class="mb-4">
                    <label for="travel_date" class="form-label">Travel Date</label>
                    <input type="text" class="form-control" id="travel_date" name="booking_date" value="{{ \Carbon\Carbon::parse($package->travel_date)->format('d M, Y') }}" readonly>
                </div>
            
                <!-- Number of People -->
                <div class="mb-4">
                    <label for="people_count" class="form-label">Number of People</label>
                    <input type="number" class="form-control" id="people_count" name="people_count" min="1" max="{{ $package->max_people }}" required>
                </div>
                
                <!-- Payment Method -->
                <div class="mb-4">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="online">Online Payment</option>
                        <option value="on_spot">Pay on Spot</option>
                    </select>
                </div>
            
                <!-- Custom Package Details -->
                <div class="mb-4">
                    <label for="custom_package_details" class="form-label">Custom Package Details (Optional)</label>
                    <textarea class="form-control" id="custom_package_details" name="custom_package_details" rows="3"></textarea>
                </div>
            
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                    Book Now
                </button>
            </form>
        </div>
    </div>
</div>

@include('components.footer')