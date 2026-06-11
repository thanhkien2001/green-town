export default function initSection6Swiper() {
    if (typeof Swiper === 'undefined') {
        return;
    }
    try {
        new Swiper('.s6-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: '.s6-swiper-button-next',
                prevEl: '.s6-swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                }
            }
        });
    } catch (e) {
        console.error('Error initializing Swiper:', e);
    }
}
