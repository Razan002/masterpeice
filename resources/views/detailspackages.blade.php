@include('components.header')

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Down Town</h1>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container py-5">
    <div class="row">
        <!-- Left Section with 5 Images -->
        <div class="col-md-6">
            <div class="row">
                <div class="col-12 mb-4">
                    <img src="assets\img\del1.jpg" alt="Image 1" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" alt="Image 2" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" alt="Image 3" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" alt="Image 4" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" alt="Image 5" class="img-fluid rounded">
                </div>
            </div>
        </div>
        
        <!-- Right Section with Details -->
        <div class="col-md-6">
            <h2 class="mb-4">Downtown Details</h2>
            <p class="lead">Explore the vibrant heart of the city</p>
            
            <div class="mb-4">
                <h4>About Downtown</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
            </div>
            
            <div class="mb-4">
                <h4>Features</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Historic Architecture</li>
                    <li class="list-group-item">Shopping Districts</li>
                    <li class="list-group-item">Fine Dining</li>
                    <li class="list-group-item">Cultural Centers</li>
                    <li class="list-group-item">Nightlife</li>
                </ul>
            </div>
            
            <div class="mb-4">
                <h4>Contact Information</h4>
                <p><i class="fa fa-map-marker-alt"></i> 123 Main Street, Downtown</p>
                <p><i class="fa fa-phone"></i> (123) 456-7890</p>
                <p><i class="fa fa-envelope"></i> info@downtown.com</p>
            </div>

            <!-- Book Now Button -->
            <div class="text-center mt-4">
                <button class="btn btn-primary btn-lg px-4 py-2">
                    Book Now
                </button>
            </div>
        </div>
    </div>
</div>

@include('components.footer')