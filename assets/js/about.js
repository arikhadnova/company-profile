// about.js — pure JavaScript file. Do NOT include <script> tags here.
// Ensure Bootstrap and Swiper libraries are loaded separately in the page.

document.addEventListener('DOMContentLoaded', function () {
    // Efek Navbar saat Scroll — hanya jika elemen ada
    const nav = document.querySelector('.navbar');
    if (nav) {
        const onScroll = function () {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
                nav.classList.remove('navbar-dark');
                nav.classList.add('navbar-light');
            } else {
                nav.classList.remove('scrolled');
                nav.classList.add('navbar-dark');
                nav.classList.remove('navbar-light');
            }
        };
        // run once to set initial state
        onScroll();
        window.addEventListener('scroll', onScroll);
    }

    // Inisialisasi Slider Tim (Swiper) — hanya jika Swiper tersedia dan elemen ada
    if (typeof Swiper !== 'undefined' && document.querySelector('.teamSwiper')) {
        new Swiper('.teamSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 }
            }
        });
    }
});