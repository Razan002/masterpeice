<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($packages->take(3) as $package)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden">
                        @if($package->media->isNotEmpty())
                            <img class="img-fluid" src="{{ asset('storage/images/' . $package->media->first()->media) }}" alt="{{ $package->title }}">
                        @endif
                    </div>
                    <div class="d-flex border-bottom">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->destination->name }}
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-calendar-alt text-primary me-2"></i>{{ \Carbon\Carbon::parse($package->travel_date)->format('d M, Y') }}
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-user text-primary me-2"></i>{{ $package->max_people }} Person
                        </small>
                    </div>
                    <div class="text-center p-4">
                        <h3 class="mb-0">{{ $package->price }}$</h3>
                        <div class="mb-3">
                            @for ($i = 0; $i < 5; $i++)
                                <small class="fa fa-star {{ $i < $package->rating ? 'text-primary' : 'text-muted' }}"></small>
                            @endfor
                        </div>
                        <p>{{ Str::limit($package->description, 100) }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{ route('detailspackages', $package->id) }}" class="btn btn-sm btn-primary px-3" style="border-radius: 30px;">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Package End -->