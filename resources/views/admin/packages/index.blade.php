@include('components.app')

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="h2 text-dark fw-bold">Tour Packages Management</h1>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-plus me-2"></i> Add New Package
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-5 border-0 shadow-sm">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($packages->isEmpty())
        <div class="text-center py-5 my-5">
            <div class="empty-state">
                <img src="{{ asset('images/empty-packages.svg') }}" alt="No packages available" style="height: 180px;" class="mb-4">
                <h3 class="h4">No Packages Available</h3>
                <p class="text-muted mb-4">You can start by adding new tour packages to display here</p>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary px-4 shadow-sm">
                    <i class="fas fa-plus me-2"></i> Add New Package
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($packages as $package)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 package-card">
                    <div class="card-img-container">
@if($package->media->isNotEmpty())
    <img src="{{ asset('storage/' . $package->media->first()->media) }}" alt="{{ $package->title }}" class="card-img-top">
@else
    <p class="text-center py-5">No image available</p>
@endif                        <span class="package-type">{{ $package->type }}</span>
                        <div class="package-overlay"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $package->title }}</h5>
                            <div class="package-rating">
                                <i class="fas fa-star text-warning"></i>
                                <small>4.8</small>
                            </div>
                        </div>
                        
                        <div class="package-destination mb-2">
                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                            <small>{{ $package->destination?->name ?? 'Multiple Destinations' }}</small>
                        </div>
                        
                        <p class="card-text text-muted">{{ Str::limit($package->description, 90) }}</p>
                        
                        <div class="package-features mb-3">
                            <div class="feature-item">
                                <i class="fas fa-user-friends"></i>
                                <span>{{ $package->max_people }} People</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-utensils"></i>
                                <span>{{ $package->meal ?? 'No meals included' }}</span>
                            </div>
                            @if($package->has_hotel)
                            <div class="feature-item">
                                <i class="fas fa-hotel"></i>
                                <span>Includes hotel</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="price-container mt-auto">
                            <div class="price-wrapper">
                                <span class="price">{{ number_format($package->price) }}</span>
                                <span class="currency">Dinar</span>
                            </div>
                            <div class="duration">
                                <i class="fas fa-clock"></i>
                                <span>{{ $package->duration }} Days</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-action btn-edit w-50">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action btn-delete w-100" onclick="return confirm('Are you sure you want to delete this package?')">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $packages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    /* General card styling */
    .package-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Package image styling */
    .card-img-container {
        height: 160px;
        overflow: hidden;
        position: relative;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .package-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
        z-index: 1;
    }

    .package-card:hover .card-img-top {
        transform: scale(1.1);
    }

    /* Package type badge */
    .package-type {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* Card content styling */
    .card-body {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2b2d42;
        margin-bottom: 4px;
    }

    .package-rating {
        background: rgba(255, 255, 255, 0.9);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .package-destination {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .card-text {
        color: #6c757d;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Features styling */
    .package-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        color: #495057;
    }

    .feature-item i {
        margin-left: 4px;
        font-size: 12px;
        color: #4361ee;
    }

    /* Price styling */
    .price-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px dashed #e9ecef;
    }

    .price-wrapper {
        display: flex;
        align-items: baseline;
    }

    .price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #4361ee;
    }

    .currency {
        font-size: 12px;
        color: #6c757d;
        margin-right: 4px;
    }

    .duration {
        display: flex;
        align-items: center;
        font-size: 13px;
        color: #6c757d;
    }

    .duration i {
        margin-left: 4px;
    }

    /* Button styling */
    .card-footer {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 12px 16px;
    }

    .btn-action {
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
    }

    .btn-edit {
        background: rgba(67, 97, 238, 0.1);
        color: #91c62e;
    }

    .btn-edit:hover {
        background:  #91c62e;
        color: white;
    }

    .btn-delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    /* Empty state styling */
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }

    /* Animation effects */
    .package-item {
        animation: fadeInUp 0.5s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive for small screens */
    @media (max-width: 768px) {
        .card-img-container {
            height: 140px;
        }
        
        .card-title {
            font-size: 1rem;
        }
        
        .package-features {
            gap: 6px;
        }
        
        .feature-item {
            font-size: 11px;
            padding: 3px 8px;
        }
    }
</style>