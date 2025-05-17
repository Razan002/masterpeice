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
                <p class="mb-1 small"><i class="fa fa-phone-alt me-2"></i>+962799330092</p>
                <div class="d-flex pt-1">
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href="https://www.instagram.com/saltdevelopmentcorporation?igsh=MTFydW4yNnU2eGZkaA=="><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-sm btn-social m-1" href="https://m.facebook.com/SaltDevelopmentCorporation/"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>

            <!-- Gallery Column -->
            <div class="col-lg-3 col-md-4">
                <h5 class="text-white mb-2">Gallery</h5>
                <div class="row g-1"> <!-- Tighter grid spacing -->
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/package-4.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="" style="max-height: 60px;">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('assets/img/del1.jpg') }}" alt="" style="max-height: 60px;">
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
<script>
    $(document).ready(function() {
        // زيادة الكمية
        $(document).on('click', '.quantity-plus', function() {
            let input = $(this).siblings('.quantity-input');
            let currentVal = parseInt(input.val());
            input.val(currentVal + 1).trigger('change');
        });
    
        // تقليل الكمية
        $(document).on('click', '.quantity-minus', function() {
            let input = $(this).siblings('.quantity-input');
            let currentVal = parseInt(input.val());
            if (currentVal > 1) {
                input.val(currentVal - 1).trigger('change');
            }
        });
    
        // تحديث عند تغيير القيمة
        $(document).on('change', '.quantity-input', function() {
            let form = $(this).closest('.quantity-form');
            updateCartItem(form);
        });
    
        // دالة AJAX لتحديث الكمية
        function updateCartItem(form) {
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    updateCartTotals();
                },
                error: function(xhr) {
                    alert('Error updating quantity');
                    location.reload(); // إعادة تحميل الصفحة في حالة خطأ
                }
            });
        }
    
        // دالة لتحديث المجاميع
        function updateCartTotals() {
            let subtotal = 0;
            
            $('table tbody tr').each(function() {
                let price = parseFloat($(this).find('td:nth-child(3)').text().replace('$', ''));
                let quantity = parseInt($(this).find('.quantity-input').val());
                let total = price * quantity;
                $(this).find('td:nth-child(5)').text('$' + total.toFixed(2));
                subtotal += total;
            });
            
            // تحديث ملخص الطلب
            $('.order-summary .d-flex:first span:last').text('$' + subtotal.toFixed(2));
            $('.order-summary .fw-bold span:last').text('$' + subtotal.toFixed(2));
        }
    });
    </script>
</body>
</html>