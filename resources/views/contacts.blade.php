@include('components.header')
 
 
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Contact Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->


<!-- Contact Start -->
<div class="container-xxl py-5">
<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
        <h1 class="mb-5">Contact For Any Query</h1>
    </div>
    <div class="row g-4">
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <h5>Get In Touch</h5>
            <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos</p>
            <div class="d-flex align-items-center mb-4">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                    <i class="fa fa-map-marker-alt text-white"></i>
                </div>
                <div class="ms-3">
                    <h5 class="text-primary">Office</h5>
                    <p class="mb-0"> Salt Development corporation     </p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                    <i class="fa fa-phone-alt text-white"></i>
                </div>
                <div class="ms-3">
                    <h5 class="text-primary">Mobile</h5>
                    <p class="mb-0">0775129273</p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                    <i class="fa fa-envelope-open text-white"></i>
                </div>
                <div class="ms-3">
                    <h5 class="text-primary">Email</h5>
                    <p class="mb-0">salt @example.com</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s"  >
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3382.1657438783627!2d35.72596057547277!3d32.03770487398128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151cbd45485b210b%3A0x2405b7d0f04f184c!2sAges%20Salt%20Salt%20Cultural%20Foundation%20_mrkz!5e0!3m2!1sen!2sjo!4v1746219075137!5m2!1sen!2sjo" width="800" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
            {{-- <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                            <label for="name">Your Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                            <label for="email">Your Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                            <label for="subject">Subject</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                            <label for="message">Message</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
</div>
</div>
<!-- Contact End -->
@include('components.footer')