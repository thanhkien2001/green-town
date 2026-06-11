export default function initSection11Swiper() {
    const sliderWrappers = document.querySelectorAll('.s11-slider-wrapper');
    sliderWrappers.forEach((wrapper) => {
        const swiperEl = wrapper.querySelector('.swiper');
        const nextEl = wrapper.querySelector('.s11-swiper-button-next');
        const prevEl = wrapper.querySelector('.s11-swiper-button-prev');
        
        if (swiperEl) {
            new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: nextEl,
                    prevEl: prevEl,
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }
            });
        }
    });
}
