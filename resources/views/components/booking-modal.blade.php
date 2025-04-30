<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <input type="hidden" name="total_price" value="{{ $destination->price }}">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book {{ $destination->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Visit Date</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="visitors" class="form-label">Number of Visitors</label>
                        <input type="number" class="form-control" id="visitors" name="visitors" min="1" value="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>