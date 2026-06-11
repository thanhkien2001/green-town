export default function initSection12Swiper() {
    const sliderWrappers = document.querySelectorAll('.s12-slider-wrapper');
    sliderWrappers.forEach((wrapper) => {
        const swiperEl = wrapper.querySelector('.swiper');
        const nextEl = wrapper.querySelector('.s12-swiper-button-next');
        const prevEl = wrapper.querySelector('.s12-swiper-button-prev');
        
        if (swiperEl) {
            new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: false,
                navigation: {
                    nextEl: nextEl,
                    prevEl: prevEl,
                },
                breakpoints: {
                    768: { slidesPerView: 2, spaceBetween: 30 },
                    1024: { slidesPerView: 3, spaceBetween: 40 }
                }
            });
        }
    });
}
