@include('components.header')
<style>
    /* Base Styles */
    :root {
        --primary-color: #6f991c;
        --secondary-color: #6f991c;
        --accent-color: #e74c3c;
        --text-color: #333;
        --light-gray: #f5f5f5;
        --dark-gray: #777;
    }
    
 
    
    /* Destination Container */
    .destination-container {
        max-width: 1200px;
        margin: 4rem auto;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row-reverse;
    }
    
    /* Cover Image */
    .destination-cover {
        position: relative;
        height: 400px;
        width: 50%;
        overflow: hidden;
    }
    
    .destination-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .destination-cover:hover img {
        transform: scale(1.05);
    }
    
    /* Content Section */
    .destination-content {
        padding: 2rem;
        width: 50%;
        margin-top: 2rem;
    }
    
    h1 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        font-size: 2.5rem;
    }
    
    .description {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 2.5rem;
        line-height: 1.8;
    }
    
    /* Price Section */
    .price {
        background-color: var(--light-gray);
        padding: 1rem 1.5rem;
        border-radius: 8px;
        display: inline-block;
        margin-bottom: 2.5rem;
        font-weight: bold;
        color: var(--accent-color);
        font-size: 1.2rem;
    }
    
    /* Details Grid */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .detail-card {
        background: var(--light-gray);
        padding: 1.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }
    
    .detail-icon {
        font-size: 1.5rem;
        margin-left: 1rem;
        color: var(--primary-color);
    }
    
    /* Gallery Section */
    .gallery {
        margin: 3rem 0;
    }
    
    .gallery-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .gallery-item {
        height: 180px;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1.5rem;
        margin: 3rem 0 2rem;
    }
    
    .btn {
        padding: 1rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #0a141c;
    }
    
    /* Reviews Section Styles */
    .reviews-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }
    
    .review-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    
    .review-card:hover {
        transform: translateY(-3px);
    }
    
    .review-rating {
        color: #ffc107;
        font-size: 1.2rem;
        margin: 0.5rem 0;
    }
    
    .review-date {
        color: var(--dark-gray);
        font-size: 0.9rem;
    }
    
    .review-comment {
        color: var(--text-color);
        line-height: 1.6;
    }
    
    .rating-stars {
        direction: rtl;
        unicode-bidi: bidi-override;
    }
    
    .rating-stars input {
        display: none;
    }
    
    .rating-stars label {
        font-size: 1.5rem;
        color: #ddd;
        cursor: pointer;
        padding: 0 3px;
    }
    
    .rating-stars input:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        color: #ffc107;
    }
    
    .alert-info {
        background-color: #e7f5ff;
        color: #1864ab;
        padding: 1rem;
        border-radius: 8px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .destination-container {
            flex-direction: column;
            align-items: center;
        }
        
        .destination-cover {
            height: 300px;
            width: 100%;
        }
        
        .destination-content {
            width: 100%;
            padding: 1.5rem;
        }
        
        h1 {
            font-size: 2rem;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
        
        .gallery-item {
            height: 150px;
        }
    }
</style>

<div class="destination-container" style="padding: 100px">
    <!-- Cover Image -->
    <div class="destination-cover">
        <img class="img-fluid" src="{{ Storage::url('images/'. $destination->image) }}" alt="{{ $destination->name }}">
    </div>

    <!-- Content Section -->
    <div class="destination-content">
        <h1>{{ $destination->name }}</h1>
        
        <!-- Rating (if available) -->
        @if($destination->rating)
        <div class="review-rating">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= round($destination->rating))
                    ★
                @else
                    ☆
                @endif
            @endfor
            ({{ number_format($destination->rating, 1) }}/5)
        </div>
        @endif
        
        <p class="description">
            {{ $destination->description }}
        </p>

    
        
        <!-- Details Grid -->
        <div class="details-grid">
            <div class="detail-card">
                <i class="fas fa-map-marker-alt detail-icon"></i>
                <div>
                    <h3>Location</h3>
                    <p>{{ $destination->location ?? 'Downtown Salt, Jordan' }}</p>
                </div>
            </div>
         
            <div class="detail-card">
                <i class="fas fa-info-circle detail-icon"></i>
                <div>
                    <h3>Place Type</h3>
                    <p>{{ $destination->type ?? 'Historical Museum' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Gallery Section -->
        @if($destination->gallery && count($destination->gallery) > 0)
        <div class="gallery">
            <h2 class="gallery-title">Photo Gallery</h2>
            <div class="gallery-grid">
                @foreach($destination->gallery as $image)
                <div class="gallery-item">
                    <img src="{{ Storage::url('gallery/'. $image) }}" alt="Gallery Image">
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Action Buttons -->
       
        
    
    </div>
    <!-- Booking Modal -->

<div id="bookingModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 2rem; border-radius: 12px; max-width: 600px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); direction: rtl; text-align: right;">
        <span class="close-modal" style="float: left; font-size: 1.5rem; font-weight: bold; cursor: pointer;">&times;</span>
        
        <h2 style="color: var(--primary-color); margin-bottom: 1.5rem;">حجز زيارة إلى {{ $destination->name }}</h2>
        
        <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">تاريخ الحجز</label>
                <input type="date" name="booking_date" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;"
                       min="{{ date('Y-m-d') }}">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">عدد الأشخاص</label>
                <input type="number" name="people_count" min="1" value="2" required 
                       style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">طريقة الدفع</label>
                <select name="payment_method" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="online">دفع إلكتروني</option>
                    <option value="on_spot">دفع عند الوصول</option>
                </select>
            </div>
            
            <div style="display: flex; justify-content: space-between; margin-top: 2rem;">
                <button type="button" class="close-modal" style="padding: 0.8rem 1.5rem; background: #ddd; border: none; border-radius: 8px; cursor: pointer;">إلغاء</button>
                <button type="submit" style="padding: 0.8rem 1.5rem; background: var(--primary-color); color: white; border: none; border-radius: 8px; cursor: pointer;">تأكيد الحجز</button>
            </div>
        </form>
    </div>
</div>
</div>
@include('components.footer')