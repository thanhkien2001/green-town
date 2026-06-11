export default function initSection10Swiper() {
    if (typeof Swiper === 'undefined') {
        return;
    }
    try {
        new Swiper('.s10-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1200, // Làm hiệu ứng lướt qua chậm và mượt hơn (1.2 giây)
            // autoplay: {
            //     delay: 5000,
            //     disableOnInteraction: false,
            // },
        });
    } catch (e) {
        console.error('Error initializing Section 10 Swiper:', e);
    }
}
