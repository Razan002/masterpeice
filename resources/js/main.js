(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    const translations = {
        en: {
            home: "Home",
            about: "About",
            services: "Services",
            packages: "Packages",
            shop: "Shop",
            pages: "Pages",
            destination: "Destination",
            booking: "Booking",
            guides: "Travel Guides",
            testimonial: "Testimonial",
            error: "404 Page",
            contact: "Contact",
            register: "Register",
            "Explore the Beauty of Al-Salt": "Explore the Beauty of Al-Salt",
            Search: "Search",
            description: "Discover the rich history, stunning landscapes, and unique cultural experiences of Al-Salt, Jordan. Whether you’re looking for ancient sites, scenic views, or local delights, we’ve got something special for you.",
            description2:"Discover the charm of Al-Salt, a city steeped in history and natural beauty. From its stunning architecture to its rich cultural heritage, Al-Salt offers a one-of-a-kind experience for every traveler."
        },
        ar: {
            home: "الصفحة الرئيسية",
            about: "حول",
            services: "الخدمات",
            packages: "الباقات",
            shop: "المتجر",
            pages: "الصفحات",
            destination: "الوجهات",
            booking: "الحجز",
            guides: "المرشدين السياحيين",
            testimonial: "الشهادات",
            error: "صفحة 404",
            contact: "اتصل بنا",
            register: "تسجيل",
            "Explore the Beauty of Al-Salt": "استكشف جمال السلط",
            Search: "بحث",
            description: "اكتشف التاريخ الغني، المناظر الخلابة، والتجارب الثقافية الفريدة في السلط، الأردن. سواء كنت تبحث عن مواقع أثرية، مناظر طبيعية، أو تجارب محلية مميزة، لدينا شيء خاص لك.",
            description2:"اكتشف سحر السلط، المدينة التي تزخر بالتاريخ والجمال الطبيعي. من هندستها المعمارية المذهلة إلى تراثها الثقافي الغني، تقدم السلط تجربة فريدة من نوعها لكل مسافر."









        }
    };

    // إضافة مستمع لتغيير اللغة
    document.getElementById("languageSwitcher").addEventListener("change", function() {
        const selectedLang = this.value;

        // ترجمة النصوص التي تحتوي على "data-lang"
        document.querySelectorAll("[data-lang]").forEach(element => {
            const key = element.getAttribute("data-lang");
            if (translations[selectedLang][key]) {
                element.textContent = translations[selectedLang][key];
            }
        });

        // ترجمة النصوص التي تحتوي على "data-lang-placeholder"
        document.querySelectorAll("[data-lang-placeholder]").forEach(element => {
            const key = element.getAttribute("data-lang-placeholder");
            if (translations[selectedLang][key]) {
                element.setAttribute("placeholder", translations[selectedLang][key]);
            }
        });
    });


    
})(jQuery);



