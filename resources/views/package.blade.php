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
</div>

<!-- Booking Form Start -->
{{-- <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="booking p-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-6">
                    <h1 class="text-white mb-4">Book A Tour</h1>
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select bg-transparent" id="package_id" name="package_id">
                                        <option value="">اختر الباقة</option>
                                        @foreach($packages as $package)
                                        <option value="{{ $package->id }}" 
                                            {{ !$package->is_available ? 'disabled style="color:#ccc"' : '' }}
                                            {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                            {{ $package->title }}
                                            @if(!$package->is_available)
                                                (غير متاحة)
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="package_id">اختر الباقة</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control bg-transparent" id="booking_date" name="booking_date" required>
                                    <label for="booking_date">تاريخ الحجز</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control bg-transparent" id="people_count" name="people_count" min="1" required>
                                    <label for="people_count">عدد الأشخاص</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-transparent" id="payment_method" name="payment_method" required>
                                        <option value="online">دفع إلكتروني</option>
                                        <option value="on_spot">دفع عند الوصول</option>
                                    </select>
                                    <label for="payment_method">طريقة الدفع</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-transparent" placeholder="ملاحظات إضافية" id="custom_package_details" name="custom_package_details" style="height: 100px"></textarea>
                                    <label for="custom_package_details">ملاحظات إضافية</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-light w-100 py-3" type="submit">احجز الآن</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-white">
                    <h6 class="text-white text-uppercase">الحجز</h6>
                    <h1 class="text-white mb-4">الحجز عبر الإنترنت</h1>
                    <p class="mb-4">يمكنك حجز رحلتك المفضلة بسهولة من خلال تعبئة النموذج. تأكد من اختيار الباقة المناسبة وتاريخ السفر.</p>
                    <p class="mb-4">سيتم تأكيد حجزك عبر البريد الإلكتروني، ويمكنك دفع المبلغ إلكترونياً أو عند الوصول حسب اختيارك.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Booking Form End -->

<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden">
                        @foreach($package->media as $media)
                            <img class="img-fluid" src="{{ asset('storage/images/' . $media->media) }}" alt="{{ $package->title }}">
                        @endforeach
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
                        <h3 class="mb-0">{{ $package->price }}JD</h3>
                        <div class="mb-3">
                            @for ($i = 0; $i < 5; $i++)
                                <small class="fa fa-star {{ $i < $package->rating ? 'text-primary' : 'text-muted' }}"></small>
                            @endfor
                        </div>
                        <p>{{ $package->description }}</p>
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

        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $packages->links() }}

        </div> --}}
    </div>
</div>
<!-- Package End -->

@include('components.footer')