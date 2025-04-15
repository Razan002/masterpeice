@include('components.header')
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Destinations</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Destinations</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Destination Start -->
<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
    <h6 class="section-title bg-white text-center text-primary px-3">Destinations</h6>
    <h1 class="mb-5">All Destinations</h1>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-3">
            @foreach ($destinations as $destination)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="position-relative d-block overflow-hidden">
                        <a href="{{ route('destination.show', $destination->id) }}">
                            <img class="img-fluid" src="{{ Storage::url('images/'. $destination->image) }}" alt="{{ $destination->name }}">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">
                                @if($destination->discount)
                                    {{ $destination->discount }}% OFF
                                @endif
                            </div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                {{ $destination->name }}
                            </div>
                        </a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">{{ $destination->name }}</h5>
                        <small class="text-body">{{ $destination->location }}</small>
                        <div class="d-flex justify-content-center mt-2">
                            @if($destination->price > 0)
                                <h5 class="text-primary mb-0">{{ $destination->price }} JOD</h5>
                            @else
                                <h5 class="text-success mb-0">FREE</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Destination End -->

@include('components.footer')