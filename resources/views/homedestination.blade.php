
<!-- Popular Destinations Start -->
<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
    <h6 class="section-title bg-white text-center text-primary px-3"> Destinations</h6>
    <h1 class="mb-5">Latest Destinations</h1>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-3">
            @foreach($destinations as $destination)
                <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <a class="position-relative d-block overflow-hidden" href="{{ route('destination.show', $destination->id) }}">
                        <img class="img-fluid" src="{{ url('storage/images/' . $destination->image) }}" alt="{{ $destination->name }}">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">{{ $destination->discount }}% OFF</div>
                        <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">{{ $destination->name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Popular Destinations End -->