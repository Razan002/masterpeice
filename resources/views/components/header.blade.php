<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

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
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Saltist</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active" data-lang="home">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link" data-lang="about">About</a>
                    <a href="{{ route('package') }}" class="nav-item nav-link" data-lang="packages">Packages</a>
                    <a href="{{ route('shop') }}"class="nav-item nav-link">Shop</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-lang="pages">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('destination.index') }}" class="dropdown-item" data-lang="destination">Destination</a>
                            <a href="{{ route('booking') }}" class="dropdown-item" data-lang="booking">Booking</a>
                            <a href="team.html" class="dropdown-item" data-lang="guides">Travel Guides</a>
                            <a href="testimonial.html" class="dropdown-item" data-lang="testimonial">Testimonial</a>
                            <a href="404.html" class="dropdown-item" data-lang="error">404 Page</a>
                        </div>
                    </div>
                    <a href="{{ route('contacts') }}" class="nav-item nav-link" data-lang="contact">Contact</a>
                </div>
    
                @auth
                    <!-- If the user is authenticated -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }} <!-- Display user's name -->
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('profile') }}" class="dropdown-item">
                                <i class="fas fa-user-circle me-2"></i>  
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
        </nav>
    </div>
    