<!-- Footer Start -->
<div class="bg-dark text-light footer pt-4 mt-4 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-3" style="max-width: 1200px;"> <!-- Added max-width constraint -->
        <div class="row g-3"> <!-- Reduced gutter spacing -->
            <!-- Company Column -->
            <div class="col-lg-2 col-md-4"> <!-- Narrower columns -->
                <h5 class="text-white mb-2">Company</h5> <!-- Smaller heading -->
                <div class="d-flex flex-column">
                    <a class="text-light mb-1 small" href="">About Us</a>
                    <a class="text-light mb-1 small" href="">Contact Us</a>
                    <a class="text-light mb-1 small" href="">Privacy Policy</a>
                    <a class="text-light mb-1 small" href="">Terms & Condition</a>
                    <a class="text-light mb-1 small" href="">FAQs & Help</a>
                </div>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-4">
                <h5 class="text-white mb-2">Contact</h5>
                <p class="mb-1 small"><i class="fa fa-map-marker-alt me-2"></i>Salt, Jordan</p>
                <p class="mb-1 small"><i class="fa fa-phone-alt me-2"></i>+962775129273</p>
                <p class="mb-1 small"><i class="fa fa-envelope me-2"></i>abbadirazan02@gmail.com</p>
                <div class="d-flex pt-1">
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Gallery Column -->
            <div class="col-lg-3 col-md-4">
                <h5 class="text-white mb-2">Gallery</h5>
                <div class="row g-1"> <!-- Tighter grid spacing -->
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-1.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/package-3.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/ph4.jpeg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/package-3.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/package-1.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                </div>
            </div>

            <!-- Newsletter Column -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-2">Newsletter</h5>
                <p class="small">Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative" style="max-width: 300px;">
                    <input class="form-control form-control-sm border-primary w-100 py-2 ps-3 pe-4" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-sm btn-primary py-1 px-2 position-absolute top-0 end-0 mt-1 me-1">SignUp</button>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="copyright mt-3 pt-3 border-top">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <span class="small">&copy; <a class="text-light" href="#">Your Site Name</a>, All Rights Reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a class="text-light small mx-2" href="">Home</a>
                        <a class="text-light small mx-2" href="">Cookies</a>
                        <a class="text-light small mx-2" href="">Help</a>
                        <a class="text-light small mx-2" href="">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<!-- Sweet Alert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>