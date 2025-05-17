@include('components.app')

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 text-dark fw-bold mb-1">Add New Tour Package</h1>
            <p class="text-muted mb-0">Fill out the form to create a new tour package</p>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>

    <div class="card border-0 shadow-lg">
        <div class="card-header text-white py-3" style="background-color: #86B817;">

            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Basic Package Information</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="row g-4">
                    <!-- First Column -->
                    <div class="col-lg-6">
                        <!-- Package Title -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter package title" required>
                            <label for="title" class="text-muted">Package Title <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">Please enter package title</div>
                        </div>

                        <!-- Description -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" placeholder="Enter package description" style="height: 120px" required></textarea>
                            <label for="description" class="text-muted">Description <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">Please enter package description</div>
                        </div>

                        <!-- Package Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label text-muted">Package Type <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="type" name="type" required>
                                <option value="" selected disabled>Select package type</option>
                                <option value="adventure"><i class="fas fa-hiking me-2"></i> Adventure</option>
                                <option value="heritage"><i class="fas fa-landmark me-2"></i> Heritage</option>
                                <option value="cultural_food"><i class="fas fa-utensils me-2"></i> Cultural Food</option>
                                <option value="spiritual"><i class="fas fa-pray me-2"></i> Spiritual</option>
                            </select>
                            <div class="invalid-feedback">Please select package type</div>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-lg-6">
                        <!-- Max People -->
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="max_people" name="max_people" placeholder="Enter maximum number of people" min="1" required>
                            <label for="max_people" class="text-muted">Max People <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">Please enter a positive number</div>
                        </div>

                        <!-- Meal Type -->
                        <div class="mb-3">
                            <label for="meal" class="form-label text-muted">Meal Type</label>
                            <select class="form-select form-select-lg" id="meal" name="meal">
                                <option value="" selected>No meal included</option>
                                <option value="Breakfast"><i class="fas fa-coffee me-2"></i> Breakfast</option>
                                <option value="Lunch"><i class="fas fa-hamburger me-2"></i> Lunch</option>
                                <option value="Dinner"><i class="fas fa-moon me-2"></i> Dinner</option>
                            </select>
                        </div> 

                        <!-- Tour Guide -->
                        <div class="mb-3">
                            <label for="guide_id" class="form-label text-muted">Tour Guide <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="guide_id" name="guide_id" required>
                                <option value="" disabled selected>Select tour guide</option>
                                @foreach($guides as $guide)
                                    <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a tour guide</div>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="text-muted">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-money-bill-wave" style="color: #86B817;"></i>
                                </i></span>
                                <input type="number" step="0.01" class="form-control border-start-0" id="price" name="price" placeholder="Price" min="0" required>
                                <span class="input-group-text bg-light">JOD</span>
                                
                            </div>
                            <div class="invalid-feedback">Please enter a valid price</div>
                        </div>
                    </div>
                </div>

                <!-- Additional Options Section -->
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="card border-primary mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-hotel" style="color: #86B817;"></i>
                                </i> Accommodation Options</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="has_hotel" name="has_hotel" value="1">
                                    <label class="form-check-label" for="has_hotel">Includes hotel stay</label>
                                </div>
                                <div id="hotel_options" style="display: none;">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Hotel name">
                                        <label for="hotel_name">Hotel Name</label>
                                    </div>
                                    <div class="form-floating">
                                        <select class="form-select" id="hotel_rating" name="hotel_rating">
                                            <option value="3">3 Stars</option>
                                            <option value="4">4 Stars</option>
                                            <option value="5">5 Stars</option>
                                        </select>
                                        <label for="hotel_rating">Hotel Rating</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-info mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-university" style="color: #86B817;"></i>
                                </i> Museum Visits</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="has_museum" name="has_museum" value="1">
                                    <label class="form-check-label" for="has_museum">Includes museum visit</label>
                                </div>
                                <div id="museum_options" style="display: none;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="museum_name" name="museum_name" placeholder="Museum name">
                                        <label for="museum_name">Museum Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- صورة الغلاف -->
{{-- @if($coverImage)
<img src="{{ asset('storage/package_images/' . $coverImage->file_name) }}" 
     class="img-fluid">
@endif --}}

<!-- صور المعرض -->
{{-- <div class="row">
    @foreach($galleryImages as $image)
    <div class="col-md-3 mb-3">
        <img src="{{ asset('storage/package_images/gallery/' . $image->file_name) }}" 
             class="img-thumbnail">
    </div>
    @endforeach
</div>
                <!-- Timing Section --> --}}
                <div class="card border-success mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-clock" style="color: #86B817;"></i>
                        </i> Package Timing</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" required>
                                    <label for="date" class="text-muted">Date <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">Please select a valid date</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                    <label for="start_time" class="text-muted">Start Time <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">Please specify start time</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                    <label for="end_time" class="text-muted">End Time <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">Please specify end time</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images Section (commented out) -->
                {{-- <div class="card border-warning mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-images text-warning me-2"></i> Package Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cover_image" class="form-label text-muted">Cover Image <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="cover_image" name="cover_image" accept="image/*" required>
                            <div class="invalid-feedback">Please upload a package image</div>
                            <div class="form-text">Image that will appear as package cover</div>
                        </div>
                        <div class="mb-3">
                            <label for="gallery_images" class="form-label text-muted">Additional Images</label>
                            <input class="form-control" type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                            <div class="form-text">You can select multiple images</div>
                        </div>
                    </div>
                </div> --}}
       
                <!-- Save Buttons -->
                <div class="d-flex justify-content-between mt-5">
                    
                    <button type="submit" class="btn rounded-pill px-4 shadow-sm" style="background-color: #86B817; border-color: #86B817;">
                        <i class="fas fa-save me-2"></i> Save Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Enable form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Show/hide hotel options
    document.getElementById('has_hotel').addEventListener('change', function() {
        const hotelOptions = document.getElementById('hotel_options');
        hotelOptions.style.display = this.checked ? 'block' : 'none';
        if (this.checked) {
            document.getElementById('hotel_name').required = true;
        } else {
            document.getElementById('hotel_name').required = false;
        }
    });

    // Show/hide museum options
    document.getElementById('has_museum').addEventListener('change', function() {
        const museumOptions = document.getElementById('museum_options');
        museumOptions.style.display = this.checked ? 'block' : 'none';
        if (this.checked) {
            document.getElementById('museum_name').required = true;
        } else {
            document.getElementById('museum_name').required = false;
        }
    });
</script>