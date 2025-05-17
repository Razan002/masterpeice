@include('components.app')

<div class="main-content">
    <div class="container">
        <h1 class="display-5 mb-4">Edit Booking #{{ $booking->id }}</h1>
        
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select class="form-select" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="package_id" class="form-label">Package</label>
                    <select class="form-select" id="package_id" name="package_id">
                        <option value="">Select Package (Optional)</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ $booking->package_id == $package->id ? 'selected' : '' }}>{{ $package->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="destination_id" class="form-label">Destination</label>
                    <select class="form-select" id="destination_id" name="destination_id">
                        <option value="">Select Destination (Optional)</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ $booking->destination_id == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="booking_date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" 
                   value="{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="online" {{ $booking->payment_method == 'online' ? 'selected' : '' }}>Online Payment</option>
                        <option value="on_spot" {{ $booking->payment_method == 'on_spot' ? 'selected' : '' }}>Payment on Arrival</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="{{ $booking->total_price }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="col-12 mb-3">
                    <label for="custom_package_details" class="form-label">Custom Package Details</label>
                    <textarea class="form-control" id="custom_package_details" name="custom_package_details" rows="3">{{ $booking->custom_package_details }}</textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.bookings') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>