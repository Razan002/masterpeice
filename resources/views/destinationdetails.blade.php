

<style>
    /* Base Styles */
    :root {
        --primary-color:  #6f991c;
        --secondary-color:  #6f991c;
        --accent-color: #e74c3c;
        --text-color: #333;
        --light-gray: #f5f5f5;
        --dark-gray: #777;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--text-color);
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }
    
    /* Destination Container */
    .destination-container {
        max-width: 1200px;
        margin: 4rem auto; /* زيادة الهامش العلوي */
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row-reverse; /* جعل الصورة على اليمين */
    }
    
    /* Cover Image */
    .destination-cover {
        position: relative;
        height: 400px;
        width: 50%; /* جعل الصورة تأخذ نصف العرض */
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
        width: 50%; /* جعل المحتوى يأخذ نصف العرض */
        margin-top: 2rem; /* تحريك المحتوى للأسفل */
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
    
    .btn-secondary {
        background-color: var(--secondary-color);
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #27ae60;
    }
    
    .btn-icon {
        margin-right: 0.8rem;
        font-size: 1.1rem;
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

<div class="destination-container">
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

        <!-- Price (if numeric) -->
        @if($destination->price > 0)
            <div class="price">
                <span>Price: {{ number_format($destination->price, 2) }} JD</span>
            </div>
        @endif
        
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
        <div class="action-buttons">
            <button class="btn btn-primary">
                <i class="fas fa-calendar-alt btn-icon"></i> Book a Visit
            </button>
           
        </div>
        <!-- Reviews Section -->
<div class="reviews-section mt-5">
    <h2 class="mb-4">Customer Reviews</h2>
    
    <!-- Display existing reviews -->
    @if($destination->reviews && count($destination->reviews) > 0)
        <div class="reviews-list">
            @foreach($destination->reviews as $review)
                <div class="review-card mb-4 p-4 border rounded">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="reviewer-name fw-bold">
                            {{ $review->user->name ?? 'Anonymous' }}
                        </div>
                        <div class="review-date text-muted">
                            {{ $review->created_at->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="review-rating mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    
                    <div class="review-comment">
                        {{ $review->comment }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            No reviews yet. Be the first to review!
        </div>
    @endif
    
    <!-- Add new review form -->
    <div class="add-review mt-5">
        <h3 class="mb-3">Write a Review</h3>
        
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
            
            <!-- Rating Stars -->
            <div class="mb-3">
                <label class="form-label">Your Rating</label>
                <div class="rating-stars">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Comment -->
            <div class="mb-3">
                <label for="comment" class="form-label">Your Review</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required>{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>
    </div>
</div>

