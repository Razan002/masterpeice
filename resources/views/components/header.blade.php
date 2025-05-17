<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Sweet Alert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Spinner Start -->
    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                <h1 class="text-primary m-0">
                    <img src="/assets/img/saltist.jpg" alt="Saltist Logo" class="me-3" style="height: 1.2em;">Saltist
                </h1>            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active" data-lang="home">Home</a>
                    <a href="{{ route('destination.index') }}" class="nav-item nav-link" data-lang="about">Destination</a>
                    <a href="{{ route('package') }}" class="nav-item nav-link" data-lang="packages">Packages</a>
                    <a href="{{ route('shop') }}"class="nav-item nav-link">Shop</a>
{{--                     
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-lang="pages">Pages</a>
                        <div class="dropdown-menu m-0">
                            
                            <a href="{{ route('booking') }}" class="dropdown-item" data-lang="booking">Booking</a>
                            <a href="team.html" class="dropdown-item" data-lang="guides">Travel Guides</a>
                            <a href="testimonial.html" class="dropdown-item" data-lang="testimonial">Testimonial</a>
                            
                        </div>
                    </div> --}}
                    <a href="{{ route('contacts') }}" class="nav-item nav-link" data-lang="contact">Contact</a>
                </div>
    
                @auth
                    <!-- If the user is authenticated -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }} <!-- Display user's name -->
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('profile.show') }}" class="dropdown-item">
                                <i class="fas fa-user-circle me-2"></i>  profile
                            </a>
                            <a href="{{ route('logout') }}" class="dropdown-item" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <!-- Logout Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <!-- If the user is not authenticated -->
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4" data-lang="login">Login</a>
                @endauth
            </div>
                <!-- Cart Icon -->
    <a href="{{ route('cart') }}" class="nav-item nav-link">
        <i class="fas fa-shopping-cart"></i> <!-- Font Awesome Cart Icon -->
    </a>
        </nav>
    </div>

    <script>
        @if(session('success'))
   
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonText: 'موافق',
            timer: 3000
        }).then((result) => {
           
        });
    
@endif
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('bookingModal');
            const btn = document.getElementById('bookNowBtn');
            const closeBtns = document.querySelectorAll('.close-modal');
            
            // عند الضغط على زر الحجز
            btn.onclick = function() {
                modal.style.display = 'block';
            }
            
            // عند الضغط على زر الإغلاق
            closeBtns.forEach(function(closeBtn) {
                closeBtn.onclick = function() {
                    modal.style.display = 'none';
                }
            });
            
            // إغلاق النافذة عند الضغط خارجها
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
            
            
            // تحديد أن التاريخ لا يمكن أن يكون قبل اليوم
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="booking_date"]').min = today;
            
            // إرسال بيانات الحجز
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('تم الحجز بنجاح!');
                        modal.style.display = 'none';
                        window.location.reload();
                    } else {
                        alert('خطأ: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert  ('تم الحجز بنجاح')
                });
            });
        });
        </script>

        
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>