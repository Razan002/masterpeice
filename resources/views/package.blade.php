@include('components.header')

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Packages</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Packages</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
           @foreach($packages as $package)
@php
    $totalBookings = $package->bookings->sum('people_count');
    $isFullyBooked = $totalBookings >= $package->max_people;
@endphp

<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="package-item {{ $package->date < now() || !$package->is_available || $isFullyBooked ? 'expired-package' : '' }}">
        @if($package->date < now() || !$package->is_available || $isFullyBooked)
        <div class="expired-badge">
            {{ $isFullyBooked ? 'Fully Booked' : 'Unavailable' }}
        </div>
        @endif
        
        <div class="overflow-hidden package-image-container">
            @foreach($package->media as $media)
            <img class="img-fluid package-image" src="{{ asset('storage/' . $media->media) }}" alt="{{ $package->title }}">
            @endforeach
        </div>
        
        <div class="d-flex border-bottom">
            <small class="flex-fill text-center border-end py-2">
                <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->destination->name }}
            </small>
            <small class="flex-fill text-center border-end py-2">
                <i class="fa fa-calendar-alt text-primary me-2"></i>{{ \Carbon\Carbon::parse($package->date)->format('d M, Y') }}
            </small>
            <small class="flex-fill text-center py-2">
                <i class="fa fa-users text-primary me-2"></i>
                {{ $package->max_people - $totalBookings }} spots left
            </small>
        </div>
        
        <div class="text-center p-4">
            <h3 class="mb-0">{{ $package->price }}JD</h3>
            <p>{{ Str::limit($package->description, 50) }}</p>
            <div class="d-flex justify-content-center mb-2">
                @if($package->date >= now() && $package->is_available && !$isFullyBooked)
                <a href="{{ route('detailspackages', $package->id) }}" class="btn btn-sm btn-primary px-3" style="border-radius: 30px;">
                    Read More
                </a>
                @else
                <button class="btn btn-sm btn-secondary px-3" style="border-radius: 30px;" disabled>
                    {{ $isFullyBooked ? 'Fully Booked' : 'Unavailable' }}
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach


        </div>
    </div>
</div>
<!-- Package End -->

@include('components.footer')

<style>
    .expired-package {
        position: relative;
        opacity: 0.7;
        filter: grayscale(70%);
    }
    
    .expired-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #dc3545;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        z-index: 10;
        font-weight: bold;
    }
    
    .package-item {
        transition: all 0.3s ease;
    }
    
    .package-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .package-image-container {
        height: 350px; /* ارتفاع ثابت لجميع الحاويات */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .package-image {
      
        width: auto;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .package-item:hover .package-image {
        transform: scale(1.05);
    }

</style>