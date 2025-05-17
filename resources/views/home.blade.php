@include('components.header')
 
 
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown" data-lang="Explore the Beauty of Al-Salt">Explore the Beauty of Al-Salt</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown" data-lang="description">
                    Discover the rich history, stunning landscapes, and unique cultural experiences of Al-Salt, Jordan. Whether you’re looking for ancient sites, scenic views, or local delights, we’ve got something special for you.
                </p>
                
                {{-- <div class="position-relative w-75 mx-auto animated slideInDown">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Eg: Al-Salt Old Town, Mount Nebo" data-lang-placeholder="Eg: Al-Salt Old Town, Mount Nebo">
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;" data-lang="Search">Search</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>
 
 
 
 <!-- About Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="assets/img/about.jpg" alt="Al-Salt Tour" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h1 class="mb-4">Welcome to <span class="text-primary">Explore Al-Salt</span></h1>
                <p class="mb-4" data-lang="description2">Discover the charm of Al-Salt, a city steeped in history and natural beauty. From its stunning architecture to its rich cultural heritage, Al-Salt offers a one-of-a-kind experience for every traveler.</p>
                <p class="mb-4">Whether you’re exploring the historic sites, tasting the local cuisine, or hiking through its scenic landscapes, Al-Salt has something for everyone. Join us for an unforgettable journey through Jordan’s hidden gem.</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Historical Sites & Landmarks</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Traditional Cuisine Experiences</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Guided Cultural Tours</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Mountain Hikes & Scenic Views</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Local Artisan Shops</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Tourist Support</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="https://www.visitas-salt.com/ar/page/13/TheStory">Read More</a>
            </div>
        </div>
    </div>
</div>

<!-- About End -->





<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        
        <!-- Horizontal Scrolling Container -->
        <div class="services-horizontal-container">
            <button class="scroll-btn scroll-left" aria-label="Scroll left">
                <i class="fa fa-chevron-left"></i>
            </button>
            
            <div class="services-horizontal-wrapper">
                <div class="services-horizontal-track">
                    <!-- Service Items -->
                    <div class="service-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-map-marker-alt text-primary mb-4"></i>
                                <h5>Guided Tours</h5>
                                <p>Explore the hidden gems of Al-Salt with our experienced local guides</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                                <h5>Local Cuisine</h5>
                                <p>Indulge in Al-Salt's traditional flavors with our curated food tours</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-hiking text-primary mb-4"></i>
                                <h5>Scenic Hikes</h5>
                                <p>Join us on breathtaking hikes through Al-Salt's mountains and valleys</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-shopping-basket text-primary mb-4"></i>
                                <h5>Shopping Tours</h5>
                                <p>Discover Al-Salt's vibrant markets for local crafts and souvenirs</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                                <h5>Hotel Reservations</h5>
                                <p>We offer a wide range of accommodations in Al-Salt</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-calendar text-primary mb-4"></i>
                                <h5>Event Planning</h5>
                                <p>We specialize in organizing unique events and experiences</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="scroll-btn scroll-right" aria-label="Scroll right">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
        
        <!-- Pagination Dots -->
        <div class="horizontal-pagination-dots text-center mt-4">
            <span class="dot active" data-index="0" aria-label="Go to slide 1"></span>
            <span class="dot" data-index="1" aria-label="Go to slide 2"></span>
            <span class="dot" data-index="2" aria-label="Go to slide 3"></span>
            <span class="dot" data-index="3" aria-label="Go to slide 4"></span>
        </div>
    </div>
</div>

<style>
    /* Horizontal Scrolling Styles */
    .services-horizontal-container {
        position: relative;
        display: flex;
        align-items: center;
        margin: 0 auto;
        max-width: 1200px;
    }
    
    .services-horizontal-wrapper {
        width: 100%;
        overflow: hidden;
        scroll-behavior: smooth;
    }
    
    .services-horizontal-track {
        display: flex;
        transition: transform 0.5s ease;
        padding: 15px 0;
        gap: 20px;
    }
    
    .service-card {
        flex: 0 0 calc(33.333% - 20px);
        min-width: 300px;
        scroll-snap-align: start;
    }
    
    .service-item {
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .service-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .scroll-btn {
        background: #86B817;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        transition: all 0.3s;
        flex-shrink: 0;
    }
    
    .scroll-btn:hover {
        background: #86B817;
        transform: scale(1.1);
    }
    
    .scroll-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .scroll-left {
        margin-right: 15px;
    }
    
    .scroll-right {
        margin-left: 15px;
    }
    
    /* Pagination Dots */
    .horizontal-pagination-dots {
        text-align: center;
        margin-top: 30px;
    }
    
    .horizontal-pagination-dots .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        margin: 0 6px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .horizontal-pagination-dots .dot.active {
        background: #86B817;
        transform: scale(1.2);
    }
    
    .horizontal-pagination-dots .dot:hover:not(.active) {
        background: #bbb;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .service-card {
            flex: 0 0 calc(50% - 15px);
        }
    }
    
    @media (max-width: 768px) {
        .service-card {
            flex: 0 0 calc(100% - 10px);
        }
        
        .scroll-btn {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.services-horizontal-track');
    const dots = document.querySelectorAll('.horizontal-pagination-dots .dot');
    const prevBtn = document.querySelector('.scroll-left');
    const nextBtn = document.querySelector('.scroll-right');
    const wrapper = document.querySelector('.services-horizontal-wrapper');
    const cards = document.querySelectorAll('.service-card');
    
    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 20; // Including gap
    const visibleCards = Math.floor(wrapper.offsetWidth / cardWidth);
    const totalCards = cards.length;
    
    // Update button states
    function updateControls() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= totalCards - visibleCards;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }
    
    // Scroll to specific card
    function scrollToCard(index) {
        currentIndex = Math.max(0, Math.min(index, totalCards - visibleCards));
        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        updateControls();
    }
    
    // Dot click handler
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            scrollToCard(index * visibleCards);
        });
    });
    
    // Next button
    nextBtn.addEventListener('click', function() {
        scrollToCard(currentIndex + 1);
    });
    
    // Previous button
    prevBtn.addEventListener('click', function() {
        scrollToCard(currentIndex - 1);
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        scrollToCard(currentIndex);
    });
    
    // Initialize
    updateControls();
    
    // Optional: Auto-scroll (uncomment if desired)
    // setInterval(() => {
    //     if (!nextBtn.disabled) {
    //         nextBtn.click();
    //     } else {
    //         scrollToCard(0);
    //     }
    // }, 5000);
});
</script>


@include('homedestination')

@include('awesomepackeges')













@include('components.footer')
